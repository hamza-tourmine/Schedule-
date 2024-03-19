<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\branch;
use App\Models\module;
use App\Models\formateur;
use App\Models\group;
use App\Models\formateur_has_branche;
use App\Models\formateur_has_group;
use App\models\module_has_formateur;
use App\Models\establishment;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class AddFormateur extends Component
{

    use LivewireAlert;
    public $formateurs = [];
    public $branches = [];
    public $groupes = [];
    public $modules = [];

    // form var
    public $formateur_name;
    public $idFormateur;
    public $selectedBranches = [];
    public $selectedGroupes = [];
    public $selectedModules = [];

    // show alert
    public $addFormateur = false;
    public $adBranche =    false;
    public $addGroupe =    false;
    public $addModule  =   false;


    public function create()
    {

    try{

        $establishment_id = session()->get('establishment_id');
        // Generate password
        function generatePassword($length = 8) {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomPassword = '';
            for ($i = 0; $i < $length; $i++) {
                $randomPassword .= $characters[random_int(0, $charactersLength - 1)];
            }
            return $randomPassword;
        }
        $password = generatePassword();
        // Create formateur
        $formateur = formateur::create([
            'id'=>$this->idFormateur,
            'passwordClone' => $password,
            'password' => bcrypt($password),
            'role' => 'formateur',
            'status' => 'active',
            'user_name' => $this->formateur_name,
            'establishment_id' => $establishment_id
        ]);

        if ($formateur) {
            // Associate selected branches if they are provided
            if (!empty($this->selectedBranches)) {
                foreach ($this->selectedBranches as $branche) {
                    // Check if the association already exists
                    $existingAssociation = formateur_has_branche::where('formateur_id', $this->idFormateur)
                        ->where('barnch_id', $branche)
                        ->first();

                    // If the association doesn't exist, create it
                    if (!$existingAssociation) {
                        formateur_has_branche::create([
                            'formateur_id' => $this->idFormateur,
                            'barnch_id' => $branche
                        ]);
                        $this->adBranche = true ;
                    }
                    else{
                        // if already  association exist  should tell  user  about it
                        $this->alert('error', 'Certains filiéres sont déjà associés à ce formateur.', [
                            'position' => 'center',
                            'timer' => 3000,
                            'toast' => true,
                        ]);
                    }
                }

            }

            // Associate selected groupes if they are provided
            if (!empty($this->selectedGroupes)) {
                foreach ($this->selectedGroupes as $groupe) {
                    // Check if the association already exists
                    $existingGroupes = formateur_has_group::where('formateur_id', $this->idFormateur)
                        ->where('group_id', $groupe)
                        ->first();

                    // If the association doesn't exist, create it
                    if (!$existingGroupes) {
                        formateur_has_group::create([
                            'formateur_id' => $this->idFormateur,
                            'group_id' => $groupe
                        ]);
                        $this->addGroupe = true ;
                    }
                    else{
                        // if already  association exist  should tell  user  about it
                        $this->alert('error', 'Certains groupes sont déjà associés à ce formateur.', [
                            'position' => 'center',
                            'timer' => 3000,
                            'toast' => true,
                        ]);
                    }
                }
            }
            // Associate selected modules if they are provided
            if (!empty($this->selectedModules)) {
                foreach ($this->selectedModules as $module) {
                    // Check if the association already exists
                    $existingModules= module_has_formateur::where('formateur_id', $this->idFormateur)
                        ->where('module_id', $module)
                        ->first();
                    // If the association doesn't exist, create it
                    if (!$existingModules) {
                        module_has_formateur::create([
                            'formateur_id' => $this->idFormateur,
                            'module_id' => $module
                        ]);
                        $this->addModule = true ;
                    }
                    else{
                        // if already  association exist  should tell  user  about it
                        $this->alert('error', 'Certains modules sont déjà associés à ce formateur.', [
                            'position' => 'center',
                            'timer' => 3000,
                            'toast' => true,
                        ]);
                    }
                }
            }

            if( $this->addModule ||  $this->addGroupe ||  $this->adBranche){
                $this->alert('success', "Vous avez ajouté un nouveau formateur", [
                    'position' => 'center',
                    'timer' => 3000,
                    'toast' => true,
                ]);
            }
        }

    }catch ( \Illuminate\Database\QueryException $e) {
        $this->alert('error', "Ce formateur existe déjà.", [
            'position' => 'center',
            'timer' => 3000,
            'toast' => true,
        ]);
        }
    }



    // public function showHomepage(){
    //     $id_formateur = session()->get('user_id');
    //  // Assuming the model name is 'Formateur' and you're looking for a single record.
    //       $formateur = formateur::select('user_name')->where('id', $id_formateur)->first();

    //     return view('formateurDashboard.Home.formateur',['formateur'=>$formateur]);
    //     // return $formateur->user_name ;
    // }

    // public function show_update_page($id)
    // {
    //     $formateur = formateur::find($id);
    //    return view('adminDashboard.addFormateur.update_formateur',['formateur'=>$formateur]);

    // }

    // public function update(Request $request , $id)
    // {
    //     $formateur  = formateur::find($id);
    //     $formateur->user_name =$request->name;
    //     $formateur->email  =$request->email;
    //     $formateur->passwordClone =$request->password;
    //     $formateur->password =bcrypt($request->password);
    //     $formateur->status =$request->status;
    //     $formateur->save();
    //     if($formateur){
    //         return redirect()->route('addFormateur')->with(['success'=>'you modified  a  formateur']) ;
    //     }else{
    //         return redirect()->back()->withErrors(['errors'=>'some thing wrang']);
    //     }

    // }

    // public function destroy($id)
    // {
    //     $formateur = formateur::destroy($id);
    //     if($formateur){
    //         return redirect()->route('addFormateur')->with(['success'=>'you delete a formateur']) ;
    //     }

    // }


    public function render()
    {
        $establishment_id = session()->get('establishment_id');
        $this->branches = branch::where('establishment_id', $establishment_id)->get();
        $this->groupes = group::where('establishment_id', $establishment_id)->get();
        $this->formateurs = formateur::select(['id', 'email', 'password', 'status', 'user_name', 'establishment_id', 'passwordClone'])
            ->where('role', 'formateur')
            ->where('establishment_id', $establishment_id)
            ->get();

        $this->modules = module::where('establishment_id', $establishment_id)->get();
        return view('livewire.add-formateur');
    }
}
