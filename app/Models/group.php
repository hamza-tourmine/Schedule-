<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class group extends Model
{
    public $table = 'groups' ;
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false ;

    public $fillable =['id','group_name','establishment_id','year','barnch_id'];
    use HasFactory;

}
