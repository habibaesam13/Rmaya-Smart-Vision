<?php

namespace Database\Seeders;

use App\Models\Member_group;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use PHPUnit\Framework\Attributes\Group;

class MemberGroups extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $groups = [
            ['name' => 'القيادة'],
            ['name' => 'المجموعة الاولي'],
            ['name' => 'المجموعة الثالثة'],
            ['name' => 'المجموعة الرابعة'],
            ['name' => 'المجموعة الخامسة'],
            ['name' => 'المجموعة السادسة'],
            ['name' => 'المجموعة السابعة'],
        ];

        foreach ($groups as $group) {
            Member_group::create($group);
        }
    }
}
