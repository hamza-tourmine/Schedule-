<x-HeaderMenuAdmin>
    <style>
        label {
            font-weight: bold;
            font-size: 30px;
            margin-left: 5px;
            margin-right: 5px;
        }

        /* CSS for the fixed fly button */
        .fixed-button {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1000;
        }

        .fixed-button button {
            padding: 10px 20px;
            background-color: #00a2b7;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            outline: none;
        }

        .fixed-button button:hover {
            background-color: #0088a2;
        }

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
            flex-wrap: wrap;
        }

        .button-container-calendar .fixed-button {
            margin-top: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
            /* Allow items to wrap to the next line */
        }

        .button-container-calendar .fixed-button button {
            padding: 8px 16px;
            margin: 5px;
        }

        .button-container-calendar label {
            font-size: 20px;
        }

        .button-container-calendar .date-info {
            margin-top: 10px;
            text-align: center;
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

        thead tr.day {
            font-size: 18px;
            /* font-weight: bold; */
            padding: 30px
        }

        thead tr.se-row {
            height: 30px !important;
            width: 30px;
            margin: 0px;
            padding: 0px;
            font-size: 16px
        }

        .idemploi {
            font-weight: bold
        }

        .st {
            color: tomato
        }

        .ed {
            color: teal
        }

        a {
            text-decoration: none;
            color: white
        }

        button .nextprevious {
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

        label.left-arrow {
            float: left;
        }

        label.right-arrow {
            float: right;
        }

        @media only screen and (max-width: 600px) {
            h4 {
                font-size: 18px;
            }

            .button-container-calendar label {
                font-size: 20px;
            }

        }

        @media only screen and (max-width: 420px) {
            h4 {
                font-size: 14px;
            }

            .button-container-calendar label {
                font-size: 16px;
            }

        }

        @media only screen and (max-width: 360px) {
            h4 {
                font-size: 10px;
            }

            .button-container-calendar label {
                font-size: 12px;
            }

        }

        @media only screen and (max-width: 290px) {
            h4 {
                font-size: 8px;
            }

            .button-container-calendar label {
                font-size: 10px;
            }

        }
    </style>


    <div class="button-container-calendar">
        <label class="left-arrow" id="previous" onclick="previous()">&#8249;</label>
        <div class="date-info">
            <h4> Start:<span id="dateStart" class="idemploi st"></span></h4>
            <h4> End: <span id="dateEnd" class="idemploi ed"></span></h4>
        </div>
        <label class="right-arrow" id="next" onclick="next()">&#8250;</label>
        <div class="fixed-button">
            <button id="createRequestBtn" type="button"><i class="fa fa-exclamation-circle"
                    style="font-size:16px;"></i>
                Creer une demande </button>



            <button id="toggleTablesBtn" onclick="toggleTables()"><i class="fas fa-table"></i> Changer la table</button>
            <button onclick="ExportToExcel('xlsx')"><i class="mdi mdi-download"></i>
                telecharger</button>

        </div>


    </div>

    <div>
        <label class="left-arrow" id="previousF" onclick="previous()">&#8249;</label>
        <div class="date-info">
            {{-- @foreach($formateurs as $formateur)
                <h1>{{$formateur->user_name}}</h1>            
            @endforeach --}}
        </div>
        <label class="right-arrow" id="nextF" onclick="next()">&#8250;</label>
    </div>
    <div id="tbl_exporttable_to_xls_2" class="table-responsive" style="display: none">
        <table id="tbl_exporttable_to_xls" style="overflow:scroll" class="col-md-12  active">
            <thead>
                <tr class="day">
                    @foreach ($days_of_week as $day_of_week)
                        <th class="text-uppercase" colspan="4">{{ $day_of_week }}</th>
                    @endforeach
                </tr>
                <tr class="dPart bg-light-gray">
                    @foreach ($days_of_week as $day_of_week)
                        @foreach ($days_part as $day_part)
                            <th class="text-uppercase" colspan="2">{{ $day_part }}</th>
                        @endforeach
                    @endforeach
                </tr>
                <tr class="se-row">
                    @foreach ($days_of_week as $day_of_week)
                        @foreach ($seances_part as $seance_part)
                            <th>{{ $seance_part }}</th>
                        @endforeach
                    @endforeach
                </tr>
            </thead>
            <tbody>
                <tr class="dtdynamic bg-light-gray">
                    @foreach ($days_of_week as $day_of_week)
                        @foreach ($seances_part as $seance_part)
                            <td data-day="{{ $day_of_week }}" data-seance="{{ $seance_part }}" data-bs-toggle="modal"
                                data-bs-target="#exampleModal" class="Cases">
                                @foreach ($AllSeances as $AllSeance)
                                    @if ($AllSeance->day == $day_of_week && $AllSeance->dure_sission == $seance_part)
                                        {{ $AllSeance->sission_type }} <br>
                                        {{ $AllSeance->group->group_name }} <br>
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

    </div>


    <div id="tbl_exporttable_to_xls_1" class="table-responsive">
        <table id="tbl_exporttable_to_xls" style="overflow: scroll" class="col-md-12">
            <thead>
                <!-- Header row for seance parts -->
                <tr>
                    <th>Days/Seance</th> <!-- Empty cell for spacing -->
                    @foreach ($seances_part as $seance_part)
                        <th>{{ $seance_part }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                <!-- Loop through each day -->
                @foreach ($days_of_week as $day_of_week)
                    <tr class="dtdynamic bg-light-gray">
                        <!-- Display the day -->
                        <th>{{ $day_of_week }}</th>
                        <!-- Loop through each seance part -->
                        @foreach ($seances_part as $seance_part)
                            <!-- Display the schedule data for each day and seance part -->
                            <td data-day="{{ $day_of_week }}" data-seance="{{ $seance_part }}"
                                data-bs-toggle="modal" data-bs-target="#exampleModal" class="Cases">
                                @foreach ($AllSeances as $AllSeance)
                                    @if ($AllSeance->day == $day_of_week && $AllSeance->dure_sission == $seance_part)
                                        {{ $AllSeance->sission_type }} <br>
                                        {{ $AllSeance->group->group_name }} <br>
                                        {{ $AllSeance->class_room->class_name }}
                                    @endif
                                @endforeach
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
        <br>
    </div>
    <button id="submitAll">Submit All</button>





    <div id="infoContainer"></div>
    </div>

    </div>


    {{-- start modal --}}
    <!-- Modal -->
    <div class="modal fade" id="groupModuleClassModal" tabindex="-1" role="dialog"
        aria-labelledby="groupModuleClassModalLabel" aria-hidden="true">
        <div class="test modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="groupModuleClassModalLabel">Sélectionner des données</h5>
                    <button type="button" class="close btn btn-danger" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="groupModuleClassForm" method="POST" action="{{ url('reciveData') }}">
                        @csrf
                        <div class="form-group">
                            <label for="group">Group:</label>
                            <select class="form-control" id="group" name="group" required>
                                @foreach ($GroupsList as $GroupList)
                                    @php
                                        $groupId = \App\Models\Group::find($GroupList['group_id'])->id;
                                        $groupName = \App\Models\Group::find($GroupList['group_id'])->group_name;
                                    @endphp
                                    <option value="{{ $groupId }}">{{ $groupName }}</option>
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
                                    <option value="{{ $ModuleId }}">{{ $ModuleName }}</option>
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
                                    <option value="{{ $RoomId }}">{{ $RoomName }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="class">Type your msg:</label>
                            <input type="text" id="msg">
                        </div>
                        <br />
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-primary">Soumettre</button>

                    </form>

                </div>


            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="createRequestModal" tabindex="-1" role="dialog"
        aria-labelledby="createRequestModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createRequestModalLabel">Create Request Emploi</h5>
                    <button type="button" class="close btn btn-danger" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="createRequestForm">
                        @csrf
                        <div class="form-group">
                            <label for="comment">Comment:</label>
                            <textarea class="form-control" id="cmt" name="comment" rows="3"></textarea>
                        </div>
                        <br>
                        <button type="button" class="btn btn-danger" data-dismiss="modal"
                            id="cancelRequest">Fermer</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- flash pop uo --}}

    {{-- end modal --}}

    <script>
        function toggleTables() {
            var table1 = document.getElementById("tbl_exporttable_to_xls_1");
            var table2 = document.getElementById("tbl_exporttable_to_xls_2");

            // If table1 is currently visible, hide it and show table2
            if (table1.style.display === "block") {
                table1.style.display = "none";
                table2.style.display = "block";
            } else { // If table1 is currently hidden, show it and hide table2
                table1.style.display = "block";
                table2.style.display = "none";
            }
        }
        document.addEventListener("DOMContentLoaded", function() {
            var cells = document.querySelectorAll("td.Cases");
            var daysOfWeek = @json($days_of_week);
            var daysPart = @json($days_part);
            var seancesPart = @json($seances_part);
            var casesPerDay = 4;
            var casesPerPartOfDay = 2;

            var clickedCell;
            var FlashMsg = document.createElement("div");



            var selectedData = [];

            var formateurs = @json($formateurs);
            var currentIndex = 0;


            document.getElementById('previousF').addEventListener('click', function() {
                currentIndex = (currentIndex - 1 + formateurs.length) % formateurs.length;
                displayItem(currentIndex);
                console.log(formateurs);


            });

            document.getElementById('nextF').addEventListener('click', function() {
                currentIndex = (currentIndex + 1) % formateurs.length;
                displayItem(currentIndex);
                console.log(formateurs);

            });

            //f foreach formateurs
            var mainEmplois = @json($main_emplois);
            var currentIndex = 0;


            document.getElementById('previous').addEventListener('click', function() {
                currentIndex = (currentIndex - 1 + mainEmplois.length) % mainEmplois.length;
                displayItem(currentIndex);
                console.log(mainEmploiId);


            });

            document.getElementById('next').addEventListener('click', function() {
                currentIndex = (currentIndex + 1) % mainEmplois.length;
                displayItem(currentIndex);
                console.log(mainEmploiId);

            });

            function displayItem(index) {
                if (mainEmplois.length == 0) {
                    document.getElementById('dateStart').innerText =
                        "veuillez attendre jusqu'a le directeur creer l'emploi";

                } else {
                    mainEmploiId = mainEmplois[index].id;
                    document.getElementById('dateStart').innerText = mainEmplois[index].datestart;
                    document.getElementById('dateEnd').innerText = mainEmplois[index].dateend;

                }
            }

            displayItem(currentIndex);
            var mainEmploiId = mainEmplois[currentIndex].id;
            $.ajax({
                type: 'GET',
                url: '{{ route('DemanderEmploi') }}',
                data: {

                    mainEmploiId: mainEmploiId,

                },
                success: function(response) {

                },
                error: function(error) {
                    console.error('Error creating sission emploi:',
                        error
                        .responseText);
                    // Handle error and display appropriate message to the user
                }
            });
            // Function to open the pop-up form and display the flash message

            $(document).ready(function() {

                // Function to handle form submission
                $('#createRequestForm').submit(function(event) {
                    event.preventDefault();

                    // Send AJAX request to create request emploi
                    console.log('Request', mainEmploiId);
                    $.ajax({
                        type: 'POST',
                        url: '{{ route('createRequestEmploi') }}',
                        data: {
                            '_token': '{{ csrf_token() }}',
                            mainEmploiId: mainEmploiId, // Add main emploi variable
                            comment: $('#cmt').val(),
                            formData: $(this).serialize() // Serialize form data

                        },
                        success: function(response) {

                            if (response.status == 400) {
                                FlashMsg.innerHTML = `<br><div class="alert alert-warning">
                                        ${response.message}
                                    </div>`;
                            } else if (response.status == 300) {
                                FlashMsg.innerHTML = `<br><div class="alert alert-success">
                                        ${response.message}
                                    </div>`;
                            }
                            if (response.requestExists) {
                                // Si la demande existe, mettre à jour le bouton en 'Update'
                                $('#createRequestBtn').text('Update');
                                // Stocker l'état du bouton dans le stockage local
                                localStorage.setItem('requestButtonState', 'Update');
                            } else {
                                // Si la demande n'existe pas, mettre à jour le bouton en 'Create'
                                $('#createRequestBtn').text('Create');
                                // Stocker l'état du bouton dans le stockage local
                                localStorage.setItem('requestButtonState', 'Create');
                            }
                            document.getElementById('infoContainer').innerHTML = '';
                            document.getElementById('infoContainer').appendChild(
                                FlashMsg);
                            $('#createRequestModal').modal('hide');
                            console.log('ajaxREQUEST', response);
                            $('#comment').val('');
                        },
                        error: function(error) {
                            console.error('Error creating request emploi:',
                                error
                                .responseText);
                            // Handle error and display appropriate message to the user
                        }
                    });
                });

                // Function to show modal when button is clicked
                $('#createRequestBtn').click(function() {
                    $('#createRequestModal').modal('show');
                });

                // Function to hide modal when cancel button is clicked
                $('#cancelRequest').click(function() {
                    $('#createRequestModal').modal('hide');
                });
                $('#createRequestModal').on('click', '.btn-danger', function() {
                    $('#createRequestModal').modal('hide');
                });
            });



            cells.forEach(function(cell) {
                cell.addEventListener("click", function() {

                    clickedCell = this; // Assign the clicked cell to clickedCell
                    console.log(clickedCell);

                    $('#groupModuleClassModal').modal('show');

                    $('#groupModuleClassForm').off('submit').on('submit', function(event) {
                        event.preventDefault();

                        var selectedGroup = $('#group option:selected').val();
                        var selectedModule = $('#module option:selected').val();
                        var selectedType = $('#type option:selected').val();
                        var selectedClass = $('#class option:selected').val();
                        var ShowselectedGroup = $('#group option:selected').text();
                        var ShowselectedModule = $('#module option:selected')
                            .text();
                        var ShowselectedType = $('#type option:selected').text();
                        var ShowselectedClass = $('#class option:selected').text();
                        var ShowselectedMsg = document.getElementById("msg").value;

                        // Get the position of the clicked cell in daysOfWeek, daysPart, and seancesPart

                        // var totalCases = casesPerDay * daysOfWeek.length;
                        // var clickedIndex = Array.from(clickedCell.parentNode
                        //         .children)
                        //     .indexOf(clickedCell);

                        // var dayOfWeekIndex = Math.floor(clickedIndex /
                        //         casesPerDay) %
                        //     daysOfWeek.length;
                        // var dayPartIndex = Math.floor((clickedIndex % totalCases) /
                        //     casesPerPartOfDay) % daysPart.length;
                        // var seancePartIndex = (clickedIndex % totalCases) %
                        //     seancesPart
                        //     .length;

                        // var dayOfWeek = daysOfWeek[dayOfWeekIndex];

                        var dayOfWeek = clickedCell.dataset.day;
                        var seancePart = clickedCell.dataset.seance;
                        var dayPart = (seancePart == "SE1" || seancePart == "SE2") ?
                            "Matin" : "A.midi";

                        // var seancePart = seancesPart[seancePartIndex];

                        // 

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



                        clickedCell.innerText = ShowselectedType + '\n ' +
                            ShowselectedGroup + '\n' + ShowselectedClass;

                        // // Create a new div to display the selected information
                        // var infoDiv = document.createElement("div");
                        // infoDiv.innerHTML = '<h3>Day of Week: ' + dayOfWeek +
                        //     '</h3>' +
                        //     '<h3>Day Part: ' + dayPart + '</h3>' +
                        //     '<h3>Seance Part: ' + seancePart + '</h3>' +
                        //     '<h3>Module: ' + ShowselectedModule + '</h3>' +
                        //     '<h3>Group: ' + ShowselectedGroup + '</h3>' +
                        //     '<h3>Seance Type: ' + ShowselectedType + '</h3>' +
                        //     '<h3>Seance MSG: ' + ShowselectedMsg + '</h3>' +
                        //     '<h3>class :' + ShowselectedClass + ' </h3>';

                        // // Append the new div to the "infoContainer"
                        // document.getElementById('infoContainer').innerHTML = '';
                        // document.getElementById('infoContainer').appendChild(
                        //     infoDiv);

                        $('#groupModuleClassModal').modal('hide');
                    });
                });
            });

            $('#groupModuleClassModal').on('click', '.btn-danger', function() {
                $('#groupModuleClassModal').modal('hide');
            });

            $('#cancelButton').click(function() {
                $('#groupModuleClassForm')[0].reset();
                $('#groupModuleClassModal').modal('hide');
            });

            $('#groupModuleClassForm').on('submit', function(event) {
                event.preventDefault();
            });


            // sending all data code
            document.getElementById('submitAll').addEventListener('click', function() {
                if (selectedData.length === 0) {
                    FlashMsg.innerHTML = `<br><div class="alert alert-danger">
                                vous devez selectionner au moins une seance.
                            </div>`
                    document.getElementById('infoContainer').innerHTML = '';
                    document.getElementById('infoContainer').appendChild(FlashMsg);
                    return;
                }
                $.ajax({
                    type: 'POST',
                    url: '{{ route('submitAllData') }}',
                    data: {

                        '_token': '{{ csrf_token() }}',
                        'selectedData': selectedData,
                        'mainEmploiId': mainEmploiId,

                    },
                    success: function(response) {

                        if (response.status == 200) {
                            FlashMsg.innerHTML = `<br><div class="alert alert-success">
                                                            ${response.sucess}
                                                            </div>`
                        } else if (response.status == 599) {
                            FlashMsg.innerHTML = `<br><div class="alert alert-warning">
                                                            ${response.msg}
                                                            </div>`
                        }

                        selectedData = [];
                        document.getElementById('infoContainer').innerHTML = '';
                        document.getElementById('infoContainer').appendChild(FlashMsg);
                    },
                    error: function(error) {
                        console.error('Error creating sission emploi:',
                            error
                            .responseText);
                        // Handle error and display appropriate message to the user
                    }
                });
            });



            console.log('demander', mainEmploiId);
            $.ajax({
                type: 'GET',
                url: '{{ route('DemanderEmploi') }}',
                data: {
                    'main_emploi_id': mainEmploiId, // Correct parameter name
                },
                success: function(response) {
                    console.log("c bon pour l'affiachge de l'emploi");
                },
                error: function(error) {
                    console.error('Error creating session emploi:', error.responseText);
                    // Handle error and display appropriate message to the user
                }
            });
            $(document).ready(function() {
                var buttonState = localStorage.getItem('requestButtonState');
                if (buttonState) {
                    $('#createRequestButton').text(buttonState);
                }
            });
        });

        function ExportToExcel(type, fn, dl) {
            // Get the currently visible table
            var currentTable = document.getElementById("tbl_exporttable_to_xls_1").style.display === "block" ?
                document.getElementById("tbl_exporttable_to_xls_1") :
                document.getElementById("tbl_exporttable_to_xls_2");

            // Convert the table to Excel format
            var wb = XLSX.utils.table_to_book(currentTable, {
                sheet: "sheet1"
            });

            // Export the Excel file
            return dl ?
                XLSX.write(wb, {
                    bookType: type,
                    bookSST: true,
                    type: 'base64'
                }) :
                XLSX.writeFile(wb, fn || ('Schedule.' + (type || 'xlsx')));
        }
    </script>



</x-HeaderMenuAdmin>
