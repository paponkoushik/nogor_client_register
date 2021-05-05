<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'email', 'gender', 'image'];

    public function skills(): BelongsToMany
    {
        return $this->belongsToMany(
            Skill::class,
            'client_skill',
            'client_id',
            'skill_id'
        );
    }
}
