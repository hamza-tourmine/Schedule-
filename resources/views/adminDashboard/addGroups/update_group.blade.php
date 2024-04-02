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
        <h1>Update  groupes</h1>
        <form  wire:submit.prevent ="create">
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
              <input wire:model='group_name' type="text"name='group_name' class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
                            <div class="mb-3">
                                 <label class="form-label">les Filiéres</label>
                                    <select wire:model='branch'  name="branch" class="form-control select2">
                                         <option>Filiére</option>
                                         @foreach ( $branches as $branche)
                                         <option value="{{$branche->id}}">{{$branche->name}}</option>
                                         @endforeach
                                    </select>
                                    <div class="mb-3">
                                        <h6 style="margin:10px">Modules</h6>
                                        <div style="width: 100%" class="checkboxContainer  col-lg-9">
                                            @foreach ($modules as $module)
                                                <span>
                                                    <input wire:model="selectedModules.{{ $module->id }}" type="checkbox" id="module{{ $module->id }}" name="selectedModules[]" value="{{ $module->id }}">
                                                    <label for="module{{ $module->id }}">{{ $module->module_name }}</label>
                                                </span>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="year" class="form-label">Year</label>
                                        <input wire:model.defer="year" type="text" name="year" class="form-control" id="year">
                                    </div>

                                    <button type="submit" class="btn btn-success">Update ...</button>
        </form>
    </div>


</x-HeaderMenuAdmin>
