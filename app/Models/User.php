<?php

namespace App\Models;

use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Builder;
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

    const MALE = 'Masculino';
    const FEMALE = 'Femenino';

    const ACTIVE = 1;
    const INACTIVE = 0;

    protected $guard_name = 'sanctum';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
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

    public function scopeType(Builder $query, $value)
    {
        $query->where('type', $value)
            ->where('verified', User::ACCEPTED);
    }
}
