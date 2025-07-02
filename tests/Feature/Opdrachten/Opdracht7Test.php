<?php

use App\Models\Project;

beforeEach(function (){
    $this->project = Project::factory()->create();
    $this->seed('ProjectSeeder');
});

test('show page is visable with project on the page', function()
{
    $this->withoutExceptionHandling();
    $escapedNameValue = htmlspecialchars($this->project->name, ENT_QUOTES);
    $escapedDescriptionValue = htmlspecialchars($this->project->description, ENT_QUOTES);
    $this->get(route('projects.show',['project' => $this->project->id]))
        ->assertViewIs('admin.projects.show')
        ->assertSee($this->project->id)
        ->assertSee($escapedNameValue)
        ->assertSee($escapedDescriptionValue)
        ->assertSee($this->project->created_at)
        ->assertStatus(200);
})->group('Opdracht7');
