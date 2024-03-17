<x-HeaderMenuAdmin>


    <style>
        .checkboxContainer {
            background-color: white;
            border-radius: 7px;
            border: 1.5px solid #eee;
            max-height: 150px;
            overflow-y: scroll;
        }

        .checkboxContainer span {
            margin: 4px;
            display: block;
        }
        .checkboxContainer span:hover {
            background-color: #eee
        }

        .checkboxContainer span input{
            width:35px;

        }
    </style>

    <div style="max-width:80vw;margin-x:auto">
        <form method='POST' action="{{route('insertFormateur')}}">
            @if(session('success'))
            <div id="liveAlertPlaceholder" class="alert alert-success">
                {{ session('success') }}
            </div>
      @endif
      @if ($errors->any())
      @foreach ( $errors->all() as $error)
      <div id="liveAlertPlaceholder" class="alert alert-danger">
        {{$error}}
    </div>
      @endforeach
      @endif
        {{-- i will add  error alert --}}

            @csrf
            <div class="mb-lg-3 col-lg-9">
              <label for="exampleInputEmail1" class="form-label">formateur Name </label>
              <input type="text"name='formateur_name' class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>





        <h6 style="margin:10px">Filiéres</h6>
        <div class="checkboxContainer mb-lg-3 col-lg-9">

            @foreach ( $branches as $branche)
            <span>
                <input  type="checkbox" id="branch{{ $branche->id }}" name="branches[]" value="{{$branche->id}}">
                <label for="branch{{ $branche->id }}">{{$branche->name}}</label>
            </span>

            @endforeach

        </div>

        <h6 style="margin:10px"> Les Groupes  </h6>


        <div class="checkboxContainer mb-lg-3 col-lg-9">

            @foreach ( $groupes as $groupe)
            <span>
                <input  type="checkbox" id="branch{{ $groupe->id }}" name="groupes[]" value="{{$groupe->id}}">
                <label for="branch{{ $groupe->id }}">{{$groupe->group_name}}</label>
            </span>

            @endforeach

        </div>

        <h6 style="margin:10px"> Les Modules  </h6>

        <div class="checkboxContainer mb-lg-3 col-lg-9">

            @foreach ( $modules as $module)
            <span>
                <input  type="checkbox" id="branch{{ $module->id }}" name="modules[]" value="{{$module->id}}">
                <label for="branch{{ $module->id }}">{{$module->module_name}}</label>
            </span>

            @endforeach

        </div>
            <div class="mb-lg-3 col-lg-9">
                <label for="exampleInputEmail1" class="form-label">Matricule formateur  </label>
                <input type="text" name='id' class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
              </div>
            <button type="submit" class="btn btn-success">save</button>
        </form>
        {{-- table --}}
        <h3>Formateurs</h3>


    </div>





    {{-- New table --}}




            <div class="row">
                <div class="col-md-12 ">
                    <div class="row">
                    <div class="card">
                        <div class="card-body ">
                            <div class="table-responsive">
                                <table class="table table-centered mb-0">
                                    <thead>
                                        <tr>
                                            <th >#</th>
                                            <th >name</th>
                                            <th  colspan="2">email</th>
                                            <th >password</th>
                                            <th >status</th>
                                            <th colspan="2">actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @if($formateurs)
                                        @foreach ($formateurs as $key => $formateur )
                                        <tr>
                                            <th scope="row">{{$key +1}}</th>

                                            <td colspan="">{{$formateur->user_name}}</td>
                                            <td colspan="2">{{$formateur->email}}</td>
                                            <td colspan="">{{$formateur->passwordClone}}</td>
                                            <td><span class="badge {{$formateur->status==='active' ? ' badge-soft-success ':' badge-soft-danger '}} font-size-12">{{$formateur->status}}</span  ></td>

                                            <td >
                                                {{-- <td><a href='{{url("/update-formateur/{$formateur->id}")}}' class="btn btn-primary btn-sm">Edit</a></td>
                                                <td><a href="{{url("delete-formateur/{$formateur->id}")}}" class="btn btn-danger btn-sm">Delate</a></td> --}}
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#staticBackdrop_{{$formateur->id}}">Voir plus</button>
                                            </td>
                                        </tr>
                                        @endforeach
                                        @endif



  <!-- Modals for detailed group information -->
  @foreach ($formateurs as $formateur)
  <div class="modal fade" id="staticBackdrop_{{ $formateur->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel_{{$formateur->id}}" aria-hidden="true">
      <div class="modal-dialog modal-xl">
          <div class="modal-content">
              <!-- Modal header -->
              <div class="modal-header">
                  <h1 class="modal-title fs-5" id="staticBackdropLabel_{{ $formateur->id}}">{{ $formateur->user_name }}</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <!-- Modal body -->
              <div class="modal-body">
                  <!-- Table to display detailed information -->
                  <table  class="table table-striped"  style="font-size: 19px;font-weight:300; ">
                      <thead>
                          <tr>
                              <th scope="col">Code Filiére</th>
                              <th scope="col">Filière</th>
                              <th scope="col">Les Modules</th>
                              <th scope="col">Les groupes</th>
                              <th scope="col">Actions</th>
                          </tr>
                      </thead>
                      <tbody style="color: black" >
                          <tr> </div>
                          </td>

                              <td>

                                   <td><a href='{{url("/update-formateur/{$formateur->id}")}}' class="btn btn-primary btn-sm">Edit</a></td>
                                                <td><a href="{{url("delete-formateur/{$formateur->id}")}}" class="btn btn-danger btn-sm">Delate</a></td>
                              </td>
                          </tr>
                      </tbody>
                  </table>
              </div>
              <!-- Modal footer -->
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary">Understood</button>
              </div>
          </div>
      </div>
  </div>
@endforeach
</div>


                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>




</x-HeaderMenuAdmin>
