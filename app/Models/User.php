<?php

namespace App\Models;

use App\Models\Traits\HasUuid;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasRoles, HasApiTokens, HasFactory, Notifiable, HasUuid;

    const ADMIN = 'Administrador';
    const PATIENT = 'Paciente';
    const NUTRITIONIST = 'Nutriólogo';

    const ACCEPTED = 'Aceptado';
    const CHECKING = 'Validando datos';
    const REJECTED = 'Rechazado';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    public function nutritionistProfile()
    {
        return $this->hasOne(Nutritionist::class);
    }

    public function patientProfile()
    {
        return $this->hasOne(Patient::class);
    }
}
