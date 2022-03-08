<div class="row" id="usersList">
    @push('style')

    @endpush
    <div class="col-12">
        <div class="card">
            <div class="card-body ms-form-input">
                <h4 class="card-title">All Customer List</h4>
                <hr>
                {{--Search Filter--}}
                <div class="row m-t-40">
                    <div class="col-md-4">
                        <div class="form-group m-b-40">
                            <input type="text" class="form-control" id="search" wire:model="search" placeholder="Search by Name, Phone, Email">
                            {{--wire:model.lazy="search"--}}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group m-b-40">
                            <select class="form-control p-0" id="verified_unverified" name="verified_unverified" wire:model="verified_unverified">
                                <option>-Verified/Unverified-</option>
                                <option value="1">Verified</option>
                                <option value="01">Unverified</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group m-b-40">
                            <select class="form-control p-0" id="active_inactive" wire:model="active_inactive">
                                <option>-Active/Inactive-</option>
                                <option value="1">Active</option>
                                <option value="01">Inactive</option>
                            </select><span class="bar"></span>
                        </div>
                    </div>
                </div>
                <div class="form-group" style="padding: 0;margin: -25px 0 0;">
                    <button class="btn waves-effect waves-light btn-primary btn-sm" id="clearFilter" onclick="clearFilter()" wire:click="resetFilters"> <i class="ti-close"></i> Clear Filter</button>
                </div>
            {{--end Search Filter--}}

            <!--Shop List-->
                <div class="row el-element-overlay">

                    <div class="col-md-12">
                        <hr>
                        <h4 class="card-title" title="Customer Count">Customers <span class="badge badge-primary">{{$users->count()}}</span></h4>
                        <hr style="margin-top: 0.5rem;">
                        <h6 class="card-subtitle m-b-20 text-muted">
                            Active: <span title="Active Shop" class="badge badge-success">{{$users->where('is_active', true)->count()}}</span> | Inactive: <span title="Inactive Shop" class="badge badge-danger">{{$users->where('is_active', false)->count()}}</span> | | Verified: <span title="Verified Shop" class="badge badge-success">{{$users->where('phone_verified_at', '!=', null)->count()}}</span> |  Unverified: <span title="Unverified Shop" class="badge badge-warning">{{$users->where('phone_verified_at', null)->count()}}</span>
                        </h6>
                        <hr>
                    </div>

                    {{--placeholder loading--}}
                    <div class="col-md-12" wire:loading>
                        @component('components.users-loader', ['users' => $users])@endcomponent
                    </div>
                    {{--End Placeholder loading--}}

                    <div class="col-md-12 row" wire:loading.class="blur-3" wire:loading.remove>
                        @forelse($users as $user)
                            <?php
                            /**
                             * @var App\Models\User $user
                             */
                            ?>
                            <div class="col-md-4 col-lg-4 col-xl-3">
                                <div class="card card-body shadow-sm" style="padding: 0.2rem;border-radius: 5px;">
                                    <div class="row align-items-center">
                                        <div class="text-center p-l-10">
                                            <a href="{{user_profile_photo($user)}}" title="Merchant Profile Photo" target="_blank"><img src="{{user_profile_photo($user)}}" style="width: 80px;height: 80px;" alt="Merchant" class="img-circle img-fluid"></a>
                                        </div>
                                        <div class="col-md-8 col-lg-9">
                                            <a href="{{route('admin.users.profile.show',$user->id)}}">
                                                <h4 class="box-title m-b-0"><strong>{{Str::limit($user->full_name,22)}}</strong></h4>
                                                <address style="margin-bottom: 0rem;">
                                                    <abbr title="Phone">P:</abbr> {{$user->phone}}
                                                    <br>
                                                    <abbr title="Email">E:</abbr> {{$user->email}}
                                                </address>
                                                <small>
                                                    @if($user->phone_verified_at != null)
                                                        <span class="badge badge-primary" title="Verified"> <i class="ti-check-box"></i>&nbsp; Verified</span>
                                                    @else
                                                        <span class="badge badge-warning"> <i class="ti-alert"></i>&nbsp; Unverified</span>
                                                    @endif
                                                    @if($user->is_active)
                                                        <span class="badge badge-success" title="Active"> <i class="ti-user"></i>&nbsp; Active</span>
                                                    @else
                                                        <span class="badge badge-danger"> <i class="ti-na"></i>&nbsp; Inactive</span>
                                                    @endif
                                                    @if(Carbon\Carbon::now()->diffInWeeks($user->created_at, false)===0)<span class="badge badge-cyan">New</span>@endif
                                                </small>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            @component('components.no-data-found')@endcomponent
                        @endforelse
                    </div>

                </div>
                <!--End Shop List-->

            </div>
        </div>

    </div>

    @push('script')

    @endpush
</div>
