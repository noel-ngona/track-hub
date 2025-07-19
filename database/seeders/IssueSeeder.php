<?php

namespace Database\Seeders;

use App\Models\Issue;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Seeder;

class IssueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $projects = Project::all();

        if ($users->count() > 0 && $projects->count() > 0) {
            // Create issues for existing projects
            $projects->each(function ($project) use ($users) {
                // Create 3-8 issues per project
                Issue::factory(rand(3, 8))->create([
                    'reporter_id' => fn() => $users->random()->id,
                    'assignee_id' => fn() => $users->random()->id,
                    'project_id' => $project->id,
                ]);
            });
        } else {
            // Create standalone issues if no projects exist
            Issue::factory(20)->create();
        }
    }
}
