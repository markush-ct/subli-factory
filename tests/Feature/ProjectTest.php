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

test('can update project', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $project = Project::factory()->for($user)->create();

    $response = $this->patch(route('projects.update', $project->id), [
        'title' => 'Updated Project',
        'customer' => 'Updated Customer',
        'description' => 'Updated Description',
        'due_date' => now()->addDays(14)->format('Y-m-d'),
        'user_id' => $user->id,
    ]);

    $response->assertRedirect();
    $response->assertSessionHas('success', 'Project updated successfully.');
    $this->assertDatabaseHas('projects', [
        'id' => $project->id,
        'title' => 'Updated Project',
        'customer' => 'Updated Customer',
        'description' => 'Updated Description',
        'due_date' => now()->addDays(14)->format('Y-m-d'),
        'user_id' => $user->id,
    ]);
});

test('can list projects', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $projects = Project::factory()->for($user)->count(3)->create();

    $response = $this->get(route('projects.index'));

    $response->assertStatus(200);
    foreach ($projects as $project) {
        $response->assertSee($project->title);
    }
});
