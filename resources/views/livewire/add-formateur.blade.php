<div wire:ignore>
    <style>
        .checkboxContainer {
            background-color: white;
            border-radius: 7px;
            border: 1.5px solid #eee;
            max-height: 150px;
            overflow-y: scroll;
        }

        .checkboxContainer span {
            margin: 4px;
            display: block;
        }

        .checkboxContainer span:hover {
            background-color: #eee;
        }

        .checkboxContainer span input {
            width: 35px;
        }
    </style>
    {{-- create formateur  --}}
    <div style="max-width: 80vw; margin-x: auto">
        <form wire:submit.prevent="create">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        {{ $error }}<br>
                    @endforeach
                </div>
            @endif
            @csrf
            <div class="mb-lg-3 col-lg-9">
                <label for="formateur_name" class="form-label">Formateur Name</label>
                <input wire:model="formateur_name" type="text" name="formateur_name" class="form-control" id="formateur_name">
            </div>
            <h6 style="margin:10px">Filiéres</h6>
            <div class="checkboxContainer mb-lg-3 col-lg-9">
                @foreach ($branches as $branch)
                    <span>
                        <input wire:model="selectedBranches" type="checkbox" id="branch{{ $branch->id }}" name="selectedBranches[]" value="{{ $branch->id }}">
                        <label for="branch{{ $branch->id }}">{{ $branch->name }}</label>
                    </span>
                @endforeach
            </div>
            <h6 style="margin:10px">Les Groupes</h6>
            <div class="checkboxContainer mb-lg-3 col-lg-9">
                @foreach ($groupes as $groupe)
                    <span>
                        <input wire:model="selectedGroupes" type="checkbox" id="group{{ $groupe->id }}" name="selectedGroupes[]" value="{{ $groupe->id }}">
                        <label for="group{{ $groupe->id }}">{{ $groupe->group_name }}</label>
                    </span>
                @endforeach
            </div>
            <h6 style="margin:10px">Les Modules</h6>
            <div class="checkboxContainer mb-lg-3 col-lg-9">
                @foreach ($modules as $module)
                    <span>
                        <input wire:model="selectedModules" type="checkbox" id="module{{ $module->id }}" name="selectedModules[]" value="{{ $module->id }}">
                        <label for="module{{ $module->id }}">{{ $module->module_name }}</label>
                    </span>
                @endforeach
            </div>
            <div class="mb-lg-3 col-lg-9">
                <label for="idFormateur" class="form-label">Matricule formateur</label>
                <input wire:model="idFormateur" type="text" name="idFormateur" class="form-control" id="idFormateur">
            </div>
            <button type="submit" class="btn btn-success">Save</button>
        </form>
        {{-- table --}}
        <h3>Les Formateurs</h3>
    </div>
    {{-- end create formateur  --}}
    {{-- Display formateur info  --}}
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-centered mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nome</th>
                                        <th colspan="2">Matricule </th>
                                        <th>Mot de passe</th>
                                        <th>état</th>
                                        <th colspan="2">actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($formateurs)
                                        @foreach ($formateurs as $key => $formateur )
                                            <tr>
                                                <th scope="row">{{$key +1}}</th>
                                                <td colspan="">{{$formateur->user_name}}</td>
                                                <td colspan="2">{{$formateur->id}}</td>
                                                <td colspan="">{{$formateur->passwordClone}}</td>
                                                <td>
                                                    <span class="badge {{$formateur->status==='active' ? ' badge-soft-success ' : ' badge-soft-danger '}} font-size-12">{{$formateur->status}}</span>
                                                </td>
                                                <td>
                                                    {{-- wire:click='GetInfo("{{$formateur->id}}")' --}}
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop_{{$formateur->id}}" wire:click="$emit('postAdded' , '{{$formateur->id}}')">View more</button>
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"  wire:click="$emit('postAdded' , '{{$formateur->id}}')">Modifier</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @foreach ($formateurs as $formateur)
     <!-- Modals for detailed group information -->
        <div class="modal fade" id="staticBackdrop_{{ $formateur->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel_{{$formateur->id}}" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <!-- Modal header -->
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel_{{ $formateur->id }}">{{ $formateur->user_name }}</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <!-- Table to display detailed information -->
                        <table class="table table-striped" style="font-size: 19px; font-weight: 300;">
                            <thead>
                                <tr>
                                    <th scope="col">Code Filiére</th>
                                    <th scope="col"> Filière    </th>
                                    <th scope="col">Les Modules</th>
                                    <th scope="col">Les groupes</th>
                                </tr>
                            </thead>
                            <tbody style="color: black">
                                <tr>
                                    <!-- Data for detailed information -->
                                  <td>
                                    <div class="mb-lg-3 w-50">
                                        <!-- Your HTML code -->

                                        <div>
                                            @foreach ($formateurBranches as $branch)
                                                {{ $branch->name}} ,
                                            @endforeach
                                        </div>

                                </div>
                                  </td>

                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" wire:click="$emit('postAdded' , '{{$formateur->id}}')">Modifier</button>

                    </div>
                </div>
            </div>
        </div>

        {{-- modal Edit --}}
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{$formateur->user_name}}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div>
                            <form wire:submit.prevent="update">
                                @csrf
                                <div class="d-flex w-100">
                                    <div class="mb-lg-3 w-50">
                                        <label for="New_formateur_name" class="form-label">Formateur Name</label>
                                        <input wire:model="New_formateur_name" value="" type="text" name="formateur_name" class="form-control" id="New_formateur_name">
                                    </div>
                                    <div class="mb-lg-3 w-50">
                                        <label for="New_idFormateur" class="form-label">Matricule formateur</label>
                                        <input wire:model="New_idFormateur" type="text" name="idFormateur" class="form-control" id="New_idFormateur">
                                    </div>
                                </div>
                                <div class="d-flex w-100">
                                    <div class="mb-lg-3 w-50">
                                            <!-- Your HTML code -->
                                            <h6 style="margin:10px">Filiéres</h6>
                                            <div class="checkboxContainer mr-2" >
                                                @foreach ($branches as $branch)
                                                    <span>
                                                        <input wire:model="selectedBranches.{{ $branch->id }}"
                                                            type="checkbox" id="New_branch{{ $branch->id }}"
                                                            name="New_selectedBranches[]" value="{{ $branch->id }}">
                                                        <label for="New_branch{{ $branch->id }}">{{ $branch->name }}</label>
                                                    </span>
                                                @endforeach
                                            </div>
                                    </div>
                                    <div class="mb-lg-3 w-50">
                                        <h6 style="margin:10px">Les Groupes</h6>
                                        <div class="checkboxContainer">
                                            @foreach ($groupes as $groupe)
                                                <span>
                                                    <input wire:model="New_selectedGroupes" type="checkbox" id="New_group{{ $groupe->id }}"
                                                                                                      name="New_selectedGroupes[]" value="{{ $groupe->id }}">
                                                    <label for="New_group{{ $groupe->id }}">{{ $groupe->group_name }}</label>
                                                </span>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex w-100">
                                    <div class="w-50">
                                        <h6>Les Modules</h6>
                                        <div class="checkboxContainer">
                                            @foreach ($modules as $module)
                                                <span>
                                                    <input wire:model="New_selectedModules" type="checkbox" id="New_module{{ $module->id }}" name="New_selectedModules[]" value="{{ $module->id }}">
                                                    <label for="New_module{{ $module->id }}">{{ $module->module_name }}</label>
                                                </span>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="w-50 pl-2">
                                        <div>
                                            <label for="New_Password" class="form-label">Mot de passe</label>
                                            <input wire:model="New_Password" value="" type="text" name="New_Password" class="form-control" id="New_Password">
                                        </div>
                                        <div>
                                            <label for="" class="form-label">status</label><br>
                                            <label for="New_status">
                                                <input wire:model="active" type="checkbox" name="acitve" id="New_status">
                                                <span class="checkmark"></span>
                                                active
                                            </label><br>
                                            <label for="New_status">
                                                <input wire:model="desactive" type="checkbox" name="desactive" id="New_status">
                                                <span class="checkmark"></span>
                                                desactive
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

