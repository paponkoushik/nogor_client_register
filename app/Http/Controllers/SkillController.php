<?php


namespace App\Http\Controllers;


use App\Models\Skill;
use Database\Seeders\SkillSeeder;

class SkillController
{
    public function index()
    {
        return Skill::query()->get();
    }
}
