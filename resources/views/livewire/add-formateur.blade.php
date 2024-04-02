<div >
    <style>
        .checkboxContainer {
            background-color: white;
            border-radius: 7px;
            border: 1.2px solid #eee;
            box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
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

        /* Change the color of the checkbox when checked */
        input[type="checkbox"]:checked + label {
            background-color: #eee;
        }

    </style>
    {{-- create formateur  --}}
   <!-- Button trigger modal -->
<button style="margin-bottom:8px" type="button" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#exampleModal7">
    Create formateur Account
  </button>
  <div wire:ignore.self  class="modal fade" id="exampleModal7" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Ajouter formateur </h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div style="max-width: 80vw; ">
                <form wire:submit.prevent="create">
                    @csrf
                    <div class="d-flex w-100 justify-content-between">
                        <div style="width: 45%" class="mb-lg-3 ">
                            <label for="formateur_name" class="form-label">Nom  Formateur </label>
                            <input style="border: 1.2px solid #eee;
                            box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;" wire:model="formateur_name" placeholder="Nom de Formateur " type="text" name="formateur_name" class="form-control" id="formateur_name">
                        </div>
                        <div style="width: 45%"  class="mb-lg-3 ">
                            <label for="idFormateur" class="form-label">Matricule formateur</label>
                            <input style="border: 1.2px solid #eee;
                            box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;" wire:model="idFormateur" placeholder="Matricule formateur" type="text" name="idFormateur" class="form-control" id="idFormateur">
                        </div>
                    </div>


                <div class="d-flex w-100 justify-content-between">


                <div style="width: 45%"  class="checkboxContainer mb-lg-3   col-lg-9">
                    <h6 style="margin:10px">Filiéres</h6>
                    @foreach ($branches as $branch)
                        <span>
                            <input wire:model="selectedBranches" type="checkbox" id="branch{{ $branch->id }}" name="selectedBranches[]" value="{{ $branch->id }}">
                            <label for="branch{{ $branch->id }}"> {{ $branch->name }} </label>
                        </span>
                    @endforeach
                </div>

                <div style="width: 45%"  class="checkboxContainer mb-lg-3  col-lg-9">
                    <h6 style="margin:10px">Les Groupes</h6>
                    @foreach ($groupes as $groupe)
                        <span>
                            <input wire:model="selectedGroupes" type="checkbox" id="group{{ $groupe->id }}" name="selectedGroupes[]" value="{{ $groupe->id }}">
                            <label for="group{{ $groupe->id }}">{{ $groupe->group_name }}</label>
                        </span>
                    @endforeach
                </div>
              </div>

                    <div style="width: 65% ;margin:auto"  class="checkboxContainer mb-lg-3 col-lg-9">
                        <h6 style="margin:10px">Les Modules</h6>
                        @foreach ($modules as $module)
                            <span>
                                <input wire:model="selectedModules" type="checkbox" id="module{{ $module->id }}" name="selectedModules[]" value="{{ $module->id }}">
                                <label for="module{{ $module->id }}">{{ $module->module_name }}</label>
                            </span>
                        @endforeach
                    </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success">Create </button>
        </div>
    </form>
      </div>
    </div>
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

                                                    <button  id='{{$formateur->id}}' type="button" class="btn btn-primary catchEvent" data-bs-toggle="modal" data-bs-target="#staticBackdrop_{{$formateur->id}}" >View more</button>
                                                    <button  id='{{$formateur->id}}' type="button" class="btn btn-primary catchEvent" data-bs-toggle="modal" data-bs-target="#exampleModal" >Modifier</button>
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
                            <th scope="col">Les Modules</th>
                            <th scope="col">Les groupes</th>
                        </tr>
                    </thead>
                    <!-- Data for detailed informateur -->
                    <tbody class="moreDetailes" style="color: black">

                    </tbody>
                </table>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Delete</button>
                <button id='{{$formateur->id}}' type="button" class="btn btn-primary catchEvent" data-bs-toggle="modal" data-bs-target="#exampleModal" wire:click="$emit('postAdded' , '{{$formateur->id}}')">Modifier</button>
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
                        <button id='{{$formateur->id}}' type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div>
                            <form id='formUpdateFrmateur'>
                                @csrf
                                <div class="d-flex w-100 justify-content-between">
                                    <div class="mb-lg-3 " style="width: 45%">
                                        <label  for="New_formateur_name" class="form-label">Formateur Name</label>
                                        <input style="border: 1.2px solid #eee;        box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;"  value="" type="text" name="formateur_name" class="form-control" id="New_formateur_name">
                                    </div>
                                    <div class="mb-lg-3 " style="width: 45%">
                                        <label for="New_idFormateur" class="form-label">Matricule formateur</label>
                                        <input style="border: 1.2px solid #eee; box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;" type="text" name="idFormateur" class="form-control" id="New_idFormateur">
                                    </div>
                                 </div>
                                 <div class="d-flex w-100 justify-content-between">
                                    <div class="mb-lg-3 " style="width: 45%">
                                        <h6 style="margin:10px">les Filiére</h6>
                                            <div class="checkboxContainer ">
                                                @foreach ($branches as $branch)
                                                    <span>
                                                        <input id="{{ $branch->id }}" class="Branchesoption"  type="checkbox" name="New_selectedBranches[]" value="{{ $branch->id }}">
                                                        <label for="New_branch{{ $branch->id }}">{{ $branch->name }}</label>
                                                    </span>
                                                @endforeach
                                            </div>

                                    </div>
                                    <div class="mb-lg-3 " style="width: 45%">
                                        <h6 style="margin:10px">Les Groupes</h6>
                                        <div class="checkboxContainer">
                                            @foreach ($groupes as $groupe)
                                                <span>
                                                    <input class="Groupesoptions" type="checkbox" id="{{ $groupe->id }}"
                                                                            name="New_selectedGroupes[]" value="{{ $groupe->id }}">
                                                    <label for="New_group{{ $groupe->id }}">{{ $groupe->group_name }}</label>
                                                </span>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex w-100 justify-content-between">
                                    <div class="mb-lg-3 " style="width: 45%">
                                        <h6>Les Modules</h6>
                                        <div class="checkboxContainer">
                                            @foreach ($modules as $module)
                                                <span>
                                                    <input  class="modulesoptoins" type="checkbox" id="{{ $module->id }}" name="New_selectedModules[]" value="{{ $module->id }}">
                                                    <label for="New_module{{ $module->id }}">{{ $module->module_name }}</label>
                                                </span>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="mb-lg-3 " style="width: 45%">
                                        <div>
                                            <label for="New_Password" class="form-label">Mot de passe</label>
                                            <input style="border: 1.2px solid #eee;
                                            box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;" value="" type="text" placeholder="Mot de passe" name="New_Password" class="form-control" id="New_Password">
                                        </div>
                                        <span>status</span>
                                        <div style="margin-top: 19px  ;  border: 1.2px solid #eee;
                                        box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px; heigth:130px">

                                        <br>
                                            <label>
                                                <input type="radio" name="status" value="active" id="active" checked>
                                                <span class="checkmark"></span>
                                                Active
                                            </label><br>
                                            <label>
                                                <input type="radio" name="status" value="desactive" id="desactive">
                                                <span class="checkmark"></span>
                                                Desactive
                                            </label>

                                        </div>
                                    </div>
                                </div>
                                <button idFormateur="{{$formateur->id}}" id="updateButton" type="submit" class="btn btn-success">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endforeach
    <Script>

        let branches = document.getElementsByClassName('Branchesoption');
        let Groupes = document.getElementsByClassName('Groupesoptions');
        let modules = document.getElementsByClassName('modulesoptoins');
        const buttons = document.getElementsByClassName('catchEvent');
        let New_idFormateur  = document.getElementById('New_idFormateur');
        let New_formateur_name = document.getElementById('New_formateur_name');
        let New_Password = document.getElementById('New_Password');
        let desactive = document.getElementById('desactive') ;
        let active =document.getElementById('active') ;
        let updateButton = document.getElementById('updateButton');
        let formUpdateFrmateur = document.getElementById('formUpdateFrmateur'); 
        let moreDetailes = document.querySelectorAll('.moreDetailes');

        let  IdFormateur = '' ;
        Array.from(buttons).forEach(button => {
    button.addEventListener('click', function() {
        const IdFormateur = button.getAttribute('id');
        fetch('/admin/reserve/' + IdFormateur, { method: "GET" })
            .then((response) => response.json())
            .then((data) => {
                if (data.status === 200) {
                    New_formateur_name.value = data.formateur.user_name;
                    New_idFormateur.value = data.formateur.id;
                    New_Password.value = data.formateur.passwordClone;

                    const jsxBranches = data.branches.map(branch => branch.id.replace(/^\d/, '')).join(', ');
                    const jsxGroupes = data.Groupes.map(groupe => groupe.group_name).join(', ');
                    const jsxModules = data.modules.map(module => module.id.replace(/^\d/, '')).join(', ');

                    const moreDetailes = document.querySelectorAll('.moreDetailes');
                    moreDetailes.forEach(element => {
                        element.innerHTML = `
                            <tr>
                                <td>${jsxBranches}</td>
                                <td>${jsxModules}</td>
                                <td>${jsxGroupes}</td>
                            </tr>
                        `;
                    });

                    if (data.formateur.status === 'active') {
                        active.checked = true;
                    } else {
                        desactive.checked = true;
                    }

                    Array.from(branches).forEach(branche => {
                        branche.checked = data.branches.some(dateItem => branche.id.toLowerCase() === dateItem.id.toLowerCase());
                    });

                    Array.from(modules).forEach(module => {
                        module.checked = data.modules.some(dateItem => module.id.toLowerCase() === dateItem.id.toLowerCase());
                    });

                    Array.from(Groupes).forEach(Groupe => {
                        Groupe.checked = data.Groupes.some(dateItem => Groupe.id.toLowerCase() === dateItem.id.toLowerCase());
                    });
                }
            });
    });
});

    updateButton.addEventListener('click', function(event) {
    event.preventDefault();


    // Array to store selected values
    var selectedBranches = [];
    var selectedGroupes = [];
    var selectedModules = [];

    var status = document.querySelector('input[name="status"]:checked').value;
    // Loop through selected branches
    document.querySelectorAll('.Branchesoption:checked').forEach(function(branch) {
        if (!selectedBranches.includes(branch.value)) {
            selectedBranches.push(branch.value);
        }
    });

    // Loop through selected groupes
    document.querySelectorAll('.Groupesoptions:checked').forEach(function(groupe) {
        if (!selectedGroupes.includes(groupe.value)) {
            selectedGroupes.push(groupe.value);
        }
    });

    // Loop through selected modules
    document.querySelectorAll('.modulesoptoins:checked').forEach(function(module) {
        if (!selectedModules.includes(module.value)) {
            selectedModules.push(module.value);
        }
    });



    let formateurData = {
        "name": New_formateur_name.value,
        'password': New_Password.value,
        "id": New_idFormateur.value,
        "status": status,
        "branches": selectedBranches,
        "groupes": selectedGroupes,
        "modules": selectedModules
    };



    fetch('update/' + IdFormateur, {
        method: 'POST',
        body: JSON.stringify(formateurData), // Convert to JSON string
        headers: {
            'Content-Type': 'application/json', // Specify content type
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    })
    .then(res => res.json())
    .then(data => {
        console.log(data);
    })
    .catch(error => {
        console.error('Error:', error);
    });
});

    </Script>
</div>

