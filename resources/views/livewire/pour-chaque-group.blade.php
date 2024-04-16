<div>


    <h2>Schedule Table</h2>
  <div style="display: flex;">
    <div style=" width :300px">
</div>
    <div style="width:200px ;  display:flex; flex-direction :column-reverse">

        <select style="maxWidth:45vw" wire:model="groupID" id="formateurSelected" class="form-control col-3" name="">
            <option > les Groupes</option>
            @foreach ($groups as $group)
               <option class="form-control"  value="{{$group->id}}">{{$group->group_name}} </option>
            @endforeach
        </select>
        <label for="" style="font-size: 19px"> les Groupes</label>
    </div>
  </div>

    <div class="table-responsive">

        <table id="tbl_exporttable_to_xls" style="overflow:scroll" class="col-md-12 ">
            <div >
                @if ($this->checkValues[0]->modeRamadan)
                <h5 colspan="6" style="marign-top:15px " >
                    SE1 = 08:30 - 10:20 SE2 = 10:25 - 12:15 SE3 = 12:45 - 14:35 SE4 = 14:40 - 16:30
                </h5>
                @else
                <h5 colspan="6"> SE1 = 08:30 - 11:00 SE2 = 11:00 - 13:30 SE3 = 13:30 - 16:20 SE4 = 16:30 - 18:30 </h5>
                @endif
                    @if (!$dataEmploi->isEmpty())
                    <h5 colspan="6" style="float: right; margin-top: 15px;">
                        @foreach ($dataEmploi as $item)
                            Du: {{ $item->datestart }} au {{ $item->dateend }}
                        @endforeach
                    </h5>
                    @else
                    <h5 colspan="6" style="float: right; margin-top: 15px; padding: 0px 5px 0px 5px; border-radius: 3px; background-color: #dc3545; color: white;">
                        Il faut créer un emploi
                </h5>
                    @endif

                </div>

             @if($tableEmploi[0]->groupe == '2')
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
                                        {{ $sission->sission_type }}<br />{{ $sission->class_name }}<br />{{ $sission->user_name }} <br />{{ preg_replace('/^\d+/', '', $sission->module_name) }}
                                    @endif
                                @endforeach
                            </td>
                        @endforeach
                    @endforeach
                </tr>
                            </form>
                    </div>
                 </div>

            </tbody>
            @elseif ($tableEmploi[0]->groupe == '1')
            @include('livewire.PourGroupe')
            @else
            @include('livewire.PourGroup3')
            @endif


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
                                           @if (!$checkValues[0]->formateur)
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
                                       @endif


                                        {{-- module  content --}}
                                        @if (!$checkValues[0]->module)
                                        <select wire:model="moduleID"   class="form-select"
                                        aria-label="Default select example">
                                            <option selected>Modules</option>
                                            @if ($modules)
                                                @foreach ($modules as $module)
                                                <option value="{{ $module->id }}">
                                                    {{ preg_replace('/^\d+/' , '' ,$module->id )}}</option>

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
        </table>


    </div>

    <button onclick="ExportToExcel('xlsx')" class=" btn  btn-primary mt-5">
        telecharger</button>
<button class="btn  btn-primary mt-5" wire:click='AddAutherEmploi'> <span class="mdi mdi-plus"></span> Ajouter un autre</button>
      <!-- Button trigger modal -->
      <button type="button" class="btn btn-danger mt-5 col-3" data-bs-toggle="modal" data-bs-target="#exampleModal111">
        Supprimer tout
    </button>

    <!-- Modal for delete-->
    <div wire:ignore class="modal fade" id="exampleModal111" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Confirmer la suppression</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Êtes-vous sûr(e) de vouloir supprimer toutes les sessions que vous avez créées ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    <button type="button" class="btn btn-danger" wire:click='deleteAllSessions'>Oui, Supprimer Tout</button>
                </div>
            </div>
        </div>
    </div>
</div>

  {{-- end Modal for delete  --}}
  <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
  <script type="text/javascript" >

  function ExportToExcel(type, fn, dl) {
         var elt = document.getElementById('tbl_exporttable_to_xls');
         var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
         return dl ?
           XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }):
           XLSX.writeFile(wb, fn || ('Schedule.' + (type || 'xlsx')));
      }


  document.addEventListener('livewire:load', function () {
  const selectElement = document.getElementById('date-select');
  selectElement.addEventListener('change', function() {
      Livewire.emit('receiveidEmploiid', selectElement.value);
  });

  let elements = document.querySelectorAll('[data-bs-toggle="modal"], .Cases');
  elements.forEach(element => {
      element.addEventListener('click', function() {
          if (element.classList.contains('Cases')) {
              Livewire.emit('receiveVariable', element.id );
              console.log(element.id);
          }
      });
  });
});


</script>

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
