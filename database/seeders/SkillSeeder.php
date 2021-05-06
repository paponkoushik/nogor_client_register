<?php

namespace Database\Seeders;

use App\Models\Skill;
use Illuminate\Database\Seeder;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Skill::query()->insert($this->demoData());
    }

    public function demoData(): array
    {
        return [
            ['name'=> 'Laravel'],
            ['name'=> 'CodeIgniter'],
            ['name'=> 'Vue js'],
            ['name'=> 'Ajax'],
            ['name'=> 'MySql'],
            ['name'=> 'API'],
        ];
    }
}
