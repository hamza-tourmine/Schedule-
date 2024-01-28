
    <x-HeaderMenuAdmin>



        <div style="width:70%;margin-x:auto">
            <form method='POST' action="{{url("update-formateur/{$formateur->id}")}}" >
                @if(session('success'))
                <div id="liveAlertPlaceholder" class="alert alert-success">
                    {{ session('success') }}
                </div>
          @endif
            {{-- i will add  error alert --}}
                @csrf
                <div class="mb-3 col-6">
                    <h1>formateur:</h1>
                  <label for="exampleInputEmail1" class="form-label"> Name </label>
                  <input type="text"name='name' value="{{$formateur->user_name}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="mb-3 col-6">
                    <label for="exampleInputEmail1" class="form-label">email </label>
                    <input type="text" name='email' value="{{$formateur->email}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                  </div>
                  <div class="mb-3 col-6">
                    <label for="exampleInputEmail1" class="form-label">password </label>
                    <input type="text"name='password' value="{{$formateur->passwordClone}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                  </div>


                  <div class="form-check">
                    <input class="form-check-input" checked value="active"  type="radio" name="status" id="flexRadioDefault1">
                    <label class="form-check-label" for="flexRadioDefault1">
                      active
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" value="desactive" type="radio" name="status" id="flexRadioDefault2" >
                    <label class="form-check-label" for="flexRadioDefault2">
                      desactive
                    </label>
                  </div>

                  <br/>
                <button type="submit" class="btn btn-success">update </button>
            </form>
            {{-- table --}}
        </div>
    </div>


    </x-Headers>


