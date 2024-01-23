<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class group extends Model
{
    public $timestamps = false ;
    public $fillable =['group_name','establishment_id'];
    use HasFactory;
}
