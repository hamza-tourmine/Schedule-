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
    <div style="width:50%;margin-x:auto">
        <form method='POST' action="{{route('insertGroups')}}">
            @if(session('success'))
            <div id="liveAlertPlaceholder" class="alert alert-success">
                {{ session('success') }}
            </div>
      @endif
      @if ($errors->any())
      @foreach ($errors->all() as $error )
      <div class="alert alert-danger">{{$error}}</div>
      @endforeach
      @endif

            @csrf
            <div class="mb-3 ">
              <label for="exampleInputEmail1" class="form-label">group Name </label>
              <input type="text"name='group_name' class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
                                    <div class="mb-3">
                                        <label class="form-label">les Filiéres</label>
                                        <select  name="branch" class="form-control select2">
                                            <option>Filiére</option>
                                            @foreach ( $branches as $branche)
                                            <option value="{{$branche->id}}">{{$branche->name}}</option>
                                            @endforeach
                                        </select>
              <div class="mb-3 ">
                <h6 style="margin:5px">les Modules </h6>
                <div class="checkboxContainer">

                    @foreach ($modules as $item)
                        <span>
                            <input  type="checkbox" id="module_{{ $item->id }}" name="modules[]" value="{{ $item->id }}">
                            <label for="module_{{ $item->id }}">{{ $item->module_name }}</label>
                        </span>
                    @endforeach
                </div>
                <label for="exampleInputEmail1" class="form-label">l'année </label>
                <input type="text"name='year' class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
              </div>

            <button type="submit" class="btn btn-success">save</button>
        </form>
        {{-- table --}}

        <h3>Groups</h3>
        <table style="font-saza:19px;font-weight: bold;width:70vw " class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Group</th>
                    <th scope='col'>Code Filiére</th>
                    <th scope="col">Filière</th>

                    <th scope="col">Niveau</th>
                    <th  scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <h1>module  Group !!!!</h1>
                @if($groups)
                    @foreach ($groups as $key => $group )
                        <tr>
                            <th scope="row">{{$key + 1}}</th>
                            <td>{{$group->group_name}}</td>
                            <td>{{substr($group->barnch_id , 7)}}</td>
                            <td >{{$group->name}}</td>
                            <td>{{$group->year}}</td>
                            <td colspan="" >
                                <button type="button" class=" btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop.{{$group->id}}">Voir plus</button>
                                <button type="button" class="btn btn-primary"><a style="text-decoration: none ;color:black" href="{{url("update-group/{$group->id}")}}">Edit</a></button>
                                <button type="button" class="btn btn-danger"> <a href="{{route('delateGrope',['id'=>$group->id])}}">Delete</a></button>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>


        @foreach ($groups as $key => $group )

        <div class="modal fade" id="staticBackdrop.{{$group->id}}" data-bs-backdrop="static"
         data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="staticBackdropLabel">{{$group->group_name}}</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>

                                <th scope='col'>Code Filiére</th>
                                <th scope="col">Filière</th>
                                <th scope="col">Les Modules</th>
                                <th scope="col">Niveau</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>

                                    <tr>
                                        <td >{{substr($group->barnch_id , 7)}}</td>
                                        <td >{{$group->name}}</td>
                                        <td >{{$group->year}}</td>
                                        {{-- <td>
                                            @foreach ($group-> as $item)

                                            @endforeach
                                        </td> --}}
                                        <td >
                                            <button type="button" class=" btn btn-primary "
                                             data-bs-toggle="modal" data-bs-target="#staticBackdrop">Voir plus</button>
                                            <button type="button" class="btn btn-primary"><a style="text-decoration: none ;color:black" href="{{url("update-group/{$group->id}")}}">Edit</a></button>
                                            <button type="button" class="btn btn-danger"><a href="{{route('delateGrope',['id'=>$group->id])}}">Delete</a></button>
                                        </td>
                                    </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary">Understood</button>
                </div>
              </div>
            </div>
        </div>
        @endforeach
    </div>


</x-HeaderMenuAdmin>
