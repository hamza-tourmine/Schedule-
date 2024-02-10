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


        <select id='date-select' class="form-select" wire:model.live="selectedValue" wire:change="updateSelectedIDEmploi($event.target.value)">
            <option value="" disabled>Select emploi</option>
            @forEach( $Main_emplois as $Main_emploi)
                <option value="{{ $Main_emploi->id }}">{{$Main_emploi->datestart  }} to {{$Main_emploi->dateend }}</option>
            @endforeach
        </select>


    </div>

    <div  style="max-width: 350px; ">
        <label for=""><h4>type d'emploi</h4></label>
        <select class="form-select" wire:model.live="selectedType" wire:change="updateSelectedType($event.target.value)">
            <option value="" disabled>Select type</option>
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


        <div   wire:loading.remove class="table-responsive">
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






                    @if ($selectedType === 'Group')
                        @foreach ($groups as $group)
                        <tr>
                            <td>{{$group->group_name}}</td>
                      <!-- Monday -S1 -->
                        <td  data-bs-toggle="modal" data-bs-target="#exampleModal{{ $group->id }}" class="Cases" id="MonmatinS1{{ $group->id }}">
                            @foreach ($sissions as $sission)
                                @if ($sission->day === 'Mon' && $sission->group_id === $group->id && $sission->day_part === 'matin' && $sission->dure_sission === "S1")
                                    {{ $sission->sission_type }} <br /> {{ $sission->class_name }} <br /> {{ $sission->user_name }}
                                @endif
                            @endforeach
                        </td>

                        <!-- Monday -S2 -->
                        <td data-bs-toggle="modal" data-bs-target="#exampleModal{{ $group->id }}" class="Cases" id="MonmatinS2{{ $group->id }}">
                            @foreach ($sissions as $sission)
                                @if ($sission->day === 'Mon' && $sission->group_id === $group->id && $sission->day_part === "matin" && $sission->dure_sission === "S2")
                                    {{ $sission->sission_type }}<br />{{ $sission->class_name }}<br />{{ $sission->user_name }}
                                @endif
                            @endforeach
                        </td>

                        <!-- Monday - A.midi S1 -->
                        <td data-bs-toggle="modal" data-bs-target="#exampleModal{{ $group->id }}" class="Cases" id="MonAmidiS1{{ $group->id }}">
                            @foreach ($sissions as $sission)
                                @if ($sission->day === 'Mon' && $sission->group_id === $group->id && $sission->day_part === "Amidi" && $sission->dure_sission === "S1")
                                    {{ $sission->sission_type }}<br />{{ $sission->class_name }}<br />{{ $sission->user_name }}
                                @endif
                            @endforeach
                        </td>

                        <!-- Monday - A.midi S2 -->
                        <td data-bs-toggle="modal" data-bs-target="#exampleModal{{ $group->id }}" class="Cases" id="MonAmidiS2{{ $group->id }}">
                            @foreach ($sissions as $sission)
                                @if ($sission->day === 'Mon' && $sission->group_id === $group->id && $sission->day_part === "Amidi" && $sission->dure_sission === "S2")
                                    {{ $sission->sission_type }}<br />{{ $sission->class_name }}<br />{{ $sission->user_name }}
                                @endif
                            @endforeach
                        </td>
                           <!-- Tue - S1 -->
                        <td data-bs-toggle="modal" data-bs-target="#exampleModal{{ $group->id }}" class="Cases" id="TuematinS1{{ $group->id }}">
                            @foreach ($sissions as $sission)
                                @if ($sission->day === 'Tue' && $sission->group_id === $group->id && $sission->day_part === 'matin' && $sission->dure_sission === "S1")
                                    {{ $sission->sission_type }} <br /> {{ $sission->class_name }} <br /> {{ $sission->user_name }}
                                @endif
                            @endforeach
                        </td>
                        <!-- Tue - S2 -->
                        <td data-bs-toggle="modal" data-bs-target="#exampleModal{{ $group->id }}" class="Cases" id="TuematinS2{{ $group->id }}">
                            @foreach ($sissions as $sission)
                                @if ($sission->day === 'Tue' && $sission->group_id === $group->id && $sission->day_part === "matin" && $sission->dure_sission === "S2")
                                    {{ $sission->sission_type }}<br />{{ $sission->class_name }}<br />{{ $sission->user_name }}
                                @endif
                            @endforeach
                        </td>
                        <!-- Tue - A.midi S1 -->
                        <td data-bs-toggle="modal" data-bs-target="#exampleModal{{ $group->id }}" class="Cases" id="TueAmidiS1{{ $group->id }}">
                            @foreach ($sissions as $sission)
                                @if ($sission->day === 'Tue' && $sission->group_id === $group->id && $sission->day_part === "Amidi" && $sission->dure_sission === "S1")
                                    {{ $sission->sission_type }}<br />{{ $sission->class_name }}<br />{{ $sission->user_name }}
                                @endif
                            @endforeach
                        </td>

                        <!-- Tue - A.midi S2 -->
                        <td data-bs-toggle="modal" data-bs-target="#exampleModal{{ $group->id }}" class="Cases" id="TueAmidiS2{{ $group->id }}">
                            @foreach ($sissions as $sission)
                                @if ($sission->day === 'Tue' && $sission->group_id === $group->id && $sission->day_part === "Amidi" && $sission->dure_sission === "S2")
                                    {{ $sission->sission_type }}<br />{{ $sission->class_name }}<br />{{ $sission->user_name }}
                                @endif
                            @endforeach
                        </td>
                        <!-- Wed - S1 -->
                        <td data-bs-toggle="modal" data-bs-target="#exampleModal{{ $group->id }}" class="Cases" id="WedmatinS1{{ $group->id }}">
                            @foreach ($sissions as $sission)
                                @if ($sission->day === 'Wed' && $sission->group_id === $group->id && $sission->day_part === 'matin' && $sission->dure_sission === "S1")
                                    {{ $sission->sission_type }} <br /> {{ $sission->class_name }} <br /> {{ $sission->user_name }}
                                @endif
                            @endforeach
                        </td>
                        <!-- Wed - S2 -->
                        <td data-bs-toggle="modal" data-bs-target="#exampleModal{{ $group->id }}" class="Cases" id="WedmatinS2{{ $group->id }}">
                            @foreach ($sissions as $sission)
                                @if ($sission->day === 'Wed' && $sission->group_id === $group->id && $sission->day_part === "matin" && $sission->dure_sission === "S2")
                                    {{ $sission->sission_type }}<br />{{ $sission->class_name }}<br />{{ $sission->user_name }}
                                @endif
                            @endforeach
                        </td>
                        <!-- Wed - A.midi S1 -->
                        <td data-bs-toggle="modal" data-bs-target="#exampleModal{{ $group->id }}" class="Cases" id="WedAmidiS1{{ $group->id }}">
                            @foreach ($sissions as $sission)
                                @if ($sission->day === 'Wed' && $sission->group_id === $group->id && $sission->day_part === "Amidi" && $sission->dure_sission === "S1")
                                    {{ $sission->sission_type }}<br />{{ $sission->class_name }}<br />{{ $sission->user_name }}
                                @endif
                            @endforeach
                        </td>
                        <!-- Wed - A.midi S2 -->
                        <td data-bs-toggle="modal" data-bs-target="#exampleModal{{ $group->id }}" class="Cases" id="WedAmidiS2{{ $group->id }}">
                            @foreach ($sissions as $sission)
                                @if ($sission->day === 'Wed' && $sission->group_id === $group->id && $sission->day_part === "Amidi" && $sission->dure_sission === "S2")
                                    {{ $sission->sission_type }}<br />{{ $sission->class_name }}<br />{{ $sission->user_name }}
                                @endif
                            @endforeach
                        </td>
                         <!-- Thu - S1 -->
                        <td data-bs-toggle="modal" data-bs-target="#exampleModal{{ $group->id }}" class="Cases" id="ThumatinS1{{ $group->id }}">
                            @foreach ($sissions as $sission)
                                @if ($sission->day === 'Thu' && $sission->group_id === $group->id && $sission->day_part === 'matin' && $sission->dure_sission === "S1")
                                    {{ $sission->sission_type }} <br /> {{ $sission->class_name }} <br /> {{ $sission->user_name }}
                                @endif
                            @endforeach
                        </td>
                        <!-- Thu - S2 -->
                        <td data-bs-toggle="modal" data-bs-target="#exampleModal{{ $group->id }}" class="Cases" id="ThumatinS2{{ $group->id }}">
                            @foreach ($sissions as $sission)
                                @if ($sission->day === 'Thu' && $sission->group_id === $group->id && $sission->day_part === "matin" && $sission->dure_sission === "S2")
                                    {{ $sission->sission_type }}<br />{{ $sission->class_name }}<br />{{ $sission->user_name }}
                                @endif
                            @endforeach
                        </td>
                        <!-- Thu - A.midi S1 -->
                        <td data-bs-toggle="modal" data-bs-target="#exampleModal{{ $group->id }}" class="Cases" id="ThuAmidiS1{{ $group->id }}">
                            @foreach ($sissions as $sission)
                                @if ($sission->day === 'Thu' && $sission->group_id === $group->id && $sission->day_part === "Amidi" && $sission->dure_sission === "S1")
                                    {{ $sission->sission_type }}<br />{{ $sission->class_name }}<br />{{ $sission->user_name }}
                                @endif
                            @endforeach
                        </td>

                        <!-- Thu - A.midi S2 -->
                        <td data-bs-toggle="modal" data-bs-target="#exampleModal{{ $group->id }}" class="Cases" id="ThuAmidiS2{{ $group->id }}">
                            @foreach ($sissions as $sission)
                                @if ($sission->day === 'Thu' && $sission->group_id === $group->id && $sission->day_part === "Amidi" && $sission->dure_sission === "S2")
                                    {{ $sission->sission_type }}<br />{{ $sission->class_name }}<br />{{ $sission->user_name }}
                                @endif
                            @endforeach
                        </td>
                          <!-- Fri - S1 -->
                          <td data-bs-toggle="modal" data-bs-target="#exampleModal{{ $group->id }}" class="Cases" id="FrimatinS1{{ $group->id }}">
                            @foreach ($sissions as $sission)
                                @if ($sission->day === 'Fri' && $sission->group_id === $group->id && $sission->day_part === 'matin' && $sission->dure_sission === "S1")
                                    {{ $sission->sission_type }} <br /> {{ $sission->class_name }} <br /> {{ $sission->user_name }}
                                @endif
                            @endforeach
                        </td>
                        <!-- Fri - S2 -->
                        <td data-bs-toggle="modal" data-bs-target="#exampleModal{{ $group->id }}" class="Cases" id="FrimatinS2{{ $group->id }}">
                            @foreach ($sissions as $sission)
                                @if ($sission->day === 'Fri' && $sission->group_id === $group->id && $sission->day_part === "matin" && $sission->dure_sission === "S2")
                                    {{ $sission->sission_type }}<br />{{ $sission->class_name }}<br />{{ $sission->user_name }}
                                @endif
                            @endforeach
                        </td>
                        <!-- Fri - A.midi S1 -->
                        <td data-bs-toggle="modal" data-bs-target="#exampleModal{{ $group->id }}" class="Cases" id="FriAmidiS1{{ $group->id }}">
                            @foreach ($sissions as $sission)
                                @if ($sission->day === 'Fri' && $sission->group_id === $group->id && $sission->day_part === "Amidi" && $sission->dure_sission === "S1")
                                    {{ $sission->sission_type }}<br />{{ $sission->class_name }}<br />{{ $sission->user_name }}
                                @endif
                            @endforeach
                        </td>
                        <!-- Fri - A.midi S2 -->
                        <td data-bs-toggle="modal" data-bs-target="#exampleModal{{ $group->id }}" class="Cases" id="FriAmidiS2{{ $group->id }}">
                            @foreach ($sissions as $sission)
                                @if ($sission->day === 'Fri' && $sission->group_id === $group->id && $sission->day_part === "Amidi" && $sission->dure_sission === "S2")
                                    {{ $sission->sission_type }}<br />{{ $sission->class_name }}<br />{{ $sission->user_name }}
                                @endif
                            @endforeach
                        </td>
                          <!-- Sat - S1 -->
                          <td data-bs-toggle="modal" data-bs-target="#exampleModal{{ $group->id }}" class="Cases" id="SatmatinS1{{ $group->id }}">
                            @foreach ($sissions as $sission)
                                @if ($sission->day === 'Sat' && $sission->group_id === $group->id && $sission->day_part === 'matin' && $sission->dure_sission === "S1")
                                    {{ $sission->sission_type }} <br /> {{ $sission->class_name }} <br /> {{ $sission->user_name }}
                                @endif
                            @endforeach
                        </td>

                        <!-- Sat - S2 -->
                        <td data-bs-toggle="modal" data-bs-target="#exampleModal{{ $group->id }}" class="Cases" id="SatmatinS2{{ $group->id }}">
                            @foreach ($sissions as $sission)
                                @if ($sission->day === 'Thu' && $sission->group_id === $group->id && $sission->day_part === "matin" && $sission->dure_sission === "S2")
                                    {{ $sission->sission_type }}<br />{{ $sission->class_name }}<br />{{ $sission->user_name }}
                                @endif
                            @endforeach
                        </td>
                        <!-- Sat - A.midi S1 -->
                        <td data-bs-toggle="modal" data-bs-target="#exampleModal{{ $group->id }}" class="Cases" id="SatAmidiS1{{ $group->id }}">
                            @foreach ($sissions as $sission)
                                @if ($sission->day === 'Sat' && $sission->group_id === $group->id && $sission->day_part === "Amidi" && $sission->dure_sission === "S1")
                                    {{ $sission->sission_type }}<br />{{ $sission->class_name }}<br />{{ $sission->user_name }}
                                @endif
                            @endforeach
                        </td>
                        <!-- Sat - A.midi S2 -->
                        <td data-bs-toggle="modal" data-bs-target="#exampleModal{{ $group->id }}" class="Cases" id="SatAmidiS2{{ $group->id }}">
                            @foreach ($sissions as $sission)
                                @if ($sission->day === 'Sat' && $sission->group_id === $group->id && $sission->day_part === "Amidi" && $sission->dure_sission === "S2")
                                    {{ $sission->sission_type }}<br />{{ $sission->class_name }}<br />{{ $sission->user_name }}
                                @endif
                            @endforeach
                        </td>
                        </tr>

                        <div   class="modal fade col-9" id="exampleModal{{ $group->id }}" tabindex="-1"
                            aria-labelledby="exampleModalLabel{{ $group->id }}" aria-hidden="true">
                            @livewire('model-update-group-emploi', ['classType'=>$classType,'salles'=>$salles ,'formateurs'=>$formateurs,'groups'=>$groups,'group' => $group, 'modules'=>$modules])
                        </div>
                        @endforeach
















                        {{-- For formateur emploi --}}
                        @else
                        @forEach ($formateurs as $formateur)
                    <tr>
                        <td>{{$formateur->user_name}}</td>
                  <!-- Monday -S1 -->
                    <td  data-bs-toggle="modal" data-bs-target="#exampleModal{{ $formateur->id }}" class="Cases" id="MonmatinS1{{ $formateur->id }}">
                        @foreach ($sissions as $sission)
                            @if ($sission->day === 'Mon' && $sission->user_id === $formateur->id && $sission->day_part === 'matin' && $sission->dure_sission === "S1")
                                {{ $sission->sission_type }} <br /> {{ $sission->class_name }} <br /> {{ $sission->user_name }}
                            @endif
                        @endforeach
                    </td>
                    <!-- Monday -S2 -->
                    <td data-bs-toggle="modal" data-bs-target="#exampleModal{{ $formateur->id }}" class="Cases" id="MonmatinS2{{ $formateur->id }}">
                        @foreach ($sissions as $sission)
                            @if ($sission->day === 'Mon' && $sission->user_id === $formateur->id  && $sission->day_part === "matin" && $sission->dure_sission === "S2")
                                {{ $sission->sission_type }}<br />{{ $sission->class_name }}<br />{{ $sission->group_name }}
                            @endif
                        @endforeach
                    </td>
                    <!-- Monday - A.midi S1 -->
                    <td data-bs-toggle="modal" data-bs-target="#exampleModal{{ $formateur->id }}" class="Cases" id="MonAmidiS1{{ $formateur->id }}">
                        @foreach ($sissions as $sission)
                            @if ($sission->day === 'Mon' && $sission->user_id === $formateur->id  && $sission->day_part === "Amidi" && $sission->dure_sission === "S1")
                                {{ $sission->sission_type }}<br />{{ $sission->class_name }}<br />{{ $sission->group_name }}
                            @endif
                        @endforeach
                    </td>
                    <!-- Monday - A.midi S2 -->
                    <td data-bs-toggle="modal" data-bs-target="#exampleModal{{ $formateur->id }}" class="Cases" id="MonAmidiS2{{ $formateur->id }}">
                        @foreach ($sissions as $sission)
                            @if ($sission->day === 'Mon'&& $sission->user_id === $formateur->id && $sission->day_part === "Amidi" && $sission->dure_sission === "S2")
                                {{ $sission->sission_type }}<br />{{ $sission->class_name }}<br />{{ $sission->group_name }}
                            @endif
                        @endforeach
                    </td>
                       <!-- Tue - S1 -->
                    <td data-bs-toggle="modal" data-bs-target="#exampleModal{{ $formateur->id }}" class="Cases" id="TuematinS1{{ $formateur->id }}">
                        @foreach ($sissions as $sission)
                            @if ($sission->day === 'Tue' && $sission->user_id === $formateur->id  && $sission->day_part === 'matin' && $sission->dure_sission === "S1")
                                {{ $sission->sission_type }} <br /> {{ $sission->class_name }} <br /> {{ $sission->group_name }}
                            @endif
                        @endforeach
                    </td>
                    <!-- Tue - S2 -->
                    <td data-bs-toggle="modal" data-bs-target="#exampleModal{{ $formateur->id }}" class="Cases" id="TuematinS2{{ $formateur->id }}">
                        @foreach ($sissions as $sission)
                            @if ($sission->day === 'Tue' && $sission->user_id === $formateur->id  && $sission->day_part === "matin" && $sission->dure_sission === "S2")
                                {{ $sission->sission_type }}<br />{{ $sission->class_name }}<br />{{ $sission->group_name }}
                            @endif
                        @endforeach
                    </td>
                    <!-- Tue - A.midi S1 -->
                    <td data-bs-toggle="modal" data-bs-target="#exampleModal{{ $formateur->id }}" class="Cases" id="TueAmidiS1{{ $formateur->id }}">
                        @foreach ($sissions as $sission)
                            @if ($sission->day === 'Tue' && $sission->user_id === $formateur->id   && $sission->day_part === "Amidi" && $sission->dure_sission === "S1")
                                {{ $sission->sission_type }}<br />{{ $sission->class_name }}<br />{{ $sission->group_name }}
                            @endif
                        @endforeach
                    </td>
                    <!-- Tue - A.midi S2 -->
                    <td data-bs-toggle="modal" data-bs-target="#exampleModal{{ $formateur->id }}" class="Cases" id="TueAmidiS2{{ $formateur->id }}">
                        @foreach ($sissions as $sission)
                            @if ($sission->day === 'Tue' && $sission->user_id === $formateur->id && $sission->day_part === "Amidi" && $sission->dure_sission === "S2")
                                {{ $sission->sission_type }}<br />{{ $sission->class_name }}<br />{{ $sission->group_name }}
                            @endif
                        @endforeach
                    </td>
                    <!-- Wed - S1 -->
                    <td data-bs-toggle="modal" data-bs-target="#exampleModal{{ $formateur->id }}" class="Cases" id="WedmatinS1{{ $formateur->id }}">
                        @foreach ($sissions as $sission)
                            @if ($sission->day === 'Wed' && $sission->user_id === $formateur->id && $sission->day_part === 'matin' && $sission->dure_sission === "S1")
                                {{ $sission->sission_type }} <br /> {{ $sission->class_name }} <br /> {{ $sission->group_name }}
                            @endif
                        @endforeach
                    </td>
                    <!-- Wed - S2 -->
                    <td data-bs-toggle="modal" data-bs-target="#exampleModal{{ $formateur->id }}" class="Cases" id="WedmatinS2{{ $formateur->id }}">
                        @foreach ($sissions as $sission)
                            @if ($sission->day === 'Wed' && $sission->user_id === $formateur->id && $sission->day_part === "matin" && $sission->dure_sission === "S2")
                                {{ $sission->sission_type }}<br />{{ $sission->class_name }}<br />{{ $sission->group_name }}
                            @endif
                        @endforeach
                    </td>
                    <!-- Wed - A.midi S1 -->
                    <td data-bs-toggle="modal" data-bs-target="#exampleModal{{ $formateur->id }}" class="Cases" id="WedAmidiS1{{ $formateur->id }}">
                        @foreach ($sissions as $sission)
                            @if ($sission->day === 'Wed'&& $sission->user_id === $formateur->id  && $sission->day_part === "Amidi" && $sission->dure_sission === "S1")
                                {{ $sission->sission_type }}<br />{{ $sission->class_name }}<br />{{ $sission->group_name }}
                            @endif
                        @endforeach
                    </td>
                    <!-- Wed - A.midi S2 -->
                    <td data-bs-toggle="modal" data-bs-target="#exampleModal{{ $formateur->id }}" class="Cases" id="WedAmidiS2{{ $formateur->id }}">
                        @foreach ($sissions as $sission)
                            @if ($sission->day === 'Wed'&& $sission->user_id === $formateur->id  && $sission->day_part === "Amidi" && $sission->dure_sission === "S2")
                                {{ $sission->sission_type }}<br />{{ $sission->class_name }}<br />{{ $sission->group_name }}
                            @endif
                        @endforeach
                    </td>
                     <!-- Thu - S1 -->
                    <td data-bs-toggle="modal" data-bs-target="#exampleModal{{ $formateur->id }}" class="Cases" id="ThumatinS1{{ $formateur->id }}">
                        @foreach ($sissions as $sission)
                            @if ($sission->day === 'Thu' && $sission->user_id === $formateur->id && $sission->day_part === 'matin' && $sission->dure_sission === "S1")
                                {{ $sission->sission_type }} <br /> {{ $sission->class_name }} <br /> {{ $sission->group_name }}
                            @endif
                        @endforeach
                    </td>
                    <!-- Thu - S2 -->
                    <td data-bs-toggle="modal" data-bs-target="#exampleModal{{ $formateur->id }}" class="Cases" id="ThumatinS2{{ $formateur->id }}">
                        @foreach ($sissions as $sission)
                            @if ($sission->day === 'Thu'&& $sission->user_id === $formateur->id  && $sission->day_part === "matin" && $sission->dure_sission === "S2")
                                {{ $sission->sission_type }}<br />{{ $sission->class_name }}<br />{{ $sission->group_name }}
                            @endif
                        @endforeach
                    </td>
                    <!-- Thu - A.midi S1 -->
                    <td data-bs-toggle="modal" data-bs-target="#exampleModal{{ $formateur->id }}" class="Cases" id="ThuAmidiS1{{ $formateur->id }}">
                        @foreach ($sissions as $sission)
                            @if ($sission->day === 'Thu'&& $sission->user_id === $formateur->id  && $sission->day_part === "Amidi" && $sission->dure_sission === "S1")
                                {{ $sission->sission_type }}<br />{{ $sission->class_name }}<br />{{ $sission->group_name }}
                            @endif
                        @endforeach
                    </td>
                    <!-- Thu - A.midi S2 -->
                    <td data-bs-toggle="modal" data-bs-target="#exampleModal{{ $formateur->id }}" class="Cases" id="ThuAmidiS2{{ $formateur->id }}">
                        @foreach ($sissions as $sission)
                            @if ($sission->day === 'Thu'&& $sission->user_id === $formateur->id  && $sission->day_part === "Amidi" && $sission->dure_sission === "S2")
                                {{ $sission->sission_type }}<br />{{ $sission->class_name }}<br />{{ $sission->group_name }}
                            @endif
                        @endforeach
                    </td>
                      <!-- Fri - S1 -->
                      <td data-bs-toggle="modal" data-bs-target="#exampleModal{{ $formateur->id }}" class="Cases" id="FrimatinS1{{ $formateur->id }}">
                        @foreach ($sissions as $sission)
                            @if ($sission->day === 'Fri' && $sission->user_id === $formateur->id  && $sission->day_part === 'matin' && $sission->dure_sission === "S1")
                                {{ $sission->sission_type }} <br /> {{ $sission->class_name }} <br /> {{ $sission->group_name }}
                            @endif
                        @endforeach
                    </td>
                    <!-- Fri - S2 -->
                    <td data-bs-toggle="modal" data-bs-target="#exampleModal{{ $formateur->id }}" class="Cases" id="FrimatinS2{{ $formateur->id }}">
                        @foreach ($sissions as $sission)
                            @if ($sission->day === 'Fri' && $sission->user_id === $formateur->id  && $sission->day_part === "matin" && $sission->dure_sission === "S2")
                                {{ $sission->sission_type }}<br />{{ $sission->class_name }}<br />{{ $sission->group_name }}
                            @endif
                        @endforeach
                    </td>
                    <!-- Fri - A.midi S1 -->
                    <td data-bs-toggle="modal" data-bs-target="#exampleModal{{ $formateur->id }}" class="Cases" id="FriAmidiS1{{ $formateur->id }}">
                        @foreach ($sissions as $sission)
                            @if ($sission->day === 'Fri' && $sission->user_id === $formateur->id  && $sission->day_part === "Amidi" && $sission->dure_sission === "S1")
                                {{ $sission->sission_type }}<br />{{ $sission->class_name }}<br />{{ $sission->group_name }}
                            @endif
                        @endforeach
                    </td>
                    <!-- Fri - A.midi S2 -->
                    <td data-bs-toggle="modal" data-bs-target="#exampleModal{{ $formateur->id }}" class="Cases" id="FriAmidiS2{{ $formateur->id }}">
                        @foreach ($sissions as $sission)
                            @if ($sission->day === 'Fri' && $sission->user_id === $formateur->id   && $sission->day_part === "Amidi" && $sission->dure_sission === "S2")
                                {{ $sission->sission_type }}<br />{{ $sission->class_name }}<br />{{ $sission->group_name }}
                            @endif
                        @endforeach
                    </td>
                      <!-- Sat - S1 -->
                      <td data-bs-toggle="modal" data-bs-target="#exampleModal{{ $formateur->id }}" class="Cases" id="SatmatinS1{{ $formateur->id }}">
                        @foreach ($sissions as $sission)
                            @if ($sission->day === 'Sat' && $sission->user_id === $formateur->id  && $sission->day_part === 'matin' && $sission->dure_sission === "S1")
                                {{ $sission->sission_type }} <br /> {{ $sission->class_name }} <br /> {{ $sission->group_name }}
                            @endif
                        @endforeach
                    </td>
                    <!-- Sat - S2 -->
                    <td data-bs-toggle="modal" data-bs-target="#exampleModal{{ $formateur->id }}" class="Cases" id="SatmatinS2{{ $formateur->id }}">
                        @foreach ($sissions as $sission)
                            @if ($sission->day === 'Thu'  && $sission->user_id === $formateur->id && $sission->day_part === "matin" && $sission->dure_sission === "S2")
                                {{ $sission->sission_type }}<br />{{ $sission->class_name }}<br />{{ $sission->group_name }}
                            @endif
                        @endforeach
                    </td>
                    <!-- Sat - A.midi S1 -->
                    <td data-bs-toggle="modal" data-bs-target="#exampleModal{{ $formateur->id }}" class="Cases" id="SatAmidiS1{{ $formateur->id }}">
                        @foreach ($sissions as $sission)
                            @if ($sission->day === 'Sat' && $sission->user_id === $formateur->id  && $sission->day_part === "Amidi" && $sission->dure_sission === "S1")
                                {{ $sission->sission_type }}<br />{{ $sission->class_name }}<br />{{ $sission->group_name }}
                            @endif
                        @endforeach
                    </td>
                    <!-- Sat - A.midi S2 -->
                    <td data-bs-toggle="modal" data-bs-target="#exampleModal{{ $formateur->id }}" class="Cases" id="SatAmidiS2{{ $formateur->id }}">
                        @foreach ($sissions as $sission)
                            @if ($sission->day === 'Sat'&& $sission->user_id === $formateur->id  && $sission->day_part === "Amidi" && $sission->dure_sission === "S2")
                                {{ $sission->sission_type }}<br />{{ $sission->class_name }}<br />{{ $sission->group_name }}
                            @endif
                        @endforeach
                    </td>
                    </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </>


      <button onclick="ExportToExcel('xlsx')" class=" btn  btn-primary mt-5">
       telecharger</button>
       <button type="button" class="btn btn-danger mt-5 col-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Supprimer tout
      </button>
      <!-- Modal for delete-->
      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    console.log(selectElement.value)
                    Livewire.emit('receiveidEmploiid', selectElement.value);
                    });

                let elements = document.querySelectorAll('[data-bs-toggle="modal"]');
                elements.forEach(element => {
                    element.addEventListener('click', function() {
                        Livewire.emit('receiveVariable', element.id);
                    });
                });


            });

</script>


    </div>
</div>
