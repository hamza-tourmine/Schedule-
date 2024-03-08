<x-HeaderMenuAdmin>
    <style>
    button , input[type=file]::file-selector-button {
    margin-right: 40px;
    margin-top: 2.5px;
    border: none;
    background: #084cdf;
    padding: 10px 20px;
    border-radius: 10px;
    color: #fff;
    cursor: pointer;
    transition:  .2s ease-in-out;
  }

  input[type=file]::file-selector-button:hover {
    background: #0d45a5;
  }

  .imageSelected{
    width:100px ;
   margin:10px;
   border-radius: 5px;
   transition: all 30ms ease-in;


  }

  .imageSelected:hover{
    filter: blur(1px);
  }
  .ContainerImage{
    position: relative;
    width: fit-content;
    height: fit-content;
  }

.ContainerImage:hover::after{
  content: "X";
  color: white;
  text-align: center;
  width: 20px;
  height: 20px;
  position: absolute;
  top: 0;
  right: 0;
  border-radius: 50%;
  background-color: rgba(17, 17, 17, 0.9); /* Semi-transparent black background */
  z-index: 1;
  cursor: pointer;
}


.drop-container {
    position: relative;
    display: flex;
    gap: 10px;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    height: 18rem;
    padding: 10px;
    border-radius: 10px;
    border: 2px dashed #b32222;
    color: #8a1f1f;
    cursor: pointer;
    width: 100%;
    transition:  .2s ease-in-out, border .2s ease-in-out;
  }

  .drop-container:hover {
    background: #eee;
    border-color: #111;
  }

  .drop-container:hover .drop-title {
    color: #222;
  }

  .drop-title {
    color: #444;
    font-size: 20px;
    font-weight: bold;
    text-align: center;
    transition: color .2s ease-in-out;
  }

    </style>

@if($errors->any())
<div id="liveAlertPlaceholder" class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
@if(session('success'))
<div id="liveAlertPlaceholder" class="alert alert-success">
{{ session('success') }}
</div>
@endif
        <form action="{{ route('UploedFileExcel') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div for="images" class="drop-container" id="dropcontainer">
                <span class="drop-title">Drop files here</span>
                or
                <input type="file" id="images" name="file" />
            </div>
            <button type="submit">Upload ..</button>
        </form>

</x-HeaderMenuAdmin>
