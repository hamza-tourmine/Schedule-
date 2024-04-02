<x-HeaderMenuAdmin>
<li class="menu-title">LES COMPOSANTS</li>

<li>
    <a href="javascript: void(0);" class="has-arrow waves-effect">
        <span class="mdi mdi-home-group"></span>
        <span>Ajouter les salles</span>
    </a>
    <ul class="sub-menu" aria-expanded="false">
        <li><a href="{{route('add-class-rooms')}}">Ajouter les salles</a></li>
        <li><a  href="{{route('add-class-type')}}">Ajouter les types</a></li>
        <li><a  href="{{route('determine-type-class-room')}}">Afictaion des types</a></li>
    </ul>
</li>



<li>
    <a href="javascript: void(0);" class="has-arrow waves-effect">
        <span class="mdi mdi-home-group"></span>
        <span> Ajouter les Filières</span>
    </a>
    <ul class="sub-menu" aria-expanded="false">
        <li><a href="{{route('addbranch')}}">Ajouter les Filières</a></li>


    </ul>
</li>

<li>
    <a href="javascript: void(0);" class="has-arrow waves-effect">
        <span class="mdi mdi-book-plus"></span>
        <span>Ajouter les modules </span>
    </a>
    <ul class="sub-menu" aria-expanded="false">
        <li><a href="{{route('addModule')}}" >Ajouter des Modules</a></li>


    </ul>
</li>

<li>
    <a href="javascript: void(0);" class="has-arrow waves-effect">
        <span class="mdi mdi-grain"></span>
        <span>Ajouter les groupes</span>
    </a>
    <ul class="sub-menu" aria-expanded="false">
        <li><a href="{{route('addGroups')}}">Ajouter des groupes</a></li>

    </ul>
</li>




<li>
    <a href="javascript: void(0);" class="has-arrow waves-effect">
        <span class="mdi mdi-account-multiple"></span>
        <span>Ajouter les formateurs </span>
    </a>
    <ul class="sub-menu" aria-expanded="false">
        <li><a  href="{{route('addFormateur')}}">Ajouter formateur</a></li>

    </ul>
</li>
<li>
    <a href="javascript: void(0);" class="has-arrow waves-effect">
        <span class="mdi mdi-account-multiple"></span>
        <span> Uploed  </span>
    </a>
    <ul>
        <li><a  href="{{route('UploedFileExcelView')}}">Uploed Excel</a></li>
        <!-- Ahmed Add new item for Formateur Module -->

    </ul>

</li>
<li>
    <a href="javascript: void(0);" class="has-arrow waves-effect">
        <span class="mdi mdi-account-multiple"></span>
        <span> Model Paramtere  </span>
    </a>
    <ul>
        <li><a  href="{{route('modelSetting')}}">Model</a></li>
        <!-- Ahmed Add new item for Formateur Module -->

    </ul>

</li>
</x-HeaderMenuAdmin>
