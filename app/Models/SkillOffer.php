<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkillOffer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'skill_name',
        'skill_level',
        'session_type',
        'contact_method',
        'availability_notes',
    ];
}
