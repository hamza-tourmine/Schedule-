@extends('layout')
@section('content')
<div class="container-fluid">
    <div class="main-content">
        <div class="page-content">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Affectation des Groupes</h4>

                            <form action="{{ route('formateurGroupe') }}" method="post">
                                @csrf

                                <div class="form-group">
                                    <label for="formateur">Sélectionnez le formateur :</label>
                                    <select class="form-control" id="formateur" name="formateur">
                                        @foreach ($formateurs as $formateur)
                                            <option value="{{ $formateur->id }}">{{ $formateur->user_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Sélectionnez les groupes :</label>
                                    @foreach ($groups as $group)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="group[]"
                                                value="{{ $group->id }}">
                                            <label class="form-check-label" for="group[]">{{ $group->group_name }}</label>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="mt-3">
                                    <button type="submit" class="btn btn-primary">Enregistrer l'affectation</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
