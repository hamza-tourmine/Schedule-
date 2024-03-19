<div wire:ignore>


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
            <form  wire:submit.prevent ="create">
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
                                            <div class="checkboxContainer mb-lg-3 col-lg-9">
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

                                        <button type="submit" class="btn btn-success">Save</button>
            </form>
            {{-- table --}}
<div  wire:target="fresh" >

    <h3>Groups</h3>
    <table class="table table-striped" style="font-size: 19px;font-weight:300; width: 70vw;">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Group</th>
                <th scope="col">Code Filiére</th>
                <th scope="col">Filière</th>
                <th scope="col">Niveau</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @if($groups)
                @foreach ($groups as $key => $group )
                    <tr>
                        <th scope="row">{{ $key + 1 }}</th>
                        <td>{{ $group['group_name'] }}</td>
                        <td>{{ substr($group['branch_id'], 7)}}</td>
                        <td>{{ $group['group_name'] }}</td>
                        <td>{{ $group['year'] }}</td>
                        <td colspan="">
                            <!-- Modal trigger button -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#staticBackdrop_{{ $group['group_id'] }}">Voir plus</button>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>

    <!-- Modals for detailed group information -->
    @foreach ($groups as $group)
        <div class="modal fade" id="staticBackdrop_{{ $group['group_id'] }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel_{{ $group['group_id'] }}" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <!-- Modal header -->
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel_{{ $group['group_id'] }}">{{ $group['group_name'] }}</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <!-- Table to display detailed information -->
                        <table  class="table table-striped"  style="font-size: 19px;font-weight:300; ">
                            <thead>
                                <tr>
                                    <th scope="col">Code Filiére</th>

                                    <th scope="col">Les Modules</th>
                                    <th scope="col">Niveau</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody style="color: black" >
                                <tr>
                                    <td>{{ substr($group['branch_id'], 7) }}</td>

                                    <td>
                                        <div style="width: 14vw">
                                    @foreach ($group['modules'] as $item)

                                        {{ $item}} ,

                                    @endforeach
                                </div>
                                </td>
                                    <td>{{ $group['year'] }}</td>
                                    <td>
                                        <button type="button" class="btn btn-primary">
                                            <a href="{{ url("update-group/{$group['group_id']}") }}" style="text-decoration: none; color: black;">Edit</a>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                         <!-- Delete button -->
                             <button type="button" class="btn btn-danger">
                                <a href="{{ route('delateGrope', ['id' => $group['group_id']]) }}">Delete</a>
                             </button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
</div>


</div>
