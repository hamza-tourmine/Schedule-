<x-HeaderMenuFormateur>
    <style>

        table{
            width: 100%;
        }
 .wrapper {
 margin: 15px auto;
 max-width: 100%; /* Set to 100% to fit within the page */
 overflow-x: auto; /* Add horizontal scroll if content exceeds width */
 }
 .container-calendar {
        background: #ffffff;
        padding: 15px;
        max-width: 100%; /* Set to 100% to fit within the page */
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
    flex-grow: 1; /* To allow the container to grow and fill the space */
}
.date-info {
    display: flex;
    align-items: center;
}

.date-info span {
    margin-right: 10px; /* Adjust the margin as needed */
}
.bg-light-gray {
    background-color: #f7f7f7;
}
.table-bordered thead td, .table-bordered thead th {
    border-bottom-width: 2px;
}
.table thead th {
    vertical-align: bottom;
    border-bottom: 2px solid #dee2e6;
}
.table-bordered td, .table-bordered th {
    border: 1px solid #dee2e6;
}
    </style>
    <div class="wrapper">
        <div class="container-calendar">
            <h3 id="monthAndYear"></h3>
            <div class="button-container-calendar">
                <button id="previous" onclick="previous()">&#8249;</button>
                <div class="date-info">
                    <h2> Start: <b><span id="dateStart"></span></b></h2>
                    <h2> End: <b><span id="dateEnd"></span><b></h3>
                </div>
                <button id="next" onclick="next()">&#8250;</button>
            </div>            
            <table class="table-calendar" id="calendar" data-lang="en">
                <thead id="thead-month"></thead>
                <tbody id="calendar-body"></tbody>
            </table>
            
        </div>
        <div class="container">
            <div class="timetable-img text-center">
                <img src="img/content/timetable.png" alt="">
            </div>
                <table id="tbl_exporttable_to_xls"  class="table table-bordered text-center col-md-12"  style="width:100%">
                    <thead>
                        <tr class="bg-light-gray">
                            @foreach ($days_of_week as $day_of_week)
                                <th class="text-uppercase" colspan="4">{{$day_of_week}}</th>
                            @endforeach
                        </tr>
                        <tr class="bg-light-gray">
                            @foreach ($days_of_week as $day_of_week)
                                @foreach ($days_part as $day_part)
                                <th class="text-uppercase" colspan="2">{{$day_part}}</th>
                                @endforeach
                            @endforeach
                        </tr>
                        <tr class="bg-light-gray">
                            @foreach ($days_of_week as $day_of_week)
                                @foreach ($seances_part as $seance_part)
                                <th>{{$seance_part}}</th>
                                @endforeach
                                
                            @endforeach
                        </tr>
                    </thead>
                    
                    
                    
                    <tbody>
                       
                        <tr>
                            @foreach ($days_of_week as $day_of_week)
                                    @foreach ($seances_part as $seance_part)
                                    <th>Agile</th>
                                    @endforeach
                            @endforeach
                        </tr>
                       
                    </tbody>
                </table>
        </div>
    </div>
    <script>
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