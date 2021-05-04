<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = ['name', 'email', 'gender', 'image'];

    public function skills()
    {
        $this->belongsToMany(
            Skill::class,
            'client_skill',
            'client_id',
            'skill_id'
        );
    }
}
