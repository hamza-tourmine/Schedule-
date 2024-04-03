<div>
    <div>
        <style>
         body {
            font-family: Arial, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            table-layout: fixed;
            word-wrap: break-word;
        }

        th,
        td {

            height: 40px;
            width: 520px !important;
            border: 1px solid #ddd;
            text-align: center;
        }
        td{
            height: 70px;
        }

        th {
            background-color: #f2f2f2;
        }
        thead tr.day{
            font-size: 18px;
            /* font-weight: bold; */
            padding:30px
        }
      thead tr.se-row {
            height: 30px !important;
            width: 30px;
            margin: 0px;
            padding: 0px;
            font-size: 16px
        }

        </style>
        @php
    @endphp
       <div style="display: flex;justify-content: space-between">
        <h2>Schedule Table</h2>
        <div  style="max-width: 350px; ">
            <label for=""><h4>date de emploi :</h4></label>
            <select id='date-select' class="form-select"  wire:model="selectedValue" wire:change="updateSelectedIDEmploi($event.target.value)">
                <option value="" disabled>Select emploi</option>
                @forEach( $Main_emplois as $Main_emploi)
                    <option value="{{ $Main_emploi->id }}">{{$Main_emploi->datestart  }} to {{$Main_emploi->dateend }}</option>
                @endforeach
            </select>
    </div>
    <div  style="max-width: 350px; ">
            <label for=""><h4>type d'emploi</h4></label>
            <select class="form-select"  wire:model="selectedType" wire:change="updateSelectedType($event.target.value)">
                <option  disabled>Select type</option>
                <option value="Formateur" selected>Formateur</option>
                <option value="Group">Group</option>
            </select>
    </div>

       </div>

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
        <div  class="table-responsive">
            <table id="tbl_exporttable_to_xls" style="overflow:scroll" class="col-md-12 "  >
                <thead>
                    <tr class="day">
                        <th style="width: 140px !important"  rowspan="3">@if ($selectedType ==="Formateur")
                           Nome  formateurs
                        @else
                        Nome Groupes
                        @endif</th>
                        <th colspan="4">Lundi</th>
                        <th colspan="4">Mardi</th>
                        <th colspan="4">Mercredi</th>
                        <th colspan="4">Jeudi</th>
                        <th colspan="4">Vendredi</th>
                        <th colspan="4">Samedi</th>
                    </tr>
                    <tr>
                        @for ($i =0 ; $i<6 ; $i++ )
                        <th colspan="2">Matin </th>
                        <th colspan="2">A.midi </th>
                        @endfor

                    </tr>
                    <tr class="se-row">
                             @for ($i =0 ; $i<12 ; $i++ )
                                <th >SE1</th>
                                <th>SE2</th>
                            @endfor
                    </tr>
                  </thead>
                <tbody>
                    @php
                     $dayWeek = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
                @endphp
                {{-- Model start --}}
                      <div wire:ignore.self  class="modal fade col-9" id="exampleModal" tabindex="-1"
                      aria-labelledby="exampleModalLabel" aria-hidden="true">
                      {{-- live wire  for diplay  new model update model  --}}

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
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form wire:submit.prevent="UpdateSession">
                                <div class="modal-body">
                                    <div style="display: flex">
                                        {{-- module  content --}}
                                        @if (!$checkValues[0]->module)
                                        <select wire:model="module" class="form-select "
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
                                        @if($selectedType==='Group')
                                        <select wire:model='formateur' class="form-select"
                                            aria-label="Default select example">

                                                <option selected>Formateurs</option>
                                                    @foreach ($formateurs as $formateur)
                                                        <option value="{{ $formateur->id }}">
                                                            {{ $formateur->user_name }}</option>
                                                    @endforeach
                                        </select>
                                        @else
                                        <select wire:model='group' class="form-select"
                                        aria-label="Default select example">
                                        <option selected>Groups</option>
                                                @foreach ($groups as $group)
                                                    <option value="{{ $group->id }}">
                                                        {{ $group->group_name }}</option>
                                                @endforeach
                                        </select>
                                            @endif

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
                                        </select>
                                        @endif
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button data-bs-dismiss="modal" wire:click="DeleteSession" aria-label="Close" type="button"  class="btn btn-danger">supprimer</button>
                                    <button data-bs-dismiss="modal" wire:click="UpdateSession" aria-label="Close" type="submit"  class="btn btn-success">Updare</button>
                                </div>
                            </form>
                </div>
                </div>
                  </div>

   {{-- FOR GROUPES  --}}
   @if($selectedType === 'Group')
   @foreach ($groups as $group)
   <tr>
       <td>{{$group->group_name}}</td>
       @foreach ($dayWeek as $day)
           @foreach (['MatinSE1', 'MatinSE2', 'AmidiSE1', 'AmidiSE2'] as $sessionType)
           <td data-bs-toggle="modal" data-bs-target="#exampleModal" class="Cases"  wire:click="getidCase('{{ $day.$sessionType.$group->id }}')"  id="{{$day.$sessionType.$group->id }}"  >
                   @foreach ($sissions as $sission)
                       @if ($sission->day === $day && $sission->group_id === $group->id && $sission->day_part === substr($sessionType, 0, 5) && $sission->dure_sission === substr($sessionType, 5))
                           {{ $sission->sission_type }}<br />{{ $sission->class_name }}<br />{{ $sission->user_name }}
                       @endif
                   @endforeach
               </td>
           @endforeach
       @endforeach
   </tr>
   @endforeach
       </div>
       {{-- FOR FORMATEUR --}}
       @else
       @foreach ($formateurs as $formateur)
    <tr>
        <td>{{$formateur->user_name}}</td>
        @foreach (['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'] as $day)
            @foreach (['MatinSE1', 'MatinSE2', 'AmidiSE1', 'AmidiSE2'] as $sessionType)
                <td data-bs-toggle="modal" data-bs-target="#exampleModal" class="Cases" wire:click="getidCase('{{$day . $sessionType . $formateur->id }}')" id="{{$day . $sessionType . $formateur->id }}">
                    @foreach ($sissions->where('user_id', $formateur->id) as $sission)
                        @if ($sission->day === $day && $sission->day_part === substr($sessionType, 0, 5) &&
                        $sission->dure_sission === substr($sessionType, 5))
                            {{ $sission->sission_type }}<br />{{ $sission->class_name }}<br />{{ $sission->group_name }}
                        @endif
                    @endforeach
                </td>
            @endforeach
        @endforeach
    </tr>
@endforeach

           @endif


                </tbody>
            </table>
        </div>
      <button onclick="ExportToExcel('xlsx')" class=" btn  btn-primary mt-5">
       telecharger</button>
      <!-- Button trigger modal -->
<button type="button" class="btn btn-danger col-3 mt-5" data-bs-toggle="modal" data-bs-target="#exampleModal1">
    Supprimer tout
  </button>
  <!-- Modal -->
  <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel1" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Êtes-vous sûr(e)?</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
        <div class="modal-body">
            Voulez-vous supprimer toutes les sessions de ce emploi ?
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">fermer</button>
            <button type="button" wire:click='deleteAllSessions' class="btn btn-danger">Oui Supprimer l'emploi</button>
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
    // selectElement.addEventListener('change', function() {
        // Livewire.emit('receiveidEmploiid', selectElement.value);
    // });

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


    </div>
</div>
