<div>
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
    <form method="get" action="{{ route('createNewSchedule') }}">
        @csrf
        <button {{ session()->get('id_main_emploi') === null ? '' : 'disabled' }} style="margin: 5px 0px 10px"
            class="btn btn-primary">
            Create New Schadule
        </button>
        <br>
        <label for="">date start</label>
        <div class="col-6">
            <input name="dateStart" id="dateStart" type="date" class="form-control col-6" placeholder="mm/dd/yyyy"
                value="{{ session()->get('datestart') }}" data-date-container="#datepicker1" data-provide="datepicker">
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
                            <td data-bs-toggle="modal" data-bs-target="#exampleModal{{ $group->id }}" class="Cases"
                                id="Mon{{ $group->id }}">
                                @foreach ($sissions as $sission)
                                    @if ($sission->day === 'Mon' && $sission->group_id === $group->id)
                                        {{ $sission->group_name }}<br />{{ $sission->class_name }}<br />{{ $sission->user_name }}
                                    @endif
                                @endforeach
                            </td>
                            {{-- Tue --}}
                            <td data-bs-toggle="modal" data-bs-target="#exampleModal{{ $group->id }}" class="Cases"
                                id="Tue{{ $group->id }}">
                                @foreach ($sissions as $sission)
                                    @if ($sission->day === 'Tue' && $sission->group_id === $group->id)
                                        {{ $sission->group_name }}<br />{{ $sission->class_name }}<br />{{ $sission->user_name }}
                                    @endif
                                @endforeach
                            </td>
                            {{-- Wed  --}}
                            <td data-bs-toggle="modal" data-bs-target="#exampleModal{{ $group->id }}" class="Cases"
                                id="Wed{{ $group->id }}">
                                @foreach ($sissions as $sission)
                                    @if ($sission->day === 'Wed' && $sission->group_id === $group->id)
                                        {{ $sission->group_name }}<br />{{ $sission->class_name }}<br />{{ $sission->user_name }}
                                    @endif
                                @endforeach
                            </td>
                            {{-- Thu --}}
                            <td data-bs-toggle="modal" data-bs-target="#exampleModal{{ $group->id }}" class="Cases"
                                id="Thu{{ $group->id }}">
                                @foreach ($sissions as $sission)
                                    @if ($sission->day === 'Thu' && $sission->group_id === $group->id)
                                        {{ $sission->group_name }}<br />{{ $sission->class_name }}<br />{{ $sission->user_name }}
                                    @endif
                                @endforeach
                            </td>
                            {{-- Fri --}}
                            <td data-bs-toggle="modal" data-bs-target="#exampleModal{{ $group->id }}" class="Cases"
                                id="Fri{{ $group->id }}">
                                @php
                                    $caseid = 'Fri' . $group->id;
                                @endphp
                                @foreach ($sissions as $sission)
                                    @if ($sission->day . $sission->group_id === $caseid)
                                        {{ $sission->group_name }}<br />{{ $sission->class_name }}<br />{{ $sission->user_name }}
                                    @endif
                                @endforeach
                            </td>
                            {{-- Sat --}}
                            <td data-bs-toggle="modal" data-bs-target="#exampleModal{{ $group->id }}" class="Cases"
                                id="Sat{{ $group->id }}">
                                @foreach ($sissions as $sission)
                                    @if ($sission->day === 'Sat' && $sission->group_id === $group->id)
                                        {{ $sission->group_name }}<br/>{{ $sission->class_name }}<br />{{ $sission->user_name }}
                                    @endif
                                @endforeach
                            </td>
                        </tr>
                        @livewire('modal-component', ['classType'=>$classType,'salles'=>$salles ,'formateurs'=>$formateurs,'groups'=>$groups,'group' => $group, 'modules'=>$modules])
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
    {{-- Main Form  --}}

    <form method='get' action="{{ route('MainFormSchadule') }}">
        <button type="submit" id="tbn_end_creating_emploi" class="btn btn-success mt-5 col-3">save</button>
        <button class="btn btn-danger mx-5 mt-5 col-3">delate all</button>
    </form>



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

        Event listener for form submission
        let form = document.getElementById('myForm'); // Update the form ID if needed
        form.addEventListener('submit', function() {
            // Ensure that the idCase value is set before submitting the form
            idCaseInput.value = idCaseInput.value.trim(); // Trim any leading/trailing whitespaces
            console.log(  idCaseInput.value)
        });

        Event listener for table cell clicks
        let cases = document.querySelectorAll('[class="Cases"]');
        cases.forEach(function(caseElement) {
            caseElement.addEventListener('click', function() {
                idCaseInput.value = this.id;
                console.log(  idCaseInput.value)
            });
        });






         });
    </script>
</div>
