<x-Headers>

    <div style="width:50%;margin-x:auto">
        <form method='POST' action="{{url("updateGroups/$group->id")}}">
            @csrf
            <div class="mb-3 col-6">
              <label for="exampleInputEmail1" class="form-label">group Name </label>
              <input type="text"name='group_name' value="{{$group->group_name}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3 col-6">
                <label for="exampleInputEmail1" class="form-label">branch </label>
                <input type="text"name='branch' value="{{$group->branch}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
              </div>
              <div class="mb-3 col-6">
                <label for="exampleInputEmail1" class="form-label">l'année </label>
                <input type="text"name='year' value="{{$group->year}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
              </div>
            <button type="submit" class="btn btn-success">update</button>
        </form>
    </div>


</x-Headers>
