<div>
    <form wire:submit.prevent="submit">
        <div wire:ignore.self  class="modal fade col-9" id="exampleModal{{ $group->id }}" tabindex="-1"
            aria-labelledby="exampleModalLabel{{ $group->id }}" aria-hidden="true">
            <div class="modal-dialog  modal-lg  ">
                <div class="modal-content  col-9">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel{{ $group->id }}">
                            Create session</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div style="display: flex">
                            {{-- module  content --}}
                            <select wire:model="module" name="module" class="form-select" aria-label="Default select example">
                                <option selected>Modules</option>
                                @if ($modules)
                                    @foreach ($modules as $module)
                                        <option value="{{ $module->id }}">{{ $module->module_name }}</option>
                                    @endforeach
                                @endif
                            </select>
                            {{-- Groups --}}
                            <label for=""></label>
                            <select wire:model="group" name="module" class="form-select" aria-label="Default select example">
                                <option selected>Groups</option>
                                @if ($groups)
                                    @foreach ($groups as $group)
                                        <option value="{{ $group->id }}">
                                            {{ $group->group_name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div style="display: flex">
                            {{-- Formateur --}}
                            <select wire:model='formateur' class="form-select"
                                aria-label="Default select example">
                                <option selected>Formateurs</option>
                                @if ($formateurs)
                                    @foreach ($formateurs as $formateur)
                                        <option value="{{ $formateur->id }}">
                                            {{ $formateur->user_name }}</option>
                                    @endforeach
                                @endif
                            </select>
                            {{-- salle --}}
                            <select wire:model="salle" class="form-select"
                                aria-label="Default select example">
                                <option selected>les salles</option>
                                @if ($salles)
                                    @foreach ($salles as $salle)
                                        <option value="{{ $salle->id }}">
                                            {{ $salle->class_name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        {{-- tyope session --}}
                        <div style="display: flex;justify-content: space-between">
                            <select wire:model="salleclassTyp" class="form-select"
                                aria-label="Default select example">
                                <option selected>les Types</option>
                                @if ($classType)
                                    @foreach ($classType as $classTyp)
                                        <option value="{{ $classTyp->id }}">
                                            {{ $classTyp->class_room_types }}</option>
                                    @endforeach
                                @endif
                            </select>
                            <select wire:model="dure" class="form-select"
                                aria-label="Default select example">
                                <option selected>Dure</option>
                                <option value="S1">S1</option>
                                <option value="S2">S2</option>
                                <option value="S1+S2">S2+S1</option>
                            </select>
                            <input type="hidden" wire:model="idCase" id="idCase" value="">
                        </div>
                        {{-- day part && type sission --}}
                        <div style="display: flex">
                            <select wire:model="dayPart" class="form-select"
                                aria-label="Default select example">
                                <option selected>Jour part</option>
                                <option value="Matin">Matin</option>
                                <option value="A.midi">AM</option>
                            </select>
                            <select wire:model="TypeSesion" class="form-select"
                                aria-label="Default select example">
                                <option selected>Types</option>
                                <option value="presentielle">Presentielle</option>
                                <option value="teams">Teams</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"data-bs-dismiss="modal">Close</button>

                        <button wire:click="save" class="btn btn-primary">Save</button>
                    </div>
    </form>
    
</div>
