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
        'user_id',
        'category_id',
    ];

    /**
     * Get the user that owns the skill offer.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the category that owns the skill offer.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
