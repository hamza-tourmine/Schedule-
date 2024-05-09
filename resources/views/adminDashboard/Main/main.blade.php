<x-HeaderMenuAdmin>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <title>Schedule Table</title>

        <style>
            body {
                font-family: Arial, sans-serif;
            }

            table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 20px;
                table-layout: fixed;
                word-wrap: break-word;
            }

            th,
            td {

                height: 40px;
                width: 520px !important;
                border: 1px solid #ddd;
                text-align: center;
            }
            td{
            height: 70px;
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

        </style>
        @livewireStyles
    </head>

    <body data-layout="detached" data-topbar="colored">
        <livewire:emploi />
        @livewireScripts
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <x-livewire-alert::scripts />
    </body>

    </html>
    </x-Headers>
