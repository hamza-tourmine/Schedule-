<x-HeaderMenuAdmin>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Schedule Table</title>
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
                padding: 10px;
                border: 1px solid #ddd;
                text-align: center;
            }

            th {
                background-color: #f2f2f2;
            }

            td {
                height: 50px;
            }
        </style>
    </head>

    <body>
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
    <form id="myForm" method="get" action="{{ route('createNewSchedule') }}">
        @csrf
        <button {{ session()->get('id_main_emploi') === null ? '' : 'disabled' }} style="margin: 5px 0px 10px" class="btn btn-primary">
            Create New Schadule
        </button>
        <br>
        <label for="">date start</label>
        <div class="col-6">
            <input name="dateStart" id="dateStart" type="date" class="form-control col-6"
                placeholder="mm/dd/yyyy" value="{{session()->get('datestart')}}" data-date-container="#datepicker1" data-provide="datepicker">
        </div>
    </form>

    <div class="table-responsive">
        <table style="overflow:scroll " class="col-md-12 ">
            <thead>
                <tr>

                    <th>Monday</th>
                    <th>Tuesday</th>
                    <th>Wednesday</th>
                    <th>Thursday</th>
                    <th>Friday</th>
                    <th>Saturday</th>
                    <!-- Add more columns for additional days -->
                </tr>
            </thead>
            <tbody>





                @if ($groups)
                    @foreach ($groups as $group)
                        <tr>
                            {{-- Mon --}}
                            <td data-bs-toggle="modal" data-bs-target="#exampleModal{{ $group->id }}"
                                class="Cases" id="Mon{{ $group->id }}">
                                @foreach ($sissions as $sission)
                                    @if ($sission->day === 'Mon' && $sission->group_id === $group->id)
                                    {{ $sission->group_name }}<br/>{{$sission->class_name }}<br/>{{$sission->user_name }}
                                    @endif
                                @endforeach
                            </td>
                            {{-- Tue --}}
                            <td data-bs-toggle="modal" data-bs-target="#exampleModal{{ $group->id }}"
                                class="Cases" id="Tue{{ $group->id }}">
                                @foreach ($sissions as $sission)
                                    @if ($sission->day === 'Tue' && $sission->group_id === $group->id)
                                    {{ $sission->group_name }}<br/>{{$sission->class_name }}<br/>{{$sission->user_name }}
                                    @endif
                                @endforeach
                            </td>
                            {{-- Wed  --}}
                            <td data-bs-toggle="modal" data-bs-target="#exampleModal{{ $group->id }}"
                                class="Cases" id="Wed{{ $group->id }}">
                                @foreach ($sissions as $sission)
                                    @if ($sission->day === 'Wed' && $sission->group_id === $group->id)
                                    {{ $sission->group_name }}<br/>{{$sission->class_name }}<br/>{{$sission->user_name }}
                                    @endif
                                @endforeach
                            </td>
                            {{-- Thu --}}
                            <td data-bs-toggle="modal" data-bs-target="#exampleModal{{ $group->id }}"
                                class="Cases" id="Thu{{ $group->id }}">
                                @foreach ($sissions as $sission)
                                    @if ($sission->day === 'Thu' && $sission->group_id === $group->id)
                                    {{ $sission->group_name }}<br/>{{$sission->class_name }}<br/>{{$sission->user_name }}
                                    @endif
                                @endforeach
                            </td>
                            {{-- Fri --}}
                            <td data-bs-toggle="modal" data-bs-target="#exampleModal{{ $group->id }}"
                                class="Cases" id="Fri{{ $group->id }}">
                                @php
                                    $caseid = 'Fri' . $group->id;
                                @endphp
                                @foreach ($sissions as $sission)
                                    @if ($sission->day . $sission->group_id === $caseid)
                                    {{ $sission->group_name }}<br/>{{$sission->class_name }}<br/>{{$sission->user_name }}
                                    @endif
                                @endforeach
                            </td>
                            {{-- Sat --}}
                            <td data-bs-toggle="modal" data-bs-target="#exampleModal{{ $group->id }}"
                                class="Cases" id="Sat{{ $group->id }}">
                                @foreach ($sissions as $sission)
                                    @if ($sission->day === 'Sat' && $sission->group_id === $group->id)
                                    {{ $sission->group_name }}<br/>{{$sission->class_name }}<br/>{{$sission->user_name }}
                                    @endif
                                @endforeach
                            </td>
                        {{-- <td data-bs-toggle="modal" data-bs-target="#exampleModal{{$group->id}}" class="Cases" id="{{$group->id}}">Tue{{$group->id}}</td>
                        <td data-bs-toggle="modal" data-bs-target="#exampleModal{{$group->id}}" class="Cases" id="{{$group->id}}">Wed{{$group->id}}</td>
                        <td data-bs-toggle="modal" data-bs-target="#exampleModal{{$group->id}}" class="Cases" id="{{$group->id}}">Thu{{$group->id}}</td>
                        <td data-bs-toggle="modal" data-bs-target="#exampleModal{{$group->id}}" class="Cases" id="{{$group->id}}">Fri{{$group->id}}</td>
                        <td data-bs-toggle="modal" data-bs-target="#exampleModal{{$group->id}}" class="Cases" id="{{$group->id}}">Sat{{$group->id}}</td> --}}
                        </tr>
                        <!-- Modal -->
                        <form id="myForm" method="Get" action="{{ route('insertSession') }}">
{{-- Start Model Form --}}

                            @csrf
                            <div class="modal fade col-9" id="exampleModal{{ $group->id }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel{{ $group->id }}" aria-hidden="true">
                                <div class="modal-dialog  modal-lg  ">
                                    <div class="modal-content  col-9">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel{{ $group->id }}">
                                                Create session</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div style="display: flex">
                                                {{-- Model  content  --}}
                                                <select name="modele" class="form-select"
                                                    aria-label="Default select example">
                                                    <option selected>Modules</option>
                                                    @if ($modules)
                                                        @foreach ($modules as $module)
                                                            <option value="{{ $module->id }}">
                                                                {{ $module->module_name }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                                {{-- Groups --}}
                                                <label for=""></label>
                                                <select name="group" class="form-select"
                                                    aria-label="Default select example">
                                                    <option selected>Groups</option>
                                                    @if ($groups)
                                                        @foreach ($groups as $group)
                                                            <option value="{{ $group->id }}">
                                                                {{ $group->group_name }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                            <div style="display: flex">
                                                {{-- Formateur --}}
                                                <select name='formateur' class="form-select"
                                                    aria-label="Default select example">
                                                    <option selected>Formateurs</option>
                                                    @if ($formateurs)
                                                        @foreach ($formateurs as $formateur)
                                                            <option value="{{ $formateur->id }}">
                                                                {{ $formateur->user_name }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                                {{-- salle --}}
                                                <select name="salle" class="form-select"
                                                    aria-label="Default select example">
                                                    <option selected>les salles</option>
                                                    @if ($salles)
                                                        @foreach ($salles as $salle)
                                                            <option value="{{ $salle->id }}">
                                                                {{ $salle->class_name }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>

                                            </div>
                                            {{-- tyope session --}}
                                            <div style="display: flex;justify-content: space-between">
                                                <select name="salleclassTyp" class="form-select"
                                                    aria-label="Default select example">
                                                    <option selected>les Types</option>
                                                    @if ($classType)
                                                        @foreach ($classType as $classTyp)
                                                            <option value="{{ $classTyp->id }}">
                                                                {{ $classTyp->class_room_types }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                                <select name="dure" class="form-select"
                                                    aria-label="Default select example">
                                                    <option selected>Dure</option>
                                                    <option value="S1">S1</option>
                                                    <option value="S2">S2</option>
                                                    <option value="S1+S2">S2+S1</option>
                                                </select>
                                                 <input type="hidden" name="idCase" id="idCase" value="">
                                            </div>
                                            {{-- day part && type sission --}}
                                            <div style="display: flex">
                                                <select name="dayPart" class="form-select"
                                                    aria-label="Default select example">
                                                    <option selected>Jour part</option>
                                                    <option value="Matin">Matin</option>
                                                    <option value="A.midi">AM</option>
                                                </select>
                                                <select name="TypeSesion" class="form-select"
                                                    aria-label="Default select example">
                                                    <option selected>Types</option>
                                                    <option value="presentielle">Presentielle</option>
                                                    <option value="teams">Teams</option>
                                                </select>

                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button id="save" type="submit" class="btn btn-primary">Save </button>
                                        </div>
                                    </form>
            {{-- end form Model --}}


    </div>
    </div>
    </div>
    @endforeach
    @endif
    </tbody>
    </table>
    </div>
     {{-- Main Form  --}}
           <form method='get' action="{{route('MainFormSchadule')}}">
    <button type="submit" id="tbn_end_creating_emploi" class="btn btn-success mt-5 col-3">save</button>
    <button class="btn btn-danger mx-5 mt-5 col-3">delate all</button>
       </form>

        {{-- <script>
            document.addEventListener('DOMContentLoaded', function() {
                let dateStart = document.getElementById('dateStart')
                var elements = document.querySelectorAll('[data-bs-toggle="modal"]');
                let btn = document.getElementById('save')
                btn.addEventListener('click', function(){
                    console.log(document.getElementById('idCase').value)
                })
                elements.forEach(function(element) {
                    element.addEventListener('click', function() {
                        document.getElementById('idCase').value = this.id;
                    });
                });
                //
                let cases = document.querySelectorAll('[class="Cases"]')
                console.log(cases)
            });
        </script> --}}

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                let dateStart = document.getElementById('dateStart');
                let idCaseInput = document.getElementById('idCase');
                var elements = document.querySelectorAll('[data-bs-toggle="modal"]');

                let btn = document.getElementById('save');
                btn.addEventListener('click', function() {
                    console.log(idCaseInput.value);
                });

                elements.forEach(function(element) {
                    element.addEventListener('click', function() {
                        idCaseInput.value = this.id;
                        console.log(  idCaseInput.value)
                    });
                });
                   // Event listener for table cell clicks
                    let cases = document.querySelectorAll('.Cases');
                    cases.forEach(function(caseElement) {
                        caseElement.addEventListener('click', function() {
                            idCaseInput.value = this.id;
                            console.log(idCaseInput.value);
                        });
                    });

                    // Event listener for form submission
                    let form = document.getElementById('myForm'); // Update the form ID if needed
                    form.addEventListener('submit', function() {
                        // Ensure that the idCase value is set before submitting the form
                        idCaseInput.value = idCaseInput.value.trim(); // Trim any leading/trailing whitespaces
                    });

                // Event listener for table cell clicks
                // let cases = document.querySelectorAll('[class="Cases"]');
                // cases.forEach(function(caseElement) {
                //     caseElement.addEventListener('click', function() {
                //         idCaseInput.value = this.id;
                //     });
                // });
            });









        </script>
    </body>
    </html>
</x-Headers>
