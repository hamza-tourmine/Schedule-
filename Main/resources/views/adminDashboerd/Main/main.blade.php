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

        <div class="table-responsive">
        <table  style="overflow:scroll " class="col-md-12 " >
            <thead>
                <tr>
                    <th></th>
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

                <label for="">date start</label>
                <input name="dateStart" type="date">

                <label for="">date end</label>
                <input name="dateEnd" type="date">
                @if($groups)
                    @foreach($groups as $group)
                        <tr>
                            <td>{{$group->group_name}}</td>
                            <td data-bs-toggle="modal" data-bs-target="#exampleModal{{$group->id}}" id="Mon{{$group->id}}">Mon{{$group->id}}</td>
                            <td data-bs-toggle="modal" data-bs-target="#exampleModal{{$group->id}}" id="Tue{{$group->id}}">Tue{{$group->id}}</td>
                            <td data-bs-toggle="modal" data-bs-target="#exampleModal{{$group->id}}" id="Wed{{$group->id}}">Wed{{$group->id}}</td>
                            <td data-bs-toggle="modal" data-bs-target="#exampleModal{{$group->id}}" id="Thu{{$group->id}}">Thu{{$group->id}}</td>
                            <td data-bs-toggle="modal" data-bs-target="#exampleModal{{$group->id}}" id="Fri{{$group->id}}">Fri{{$group->id}}</td>
                            <td data-bs-toggle="modal" data-bs-target="#exampleModal{{$group->id}}" id="Sat{{$group->id}}">Sat{{$group->id}}</td>
                            <!-- Add more columns for additional days -->
                        </tr>
                        <!-- Modal -->
                        <form method="get" action="{{route('insertSession')}}">
                        <div  class="modal fade col-9" id="exampleModal{{$group->id}}" tabindex="-1" aria-labelledby="exampleModalLabel{{$group->id}}" aria-hidden="true">
                            <div class="modal-dialog  modal-lg  ">
                                <div class="modal-content  col-9">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel{{$group->id}}">Create session</h1>

                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>

                                        <div class="modal-body">
                                            <div style="display: flex">
                                                        {{-- Model --}}

                                                        <select name="modele"  class="form-select" aria-label="Default select example">
                                                            <option selected>Modules</option>
                                                            @if($modules)
                                                            @foreach($modules as $module)
                                                               <option  value="{{$module->id}}">{{$module->module_name}}</option>
                                                            @endforeach
                                                            @endif
                                                          </select>

                                              {{-- Groups --}}
                                              <label for=""></label>
                                              <select name="group" class="form-select" aria-label="Default select example">
                                                <option selected>Groups</option>
                                                @if($groups)
                                                @foreach($groups as $group)
                                                   <option value="{{$group->id}}">{{$group->group_name}}</option>
                                                @endforeach
                                                @endif
                                              </select>
                                            </div>
                                            <div style="display: flex">

                                              {{-- Formateur --}}

                                              <select name='formateur' class="form-select" aria-label="Default select example">
                                                <option selected>Formateurs</option>
                                                @if($formateurs)
                                                @foreach($formateurs as $formateur)
                                                   <option value="{{$formateur->id}}">{{$formateur->user_name}}</option>
                                                @endforeach
                                                @endif
                                              </select>
                                              {{-- salle --}}
                                              <select name="salle" class="form-select" aria-label="Default select example">
                                                <option  selected>les salles</option>
                                                @if($salles)
                                                @foreach($salles as $salle)
                                                   <option value="{{$salle->id}}">{{$salle->id}}</option>
                                                @endforeach
                                                @endif
                                              </select>

                                            </div>
                                              {{-- tyope session --}}
                                              <div style="display: flex">
                                                <select name="TypeSesion" class="form-select" aria-label="Default select example">
                                                    <option selected>Types</option>
                                                    <option value="presentielle">presentielle</option>
                                                    <option value="teams">TEams</option>
                                                  </select>

                                                  <select name="dure" class="form-select" aria-label="Default select example">
                                                    <option selected>Dure</option>
                                                    <option value="S1">S1</option>
                                                    <option value="S2">S2</option>
                                                    <option value="S3">S2+S1</option>


                                                  </select>
                                                  <input name="idCase" id="idCase" style="display: none" value="" type="text">
                                              </div>

                                              <select name="dayPart" class="form-select" aria-label="Default select example">
                                                <option selected>Jour part</option>
                                                <option value="Matin">Matin</option>
                                                <option value="A.midi">AM</option>

                                              </select>

                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save </button>
                                        </div>
                                    </form>


                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </tbody>
        </table>
        </div>



        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var elements = document.querySelectorAll('[data-bs-toggle="modal"]');
                elements.forEach(function (element) {
                    element.addEventListener('click', function () {
                        document.getElementById('idCase').value = this.id;
                    });
                });
            });
        </script>
    </body>

    </html>

</x-Headers>
