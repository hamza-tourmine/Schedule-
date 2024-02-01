<div>
    @php
    function getSession1($day, $group, $dayPart, $sissionType, $sissions) {
        foreach ($sissions as $sission) {
            if ($sission->day === $day && $sission->group_id === $group->id && $sission->day_part === $dayPart && $sission->dure_sission === $sissionType) {
                return "{$sission->group_name}<br>{$sission->class_name}<br>{$sission->user_name}";
            }
        }
        return '';
    }

    function getSession2($day, $group, $dayPart, $sissionType, $sissions) {
        foreach ($sissions as $sission) {
            if ($sission->day === $day && $sission->group_id === $group->id && $sission->day_part === $dayPart && $sission->dure_sission === $sissionType) {
                return "{$sission->group_name}<br>{$sission->class_name}<br>{$sission->user_name}";
            }
        }
        return '';
    }


    function getSession3($day, $group, $dayPart, $sissionType, $sissions) {
        foreach ($sissions as $sission) {
            if ($sission->day === $day && $sission->group_id === $group->id && $sission->day_part === $dayPart && $sission->dure_sission === $sissionType) {
                return "{$sission->group_name}<br>{$sission->class_name}<br>{$sission->user_name}";
            }
        }
        return '';
    }
@endphp
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
                <tr class="day">
                    <th rowspan="3">Groups Name</th>
                    <th colspan="4">Monday</th>
                    <th colspan="4">Tuesday</th>
                    <th colspan="4">Wednesday</th>
                    <th colspan="4">Thursday</th>
                    <th colspan="4">Friday</th>
                    <th colspan="4">Saturday</th>
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
                    @foreach ($groups as $group)


                <tr>
                    <td>{{$group->group_name}}</td>
              <!-- Monday - S1 -->
                <td data-bs-toggle="modal" data-bs-target="#exampleModal{{ $group->id }}" class="Cases" id="MonS1{{ $group->id }}">
                    @foreach ($sissions as $sission)
                        @if ($sission->day === 'Mon' && $sission->group_id === $group->id && $sission->day_part === 'matin' && $sission->dure_sission === "S1")
                            {{ $sission->group_name }} <br /> {{ $sission->class_name }} <br /> {{ $sission->user_name }}
                        @endif
                    @endforeach
                </td>

                <!-- Monday - S2 -->
                <td data-bs-toggle="modal" data-bs-target="#exampleModal{{ $group->id }}" class="Cases" id="MonS2{{ $group->id }}">
                    @foreach ($sissions as $sission)
                        @if ($sission->day === 'Mon' && $sission->group_id === $group->id && $sission->day_part === "matin" && $sission->dure_sission === "S2")
                            {{ $sission->group_name }}<br />{{ $sission->class_name }}<br />{{ $sission->user_name }}
                        @endif
                    @endforeach
                </td>

                <!-- Monday - A.midi S1 -->
                <td data-bs-toggle="modal" data-bs-target="#exampleModal{{ $group->id }}" class="Cases" id="MonAMidiS1{{ $group->id }}">
                    @foreach ($sissions as $sission)
                        @if ($sission->day === 'Mon' && $sission->group_id === $group->id && $sission->day_part === "A.midi" && $sission->dure_sission === "S1")
                            {{ $sission->group_name }}<br />{{ $sission->class_name }}<br />{{ $sission->user_name }}
                        @endif
                    @endforeach
                </td>

                <!-- Monday - A.midi S2 -->
                <td data-bs-toggle="modal" data-bs-target="#exampleModal{{ $group->id }}" class="Cases" id="MonAMidiS2{{ $group->id }}">
                    @foreach ($sissions as $sission)
                        @if ($sission->day === 'Mon' && $sission->group_id === $group->id && $sission->day_part === "A.midi" && $sission->dure_sission === "S2")
                            {{ $sission->group_name }}<br />{{ $sission->class_name }}<br />{{ $sission->user_name }}
                        @endif
                    @endforeach
                </td>




                   <!-- Monday - S1 -->
                <td data-bs-toggle="modal" data-bs-target="#exampleModal{{ $group->id }}" class="Cases" id="TueS1{{ $group->id }}">
                    @foreach ($sissions as $sission)
                        @if ($sission->day === 'Tue' && $sission->group_id === $group->id && $sission->day_part === 'matin' && $sission->dure_sission === "S1")
                            {{ $sission->group_name }} <br /> {{ $sission->class_name }} <br /> {{ $sission->user_name }}
                        @endif
                    @endforeach
                </td>

                <!-- Monday - S2 -->
                <td data-bs-toggle="modal" data-bs-target="#exampleModal{{ $group->id }}" class="Cases" id="TueS2{{ $group->id }}">
                    @foreach ($sissions as $sission)
                        @if ($sission->day === 'Tue' && $sission->group_id === $group->id && $sission->day_part === "matin" && $sission->dure_sission === "S2")
                            {{ $sission->group_name }}<br />{{ $sission->class_name }}<br />{{ $sission->user_name }}
                        @endif
                    @endforeach
                </td>

                <!-- Monday - A.midi S1 -->
                <td data-bs-toggle="modal" data-bs-target="#exampleModal{{ $group->id }}" class="Cases" id="TueAMidiS1{{ $group->id }}">
                    @foreach ($sissions as $sission)
                        @if ($sission->day === 'Tue' && $sission->group_id === $group->id && $sission->day_part === "A.midi" && $sission->dure_sission === "S1")
                            {{ $sission->group_name }}<br />{{ $sission->class_name }}<br />{{ $sission->user_name }}
                        @endif
                    @endforeach
                </td>

                <!-- Monday - A.midi S2 -->
                <td data-bs-toggle="modal" data-bs-target="#exampleModal{{ $group->id }}" class="Cases" id="TueAMidiS2{{ $group->id }}">
                    @foreach ($sissions as $sission)
                        @if ($sission->day === 'Tue' && $sission->group_id === $group->id && $sission->day_part === "A.midi" && $sission->dure_sission === "S2")
                            {{ $sission->group_name }}<br />{{ $sission->class_name }}<br />{{ $sission->user_name }}
                        @endif
                    @endforeach
                </td>





 <!-- Monday - S1 -->
                <td data-bs-toggle="modal" data-bs-target="#exampleModal{{ $group->id }}" class="Cases" id="WedS1{{ $group->id }}">
                    @foreach ($sissions as $sission)
                        @if ($sission->day === 'Wed' && $sission->group_id === $group->id && $sission->day_part === 'matin' && $sission->dure_sission === "S1")
                            {{ $sission->group_name }} <br /> {{ $sission->class_name }} <br /> {{ $sission->user_name }}
                        @endif
                    @endforeach
                </td>

                <!-- Wed - S2 -->
                <td data-bs-toggle="modal" data-bs-target="#exampleModal{{ $group->id }}" class="Cases" id="WedS2{{ $group->id }}">
                    @foreach ($sissions as $sission)
                        @if ($sission->day === 'Wed' && $sission->group_id === $group->id && $sission->day_part === "matin" && $sission->dure_sission === "S2")
                            {{ $sission->group_name }}<br />{{ $sission->class_name }}<br />{{ $sission->user_name }}
                        @endif
                    @endforeach
                </td>

                <!-- Wed - A.midi S1 -->
                <td data-bs-toggle="modal" data-bs-target="#exampleModal{{ $group->id }}" class="Cases" id="WedS12{{ $group->id }}">
                    @foreach ($sissions as $sission)
                        @if ($sission->day === 'Wed' && $sission->group_id === $group->id && $sission->day_part === "A.midi" && $sission->dure_sission === "S1")
                            {{ $sission->group_name }}<br />{{ $sission->class_name }}<br />{{ $sission->user_name }}
                        @endif
                    @endforeach
                </td>

                <!-- Wed - A.midi S2 -->
                <td data-bs-toggle="modal" data-bs-target="#exampleModal{{ $group->id }}" class="Cases" id="Wed{{ $group->id }}">
                    @foreach ($sissions as $sission)
                        @if ($sission->day === 'Wed' && $sission->group_id === $group->id && $sission->day_part === "A.midi" && $sission->dure_sission === "S2")
                            {{ $sission->group_name }}<br />{{ $sission->class_name }}<br />{{ $sission->user_name }}
                        @endif
                    @endforeach
                </td>








                 <!-- Thu - S1 -->
                <td data-bs-toggle="modal" data-bs-target="#exampleModal{{ $group->id }}" class="Cases" id="Thu{{ $group->id }}">
                    @foreach ($sissions as $sission)
                        @if ($sission->day === 'Thu' && $sission->group_id === $group->id && $sission->day_part === 'matin' && $sission->dure_sission === "S1")
                            {{ $sission->group_name }} <br /> {{ $sission->class_name }} <br /> {{ $sission->user_name }}
                        @endif
                    @endforeach
                </td>

                <!-- Thu - S2 -->
                <td data-bs-toggle="modal" data-bs-target="#exampleModal{{ $group->id }}" class="Cases" id="Thu{{ $group->id }}">
                    @foreach ($sissions as $sission)
                        @if ($sission->day === 'Thu' && $sission->group_id === $group->id && $sission->day_part === "matin" && $sission->dure_sission === "S2")
                            {{ $sission->group_name }}<br />{{ $sission->class_name }}<br />{{ $sission->user_name }}
                        @endif
                    @endforeach
                </td>

                <!-- Thu - A.midi S1 -->
                <td data-bs-toggle="modal" data-bs-target="#exampleModal{{ $group->id }}" class="Cases" id="Thu{{ $group->id }}">
                    @foreach ($sissions as $sission)
                        @if ($sission->day === 'Thu' && $sission->group_id === $group->id && $sission->day_part === "A.midi" && $sission->dure_sission === "S1")
                            {{ $sission->group_name }}<br />{{ $sission->class_name }}<br />{{ $sission->user_name }}
                        @endif
                    @endforeach
                </td>

                <!-- Thu - A.midi S2 -->
                <td data-bs-toggle="modal" data-bs-target="#exampleModal{{ $group->id }}" class="Cases" id="Thu{{ $group->id }}">
                    @foreach ($sissions as $sission)
                        @if ($sission->day === 'Thu' && $sission->group_id === $group->id && $sission->day_part === "A.midi" && $sission->dure_sission === "S2")
                            {{ $sission->group_name }}<br />{{ $sission->class_name }}<br />{{ $sission->user_name }}
                        @endif
                    @endforeach
                </td>









                  <!-- Fri - S1 -->
                  <td data-bs-toggle="modal" data-bs-target="#exampleModal{{ $group->id }}" class="Cases" id="Fri{{ $group->id }}">
                    @foreach ($sissions as $sission)
                        @if ($sission->day === 'Fri' && $sission->group_id === $group->id && $sission->day_part === 'matin' && $sission->dure_sission === "S1")
                            {{ $sission->group_name }} <br /> {{ $sission->class_name }} <br /> {{ $sission->user_name }}
                        @endif
                    @endforeach
                </td>

                <!-- Fri - S2 -->
                <td data-bs-toggle="modal" data-bs-target="#exampleModal{{ $group->id }}" class="Cases" id="Fri{{ $group->id }}">
                    @foreach ($sissions as $sission)
                        @if ($sission->day === 'Fri' && $sission->group_id === $group->id && $sission->day_part === "matin" && $sission->dure_sission === "S2")
                            {{ $sission->group_name }}<br />{{ $sission->class_name }}<br />{{ $sission->user_name }}
                        @endif
                    @endforeach
                </td>

                <!-- Fri - A.midi S1 -->
                <td data-bs-toggle="modal" data-bs-target="#exampleModal{{ $group->id }}" class="Cases" id="Fri{{ $group->id }}">
                    @foreach ($sissions as $sission)
                        @if ($sission->day === 'Fri' && $sission->group_id === $group->id && $sission->day_part === "A.midi" && $sission->dure_sission === "S1")
                            {{ $sission->group_name }}<br />{{ $sission->class_name }}<br />{{ $sission->user_name }}
                        @endif
                    @endforeach
                </td>

                <!-- Fri - A.midi S2 -->
                <td data-bs-toggle="modal" data-bs-target="#exampleModal{{ $group->id }}" class="Cases" id="Fri{{ $group->id }}">
                    @foreach ($sissions as $sission)
                        @if ($sission->day === 'Fri' && $sission->group_id === $group->id && $sission->day_part === "A.midi" && $sission->dure_sission === "S2")
                            {{ $sission->group_name }}<br />{{ $sission->class_name }}<br />{{ $sission->user_name }}
                        @endif
                    @endforeach
                </td>





                  <!-- Sat - S1 -->
                  <td data-bs-toggle="modal" data-bs-target="#exampleModal{{ $group->id }}" class="Cases" id="SatS1{{ $group->id }}">
                    @foreach ($sissions as $sission)
                        @if ($sission->day === 'Sat' && $sission->group_id === $group->id && $sission->day_part === 'matin' && $sission->dure_sission === "S1")
                            {{ $sission->group_name }} <br /> {{ $sission->class_name }} <br /> {{ $sission->user_name }}
                        @endif
                    @endforeach
                </td>

                <!-- Sat - S2 -->
                <td data-bs-toggle="modal" data-bs-target="#exampleModal{{ $group->id }}" class="Cases" id="SatS2{{ $group->id }}">
                    @foreach ($sissions as $sission)
                        @if ($sission->day === 'Thu' && $sission->group_id === $group->id && $sission->day_part === "matin" && $sission->dure_sission === "S2")
                            {{ $sission->group_name }}<br />{{ $sission->class_name }}<br />{{ $sission->user_name }}
                        @endif
                    @endforeach
                </td>

                <!-- Sat - A.midi S1 -->
                <td data-bs-toggle="modal" data-bs-target="#exampleModal{{ $group->id }}" class="Cases" id="SatAMidiS1{{ $group->id }}">
                    @foreach ($sissions as $sission)
                        @if ($sission->day === 'Sat' && $sission->group_id === $group->id && $sission->day_part === "A.midi" && $sission->dure_sission === "S1")
                            {{ $sission->group_name }}<br />{{ $sission->class_name }}<br />{{ $sission->user_name }}
                        @endif
                    @endforeach
                </td>

                <!-- Sat - A.midi S2 -->
                <td data-bs-toggle="modal" data-bs-target="#exampleModal{{ $group->id }}" class="Cases" id="SatAMidiS2{{ $group->id }}">
                    @foreach ($sissions as $sission)
                        @if ($sission->day === 'Sat' && $sission->group_id === $group->id && $sission->day_part === "A.midi" && $sission->dure_sission === "S2")
                            {{ $sission->group_name }}<br />{{ $sission->class_name }}<br />{{ $sission->user_name }}
                        @endif
                    @endforeach
                </td>
                </tr>
                        <div wire:ignore.self  class="modal fade col-9" id="exampleModal{{ $group->id }}" tabindex="-1"
                            aria-labelledby="exampleModalLabel{{ $group->id }}" aria-hidden="true">
                            @livewire('modal-component', ['classType'=>$classType,'salles'=>$salles ,'formateurs'=>$formateurs,'groups'=>$groups,'group' => $group, 'modules'=>$modules])

                        </div>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
    {{-- Main Form  --}}

    <form method='get' action="{{ route('MainFormSchadule') }}">
        <button class="btn btn-danger mx-5 mt-5 col-3">delate all</button>
    </form>


    <script>
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
