<x-Headers>
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

            th, td {
                padding: 10px;
                border: 1px solid #ddd;
                text-align: center;
            }

            th {
                background-color: #f2f2f2;
            }

            td {
                height: 50px;
            }
        </style>
    </head>
    <body>

        <h2>Schedule Table</h2>

        <table>
            <thead>
                <tr>
                    <th></th>
                    <th id>Monday</th>
                    <th>Tuesday</th>
                    <th>Wednesday</th>
                    <th>Thursday</th>
                    <th>Friday</th>
                    <th>Saturday</th>
                    <!-- Add more columns for additional days -->
                </tr>
            </thead>
            <tbody>
                @if($groups)
                @foreach($groups as $group)
                <tr>
                    <td>{{$group->group_name}}</td>
                    <td    data-bs-toggle="modal" data-bs-target="#exampleModal id="mon{{$group->id}}"> mon{{$group->id}}</td>
                    <td  data-bs-toggle="modal" data-bs-target="#exampleModal id="Tue{{$group->id}}"> Tue{{$group->id}}</td>
                    <td  data-bs-toggle="modal" data-bs-target="#exampleModal id="Wed{{$group->id}}"> Wed{{$group->id}}</td>
                    <td  data-bs-toggle="modal" data-bs-target="#exampleModal id="Thu{{$group->id}}"> Thu{{$group->id}}</td>
                    <td  data-bs-toggle="modal" data-bs-target="#exampleModal id="Fri{{$group->id}}"> Fri{{$group->id}}</td>
                    <td  data-bs-toggle="modal" data-bs-target="#exampleModal id="Sat{{$group->id}}" > Sat{{$group->id}}</td>
                    <!-- Add more columns for additional days -->
                </tr>



                @endforeach
                @endif

               

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          ...
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                      </div>
                    </div>
                  </div>


            </tbody>
        </table>

    </body>
    </html>

</x-Headers>
