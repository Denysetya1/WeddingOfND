<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements FilamentUser
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'slug',
        'pernikahan',
        'phone'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function canAccessPanel(Panel $panel): bool
    {
        if ($panel->getId() === 'admin') {
            return $this->hasRole('admin');
        }

        return true;
    }

    public function undangans(): HasMany
    {
        return $this->hasMany(Undangan::class);
    }
    public function akad(): HasOne
    {
        return $this->hasOne(Akad::class);
    }
    public function fotocover(): HasOne
    {
        return $this->hasOne(Fotocover::class);
    }
    public function fotoawal(): HasOne
    {
        return $this->hasOne(Fotoawal::class);
    }
    public function fotologo(): HasOne
    {
        return $this->hasOne(Fotologo::class);
    }
    public function fotonamacover(): HasOne
    {
        return $this->hasOne(Fotonamacover::class);
    }
    public function infocpp(): HasOne
    {
        return $this->hasOne(Infocpp::class);
    }
    public function fotopengantinpria(): HasMany
    {
        return $this->hasMany(Fotopengantinpria::class);
    }
    public function fotopengantin(): HasMany
    {
        return $this->hasMany(Fotopengantin::class);
    }
    public function infocpw(): HasOne
    {
        return $this->hasOne(Infocpw::class);
    }
    public function fotopengantinwanita(): HasMany
    {
        return $this->hasMany(Fotopengantinwanita::class);
    }
    public function resepsi(): HasOne
    {
        return $this->hasOne(Resepsi::class);
    }
    public function gallery(): HasMany
    {
        return $this->hasMany(Gallery::class);
    }
    public function fotorsvp(): HasOne
    {
        return $this->hasOne(Fotorsvp::class);
    }
    public function weddinggift(): HasMany
    {
        return $this->hasMany(Weddinggift::class);
    }
    public function isAdmin(): bool
    {
        return $this->hasRole('admin');
    }
}
