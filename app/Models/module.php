<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class module extends Model
{
    // protected $table ='module';
    public $fillable = [
        'id',
        'establishment_id',
        'module_name'
    ];
    public $timestamps = false ;
    public $incrementing = false;
    protected $keyType = 'string';
    protected $primaryKey = 'id';
    use HasFactory;
}
