<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sission extends Model
{
    use HasFactory;
    public $fillable = [
            'day',
            'day_part',
            'dure_sission',
            'module_id', 
            'group_id',
        	'establishment_id',
            'user_id',
            'class_room_id',
            'validate_date'	,
            'main_emploi_id',
            "demand_emploi_id",
            'message',
            'sission_type',
        	'status_sission',

    ];
}
