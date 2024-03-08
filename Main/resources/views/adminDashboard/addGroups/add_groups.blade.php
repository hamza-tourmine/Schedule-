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
   <table class="table table-striped">
    <thead>
        <tr>
          <th scope="col">#</th>
          <th tpscope="col">group</th>
          <th tpscope="col">branch</th>
          <th tpscope="col">year</th>
          <th scope="col">actions</th>
        </tr>
      </thead>
      <tbody>
   @if($groups)
   @foreach ($groups as $key => $group )
   <tr>
    <th scope="row">{{$key +1}}</th>
    <td colspan="">{{$group->group_name}}</td>
    <td colspan="">{{$group->branch}}</td>
    <td colspan="">{{$group->year}}</td>

    <td colspan="2">
      <button type="button" class="btn  btn-primary"><a  style="text-decoration: none ;color:black" href="{{url("update-group/{$group->id}")}}">Edit</a></button>
      <button type="button" class="btn btn-danger"><a href="{{route('delateGrope',['id'=>$group->id])}}">Delete</a></button>
    </td>
  </tr>
   @endforeach
   @endif
      </tbody>
  </table>


    </div>


</x-HeaderMenuAdmin>
