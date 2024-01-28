
    @extends('layout')
    @section('content')
    <div class="container-fluid">
      <div class="main-content">
        <div class="page-content">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Liste Des Modules</h4>

                  <table
                    id="datatable-buttons"
                    class="table table-striped table-bordered dt-responsive nowrap"
                  >
                    <thead>
                      <tr>
                        <th>IdModule</th>
                        <th>Nom Du Module</th>
                      </tr>
                    </thead>

                    <tbody>
                      @foreach ($modules as $module)
                      <tr>
                        <td>{{ $module->id }}</td>
                        <td>{{ $module->module_name }}</td>
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

