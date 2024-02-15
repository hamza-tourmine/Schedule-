<x-HeaderMenuFormateur>
    <style>
        .wrapper {
            margin: 15px auto;
            max-width: 100%;
            overflow-x: auto;
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

        body {
                font-family: Arial, sans-serif;
            }

            table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 20px;
            }

            th,
            td {
                height: 40px;
                width: 60px !important;
                border: 1px solid #ddd;
                text-align: center;
            }

            th {
                background-color: #f2f2f2;
            }
            thead tr.day{
                font-size: 18px;
                /* font-weight: bold; */
                padding:30px
            }
          thead tr.se-row {
                height: 30px !important;
                width: 30px;
                margin: 0px;
                padding: 0px;
                font-size: 16px
            }

            /* table {
            table-layout: fixed;
            word-wrap: break-word;
            } */
            .idemploi{
                font-weight: bold
            }
            .st{
                color: tomato
            }
            .ed{
                color: teal 
            }

    </style>

            <div class="button-container-calendar">
                <button id="previous" onclick="previous()">&#8249;</button>
                <div class="date-info">
                    <h2> Start:<span id="dateStart" class="idemploi st"></span></h2>
                    <h2> End: <span id="dateEnd" class="idemploi ed"></span></h2>
                </div>
                <button id="next" onclick="next()">&#8250;</button>
            </div>




        <div class="table-responsive">  
            <table id="tbl_exporttable_to_xls" style="overflow:scroll" class="col-md-12 ">
                <thead>
                    <tr class="day">
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
                    <tr class="se-row">
                        @foreach ($days_of_week as $day_of_week)
                            @foreach ($seances_part as $seance_part)
                                <th>{{$seance_part}}</th>
                            @endforeach
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    <tr class="dtdynamic bg-light-gray" >
                        @foreach ($days_of_week as $day_of_week)
                            @foreach ($seances_part as $seance_part)
                                <td data-bs-toggle="modal" data-bs-target="#exampleModal" class="Cases"></td> <!-- Leave this cell empty -->
                            @endforeach
                        @endforeach
                    </tr>
                </tbody>
            </table>
        </div>
        </div>
        
    </div>

    
{{-- start modal --}}
    <!-- Modal -->
    <div  class="modal fade" id="groupModuleClassModal" tabindex="-1" role="dialog" aria-labelledby="groupModuleClassModalLabel" aria-hidden="true">
        <div class="test modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="groupModuleClassModalLabel">Sélectionner des données</h5>
                    <button type="button" class="close btn btn-danger" data-dismiss="modal" aria-label="Close">
                        <span  aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="groupModuleClassForm"  method="POST">
                        @csrf
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
                                        $RoomName = \App\Models\class_room::find($class_room['id'])->class_name;
                                        $RoomId = \App\Models\class_room::find($class_room['id'])->id;

                                    @endphp
                                    <option value="{{$RoomId}}">{{$RoomName}}</option>
                                @endforeach
                            </select>
                        </div>
                        <br/>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-primary">Soumettre</button>

                    </form>
                    
                </div>
              
                
            </div>
        </div>
    </div>
    {{-- end modal --}}

    <script>
        document.addEventListener("DOMContentLoaded", function () {
    // Get all table cells
    var cells = document.querySelectorAll("tbody tr.dtdynamic td");

    // Add click event listener to each cell
    cells.forEach(function (cell) {
        cell.addEventListener("click", function () {
            console.log("Cell clicked");

            // Save the reference to the clicked cell
            var clickedCell = this;

            // Show the modal when a cell is clicked
            $('#groupModuleClassModal').modal('show');

            // Event listener for the "Soumettre" button inside the modal
            $('#groupModuleClassForm').off('submit').on('submit', function (event) {
                console.log("Form submitted");

                event.preventDefault(); // Prevent the form from submitting normally

                // Get the selected values from the form
                var selectedGroup = $('#group option:selected').text();
                var selectedModule = $('#module option:selected').text();
                var selectedClass = $('#class option:selected').text();

                // Concatenate the selected values
                var selectedText = selectedGroup + ',' + selectedModule + ', ' + selectedClass;

                // Create a new div element to display the information
                var infoDiv = document.createElement('div');
                infoDiv.innerText = selectedText;

                // Append the new div under the clicked cell
                clickedCell.appendChild(infoDiv);

                // Hide the modal
                $('#groupModuleClassModal').modal('hide');
            });
        });
    });

    // Event listener for the "Fermer" button inside the modal
    $('#groupModuleClassModal').on('click', '.btn-danger', function () {

        // Hide the modal when the "Fermer" button is clicked
        $('#groupModuleClassModal').modal('hide');
    });

    // Event listener for the "Annuler" button
    $('#cancelButton').click(function () {

        // Clear the form when the "Annuler" button is clicked
        $('#groupModuleClassForm')[0].reset();
        // Hide the modal
        $('#groupModuleClassModal').modal('hide');
    });

    // Additional event listener for form submission
    $('#groupModuleClassForm').on('submit', function (event) {
        console.log("Form submitted");
        event.preventDefault(); // Prevent the form from submitting normally
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