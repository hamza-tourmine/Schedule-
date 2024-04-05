<div>

    @php

@endphp
    <h2>Schedule Table</h2>

</div>
    <div style="width:200px ;  display:flex; flex-direction :column-reverse">

        <select wire:model="groupID" id="formateurSelected" class="form-control col-3" name="">
            <option > les Groupes</option>
            @foreach ($groups as $group)
               <option class="form-control"  value="{{$group->id}}">{{$group->group_name}} </option>
            @endforeach
        </select>
        <label for="" style="font-size: 19px"> les Groupes</label>
    </div>
  </div>

    <div class="table-responsive">
        <h3 style="margin: auto ; width :fit-content;">Emploi Global hebdomadaire</h3>
        <table  style="overflow:scroll" class="col-md-12 ">
            <h3 style="float: right; margin: 10px;">
                @if ($dataEmploi)
                @foreach ( $dataEmploi as  $item)
                Du: {{ $item->datestart}} au {{ $item->dateend}}
                @endforeach
                @else
                    Il faut créer un emploi
                @endif
            </h3>
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
                        @foreach (['MatinSE1', 'MatinSE2', 'AmidiSE3', 'AmidiSE4'] as $sessionType)
                        <td data-bs-toggle="modal" class="tdClass" data-bs-target="#exampleModal" class="Cases" id="{{$day.$sessionType }}"  >
                                @foreach ($sissions as $sission)
                                    @if ($sission->day === $day && $sission->group_id === $groupID && $sission->day_part === substr($sessionType, 0, 5) && $sission->dure_sission === substr($sessionType, 5))
                                        {{ $sission->sission_type }}<br />{{ $sission->class_name }}<br />{{ $sission->user_name }} <br />{{ $sission->module_name }}
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


                                           {{-- Formateur --}}

                                           <select wire:model='formateurId' class="form-select"
                                           aria-label="Default select example">
                                           <option selected>Les Formateur</option>
                                           @if ($formateurs)

                                               @foreach ($formateurs as $formateur)
                                                   <option value="{{ $formateur->id }}">
                                                       {{ $formateur->user_name  }}</option>
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
