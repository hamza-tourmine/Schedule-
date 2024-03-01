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
        #submitAll {
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
            {
                text-decoration: none;
                color: white
            }
            {
                text-decoration: none;
                color: white
                
            }
        button .nextprevious{
          cursor: pointer;
          background: #00a2b7;
          color: #fff;
          border: 1px solid #0aa2b5;
          border-radius: 4px;
          padding: 5px 10px;
          margin: 5px;
        }
      
        button:disabled {
          background: #ddd;
          color: #666;
          cursor: not-allowed;
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
                            <td data-bs-toggle="modal" data-bs-target="#exampleModal" class="Cases">
                                @foreach ($AllSeances as $AllSeance)
                                    @if ($AllSeance->day == $day_of_week && $AllSeance->dure_sission == $seance_part)
                                            {{ $AllSeance->sission_type }}
                                            {{ $AllSeance->group->group_name }}
                                            {{ $AllSeance->class_room->class_name }}
                                    @endif
                                @endforeach
                            </td>
                                        @endforeach
                        @endforeach
                    </tr>
                </tbody>
            </table>
            <br>
            <button id="submitAll">Submit All</button>
            
        </div>
        
        <div id="infoContainer"></div>
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
                    <form id="groupModuleClassForm"  method="POST" action="{{url('reciveData')}}">
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
                            <label for="type">Seance Type</label>
                            <select class="form-control" id="type" name="type" required>
                                @foreach ($seances_type as $index => $seance_type)
                                    <option value="{{ $index }}">{{ $seance_type }}</option>
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
                        <div class="form-group">
                            <label for="class">Type your msg:</label>
                            <input type="text" id="msg" >
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
        var cells = document.querySelectorAll("tbody tr.dtdynamic td");
        var daysOfWeek = @json($days_of_week);
        var daysPart = @json($days_part);
        var seancesPart = @json($seances_part);
        var casesPerDay = 4;
        var casesPerPartOfDay = 2;

        var clickedCell;  
        var mainEmploiId;

        var selectedData = [];
    
    cells.forEach(function (cell) {
        cell.addEventListener("click", function () {
            clickedCell = this;  // Assign the clicked cell to clickedCell

            
            $('#groupModuleClassModal').modal('show');

            $('#groupModuleClassForm').off('submit').on('submit', function (event) {
                event.preventDefault();

                var selectedGroup = $('#group option:selected').val();
                var selectedModule = $('#module option:selected').val();
                var selectedType = $('#type option:selected').val();
                var selectedClass = $('#class option:selected').val();
                var ShowselectedGroup = $('#group option:selected').text();
                var ShowselectedModule = $('#module option:selected').text();
                var ShowselectedType = $('#type option:selected').text();
                var ShowselectedClass = $('#class option:selected').text(); 
                var ShowselectedMsg = document.getElementById("msg").value;

                // Get the position of the clicked cell in daysOfWeek, daysPart, and seancesPart
                var totalCases = casesPerDay * daysOfWeek.length;
                var clickedIndex = Array.from(clickedCell.parentNode.children).indexOf(clickedCell);

                var dayOfWeekIndex = Math.floor(clickedIndex / casesPerDay) % daysOfWeek.length;
                var dayPartIndex = Math.floor((clickedIndex % totalCases) / casesPerPartOfDay) % daysPart.length;
                var seancePartIndex = (clickedIndex % totalCases) % seancesPart.length;

                var dayOfWeek = daysOfWeek[dayOfWeekIndex];
                
                var dayPart = daysPart[dayPartIndex];
                var seancePart = seancesPart[seancePartIndex];
                // all data in once
                selectedData.push({
                                'group': selectedGroup,
                                'module': selectedModule,
                                'type': ShowselectedType,
                                'class': selectedClass,
                                'day': dayOfWeek,
                                'dayPart': dayPart,
                                'seancePart': seancePart,
                                'mainEmploiId': mainEmploiId,
                                'message': ShowselectedMsg
                            });
                

                clickedCell.innerText = ShowselectedType + '\n ' + ShowselectedGroup + '\n' + ShowselectedClass;

                // Create a new div to display the selected information
                var infoDiv = document.createElement("div");
                infoDiv.innerHTML = '<h3>Day of Week: ' + dayOfWeek + '</h3>' +
                    '<h3>Day Part: ' + dayPart + '</h3>' +
                    '<h3>Seance Part: ' + seancePart + '</h3>' +
                    '<h3>Module: ' + ShowselectedModule + '</h3>' +
                    '<h3>Group: ' + ShowselectedGroup + '</h3>' +
                    '<h3>Seance Type: ' + ShowselectedType + '</h3>' +
                    '<h3>Seance MSG: ' + ShowselectedMsg + '</h3>' +
                    '<h3>class :' + ShowselectedClass + ' </h3>';

                // Append the new div to the "infoContainer"
                document.getElementById('infoContainer').innerHTML = '';
                document.getElementById('infoContainer').appendChild(infoDiv);

                $('#groupModuleClassModal').modal('hide');
            });
        });
    });

    $('#groupModuleClassModal').on('click', '.btn-danger', function () {
        $('#groupModuleClassModal').modal('hide');
    });

    $('#cancelButton').click(function () {
        $('#groupModuleClassForm')[0].reset();
        $('#groupModuleClassModal').modal('hide');
    });

    $('#groupModuleClassForm').on('submit', function (event) {
        event.preventDefault();
    });


    // sending all data code
    document.getElementById('submitAll').addEventListener('click', function () {
                    if (selectedData.length === 0) {
                        alert('No data selected. Please select at least one cell.');
                        return;
                    }

                    // Send all selected data to the server
                    $.ajax({
                        type: 'POST',
                        url: '{{ route("submitAllData") }}',
                        data: { '_token': '{{ csrf_token() }}', 'selectedData': selectedData },
                        success: function (response) {
                            console.log('All data submitted successfully:', response);
                            // Optionally, you can reset the selectedData array after submission
                            selectedData = [];
                        },
                        error: function (error) {
                            console.error('Error submitting data:', error.responseText  );
                            alert('Error submitting data. Please try again.');
                        }
                    });
                });


    var mainEmplois = @json($main_emplois);
    var currentIndex = 0;
    

    document.getElementById('previous').addEventListener('click', function () {
        currentIndex = (currentIndex - 1 + mainEmplois.length) % mainEmplois.length;
        displayItem(currentIndex);
        

    });

    document.getElementById('next').addEventListener('click', function () {
        currentIndex = (currentIndex + 1) % mainEmplois.length;
        displayItem(currentIndex);
    });

    function displayItem(index) {
        if(mainEmplois.length == 0){
        document.getElementById('dateStart').innerText ="veuillez attendre jusqu'a le directeur creer l'emploi";
        
    }else {
        mainEmploiId = mainEmplois[index].id;
        document.getElementById('dateStart').innerText = mainEmplois[index].datestart;
        document.getElementById('dateEnd').innerText = mainEmplois[index].dateend;

    }
    }

    displayItem(currentIndex);
    
});
    </script>
      
    
</x-HeaderMenuFormateur>