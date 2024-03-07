<x-HeaderMenuAdmin>


    <div style="width:50%;margin-x:auto">

        @if ($errors->any())
        @foreach ($errors->all() as $error )
        <div class=" alert alert-danger">{{$error}}</div>
        @endforeach
        @endif
        <form method='POST' action="{{route('insertmodule')}}">
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
            <div class="mb-3 col-3">
                <label for="exampleInputEmail1" class="form-label">Code Module  </label>
                <input type="text"name='id' class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
              </div>

            <button type="submit" class="btn btn-success">save</button>
        </form>
        {{-- table --}}

        <h3>modules</h3>
   <table style="width: 70vw ; font-weight: bold;" class="table table-striped">
    <thead>
        <tr>
          <th scope="col">#</th>
          <th > Code Modules</th>
          <th tpscope="col">Moduls</th>
          <th scope="col">actions</th>
        </tr>
      </thead>
      <tbody>
   @if($modules)
   @foreach ($modules as $key => $module )
   <tr>
    <th scope="row">{{$key +1}}</th>
    <th>fffffff</th>
    <td colspan="">{{$module->module_name}}</td>
    <td colspan="2">
      <button type="button" class="btn  btn-primary">
        <a style="text-decoration: none ;color:black" href="{{url("update-module/{$module->id}")}}">Edit</a>
    </button>
      <button type="button" class="btn btn-danger">
        <a href="{{url("delatemodule/{$module->id}")}}">Delete</a>
    </button>
    </td>
  </tr>
   @endforeach
   @endif
      </tbody>
  </table>


    </div>



</x-HeaderMenuAdmin>
