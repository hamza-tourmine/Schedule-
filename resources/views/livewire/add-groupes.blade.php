<div>
    <style>
        .checkboxContainer {
            background-color: white;
            border-radius: 7px;
            border: 1.5px solid #eee;
            max-height: 150px;
            overflow-y: scroll;
            width: 100%;
        }

        .checkboxContainer span {
            margin: 4px;
            display: block;
        }

        .checkboxContainer span:hover {
            background-color: #eee
        }

        .checkboxContainer span input {
            width: 35px;
        }

        /* Change the color of the checkbox when checked */
        input[type="checkbox"]:checked+label {
            background-color: #eee;
        }
    </style>

    <div style="width:50%;margin-x:auto">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal1">
            Ajouter groupe
        </button>
        <!-- Modal create groupes -->
        <div wire:ignore.self class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ajouter groupe</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form wire:submit.prevent="create">
                            @csrf
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label"> Nom group  </label>
                                <input style="border: 1.2px solid #eee; box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;" placeholder="Nom groupe" wire:model='group_name' type="text" name='group_name' class="form-control mb-lg-3 col-lg-9" id="exampleInputEmail1" aria-describedby="emailHelp">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">les Filiéres</label>
                                <select style="border: 1.2px solid #eee; box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;" wire:model='branch' name="branch" class="form-control select2 mb-lg-3 col-lg-9">
                                    <option>Filiére</option>
                                    @foreach ($branches as $branche)
                                    <option value="{{ $branche->id }}">{{ $branche->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <h6 style="margin:10px">Modules</h6>
                                <div style="border: 1.2px solid #eee; box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;" class="checkboxContainer mb-lg-3 col-lg-9">
                                    @foreach ($modules as $module)
                                    <span>
                                        <input wire:model="selectedModules.{{ $module->id }}" type="checkbox" id="module{{ $module->id }}" name="selectedModules[]" value="{{ $module->id }}">
                                        <label for="module{{ $module->id }}">{{ $module->module_name }}</label>
                                    </span>
                                    @endforeach
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="year" class="form-label">Année</label>
                                <input style="border: 1.2px solid #eee; box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;" placeholder="Année" wire:model.defer="year" type="text" name="year" class="form-control mb-lg-3 col-lg-9" >
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- table --}}
        <div>
            <h3>Groupes</h3>
            <table class="table table-striped" style="font-size: 19px; font-weight:300; width: 70vw;">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Groupe</th>
                        <th scope="col">Code Filiére</th>
                        <th scope="col">Filière</th>
                        <th scope="col">Niveau</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if($groups)
                    @foreach ($groups as $key => $group )
                    <tr>
                        <th scope="row">{{ $key + 1 }}</th>
                        <td>{{ $group['group_name'] }}</td>
                        <td>{{ preg_replace('/^\d+/' , "" ,$group['branch_id'])}}</td>
                        <td>{{ $group['group_name'] }}</td>
                        <td>{{ $group['year'] }}</td>
                        <td colspan="">
                            <!-- Modal trigger button -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop_{{ $group['group_id'] }}">Voir plus</button>
                            <td>
                                <button type="button" id="{{$group['group_id']}}"  class="btn btn-primary EditButton" data-bs-toggle="modal" data-bs-target="#exampleModal99">
                                    Modifier
                                </button>
                            </td>
                        </td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>

            {{--start Edit Model  --}}
            <!-- Modal -->
            <div wire:ignore.self  class="modal fade" id="exampleModal99" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modifier groupe</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form>
                                @csrf
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">group Name </label>
                                    <input id="groupName" type="text" name='group_name' class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">les Filiéres</label>
                                    <select name="branch" class="form-control select2">
                                         <option>Filiére</option>
                                         @foreach ($branches as $branche)
                                             <option class="branchOption" value="{{$branche->id}}">{{$branche->name}}</option>
                                         @endforeach
                                    </select>
                                    <div class="mb-3">
                                        <h6 style="margin:10px"> Modules </h6>
                                        <div style="width: 100%" class="checkboxContainer  col-lg-9">
                                            @foreach ($modules as $module)
                                            <span >
                                                <input class="modulesoption" type="checkbox" id="{{ $module->id }}"  value="{{ $module->id }}">
                                                <label for="module{{ $module->id }}">{{ $module->module_name }}</label>
                                            </span>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="year" class="form-label">Année</label>
                                        <input id="year"  type="text" name="year" class="form-control" >
                                    </div>

                                    <button type="submit" class="btn btn-success">Update ...</button>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- end Edit model  --}}


            <!-- Modals for detailed group information -->
            @foreach ($groups as $group)
            <div class="modal fade" id="staticBackdrop_{{ $group['group_id'] }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel_{{ $group['group_id'] }}" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <!-- Modal header -->
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel_{{ $group['group_id'] }}">{{ $group['group_name'] }}</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <!-- Modal body -->
                        <div class="modal-body">
                            <!-- Table to display detailed information -->
                            <table class="table table-striped" style="font-size: 19px; font-weight:300;">
                                <thead>
                                    <tr>
                                        <th scope="col">Les Modules</th>
                                    </tr>
                                </thead>
                                <tbody style="color: black">
                                    <tr>
                                        <td colspan="9">
                                            @foreach ($group['modules'] as $module)
                                            {{ $module }},
                                            @endforeach
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <!-- Delete button -->
                            <button wire:click='delete("{{ $group['group_id'] }}")' data-bs-dismiss="modal" type="button" class="btn btn-danger">
                                Delete
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
    <script>
        let EditButton = document.querySelectorAll('.EditButton');
        let groupName = document.getElementById('groupName');
        let branchOptions =  document.querySelectorAll('.branchOption');
        let modulesoption = document.querySelectorAll('.modulesoption');
        let year = document.getElementById('year');
        console.log(year)

        EditButton.forEach(button => {
    button.addEventListener('click', function () {
        const IdGroup = button.id;
        let GroupDate = 'dataGrop test';
        fetch('GetdataGroupe/' + IdGroup, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(res => {
            if (!res.ok) {
                throw new Error('Network response was not ok');
            }
            return res.json();
        })
        .then(data => {
            if (data.status === 200) {
                // Assuming groupName and branchOption are defined elsewhere
                groupName.value = data.data.group_name;
                year.value = data.data.year
                branchOptions.forEach(branch => {
                    if (branch.value === data.data.branch_id) {
                        branch.selected = true;
                    }
                });


                    Array.from(modulesoption).forEach(module => {
                    let isChecked = false;
                    data.data.modules.forEach(item => {
                if (module.value.toLowerCase() === item.toLowerCase()) {
                    isChecked = true;
                    return;
                    }
                });
                module.checked = isChecked;
        });




                console.log(data);
            } else {
                console.error('Error: Unexpected status code received from server');
            }
        })
        .catch(error => {
            console.error('Error fetching data:', error);
        });
    });
});


    </script>
</div>
