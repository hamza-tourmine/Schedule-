<x-HeaderMenuAdmin>




    <div style="width:70%;margin-x:auto">
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
            <div class="mb-3 col-3">
              <label for="exampleInputEmail1" class="form-label">formateur Name </label>
              <input type="text"name='formateur_name' class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3 col-3">
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
                                                <td><a href='{{url("/update-formateur/{$formateur->id}")}}' class="btn btn-primary btn-sm">Edit</a></td>
                                                <td><a href="{{url("delete-formateur/{$formateur->id}")}}" class="btn btn-danger btn-sm">Delate</a></td>
                                            </td>
                                        </tr>
                                        @endforeach
                                        @endif





                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>


</x-HeaderMenuAdmin>
