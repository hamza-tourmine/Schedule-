<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sidebars/">
    <link rel="stylesheet" href="{{asset('css/sidebars.css')}}">
    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-***(hash value)***" crossorigin="anonymous">
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }
      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
</head>
<body>

    <x-navbar/>
    <div class="mx-5 col-6">
        <h4>Select your Model :</h4>
        <form pethod='POST' action="{{route('insertMyModules')}}">

            @if ($models)


            @foreach ($models as $model)
                    <input id="option1" name="Moduls[]" class="form-check-input" type="checkbox" value="{{$model->id}}"/>
                    <label  class="form-check-label" for="option1" for="">{{$model->module_name}}</label>
                    <br/>
            @endforeach


            @endif

            <button class=" btn btn-primary col-1">save</button>
        </form>
    </div>



</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
      <script src="{{asset('js/sidebars.js')}}"></script>
</html>
