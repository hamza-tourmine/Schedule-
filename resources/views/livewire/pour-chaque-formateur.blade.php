<div>
    @php

@endphp
    <h2>Schedule Table</h2>
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
  <div style="display: flex;">
    <div style=" width :300px">
    <form method="get" action="{{ route('createNewSchedule') }}">
        @csrf
        <button {{ session()->get('id_main_emploi') === null ? '' : 'disabled' }} style="margin: 5px 0px 10px"
            class="btn btn-primary">
            Create New Schadule
        </button>
        <br>
        <label >date start</label>
        <div class="col-6">
            <input name="dateStart" id="dateStart" type="date" class="form-control col-6" placeholder="mm/dd/yyyy"
            value="{{ session()->get('datestart') }}" data-date-container="#datepicker1" data-provide="datepicker">
        </div>
    </form>
</div>
    <div style="width:200px ;  display:flex; flex-direction :column-reverse">

        <select wire:model="formateurId" id="formateurSelected" class="form-control col-3" name="">
            <option >Formateur</option>
            @foreach ($formateurs as $formateur)
               <option class="form-control"  value="{{$formateur->id}}">{{$formateur->user_name}} </option>
            @endforeach
        </select>
        <label for="" style="font-size: 19px"> les Formateurs</label>
    </div>
  </div>

    <div class="table-responsive">
        <table  style="overflow:scroll" class="col-md-12 ">
            <thead>
                <tr class="day">

                    <th colspan="4">Lundi</th>
                    <th colspan="4">Mardi</th>
                    <th colspan="4">Mercredi</th>
                    <th colspan="4">Jeudi</th>
                    <th colspan="4">Vendredi</th>
                    <th colspan="4">Samedi</th>
                </tr>
                <tr>

                  <th colspan="2">Matin </th>
                  <th colspan="2">A.midi </th>
                  <th colspan="2">Matin </th>
                  <th colspan="2">A.midi </th>
                  <th colspan="2">Matin </th>
                  <th colspan="2">A.midi </th>
                  <th colspan="2">Matin </th>
                  <th colspan="2">A.midi </th>
                  <th colspan="2">Matin </th>
                  <th colspan="2">A.midi </th>
                  <th colspan="2">Matin </th>
                  <th colspan="2">A.midi </th>
                </tr>
                <tr class="se-row">

                    <th >SE1</th>
                    <th>SE2</th>
                    <th>SE1</th>
                    <th>SE2</th>
                    <th>SE1</th>
                    <th>SE2</th>
                    <th>SE1</th>
                    <th>SE2</th>
                    <th>SE1</th>
                    <th>SE2</th>
                    <th>SE1</th>
                    <th>SE2</th>
                    <th>SE1</th>
                    <th>SE2</th>
                    <th>SE1</th>
                    <th>SE2</th>
                    <th>SE1</th>
                    <th>SE2</th>
                    <th>SE1</th>
                    <th>SE2</th>
                    <th>SE1</th>
                    <th>SE2</th>
                    <th>SE1</th>
                    <th>SE2</th>
                </tr>
              </thead>
            <tbody>
                @php
                     $dayWeek = ['Mon', 'Tue', 'Wed', 'Thu','Fri','Sat'];
                @endphp
                <tr>

                    @foreach ($dayWeek as $day)
                        @foreach (['matinS1', 'matinS2', 'AmidiS3', 'AmidiS4'] as $sessionType)
                        <td data-bs-toggle="modal" class="tdClass" data-bs-target="#exampleModal" class="Cases" id="{{$day.$sessionType }}"  >
                                @foreach ($sissions as $sission)
                                    @if ($sission->day === $day  && $sission->day_part === substr($sessionType, 0, 5) && $sission->dure_sission === substr($sessionType, -2))
                                        {{ $sission->sission_type }}<br />{{ $sission->class_name }}<br/>{{$sission->group_name}} <br/>{{$sission->module_name}}
                                    @endif
                                @endforeach
                            </td>
                        @endforeach
                    @endforeach
                </tr>

                     {{-- Model --}}
                     <div wire:ignore.self  class="modal fade col-9" id="exampleModal" tabindex="-1"
                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                     <div class="modal-dialog  modal-lg  ">
                        <div class="modal-content  col-9">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" >
                                    Create session</h1>
                                    @if ($errors->any())
                                    @foreach ( $errors->all() as $error)
                                    <div id="liveAlertPlaceholder" class="alert alert-danger">
                                        {{$error}}
                                    </div>
                              @endforeach
                              @endif

                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form wire:submit.prevent="createSession">
                                <div class="modal-body">

                                    <div style="display: flex">


                                        <select wire:model='brancheId'  class="form-select "  aria-label="Default select example">
                                        <option > Filiére</option>
                                        @if ($baranches)
                                        @foreach ($baranches as $baranche)
                                        <option value="{{ $baranche->id }}">{{ $baranche->name }}</option>
                                        @endforeach
                                        @endif
                                        </select>

                                        {{-- module  content --}}
                                        @if (!$checkValues[0]->module)
                                        <select wire:model="moduleID"   class="form-select"
                                        aria-label="Default select example">
                                            <option selected>Modules</option>
                                            @if ($modules)
                                                @foreach ($modules as $module)
                                                <option value="{{ $module->id }}">
                                                        {{ $module->module_name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        @endif

                                    </div>
                                    <div style="display: flex">
                                        {{-- Formateur --}}

                                        <select wire:model='groupID' class="form-select"
                                        aria-label="Default select example">
                                        <option selected>Groupes</option>
                                        @if ($groups)

                                            @foreach ($groups as $groupe)
                                                <option value="{{ $groupe->id }}">
                                                    {{ $groupe->group_name }}</option>
                                            @endforeach
                                            @endif

                                    </select>


                                        {{-- salle --}}
                                        @if (!$checkValues[0]->salle)
                                        <select wire:model="salle" class="form-select"
                                            aria-label="Default select example">
                                            <option selected>les salles</option>
                                            @if ($salles)
                                                @foreach ($salles as $salle)
                                                    <option value="{{ $salle->id }}">
                                                        {{ $salle->class_name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        @endif
                                    </div>
                                    {{-- tyope session --}}

                                    <div style="display: flex;justify-content: space-between">
                                        @if (!$checkValues[0]->typeSalle)
                                        <select wire:model="salleclassTyp" class="form-select"
                                            aria-label="Default select example">
                                            <option selected>les Types</option>
                                            @if ($classType)
                                                @foreach ($classType as $classTyp)
                                                    <option value="{{ $classTyp->id }}">
                                                        {{ $classTyp->class_room_types }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        @endif


                                    </div>
                                    <div style="display: flex">
                                        @if (!$checkValues[0]->typeSession)
                                        <select wire:model="TypeSesion" class="form-select"
                                            aria-label="Default select example">
                                            <option selected>Types</option>
                                            <option value="presentielle">Presentielle</option>
                                            <option value="teams">Teams</option>
                                            <option value="EFM">EFM</option>
                                        </select>
                                        @endif
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button data-bs-dismiss="modal"
                                    aria-label="Close" type="submit"  class="btn btn-primary">Save</button>
                                </div>
                            </form>

                    </div>
                 </div>

            </tbody>


        </table>

    </div>


<button class="btn  btn-primary mt-5" wire:click='AddAutherEmploi'> <span class="mdi mdi-plus"></span> Ajouter un autre</button>
      <!-- Button trigger modal -->
<button type="button" class="btn btn-danger mt-5 col-3" data-bs-toggle="modal" data-bs-target="#exampleModal1">
    Supprimer tout
  </button>
  <!-- Modal for delete-->
  <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Êtes-vous sûr(e)?</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            Voulez-vous supprimer toutes les sessions que vous avez créées ?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">fermer</button>
          <button type="button" wire:click='deleteAllSessions' class="btn btn-danger">Oui Supprimer Tout</button>
        </div>
      </div>
    </div>
  </div>
  {{-- end Modal for delete  --}}


  <script  >


    document.addEventListener('livewire:load', function () {
            let elements = document.querySelectorAll('[data-bs-toggle="modal"]');
            elements.forEach(element => {
                element.addEventListener('click', function() {
                    Livewire.emit('receiveVariable', element.id);
                    console.log(element.id)
                });
            });
        });

    </script>
</div>
