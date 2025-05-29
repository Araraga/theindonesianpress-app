<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Like;
use App\Models\Comment;
use App\Models\Bookmark;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    public function create()
    {
        $genres = [
            'Bisnis & Tenaga Kerja',
            'Seni & Budaya',
            'Sains',
            'Olahraga',
            'Foto',
            'Ilustrasi',
            'Video',
            'Majalah',
            'Teka-Teki',
            'Opini', // Tambah genre Opini
        ];
        return view('write-article', compact('genres'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subheadline' => 'required|string|max:255',
            'content' => 'required',
            'genre' => 'required|string',
            'featured_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if (!$request->hasFile('featured_image')) {
            \Log::error('File tidak diterima server!');
            return back()->withErrors(['featured_image' => 'File tidak diterima server!'])->withInput();
        }

        $image = $request->file('featured_image');
        $imageName = time().'_'.Str::random(8).'.'.$image->getClientOriginalExtension();
        $uploadResult = $image->storeAs('articles', $imageName);
        if (!$uploadResult) {
            \Log::error('Gagal upload file ke storage!', ['imageName' => $imageName]);
            return back()->withErrors(['featured_image' => 'Gagal upload file ke storage!'])->withInput();
        }
        \Log::info('Upload file berhasil', ['path' => $uploadResult]);

        $slug = Str::slug($request->title);
        // Pastikan slug unik
        $originalSlug = $slug;
        $i = 1;
        while (Article::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $i;
            $i++;
        }

        $article = Article::create([
            'user_id' => Auth::id(),
            'genre' => $request->genre,
            'title' => $request->title,
            'slug' => $slug,
            'subheadline' => $request->subheadline,
            'content' => $request->content,
            'featured_image' => 'articles/'.$imageName,
            'excerpt' => Str::limit(strip_tags($request->content), 150),
            'status' => 'published', // status default
            'published_at' => now(),
        ]);

        return redirect()->route('dashboard')->with('success', 'Artikel berhasil disimpan!');
    }

    public function dashboard(Request $request)
    {
        $query = Article::orderByDesc('published_at')
            ->where('status', 'published');

        // Filter by genre if present
        // Mapping slug ke nama genre asli
        $genreMap = [
            'bisnis' => 'Bisnis & Tenaga Kerja',
            'fitur' => 'Fitur',
            'opini' => 'Opini',
            'seni' => 'Seni & Budaya',
            'sains' => 'Sains',
            'olahraga' => 'Olahraga',
            'foto' => 'Foto',
            'ilustrasi' => 'Ilustrasi',
            'video' => 'Video',
            'majalah' => 'Majalah',
            'teka-teki' => 'Teka-Teki',
        ];
        $selectedGenre = null;
        if ($request->has('genre') && $request->genre) {
            $genreKey = strtolower($request->genre);
            $genreName = $genreMap[$genreKey] ?? $request->genre;
            $query->where('genre', $genreName);
            $selectedGenre = $genreName;
        }

        $articles = $query->get();

        // Headline: artikel dengan skor tertinggi minggu ini (view_count + 2*like_count)
        $headline = Article::withCount('likes')
            ->where('status', 'published')
            ->when($selectedGenre, function($q) use ($selectedGenre) {
                $q->where('genre', $selectedGenre);
            })
            ->whereBetween('published_at', [now()->startOfWeek(), now()->endOfWeek()])
            ->get()
            ->sortByDesc(function($a) {
                return $a->view_count + 2 * $a->likes_count;
            })
            ->first();
        $headline2 = $headline ? Article::withCount('likes')
            ->where('status', 'published')
            ->when($selectedGenre, function($q) use ($selectedGenre) {
                $q->where('genre', $selectedGenre);
            })
            ->whereBetween('published_at', [now()->startOfWeek(), now()->endOfWeek()])
            ->where('id', '!=', $headline->id)
            ->get()
            ->sortByDesc(function($a) {
                return $a->view_count + 2 * $a->likes_count;
            })
            ->first() : null;
        // Top 3 populer: 3 artikel dengan skor tertinggi (view_count + 2*like_count), TIDAK exclude headline
        $top3 = Article::withCount('likes')
            ->where('status', 'published')
            ->when($selectedGenre, function($q) use ($selectedGenre) {
                $q->where('genre', $selectedGenre);
            })
            ->get()
            ->sortByDesc(function($a) {
                return $a->view_count + 2 * $a->likes_count;
            })
            ->take(3)
            ->values();
        // ICYMI: 3 artikel random selain headline & top3
        $excludeIds = collect([$headline?->id, $headline2?->id])->merge($top3->pluck('id'))->filter();
        $icymi = $articles->whereNotIn('id', $excludeIds)->shuffle()->take(3);
        // Ambil semua genre unik
        $allGenres = Article::query()->select('genre')->distinct()->pluck('genre');

        return view('dashboard', [
            'articles' => $articles,
            'headline' => $headline,
            'headline2' => $headline2,
            'top3' => $top3,
            'icymi' => $icymi,
            'allGenres' => $allGenres,
            'selectedGenre' => $selectedGenre,
        ]);
    }

    public function show($id)
    {
        $article = \App\Models\Article::with('user')->findOrFail($id);
        // Tambah view_count setiap kali artikel dibuka
        $article->increment('view_count');
        return view('article', compact('article'));
    }

    public function edit($id)
    {
        $article = Article::findOrFail($id);
        if ($article->user_id !== Auth::id()) {
            abort(403, 'Anda tidak berhak mengedit artikel ini.');
        }
        $genres = [
            'Bisnis & Tenaga Kerja',
            'Seni & Budaya',
            'Sains',
            'Olahraga',
            'Foto',
            'Ilustrasi',
            'Video',
            'Majalah',
            'Teka-Teki',
            'Opini',
        ];
        return view('edit-article', compact('article', 'genres'));
    }

    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id);
        if ($article->user_id !== Auth::id()) {
            abort(403, 'Anda tidak berhak mengedit artikel ini.');
        }
        $request->validate([
            'title' => 'required|string|max:255',
            'subheadline' => 'required|string|max:255',
            'content' => 'required',
            'genre' => 'required|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $article->title = $request->title;
        $article->subheadline = $request->subheadline;
        $article->content = $request->content;
        $article->genre = $request->genre;
        if ($request->hasFile('featured_image')) {
            $image = $request->file('featured_image');
            $imageName = time().'_'.Str::random(8).'.'.$image->getClientOriginalExtension();
            $uploadResult = $image->storeAs('articles', $imageName);
            if ($uploadResult) {
                $article->featured_image = 'articles/'.$imageName;
            }
        }
        $article->save();
        return redirect()->route('artikel.show', $article->id)->with('success', 'Artikel berhasil diperbarui!');
    }

    public function like($id)
    {
        $article = Article::findOrFail($id);
        $user = Auth::user();
        if (!$user) return redirect()->back();
        $like = $article->likes()->where('user_id', $user->id)->first();
        if ($like) {
            // Jika sudah like, maka unlike
            $like->delete();
        } else {
            // Jika belum like, maka like
            $article->likes()->create(['user_id' => $user->id]);
        }
        return response()->json(['likes' => $article->likes()->count()]);
    }

    public function dislike($id)
    {
        $article = Article::findOrFail($id);
        $user = Auth::user();
        if (!$user) return redirect()->back();
        $article->likes()->where('user_id', $user->id)->delete();
        return response()->json(['likes' => $article->likes()->count()]);
    }

    public function comment(Request $request, $id)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);
        $article = Article::findOrFail($id);
        $user = Auth::user();
        if (!$user) return response()->json(['error' => 'Unauthorized'], 401);
        $comment = $article->comments()->create([
            'user_id' => $user->id,
            'content' => $request->content,
            'is_approved' => true, // Atau false jika ingin moderasi
        ]);
        // Render HTML komentar baru (1 baris saja)
        $commentHtml = view('components.comment', compact('comment'))->render();
        return response()->json(['commentHtml' => $commentHtml]);
    }

    public function editComment(Request $request, $commentId)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);
        $comment = \App\Models\Comment::findOrFail($commentId);
        if ($comment->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        $comment->content = $request->content;
        $comment->save();
        return response()->json(['content' => $comment->content]);
    }

    public function bookmark($id)
    {
        $article = Article::findOrFail($id);
        $user = Auth::user();
        if (!$user) return response()->json(['error' => 'Unauthorized'], 401);
        if (!$article->bookmarks()->where('user_id', $user->id)->exists()) {
            $article->bookmarks()->create(['user_id' => $user->id]);
        }
        return response()->json(['bookmarked' => true]);
    }

    public function unbookmark($id)
    {
        $article = Article::findOrFail($id);
        $user = Auth::user();
        if (!$user) {
            if (request()->expectsJson()) {
                return response()->json(['error' => 'Unauthorized'], 401);
            } else {
                return redirect()->route('bookmarks')->with('error', 'Anda harus login.');
            }
        }
        $article->bookmarks()->where('user_id', $user->id)->delete();
        if (request()->expectsJson()) {
            return response()->json(['bookmarked' => false]);
        } else {
            return redirect()->route('bookmarks')->with('success', 'Bookmark berhasil dihapus.');
        }
    }

    public function bookmarks()
    {
        $user = Auth::user();
        $bookmarks = $user ? $user->bookmarks()->with('article')->latest()->get() : collect();
        return view('bookmarks', compact('bookmarks'));
    }

    // AJAX search for article titles (dropdown)
    public function searchTitles(Request $request)
    {
        $q = $request->get('q', '');
        $results = [];
        if (strlen($q) > 1) {
            // Cari hanya dari headline dan headline2 minggu ini
            $headline = Article::withCount('likes')
                ->where('status', 'published')
                ->whereBetween('published_at', [now()->startOfWeek(), now()->endOfWeek()])
                ->get()
                ->sortByDesc(function($a) {
                    return $a->view_count + 2 * $a->likes_count;
                })
                ->first();
            $headline2 = $headline ? Article::withCount('likes')
                ->where('status', 'published')
                ->whereBetween('published_at', [now()->startOfWeek(), now()->endOfWeek()])
                ->where('id', '!=', $headline->id)
                ->get()
                ->sortByDesc(function($a) {
                    return $a->view_count + 2 * $a->likes_count;
                })
                ->first() : null;
            $ids = collect([$headline?->id, $headline2?->id])->filter()->unique();
            $results = Article::whereIn('id', $ids)
                ->where(function($query) use ($q) {
                    $query->where('title', 'like', "%$q%")
                        ->orWhere('subheadline', 'like', "%$q%")
                        ;
                })
                ->get(['id', 'title']);
        }
        return response()->json($results);
    }

    // Search result page
    public function search(Request $request)
    {
        $q = $request->get('q', '');
        $articles = collect();
        if (strlen($q) > 1) {
            $articles = Article::where('status', 'published')
                ->where(function($query) use ($q) {
                    $query->where('title', 'like', "%$q%")
                        ->orWhere('subheadline', 'like', "%$q%")
                        ->orWhere('content', 'like', "%$q%")
                        ;
                })
                ->orderByDesc('published_at')
                ->paginate(12);
        } else {
            $articles = Article::where('status', 'published')->orderByDesc('published_at')->paginate(12);
        }
        return view('search-results', compact('q', 'articles'));
    }

    /**
     * Hapus artikel (khusus penulis)
     */
    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        if ($article->user_id !== Auth::id()) {
            abort(403, 'Anda tidak berhak menghapus artikel ini.');
        }
        $article->delete();
        return redirect()->route('dashboard')->with('success', 'Artikel berhasil dihapus.');
    }
}
