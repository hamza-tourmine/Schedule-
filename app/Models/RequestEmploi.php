<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestEmploi extends Model
{
    protected $fillable = [
        'date_request',
        'comment',
        'formateur_id',
        'emploi_id'
    ];
    use HasFactory;

    // Define the relationship with the User model
    public function formateur()
    {
        return $this->belongsTo(User::class, 'formateur_id');
    }
}
