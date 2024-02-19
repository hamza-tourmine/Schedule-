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
            }

            th,
            td {
                height: 40px;
                width: 60px !important;
                border: 1px solid #ddd;
                text-align: center;
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
                        <th rowspan="3">Groups Name</th>
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


                    @if ($selectedType === 'Group')
                    @php
                     $dayWeek = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
                @endphp
                      <div wire:ignore.self  class="modal fade col-9" id="exampleModal" tabindex="-1"
                      aria-labelledby="exampleModalLabel" aria-hidden="true">
                      {{-- live wire  for diplay  new model update model  --}}
                      @livewire('model-update-group-emploi',
                      ['classType'=>$classType,
                      'salles'=>$salles ,
                      'formateurs'=>$formateurs,
                      'FormateurOrgroup'=>'Group',
                      'modules'=>$modules,

                      ]);
                      {{-- 'receivedVariable'=>$receivedVariable --}}
                  </div>
                @foreach ($groups as $group)
                <tr>
                    <td>{{$group->group_name}}</td>
                    @foreach ($dayWeek as $day)
                        @foreach (['matinS1', 'matinS2', 'AmidiS1', 'AmidiS2'] as $sessionType)
                        <td data-bs-toggle="modal" data-bs-target="#exampleModal" class="Cases" id="{{$day.$sessionType.$group->id }}"  >
                                @foreach ($sissions as $sission)
                                    @if ($sission->day === $day && $sission->group_id === $group->id && $sission->day_part === substr($sessionType, 0, 5) && $sission->dure_sission === substr($sessionType, -2))
                                        {{ $sission->sission_type }}<br />{{ $sission->class_name }}<br />{{ $sission->user_name }}
                                    @endif
                                @endforeach
                            </td>
                        @endforeach
                    @endforeach
                </tr>
                @endforeach
                        {{-- For formateur emploi --}}
                        @else
                        <div wire:ignore.self  class="modal fade col-9" id="exampleModal" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        {{-- live wire  for diplay  new model update model  --}}
                        @livewire('model-update-group-emploi',
                        ['classType'=>$classType,
                        'salles'=>$salles ,
                        'FormateurOrgroup'=>'formateur',
                        'groups'=>$groups,
                        'modules'=>$modules,
                        ]);
                        {{-- 'receivedVariable'=>$receivedVariable --}}
                    </div>
                        @forEach ($formateurs as $formateur)
                        <tr>
                            <td>{{$formateur->user_name}}</td>
                            @foreach ( ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'] as $day)
                                @foreach (['matinS1', 'matinS2', 'AmidiS1', 'AmidiS2'] as $sessionType)
                                    <td  data-bs-toggle="modal" data-bs-target="#exampleModal" class="Cases" id="{{$day . $sessionType . $formateur->id }}">
                                        @foreach ($sissions as $sission)
                                            @if ($sission->day === $day && $sission->user_id === $formateur->id && $sission->day_part === substr($sessionType, 0, 5) && $sission->dure_sission === substr($sessionType, -2))
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


    </div>
</div>
