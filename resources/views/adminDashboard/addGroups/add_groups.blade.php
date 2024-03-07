<x-HeaderMenuAdmin>


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
            <div class="mb-3 col-6">
              <label for="exampleInputEmail1" class="form-label">group Name </label>
              <input type="text"name='group_name' class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>

            <div class="mb-3 col-6">
                <label for="exampleInputEmail1" class="form-label"> barnch </label>
                <input type="text"name='branch' class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
              </div>

              <div class="mb-3 col-6">
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
                    <th scope="col">Filière</th>
                    <th scope="col">Année</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @if($groups)
                    @foreach ($groups as $key => $group )
                        <tr>
                            <th scope="row">{{$key + 1}}</th>
                            <td>{{$group->group_name}}</td>
                            <td style="Width: 520px">{{$group->branch}}</td>
                            <td>{{$group->year}}</td>
                            <td style="width: 220px">
                                <button type="button" class="btn btn-primary"><a style="text-decoration: none ;color:black" href="{{url("update-group/{$group->id}")}}">Edit</a></button>
                                <button type="button" class="btn btn-danger"><a href="{{route('delateGrope',['id'=>$group->id])}}">Delete</a></button>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>


    </div>


</x-HeaderMenuAdmin>
