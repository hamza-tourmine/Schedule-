<table id="tbl_exporttable_to_xls"  style="overflow:scroll" class="col-md-12 ">
    <thead>
        <div style="display: flex ;justify-content:space-between ;marign-top:15px ">

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
<tr class="day">
    <th style="width: 200px !important" colspan="2" rowspan="3">Groups Name</th>
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

    <th>08h30-11h</th>
    <th>11h-13h30</th>
    <th>13h30-16h</th>
    <th>16h-18h30</th>


    <th>08h30-11h</th>
    <th>11h-13h30</th>
    <th>13h30-16h</th>
    <th>16h-18h30</th>

    <th>08h30-11h</th>
    <th>11h-13h30</th>
    <th>13h30-16h</th>
    <th>16h-18h30</th>

     <th>08h30-11h</th>
    <th>11h-13h30</th>
    <th>13h30-16h</th>
    <th>16h-18h30</th>

     <th>08h30-11h</th>
    <th>11h-13h30</th>
    <th>13h30-16h</th>
    <th>16h-18h30</th>

     <th>08h30-11h</th>
    <th>11h-13h30</th>
    <th>13h30-16h</th>
    <th>16h-18h30</th>

</tr>
</thead>


<tbody>
    @if ($groups)
        @php
            $dayWeek = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
            $sessionData = ['Formateur', 'Module','Salle' ,'type Séance'];
            if ($checkValues[0]->module){
                unset($sessionData[1]);
            }
            elseif ($checkValues[0]->typeSession) {
                unset($sessionData[3]);
            }
        @endphp
        @foreach ($groups as $group)
            <tr>
                <td style="height: 50px !important ;overflow: hidden;" rowspan="{{ count($sessionData) }}">{{ $group->group_name }}</td>
                @foreach ($sessionData as $item)
                <td style="height: 50px !important ;overflow: hidden">{{ $item }}</td>
                    @foreach ($dayWeek as $day)
                        @foreach (['MatinSE1', 'MatinSE2', 'AmidiSE3', 'AmidiSE4'] as $sessionType)
                            <td style="height: 50px !important ;overflow: hidden" colspan="1" rowspan="1" data-bs-toggle="modal" data-bs-target="#exampleModal" class="TableCases" id="{{ $day . $sessionType . $group->id }}">
                                @foreach ($sissions as $sission)
                                    @if ($sission->day === $day &&
                                     $sission->group_id === $group->id &&
                                     $sission->day_part === substr($sessionType, 0, 5) &&
                                     $sission->dure_sission === substr($sessionType, 5))
                                        @if ($item === 'Formateur')
                                            {{ $sission->user_name }}
                                        @elseif ($item === 'Module' )
                                            {{ preg_replace('/^\d+/', '', $sission->module_name) }}
                                        @elseif ($item === 'Salle')
                                            {{ $sission->class_name }}
                                        @elseif($item == 'type Séance')
                                             {{ $sission->sission_type }}
                                        @endif
                                    @endif
                                @endforeach
                            </td>
                        @endforeach
                    @endforeach
                    </tr><tr>
                @endforeach
            </tr>
        @endforeach


                     {{-- Model --}}
                     <div wire:ignore.self  class="modal fade col-9" id="exampleModal" tabindex="-1"
                     aria-labelledby="exampleModalLabel" aria-hidden="true" >
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
                                           @if ($formateurs)
                                           <select wire:model='formateur' class="form-select"
                                               aria-label="Default select example">
                                               <option selected>Formateurs</option>
                                                   @foreach ($formateurs as $formateur)
                                                       <option value="{{ $formateur->id }}">
                                                           {{ $formateur->user_name }}</option>
                                                   @endforeach

                                           </select>
                                           @endif
                                           @endif
                                    </div>
                                    <div style="display: flex">
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
</table>



