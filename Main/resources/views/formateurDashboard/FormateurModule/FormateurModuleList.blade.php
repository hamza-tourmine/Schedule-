<x-HeaderMenuFormateur>
<div class="container-fluid">
    <div class="main-content">
        <div class="page-content">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Liste Des modules</h4>

                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap">
                                <thead>
                                    <tr>
                                        <th>Nom Du module</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @if (isset($modulesList) && $modulesList->count() > 0)
                                        @foreach ($modulesList as $moduleList)
                                        @php
                                        $moduleName = \App\Models\module::find($moduleList['module_id'])->module_name;
                                        @endphp
                                            <tr>
                                                <td>{{ $moduleName }}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="2">No modules assigned to this formateur</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</x-HeaderMenuFormateur>
