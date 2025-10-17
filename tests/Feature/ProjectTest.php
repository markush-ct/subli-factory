<?php

use App\Models\Project;
use App\Models\User;

test('can create project', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $project = Project::factory()->for($user)->create([
        'title' => 'Test Project',
        'customer' => 'Test Customer',
        'description' => 'Test Description',
        'due_date' => now()->addDays(7)->format('Y-m-d'),
    ]);

    $response = $this->post(route('projects.store'), $project->toArray());

    $response->assertRedirect();
    $response->assertSessionHas('success', 'Project created successfully.');
    $this->assertDatabaseHas('projects', [
        'id' => $project->id,
        'title' => 'Test Project',
        'customer' => 'Test Customer',
        'description' => 'Test Description',
        'due_date' => $project->due_date,
        'user_id' => $user->id,
    ]);
});
