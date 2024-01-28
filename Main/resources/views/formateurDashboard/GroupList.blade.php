
@extends('layout')
@section('content')
<div class="container-fluid">
  <div class="main-content">
    <div class="page-content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Liste Des Groupes</h4>

              <table
                id="datatable-buttons"
                class="table table-striped table-bordered dt-responsive nowrap"
              >
                <thead>
                  <tr>
                    <th>IdGroupe</th>
                    <th>Nom Du Groupe</th>
                  </tr>
                </thead>

                <tbody>
                  @foreach ($groups as $group)
                  <tr>
                    <td>{{ $group->id }}</td>
                    <td>{{ $group->group_name }}</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

