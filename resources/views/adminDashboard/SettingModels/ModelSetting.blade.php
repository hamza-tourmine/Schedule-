<x-HeaderMenuAdmin>

        <div>
            <h1>Model Paramtere !</h1>
            <div class="Alter"></div>
        <form action="">
            @csrf
            <div style="margin: 10px" class="form-check form-switch">
                <input class="checkbox" name="Module" type="checkbox"  style="width: 50px ; height:25px ; border:3px solid  #ddd9d9" class="form-check-input"  id="flexSwitchCheckChecked1"  >
                <label style="font-size:19px;font-weigth:400;"  class="form-check-label ms-1" for="flexSwitchCheckChecked1">
                    supprimer Module input</label>

            </div>

            <div style="margin: 10px" class="form-check form-switch">
                <input class="checkbox"  name="Salle"  style="width: 50px ; height:25px ; border:3px solid  #ddd9d9" class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" >
                <label style="font-size:19px;font-weigth:400;"  class="form-check-label ms-1" for="flexSwitchCheckChecked">
                    supprimer  Salle input</label>
            </div>

            <div style="margin: 10px" class="form-check form-switch">
                <input class="checkbox"  name='Formateur' style="width: 50px ; height:25px ; border:3px solid  #ddd9d9" class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" >
                <label style="font-size:19px;font-weigth:400;"  class="form-check-label ms-1" for="flexSwitchCheckChecked">
                    supprimer Formateur input</label>
            </div>


            <div style="margin: 10px" class="form-check form-switch">
                <input class="checkbox" name='TypeSalle'  style="width: 50px ; height:25px ; border:3px solid  #ddd9d9" class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" >
                <label  style="font-size:19px;font-weigth:400;" class="form-check-label ms-1" for="flexSwitchCheckChecked">
                    supprimer Type Salle input</label>
            </div>


            <div style="margin: 10px" class="form-check form-switch">
                <input class="checkbox" name="TypeSeance" style="width: 50px ; height:25px ; border:3px solid  #ddd9d9" class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" >
                <label  style="font-size:19px;font-weigth:400;" class="form-check-label ms-1" for="flexSwitchCheckChecked">
                    supprimer Type Séance input</label>
            </div>


            <div style="margin: 10px" class="form-check form-switch">
                <input class="checkbox" name="branch" style="width: 50px ; height:25px ; border:3px solid  #ddd9d9" class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" >
                <label  style="font-size:19px;font-weigth:400;" class="form-check-label ms-1" for="flexSwitchCheckChecked">
                    supprimer les filiéres filter</label>
            </div>
        </form>
        </div>
        <script>
         document.addEventListener('DOMContentLoaded', function () {
    fetch('/Model-values')
        .then(resp => resp.json())
        .then(data => {
            console.log('----------------')
            console.log(data[0])
            let checkboxes = document.getElementsByClassName('checkbox');
            checkboxes.forEach(item => {
                if (item.name === 'Formateur') {
                    if (data[0].formateur === 0) {
                        item.removeAttribute('checked');
                    } else {
                        item.setAttribute('checked', 'checked');
                    }
                } else if (item.name === 'Salle') {
                    if (data[0].salle === 0) {
                        item.removeAttribute('checked');
                    } else {
                        item.setAttribute('checked', 'checked');
                    }
                } else if (item.name === 'Module') {
                    if (data[0].module === 0) {
                        item.removeAttribute('checked');
                    } else {
                        item.setAttribute('checked', 'checked');
                    }
                } else if (item.name === 'TypeSalle') {
                    if (data[0].typeSalle === 0) {
                        item.removeAttribute('checked');
                    } else {
                        item.setAttribute('checked', 'checked');
                    }
                } else if (item.name === 'TypeSeance') {
                    if (data[0].typeSession === 0) {
                        item.removeAttribute('checked');
                    } else {
                        item.setAttribute('checked', 'checked');
                    }
                } else if (item.name === 'branch') {
                    if (data[0].branch === 0) {
                        item.removeAttribute('checked');
                    } else {
                        item.setAttribute('checked', 'checked');
                    }
            });
            // localStorage.setItem('ModelSetting', JSON.stringify(data[0]));
        })
        .catch(error => {
            console.error('Error:', error);
        });

                let checkboxes = document.querySelectorAll('.checkbox');
                checkboxes.forEach(checkbox => {
                    checkbox.addEventListener('change', function () {
                        let checkboxData = {};
                            checkboxes.forEach(cb => {
                            checkboxData[cb.name] = cb.checked;
                        });

                        fetch('/Model-setting', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                            },
                            body: JSON.stringify(checkboxData)
                        })
                        .then(response => response.json())
                        .then(data => {
                            console.log(data);
                            // Handle response from the server if needed

                        })
                        .catch(error => {
                            console.error('Error:', error);
                        });
                    });
                });


            });



        </script>
</x-HeaderMenuAdmin>
