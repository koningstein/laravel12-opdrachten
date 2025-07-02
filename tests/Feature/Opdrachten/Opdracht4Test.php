<?php

use App\Models\Project;

test('An project admin index page is visable ', function()
{
    $this->withoutExceptionHandling();

    // Testen
    $this->get(route('projects.index'))
        ->assertViewIs('admin.projects.index')
        ->assertStatus(200);
})->group('Opdracht4');

test('The project admin index page shows all projects', function() {
    $this->withoutExceptionHandling();
    // Data aanmaken
    $projects = Project::factory()->count(15)->create();

    // Testen
    $response = $this->get(route('projects.index'))->assertViewIs('admin.projects.index');
    foreach ($projects as $project) {
        $escapedNameValue = htmlspecialchars($project->name, ENT_QUOTES);
        $escapedDescriptionValue = htmlspecialchars($project->description, ENT_QUOTES);
        $response->assertSee((string)$project->id);
        $response->assertSee($escapedNameValue); // Voeg false toe als je exacte matches wilt vermijden
        $response->assertSee(Str::limit($escapedDescriptionValue, 50));
    }
    $response->assertStatus(200);
})->group('Opdracht4');

test('The project admin index page shows all projects from Seeder', function() {
    // Data aanmaken
    $this->withoutExceptionHandling();
    $this->seed('ProjectSeeder');
    $projects = Project::all();

    // Testen
    $response = $this->get(route('projects.index'))->assertViewIs('admin.projects.index');
    foreach ($projects as $project) {
        $escapedNameValue = htmlspecialchars($project->name, ENT_QUOTES);
        $escapedDescriptionValue = htmlspecialchars($project->description, ENT_QUOTES);
        $response->assertSee((string)$project->id);
        $response->assertSee($escapedNameValue); // Voeg false toe als je exacte matches wilt vermijden
        $response->assertSee(Str::limit($escapedDescriptionValue, 50));
    }
    $response->assertStatus(200);
})->group('Opdracht4');
