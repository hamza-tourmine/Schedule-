<div>
    <style>
          .dateContent{
            width: 85vw ;
            display: flex ;
            justify-content: space-between
        }
        @media screen and (max-width:600px){
            .dateContent{
            margin-top: 15px ;
            width: 95vw ;
            display: flex ;
            flex-direction: column
        }
        .hide{
            display: none ;
        }
        .data{
            margin-top:5px
        }
        }

        #SearchInput{
            width: 45% !important;
        }

        @media screen and (max-width: 600px){
            #SearchInput{
            width: 100% !important;
        }
        }

    </style>
    @php

@endphp
    <h2>Schedule Table</h2>


    <div  class="table-responsive">
        <h3 class="hide" style="margin: auto ; width :fit-content;">Emploi Global hebdomadaire</h3>
        @if($tableEmploi[0]->toueGroupe == '1')
        <div id="SearchInput" class="input-group rounded">
            <input wire:model='SearchValue' style="max-width:400px" type="search" class="form-control rounded " placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
            <span class="input-group-text border-0" id="search-addon">
              <i class="fas fa-search"></i>
            </span>
        </div>





        <table id="tbl_exporttable_to_xls" style="overflow:scroll" class="col-md-12 ">
            <div class="dateContent">
                @if ($this->checkValues[0]->modeRamadan)
                <h4 style="marign-top:15px " >
                    SE1 = 08:30 - 10:20 SE2 = 10:25 - 12:15 SE3 = 12:45 - 14:35 SE4 = 14:40 - 16:30
                </h4>
                @else
                <h4> SE1 = 08:30 - 11:20 SE2 = 11:30 - 13:30 SE3 = 13:30 - 16:20 SE4 = 16:30 - 18:30 </h4>
                @endif



                    @if (!$dataEmploi->isEmpty())
                    <h4 class='data' style="float: right; ">
                        @foreach ($dataEmploi as $item)
                            Du: {{ $item->datestart }} au {{ $item->dateend }}
                        @endforeach
                    </h4>
                    @else
                    <h4 class='data' style="float: right;  padding: 0px 5px 0px 5px;
                     border-radius: 3px; background-color: #dc3545; color: white;">
                        Il faut créer un emploi
                    </h4>
                    @endif


             </div>

            <thead>


                <tr class="day">
                    <th style="width: 140px !important"  rowspan="3">Groups Name</th>
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
                @if ($groups)
                @php
                     $dayWeek = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
                @endphp
                @foreach ($groups as $group)
                <tr>
                    <td>{{ $group->group_name }}</td>
                    @foreach ($dayWeek as $day)
                        @foreach (['MatinSE1', 'MatinSE2', 'AmidiSE3', 'AmidiSE4'] as $sessionType)
                            @php
                                $foundSession = false;
                            @endphp
                            @foreach ($sissions as $sission)
                                @if ($sission->day === $day &&
                                     $sission->group_id === $group->id &&
                                     $sission->day_part === substr($sessionType, 0, 5) &&
                                     $sission->dure_sission === substr($sessionType, 5))
                                    @php
                                        $foundSession = true;
                                    @endphp
                                    <td wire:click="updateCaseStatus(false , true)"
                                        colspan="1" rowspan="1"
                                        data-bs-toggle="modal"
                                        data-bs-target="#exampleModal"
                                        class="TableCases"
                                        style="background-color:{{ $isActive ? 'rgba(12, 72, 166, 0.3)' :  ''}} ;"
                                        id="{{ $day.$sessionType.$group->id }}">
                                        {{ $sission->sission_type }}<br>
                                        {{ $sission->class_name }}<br>
                                        {{ $sission->typeSalle }}<br>
                                        {{ $sission->user_name }}<br>
                                        {{ preg_replace('/^\d/' , ' ' , $sission->module_name ) }}
                                    </td>
                                    @break
                                @endif
                            @endforeach
                            @if (!$foundSession)
                                <td wire:click="updateCaseStatus(true , true)"
                                    colspan="1" rowspan="1"
                                    data-bs-toggle="modal"
                                    data-bs-target="#exampleModal"
                                    class="TableCases"
                                    {{-- style="white-space: nowrap;" --}}
                                    id="{{ $day.$sessionType.$group->id }}">
                                </td>
                            @endif
                        @endforeach
                    @endforeach
                </tr>

                @endforeach

                  @include('livewire.GroupModule')
                @endif
            </tbody>
        </table>

        @else
                @include('livewire.tout-groupes22')
                @endif
    </div>

    <button id="sheetjsexport" onclick="ExportToExcel('xlsx')" class=" btn  btn-primary mt-5">  télécharger</button>

      <!-- Button trigger modal -->
<button type="button" class="btn btn-danger mt-5 col-3" data-bs-toggle="modal" data-bs-target="#exampleModal1"> Supprimer tout</button>
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
          }
      });
  });
});



    document.addEventListener('livewire:load', function () {
            let elements = document.querySelectorAll('[data-bs-toggle="modal"]');
            elements.forEach(element => {
                element.addEventListener('click', function() {
                    Livewire.emit('receiveVariable', element.id);
                });
            });
        });



        document.addEventListener('DOMContentLoaded', function() {
            const handleDomChanges = function(mutationsList, observer) {
            let elements = document.querySelectorAll('[data-bs-toggle="modal"]');
            elements.forEach(element => {
                element.addEventListener('click', function() {
                    Livewire.emit('receiveVariable', element.id);

                });
            });

            };
                const observerConfig = { childList: true, subtree: true };
                const observer = new MutationObserver(handleDomChanges);
                observer.observe(document.body, observerConfig);
});

    </script>

</div>
