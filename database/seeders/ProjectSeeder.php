<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create projects with existing users as leaders
        $users = User::all();

        if ($users->count() > 0) {
            Project::factory(10)->create([
                'leader_id' => fn() => $users->random()->id
            ])->each(function ($project) use ($users) {
                // Attach random members to each project
                $members = $users->random(rand(2, 5));
                $project->members()->attach($members->pluck('id'));
            });
        } else {
            // Create projects with new users if no users exist
            Project::factory(10)->create()->each(function ($project) {
                // Create additional users and attach them as members
                $members = User::factory(rand(2, 5))->create();
                $project->members()->attach($members->pluck('id'));
            });
        }
    }
}
