<x-HeaderMenuAdmin>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Schedule Table</title>
        <style>
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
                height: 10px !important;
                background-color: green;
                margin: 0px;
                padding: 0px;
                font-size: 16px
            }

        </style>
         @livewireStyles
    </head>
    <body>
        <livewire:emploi/>
        @livewireScripts
    </body>
    </html>
</x-Headers>

