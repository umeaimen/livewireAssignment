<div>
    <div class="components-preview wide-md mx-auto">
        <div class="nk-block nk-block-lg">
            <div class="nk-block-head">
                <div class="nk-block-head-content">
                    <h4 class="nk-block-title">Users</h4>
                    <div class="d-flex justify-content-end" >
                    <a href="javascript:void(0);" class="btn btn-primary" tabindex="0" aria-controls="table-hover" type="button" wire:click="openMainModal">Add User</a> 
                </div> 
                </div>      
            </div>
            <div class="card card-bordered card-preview">
                <div class="card-inner">
                    <table class=" nowrap table" >
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @isset($users)
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>
                                        {{ $user->email }}
                                    </td>
                                    <td>
                                        {{ $user->created_at }}
                                    </td>
                                    <td class="nk-tb-col nk-tb-col-tools">
                                    <!-- <a href="javascript:void(0);" wire:click="edit()"><span >Edit </span></a>
                                    <a href="javascript:void(0);" wire:click="deleteConfirmation('{{ $user->id }}')"><span >Delete </span></a> -->
                                        <ul class="nk-tb-actions gx-1 my-n1">
                                            <li class="me-n1">
                                                <div class="dropdown">
                                                    <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <ul class="link-list-opt no-bdr">
                                                            <li><a href="javascript:void(0);" wire:click="edit('{{ $user?->id }}')"><span  wire:ignore><em class="icon ni ni-edit"></em></span><span>Edit </span></a></li>
                                                           
                                                            <li><a href="javascript:void(0);" class="warning" wire:click="deleteConfirmation('{{ $user?->id }}')"><span  wire:ignore><em class="icon ni ni-trash" ></em></span><span>Delete</span></a></li>
                                                                                                                   </ul>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                            @endforeach
                        @endisset
                        </tbody>
                    </table>
                </div>
            </div><!-- .card-preview -->
        </div> <!-- nk-block -->
    </div>
    <x-main-modal wireIgnoreSelf="wire:ignore.self" modelSize="modal-md" modalTitle="{{ $modalTitle }}">  
        <form class="row" wire:submit.prevent="{{ $form->isUpdate ? 'update(' . $form->id . ')' : 'store' }}">
            <div class="col-6 mt-2">
                <label class="form-label"> Name</label>
                <input type="text" class="form-control " id="name" wire:model="form.name" placeholder="Name" autofocus
                    data-msg="Please enter name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>
            <div class="col-6 mt-2">
                <x-input-label for="email" class="required" value="Email" />
                <x-input type="email" name="email" id="email" :class="$errors->has('form.email') ? 'error' : ''" placeholder="Enter email" wire:model="form.email" autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
            <div class="col-6 mt-2">
                <x-input-label for="company" class="required" value="role" />
                <x-select-input name="role" id="role" :class="$errors->has('form.role') ? 'error select-two' : 'select-two'" wire:model="form.role">
                    <option>Select Role</option>
                    @isset($roles)
                        @foreach ($roles as $role)
                            <option value="{{ $role?->id }}">{{ $role?->name }}</option>
                        @endforeach
                    @endisset
                </x-select-input>
                <x-input-error :messages="$errors->get('role')" class="mt-2" />
            </div>
            @if(!$form->isUpdate)
            <div class="col-6 mt-2">
                <x-input-label for="password" class="required" value="Password" />
                <x-input type="password" name="password" id="password" placeholder="Enter password" wire:model="form.password" autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
            @endif
            <div class="col-12 text-end mt-2">
                <button class="btn btn-primary s" tabindex="4" wire:loading.attr="disabled">
                    <span wire:loading.remove>{{ $form->isUpdate ? __('Update Changes') : __('Save Changes') }}</span>
                    <span wire:loading wire:ignore>
                         {{ __('Loading...') }}
                    </span>
                </button>
            </div>
        </form>
    </x-main-modal>

</div>
