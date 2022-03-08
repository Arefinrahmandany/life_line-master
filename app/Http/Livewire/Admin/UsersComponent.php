<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use App\Models\UserType;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;

class UsersComponent extends Component
{
    use WithPagination;

    public $search,$verified_unverified,$active_inactive,$route;
    public $perPage = 20;

    protected $listeners = [
        'load-more' => 'loadMore'
    ];

    public function loadMore(): void
    {
        $this->perPage += 10;
    }


    public function resetFilters(): void
    {
        $this->reset('search');
        $this->reset('verified_unverified');
        $this->reset('active_inactive');
    }

    public function mount($route): void
    {
        $this->route = $route;
    }

    public function profileInactive($id): void
    {
        User::where('id',$id)->update(['is_active' => false]);
        $this->dispatchBrowserEvent('toast-msg', ['type' => 'success','message' => 'Inactive is success.']);
    }

    public function render()
    {
        $q = $this->search;
        $verifiedUnverified = $this->verified_unverified;
        $activeInactive = $this->active_inactive;
        $users = User::where('type_id',UserType::USER);
        if ($q) {
            $users->where(function (Builder $query) use ($q) {
                $query->where('phone', 'LIKE', "%$q%")
                    ->orWhere('first_name', 'LIKE', "%$q%")
                    ->orWhere('last_name', 'LIKE', "%$q%")
                    ->orWhere('email', 'LIKE', "%$q%");
            });
        }
        if($verifiedUnverified){if($verifiedUnverified==='1') {$users->where('phone_verified_at', '!=', null);}else if($verifiedUnverified==='01') {$users->where('phone_verified_at', null);}}
        if($activeInactive){if($activeInactive==='1') {$users->where('is_active',true);}else if($activeInactive==='01') {$users->where('is_active',false);}}

        return view('livewire.admin.users-component', [
            'users' => $users->latest()->paginate($this->perPage),
        ]);
    }
}
