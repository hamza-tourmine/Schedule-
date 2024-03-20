
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
            background-color: #eee
        }
        .checkboxContainer span input{
            width:35px;

        }
    </style>
        <div style="width:70%;margin-x:auto">

            <form wire:submit.prevent="update">
                @csrf
                <div class="mb-lg-3 col-lg-9">
                    <label for="formateur_name" class="form-label">Formateur Name</label>
                    <input wire:model="formateur_name" value="" type="text" name="formateur_name" class="form-control" id="formateur_name">
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
        </div>
    </div>



</div>
