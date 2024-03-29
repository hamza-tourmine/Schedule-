
<x-HeaderMenuFormateur>
<div class="container-fluid">
    <div class="main-content">
        <div class="page-content">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Liste Des Groupes</h4>

                            <table id="FormateurGroupesTable" class="table table-striped table-bordered dt-responsive nowrap">
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
                    <button  class="btn btn-primary" onclick="ExportToExcel('xlsx')">Telecharger</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
<script>
    function ExportToExcel(type, fn, dl) {
       var elt = document.getElementById('FormateurGroupesTable');
       var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });

       // Modifier le style de la feuille Excel
       wb.Sheets['sheet1']['!cols'] = [{ wch: 30 }, { wch: 15 }, { wch: 15 }]; 
       return dl ?
         XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }):
         XLSX.writeFile(wb, fn || ('FormateurGroupesTable.' + (type || 'xlsx')));
    }
</script>




</x-HeaderMenuFormateur>


