{{-- @extends('layout')

@section('content') --}}
<x-HeaderMenuAdmin>
<div class="container-fluid">
    <div class="main-content">
        <div class="page-content">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title text-center">Affectation des modules</h4>

                            @if(Session::has('warning'))
                                <div class="alert alert-warning text-center">
                                    {{ Session::get('warning') }}
                                </div>
                            @endif

                            <form action="{{ route('formateurModule') }}" method="post" id="moduleForm">
                                @csrf

                                <div class="form-group text-center">
                                    <label for="formateur">Sélectionnez le formateur :</label>
                                    <select class="form-control" id="formateur" name="formateur">
                                        @foreach ($formateurs as $formateur)
                                            <option value="{{ $formateur->id }}">{{ $formateur->user_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group text-center">
                                    <label>Sélectionnez les modules :</label>
                                    <div class="row justify-content-center">
                                        @foreach ($modules as $module)
                                            <div class="col-md-4 mb-3">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="module{{ $module->id }}" name="module[]"
                                                        value="{{ $module->id }}">
                                                    <label class="custom-control-label" for="module{{ $module->id }}">{{ $module->module_name }}</label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="mt-3 text-center">
                                    <button type="button" class="btn btn-primary" onclick="validateForm()">Enregistrer l'affectation</button>
                                </div>
                                <br/>
                                <div id="warningMessage" class="alert alert-warning text-center" style="display: none;">
                                    Veuillez sélectionner au moins un module.
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function validateForm() {
        // Get the checkboxes by name attribute
        var checkboxes = document.getElementsByName('module[]');
        var isChecked = false;

        // Check if at least one checkbox is checked
        for (var i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i].checked) {
                isChecked = true;
                break;
            }
        }

        // Show warning message if no checkbox is checked
        if (!isChecked) {
            document.getElementById('warningMessage').style.display = 'block';
            return;
        }

        // If at least one checkbox is checked, submit the form
        document.getElementById('moduleForm').submit();
    }
</script>

{{-- @endsection --}}
</x-HeaderMenuAdmin>
