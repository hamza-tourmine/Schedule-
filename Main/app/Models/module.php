<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class module extends Model
{
    // protected $table ='module';
    public $fillable = [
        'establishment_id',
        'module_name'
    ];
    public $timestamps = false ;
    use HasFactory;
}
