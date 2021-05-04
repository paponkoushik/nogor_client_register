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
            ['name'=> 'PHP'],
            ['name'=> 'Vue js'],
            ['name'=> 'Laravel'],
            ['name'=> 'Django'],
            ['name'=> 'Python'],
        ];
    }
}
