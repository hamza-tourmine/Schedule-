<div>
    @php

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
        <label >date start</label>
        <div class="col-6">
            <input name="dateStart" id="dateStart" type="date" class="form-control col-6" placeholder="mm/dd/yyyy"
                value="{{ session()->get('datestart') }}" data-date-container="#datepicker1" data-provide="datepicker">
        </div>
    </form>

    <div class="table-responsive">
        <table  style="overflow:scroll" class="col-md-12 ">


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
                @if ($groups)
                @php
                     $dayWeek = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
                @endphp
                @foreach ($groups as $group)
                <tr>
                    <td>{{$group->group_name}}</td>
                    @foreach ($dayWeek as $day)
                        @foreach (['matinS1', 'matinS2', 'AmidiS3', 'AmidiS4'] as $sessionType)
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
                     {{-- Model --}}
                     <div wire:ignore.self  class="modal fade col-9" id="exampleModal" tabindex="-1"
                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                     @livewire('modal-component', ['classType'=>$classType,'salles'=>$salles ,'formateurs'=>$formateurs,'groups'=>$groups,'group' => $group, 'modules'=>$modules])
                 </div>
                @endif
            </tbody>
        </table>
    </div>


<button class="btn  btn-primary mt-5" wire:click='AddAutherEmploi'> <span class="mdi mdi-plus"></span> Ajouter un autre</button>
      <!-- Button trigger modal -->
<button type="button" class="btn btn-danger mt-5 col-3" data-bs-toggle="modal" data-bs-target="#exampleModal1">
    Supprimer tout
  </button>
  <!-- Modal for delete-->
  <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
</div>
