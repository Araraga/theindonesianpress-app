<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Str;

class CategoryManager extends Component
{
    use WithPagination;

    public $search = '';
    public $name = '';
    public $description = '';
    public $editingId = null;
    public $showModal = false;

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
    ];

    protected $messages = [
        'name.required' => 'Nama kategori wajib diisi.',
        'name.max' => 'Nama kategori maksimal 255 karakter.',
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function create()
    {
        $this->reset(['name', 'description', 'editingId']);
        $this->resetErrorBag();
        $this->showModal = true;
    }

    public function edit($categoryId)
    {
        $category = Category::findOrFail($categoryId);
        if ($category) {
            $this->editingId = $category->id;
            $this->name = $category->name;
            $this->description = $category->description;
            $this->resetErrorBag();
            $this->showModal = true;
        }
    }

    public function save()
    {
        $rules = $this->rules;
        if ($this->editingId) {
            $rules['name'] = 'required|string|max:255|unique:categories,name,' . $this->editingId;
        } else {
            $rules['name'] = 'required|string|max:255|unique:categories,name';
        }

        $this->validate($rules);

        if ($this->editingId) {
            $category = Category::find($this->editingId);
            if ($category) {
                $category->update([
                    'name' => $this->name,
                    'slug' => Str::slug($this->name),
                    'description' => $this->description,
                ]);
                session()->flash('success', 'Kategori berhasil diupdate.');
            }
        } else {
            Category::create([
                'name' => $this->name,
                'slug' => Str::slug($this->name),
                'description' => $this->description,
            ]);
            session()->flash('success', 'Kategori berhasil dibuat.');
        }

        $this->closeModal();
    }

    public function delete($categoryId)
    {
        $category = Category::find($categoryId);
        if ($category) {
            if ($category->articles()->count() > 0) {
                session()->flash('error', 'Kategori tidak dapat dihapus karena masih memiliki artikel.');
            } else {
                $category->delete();
                session()->flash('success', 'Kategori berhasil dihapus.');
            }
        }
    }

    public function closeModal()
    {
        $this->reset(['name', 'description', 'editingId', 'showModal']);
        $this->resetErrorBag();
    }

    public function render()
    {
        $query = Category::withCount('articles')
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('description', 'like', '%' . $this->search . '%');
                });
            })
            ->orderBy('created_at', 'desc');

        $categories = $query->paginate(10);

        return view('livewire.admin.category-manager', [
            'categories' => $categories,
        ]);
    }
}
