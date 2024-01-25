<x-HeaderMenuAdmin>


    <div style="width:50%;margin-x:auto">
        <form method='POST' action="{{url("update-Model/$model->id")}}">
            @if(session('success'))
            <div id="liveAlertPlaceholder" class="alert alert-success">
                {{ session('success') }}
            </div>
      @endif

            @csrf
            <div class="mb-3 col-3">
              <label for="exampleInputEmail1" class="form-label">Module Name </label>
              <input type="text" name='model_name' value="{{$model->module_name}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>

            <button type="submit" class="btn btn-success">update</button>
        </form>
        {{-- table --}}



    </div>



</x-HeaderMenuAdmin>
