<div>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">nave</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{route('dashboard_formateur')}}">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{route('mygroups')}}">group and models</a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="{{route('selectgroups')}}">groups</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{route('selectmodels')}}">Modules</a>
              </li>
              <li class="nav-item">
                <a class="nav-link " aria-disabled="true">Seting</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
</div>
