<x-Headers>


    <div style="width:50%;margin-x:auto">

        @if ($errors->any())
        @foreach ($errors->all() as $error )
        <div class=" alert alert-danger">{{$error}}</div>
        @endforeach
        @endif
        <form method='POST' action="{{route('insertmodel')}}">
            @if(session('success'))
            <div id="liveAlertPlaceholder" class="alert alert-success">
                {{ session('success') }}
            </div>
      @endif

            @csrf
            <div class="mb-3 col-3">
              <label for="exampleInputEmail1" class="form-label">Module Name </label>
              <input type="text"name='module_name' class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>

            <button type="submit" class="btn btn-success">save</button>
        </form>
        {{-- table --}}

        <h3>Models</h3>
   <table class="table table-striped">
    <thead>
        <tr>
          <th scope="col">#</th>
          <th tpscope="col">Moduls</th>
          <th scope="col">actions</th>
        </tr>
      </thead>
      <tbody>
   @if($models)
   @foreach ($models as $key => $model )
   <tr>
    <th scope="row">{{$key +1}}</th>
    <td colspan="">{{$model->module_name}}</td>

    <td colspan="2">
      <button type="button" class="btn  btn-primary"><a  style="text-decoration: none ;color:black" href="{{url("update-Model/{$model->id}")}}">Edit</a></button>
      <button type="button" class="btn btn-danger"><a href="{{url("delatemodel/{$model->id}")}}">Delete</a></button>
    </td>
  </tr>
   @endforeach
   @endif
      </tbody>
  </table>


    </div>



</x-Headers>
