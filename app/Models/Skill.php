<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $fillable = ['name'];

    public function Clients()
    {
        $this->belongsToMany(
            Client::class,
            'client_skill',
            'skill_id',
            'client_id',
        );
    }

}
