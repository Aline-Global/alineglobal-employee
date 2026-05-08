<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    protected $fillable = [
        'name',
        'legal_name',
        'logo_url',
        'website',
        'main_email',
        'phone',
        'tagline',
        'about',
        'bangladesh_office_address',
        'uk_office_address',
        'facebook_url',
        'linkedin_url',
        'instagram_url',
        'youtube_url',
        'map_url',
        'is_active',
    ];

    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class);
    }
}
