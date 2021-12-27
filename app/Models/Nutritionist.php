<?php

namespace App\Models;

use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nutritionist extends Model
{
    use HasFactory, HasUuid;

    protected $guarded = [];

    protected $casts = ['specializations' => 'array'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function patients()
    {
        return $this->hasManyThrough(
            User::class,
            Patient::class,
            'nutritionist_id',
            'id',
            'user_id',
            'user_id'
        );
    }
}
