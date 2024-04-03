<x-HeaderMenuAdmin>
  <style>
    .container {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 10px 15px;
    padding: 15px;

}

.rectungle {
    border-radius: 3.5px;
    padding: 20px;
    transition: all 0.5s; /* Define transition effect here */
    min-width: 250px;
    margin-left: 30px;
    display: block
}

.rectungle:hover {
    border: 2.5px solid #ebe8e8;
    box-shadow: rgba(0, 0, 0, 0.25) 0px 0.0625em 0.0625em, rgba(0, 0, 0, 0.25) 0px 0.125em 0.5em, rgba(255, 255, 255, 0.1) 0px 0px 0px 1px inset;
    cursor: pointer;
    transform: scale(1.05); /* Example transformation on hover */
}

.containerContent {
    display: flex;
    align-items: center; /* Align items vertically */
    justify-content: center; /* Center items horizontally */
}

.icon {
    max-width: 50px;
    margin: 3px;
}

.iconStyle {
    font-size: 40px;
    color: #1F5EE6;
}

  </style>

<h3 class="menu-title">LES COMPOSANTS</h3>
<div class="container">


    <a href="{{route('add-class-rooms')}}">
        <div class="rectungle">
            <div class="containerContent">
                <div class="icon"> <span  class="mdi mdi-home-plus iconStyle"></span></div>
                <div>
                        <span style="color: black">Ajouter les salles</span>
                        <br>
                        <span style="color: #504f4f">Tout les info sur les Salles</span>

                </div>
            </div>
        </div>
    </a>


    <a href="{{route('add-class-type')}}">
        <div class="rectungle">
            <div class="containerContent">
                <div class="icon"> <span  class="mdi mdi-alpha-t-circle iconStyle"></span></div>
                <div>
                        <span style="color: black">Ajouter les types</span>
                        <br>
                        <span style="color: #504f4f">Tout les info sur les types des salles</span>

                </div>
            </div>
        </div>
    </a>

    

<a href="{{route('determine-type-class-room')}}">
    <div class="rectungle">
        <div class="containerContent">
            <div class="icon"> <span  class="mdi mdi-alpha-t-circle iconStyle"></span></div>
            <div>
                    <span style="color: black">Afictaion des types</span>
                    <br>
                    <span style="color: #504f4f">Afictation des types à sa salle</span>

            </div>
        </div>
    </div>
</a>











<a href="{{route('addbranch')}}">
    <div class="rectungle">
        <div class="containerContent">
            <div class="icon"> <span  class="mdi mdi-source-branch iconStyle"></span></div>
            <div>
                    <span style="color: black">Ajouter les Filières</span>
                    <br>
                    <span style="color: #504f4f">Tout les info sur les Filières</span>

            </div>
        </div>
    </div>
</a>






<a href="{{route('modelSetting')}}" >
    <div class="rectungle">
        <div class="containerContent">
            <div class="icon"> <span  class="mdi mdi-google-assistant iconStyle"></span></div>
            <div>
                    <span style="color: black">Ajouter les modules</span>
                    <br>
                    <span style="color: #504f4f">Tout les info sur les popapes</span>

            </div>
        </div>
    </div>
</a>





<a href="{{route('addGroups')}}">
<div class="rectungle">
    <div class="containerContent">
        <div class="icon"> <span  class="mdi mdi-lightbulb-group iconStyle"></span></div>
        <div>
                <span style="color: black">Ajouter les groupes</span>
                <br>
                <span style="color: #504f4f">Tout les info sur groupes</span>

        </div>
    </div>
</div>
</a>




<a  href="{{route('addFormateur')}}">
<div class="rectungle">
 <div class="containerContent">
    <div class="icon"> <span class=" iconStyle mdi mdi-account-plus"></span></div>
    <div>

            <span style=" color:black ">Ajouter les formateurs </span>
            <br>
                <span style="color: #504f4f">Tout les info sur les formateurs </span>


    </div>
 </div>
</div>
</a>





<a  href="{{route('addModule')}}" >
<div class="rectungle">
    <div class="containerContent">
        <div  class="icon" ><span class="mdi mdi-file-edit-outline iconStyle"></span></div>
        <div style=" color:black ">
            <span> Modules Paramteres  </span>
            <br>
            <span style="color: #504f4f">Tout les info sur les Modules</span>
        </div>


</div>
</div>
</a>



<a  href="{{route('UploedFileExcelView')}}">
    <div class="rectungle">
    <div class="containerContent">
            <div  class="icon" ><span class="mdi mdi-cloud-upload iconStyle"></span></div>
            <div style=" color:black ">
                  <span> Upload Excel </span>
                  <br>
                  <span style="color: #504f4f">Uploader un fichier Excel mettra à jour tous les paramètres.</span>
            </div>
    </div>
    </div>
    </a>

</div>
</x-HeaderMenuAdmin>
