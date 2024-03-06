<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class formateur extends Model
{
    public $table = 'users' ;
    public $timestamps = false ;
    public $fillable =[
        'email',
        'password',
        'role',
        'status',
        'user_name',
        'establishment_id',
        'passwordClone',
        'matricule'
    ];
    use HasFactory;
}
