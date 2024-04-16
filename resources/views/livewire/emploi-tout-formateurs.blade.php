<div>
    <style>
        .checkboxContainer {
            background-color: white;
            border-radius: 7px;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 10px 15px;
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

    <h2>Schedule Table</h2>


    <div class="table-responsive">
        <h3 style="margin: auto ; width :fit-content;">Emploi Global hebdomadaire</h3>
        @if($tableEmploi[0]->toutFormateur == '1')
        <div class="input-group rounded">
            <input wire:model='SearchValue' style="max-width:400px" type="search" class="form-control rounded " placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
            <span class="input-group-text border-0" id="search-addon">
              <i class="fas fa-search"></i>
            </span>
        </div>

        <table id="tbl_exporttable_to_xls" style="overflow:scroll" class="col-md-12 ">

            <div style="display: flex ;justify-content:space-between ;marign-top:15px ">
                @if ($this->checkValues[0]->modeRamadan)
                <h4 style="marign-top:15px " >
                    SE1 = 08:30 - 10:20 SE2 = 10:25 - 12:15 SE3 = 12:45 - 14:35 SE4 = 14:40 - 16:30
                </h4>
                @else
                <h4> SE1 = 08:30 - 11:20 SE2 = 11:30 - 13:30 SE3 = 13:30 - 16:20 SE4 = 16:30 - 18:30 </h4>
                @endif



                    @if (!$dataEmploi->isEmpty())
                    <h4 style="float: right; margin-top: 15px;">
                        @foreach ($dataEmploi as $item)
                            Du: {{ $item->datestart }} au {{ $item->dateend }}
                        @endforeach
                    </h4>
                    @else
                    <h4 style="float: right; margin-top: 15px; padding: 0px 5px 0px 5px; border-radius: 3px; background-color: #dc3545; color: white;">
                        Il faut créer un emploi
                    </h4>
                    @endif


             </div>
              {{-- first table --}}

                        <thead>

                <tr class="day">
                    <th style="width: 140px !important" rowspan="4">Formateur Name</th>
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
                @if ($formateurs)
                @php
                     $dayWeek = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
                @endphp
                @foreach ($formateurs as $formateur)
                <tr>
                    <td>{{$formateur->user_name}}</td>
                    @foreach ($dayWeek as $day)
                        @foreach (['MatinSE1', 'MatinSE2', 'AmidiSE3', 'AmidiSE4'] as $sessionType)

                        <td data-bs-toggle="modal" data-bs-target="#exampleModal" class="Cases" id="{{$day.$sessionType.$formateur->id }}">
                            @php
                                $sessionWords = [];
                            @endphp
                            @foreach ($sissions as $sission)
                                @if ($sission->day      === $day &&
                                 $sission->user_id      === $formateur->id &&
                                 $sission->day_part     === substr($sessionType, 0, 5) &&
                                 $sission->dure_sission === substr($sessionType, 5))
                                    @php
                                        $details = $sission->sission_type . '<br>' . $sission->class_name . '<br>' . $sission->group_name . '<br>' .preg_replace('/^\d+/', '', $sission->module_name) ;
                                        $uniqueDetails = [];
                                        foreach (explode('<br>', $details) as $word) {
                                            if (!in_array($word, $sessionWords)) {
                                                $uniqueDetails[] = $word;
                                                $sessionWords[] = $word;
                                            }
                                        }
                                        echo implode('<br>', $uniqueDetails);
                                    @endphp
                                @endif
                            @endforeach
                        </td>
                        @endforeach
                    @endforeach
                </tr>
                @endforeach

                     {{-- Model --}}
                     <div wire:ignore.self  class="modal fade col-9"  id="exampleModal"
                      tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                     <div class="modal-dialog  modal-lg  ">
                        <div class="modal-content  col-9">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" >Create session</h1>
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
                                        {{-- branches --}}
                                        @if (!$checkValues[0]->branch)
                                        <select wire:model='brancheId'  class="form-select "  aria-label="Default select example">
                                            <option > Filiére</option>
                                            @if ($baranches)
                                            @foreach ($baranches as $baranche)
                                            <option value="{{ $baranche->id }}">{{ $baranche->name }}</option>
                                            @endforeach
                                            @endif
                                            </select >
                                            @endif
                                            {{-- year --}}

                                            @if (!$checkValues[0]->year)
                                            <select wire:model='selectedYear'  class="form-select "  aria-label="Default select example">
                                                <option > année </option>
                                                @if ($yearFilter)
                                                @foreach ($yearFilter as $item)
                                                <option value="{{ $item }}">{{ $item}}</option>
                                                @endforeach
                                                @endif
                                            </select >
                                            @endif
                                               {{-- module  content --}}
                                         @if (!$checkValues[0]->module)
                                         <select wire:model="module" class="form-select "
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
                                    <div style="display: block">

                                      {{-- Groupes --}}
                                      @if ($groups)
                                      <div class="mb-3">
                                        <h6 style="margin: 10px;">Groupes</h6>
                                        <div style="width: 100%;" style="" class="checkboxContainer ">
                                            @foreach ($groups as $group)
                                                <span style="display: block">
                                                    <input class="modulesoption" type="checkbox" wire:model="selectedGroups.{{ $group->id }}" value="{{ $group->id }}">
                                                    <label>{{ $group->group_name }}</label>
                                                </span>
                                            @endforeach
                                        </div>
                                    </div>
                                    @else
                                    <div class="mb-3">
                                        <h6 style="margin: 10px;">Groupes</h6>
                                        <div style="width: 100%;" style="" class="checkboxContainer ">
                                           No groupe trouver !
                                        </div>
                                    </div>
                                    @endif
                                    <br>

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

                                        {{-- id case --}}
                                        <input type="hidden"   value="{{$receivedVariable}}" >
                                    </div>
                                    {{-- day part && type sission --}}
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
                        @endif
            </tbody>
              {{-- end first table table --}}
        </table>
        @else
        @include('livewire.ToutFormateur')
        @endif


    </div>

    <button onclick="ExportToExcel('xlsx')" class=" btn  btn-primary mt-5">telecharger</button>
<button class="btn  btn-primary mt-5" wire:click='AddAutherEmploi'> <span class="mdi mdi-plus"></span> Ajouter un autre</button>
      <!-- Button trigger modal -->
<button type="button" class="btn btn-danger mt-5 col-3" data-bs-toggle="modal" data-bs-target="#exampleModal1">
    Supprimer tout
  </button>
  <!-- Modal for delete-->
  <div wire:ignore class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
              Livewire.emit('receiveVariable', element.id);
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


        document.addEventListener('DOMContentLoaded', function() {
            const handleDomChanges = function(mutationsList, observer) {

                // console.log( document.querySelectorAll('.TableCases'));
                let elements = document.querySelectorAll('[data-bs-toggle="modal"]');
            elements.forEach(element => {
                element.addEventListener('click', function() {
                    Livewire.emit('receiveVariable', element.id);
                    console.log(element.id)
                });
            });
            };
                const observerConfig = { childList: true, subtree: true };
                const observer = new MutationObserver(handleDomChanges);
                observer.observe(document.body, observerConfig);
});


    </script>
</div>