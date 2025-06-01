<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Article;
use App\Models\Category;
use App\Models\User;

class UserManager extends Component
{
    use WithPagination;

    public $search = '';
    public $roleFilter = '';
    public $sortBy = 'created_at';
    public $sortDirection = 'desc';

    protected $queryString = [
        'search' => ['except' => ''],
        'roleFilter' => ['except' => ''],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingRoleFilter()
    {
        $this->resetPage();
    }

    public function sortBy($field)
    {
        if ($this->sortBy === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function deleteUser($userId)
    {
        $user = User::find($userId);
        if ($user && !$user->isAdmin()) {
            $user->delete();
            session()->flash('success', 'User berhasil dihapus.');
        }
    }

    public function changeRole($userId, $role)
    {
        $user = User::find($userId);
        if ($user) {
            $user->update(['role' => $role]);
            session()->flash('success', 'Role user berhasil diubah.');
        }
    }

    public function render()
    {
        $query = User::when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('email', 'like', '%' . $this->search . '%');
            })
            ->when($this->roleFilter, function ($query) {
                $query->where('role', $this->roleFilter);
            })
            ->orderBy($this->sortBy, $this->sortDirection);

        $users = $query->paginate(10);

        return view('livewire.admin.user-manager', [
            'users' => $users,
        ]);
    }
}