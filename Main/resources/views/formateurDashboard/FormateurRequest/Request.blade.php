<x-HeaderMenuFormateur>
    <style>

       
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
thead tr.day{
    font-size: 18px;
    padding:30px;
    color: black;
    height: 50px;
    background-color: white
}
thead tr.dPart{
    font-size: 18px;
    padding:30px;
    color: black;
    height: 40px;
    background-color: gainsboro
}
thead tr.se-row {
    height: 30px !important;
    width: 30px;
    margin: 0px;
    padding: 0px;
    font-size: 16px;
    color: black;
    background-color: white
}

tbody tr.dtdynamic {
    height: 100px !important;
    width: 30px;
    margin: 0px;
    padding: 0px;
    font-size: 16px;
    color: black;
    background-color: gainsboro
}
    </style>
    <div class="wrapper">
        <div class="container-calendar">
            <h3 id="monthAndYear">hello</h3>
            <div class="button-container-calendar">
                <button id="previous" onclick="previous()">&#8249;</button>
                <div class="date-info">
                    <h2> Start:<span id="dateStart"></span></h2>
                    <h2> End: <span id="dateEnd"></span></h2>
                </div>
                <button id="next" onclick="next()">&#8250;</button>
                
            </div>            
            <table id="tbl_exporttable_to_xls"  class="table-bordered text-center col-md-12"  style="width:100%">
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
                                <th>Agile</th>
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