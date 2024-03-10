<div>
    <h1>Model Paramtere !</h1>
<form action="">
    <div style="margin: 10px" class="form-check form-switch">
        <input type="checkbox" wire:model="isChecked" style="width: 50px ; height:25px ; border:3px solid  #ddd9d9" class="form-check-input"  id="flexSwitchCheckChecked1"  >
        <label style="font-size:19px;font-weigth:400;"  class="form-check-label ms-1" for="flexSwitchCheckChecked1">
            Affichage Module input</label>
            checked: {{var_export($isChecked)}}
    </div>



    <div style="margin: 10px" class="form-check form-switch">
        <input wire:model="isCheckSalle" style="width: 50px ; height:25px ; border:3px solid  #ddd9d9" class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
        <label style="font-size:19px;font-weigth:400;"  class="form-check-label ms-1" for="flexSwitchCheckChecked">
            Affichage  Salle input</label>
    </div>



    <div style="margin: 10px" class="form-check form-switch">
        <input wire:model="isCheckFormteur" style="width: 50px ; height:25px ; border:3px solid  #ddd9d9" class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
        <label style="font-size:19px;font-weigth:400;"  class="form-check-label ms-1" for="flexSwitchCheckChecked">
            Affichage Formateur input</label>
    </div>






    <div style="margin: 10px" class="form-check form-switch">
        <input wire:model="isCheckTypeSalle" style="width: 50px ; height:25px ; border:3px solid  #ddd9d9" class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" >
        <label  style="font-size:19px;font-weigth:400;" class="form-check-label ms-1" for="flexSwitchCheckChecked">
            Affichage Type Salle input</label>
    </div>


    <div style="margin: 10px" class="form-check form-switch">
        <input wire:model="isCheckTyleSeance" style="width: 50px ; height:25px ; border:3px solid  #ddd9d9" class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" >
        <label  style="font-size:19px;font-weigth:400;" class="form-check-label ms-1" for="flexSwitchCheckChecked">
            Affichage Type Séance input</label>
    </div>






</form>
</div>
