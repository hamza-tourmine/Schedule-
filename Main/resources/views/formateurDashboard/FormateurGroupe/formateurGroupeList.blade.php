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

                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap">
                                <thead>
                                    <tr>
                                        <th>Nom Du Groupe</th>
                                        <th>Branch</th>
                                        <th>Year</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @if (isset($GroupsList) && $GroupsList->count() > 0)
                                        @foreach ($GroupsList as $GroupList)
                                        @php
                                        $groupName = \App\Models\Group::find($GroupList['group_id'])->group_name;
                                        $groupBranch = \App\Models\Group::find($GroupList['group_id'])->branch;
                                        $groupYear = \App\Models\Group::find($GroupList['group_id'])->year;
                                        @endphp
                                                <tr>
                                                    <td>{{ $groupName}}</td>
                                                    <td>{{ $groupBranch}}</td>
                                                    <td>{{ $groupYear}}</td>
                                                </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="2">No groups assigned to this formateur</td>
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
@endsection
