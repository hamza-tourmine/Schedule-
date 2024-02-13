<x-HeaderMenuFormateur>
    <style>
        .wrapper {
            margin: 15px auto;
            max-width: 100%;
            overflow-x: auto;
        }

        .container-calendar {
            background: #ffffff;
            padding: 15px;
            max-width: 100%;
            margin: 0 auto;
            overflow: auto;
        }

        .button-container-calendar button {
            cursor: pointer;
            display: inline-block;
            zoom: 1;
            background: #00a2b7;
            color: #fff;
            border: 1px solid #0aa2b5;
            border-radius: 4px;
            padding: 5px 10px;
        }

        #previous {
            float: left;
        }

        #next {
            float: right;
        }

        .button-container-calendar {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .date-container {
            text-align: center;
            flex-grow: 1;
        }

        .date-info {
            display: flex;
            align-items: center;
        }

        .date-info span {
            margin-right: 10px;
        }

        thead tr.day {
            font-size: 18px;
            padding: 30px;
            color: black;
            height: 50px;
            background-color: white;
        }

        thead tr.dPart {
            font-size: 18px;
            padding: 30px;
            color: black;
            height: 40px;
            background-color: gainsboro;
        }

        thead tr.se-row {
            height: 30px !important;
            width: 30px;
            margin: 0px;
            padding: 0px;
            font-size: 16px;
            color: black;
            background-color: white;
        }

        tbody tr.dtdynamic {
            height: 100px !important;
            width: 30px;
            margin: 0px;
            padding: 0px;
            font-size: 16px;
            color: black;
            background-color: gainsboro;
        }
        .fade{
            /* top: -450px; */
        }
    </style>

    <div class="wrapper">
        <div class="container-calendar">
            <div class="button-container-calendar">
                <button id="previous" onclick="previous()">&#8249;</button>
                <div class="date-info">
                    <h2> Start:<span id="dateStart"></span></h2>
                    <h2> End: <span id="dateEnd"></span></h2>
                </div>
                <button id="next" onclick="next()">&#8250;</button>
            </div>
            <table id="tbl_exporttable_to_xls" class="table-bordered text-center col-md-12" style="width:100%">
                <thead>
                    <tr class="day bg-light-gray">
                        @foreach ($days_of_week as $day_of_week)
                            <th class="text-uppercase" colspan="4">{{$day_of_week}}</th>
                        @endforeach
                    </tr>
                    <tr class="dPart bg-light-gray">
                        @foreach ($days_of_week as $day_of_week)
                            @foreach ($days_part as $day_part)
                                <th class="text-uppercase" colspan="2">{{$day_part}}</th>
                            @endforeach
                        @endforeach
                    </tr>
                    <tr class="se-row bg-light-gray">
                        @foreach ($days_of_week as $day_of_week)
                            @foreach ($seances_part as $seance_part)
                                <th>{{$seance_part}}</th>
                            @endforeach
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    <tr class="dtdynamic bg-light-gray">
                        @foreach ($days_of_week as $day_of_week)
                            @foreach ($seances_part as $seance_part)
                                <th></th> <!-- Leave this cell empty -->
                            @endforeach
                        @endforeach
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="container">
            <div class="timetable-img text-center">
                <img src="img/content/timetable.png" alt="">
            </div>
        </div>
    </div>

    {{-- start modal --}}
    <!-- Modal -->
    <div style="top: -450px"  class="modal fade" id="groupModuleClassModal" tabindex="-1" role="dialog" aria-labelledby="groupModuleClassModalLabel" aria-hidden="true">
        <div class="test modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="groupModuleClassModalLabel">Sélectionner des données</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="groupModuleClassForm">
                        <div class="form-group">
                            <label for="group">Group:</label>
                            <select class="form-control" id="group" name="group" required>
                                @foreach ($GroupsList as $GroupList)
                                @php
                                $groupId = \App\Models\Group::find($GroupList['group_id'])->id;
                                $groupName = \App\Models\Group::find($GroupList['group_id'])->group_name;
                                @endphp
                                <option value="{{$groupId}}">{{$groupName}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="module">Module:</label>
                            <select class="form-control" id="module" name="module" required>
                                @foreach ($modulesList as $moduleList)
                                @php
                                $ModuleId = \App\Models\module::find($moduleList['module_id'])->id;
                                $ModuleName = \App\Models\module::find($moduleList['module_id'])->module_name;
                                @endphp
                                <option value="{{$ModuleId}}">{{$ModuleName}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="class">Class:</label>
                            <select class="form-control" id="class" name="class" required>
                                @foreach ($class_rooms as $class_room)
                                @php
                                $RoomName = \App\Models\class_room::find($class_room['class_name'])->class_name;
                                @endphp
                                <option value="{{$RoomName}}">{{$RoomName}}</option>
                                @endforeach
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-primary">Soumettre</button>
                </div>
            </div>
        </div>
    </div>
    {{-- end modal --}}

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Get all table cells
            var cells = document.querySelectorAll("tbody tr.dtdynamic th");
    
            // Add click event listener to each cell
            cells.forEach(function (cell) {
                cell.addEventListener("click", function () {
                    // Show the modal when a cell is clicked
                    $('#groupModuleClassModal').modal('show');
                });
            });
    
            // Event listener for the "Fermer" button
            $('#groupModuleClassModal').on('hidden.bs.modal', function () {
                // Clear the form when the modal is hidden
                $('#groupModuleClassForm')[0].reset();
            });
        });
    
        var mainEmplois = @json($main_emplois);
        var currentIndex = 0;
    
        function displayItem(index) {
            document.getElementById('dateStart').innerText = mainEmplois[index].datestart;
            document.getElementById('dateEnd').innerText = mainEmplois[index].dateend;
        }
    
        function previous() {
            currentIndex = (currentIndex - 1 + mainEmplois.length) % mainEmplois.length;
            displayItem(currentIndex);
        }
    
        function next() {
            currentIndex = (currentIndex + 1) % mainEmplois.length;
            displayItem(currentIndex);
        }
    
        // Display the first item initially
        displayItem(currentIndex);
    </script>
    
</x-HeaderMenuFormateur>
