<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Employee extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'company_id',
        'employee_code',
        'full_name',
        'slug',
        'designation',
        'department',
        'phone',
        'whatsapp',
        'email',
        'photo_url',
        'bio',
        'linkedin_url',
        'facebook_url',
        'instagram_url',
        'public_profile_enabled',
        'show_phone',
        'show_whatsapp',
        'show_email',
        'show_photo',
        'show_company_address',
        'scan_count',
        'last_scanned_at',
        'status',
    ];

    protected $casts = [
        'public_profile_enabled' => 'boolean',
        'show_phone' => 'boolean',
        'show_whatsapp' => 'boolean',
        'show_email' => 'boolean',
        'show_photo' => 'boolean',
        'show_company_address' => 'boolean',
        'last_scanned_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($employee) {
            if (!$employee->slug) {
                $employee->slug = self::generateUniqueSlug($employee->full_name);
            }
        });
    }

    public static function generateUniqueSlug(string $name): string
    {
        $slug = Str::slug($name);
        $originalSlug = $slug;
        $counter = 1;

        while (static::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . ++$counter;
        }

        return $slug;
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function profileViews(): HasMany
    {
        return $this->hasMany(ProfileView::class);
    }

    public function getPhotoPublicUrlAttribute(): ?string
    {
        $photo = $this->photo_url;

        if (blank($photo)) {
            return null;
        }

        if (Str::startsWith($photo, ['http://', 'https://'])) {
            return $photo;
        }

        return Storage::disk('public')->url($photo);
    }

    public function getPhotoFallbackUrlAttribute(): string
    {
        return 'https://ui-avatars.com/api/?name=' . urlencode((string) $this->full_name) . '&background=f3e8ef&color=8e1d56&size=160';
    }
}
