<?php


namespace App\Http\Controllers;


use App\Models\Skill;
use Database\Seeders\SkillSeeder;

class SkillController
{
    public function index()
    {
        return cache()->rememberForever('skills', fn() => Skill::query()->get());
    }
}
