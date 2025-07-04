<?php

use App\Models\User;
use App\Models\Project;
use Illuminate\Support\Str;
use \Pest\Laravel;

beforeEach(function (){
//    $this->seed('RoleAndPermissionSeeder');
//    $this->seed('UserSeeder');

    $this->projects = Project::factory()->count(15)->create();
    $this->seed('ProjectSeeder');
    $this->project = Project::factory()->create();
});

test('the visitor can view the public projects page', function() {
    $response = $this->get(route('open.projects.index'));

    $response->assertStatus(200);
})->group('Opdracht11');

test('the projects page uses the correct view', function() {
    $response = $this->get(route('open.projects.index'));

    $response->assertViewIs('open.projects.index');
})->group('Opdracht11');

test('the route name open.projects.index points to /projects', function() {
    $this->assertEquals(url('/projects'), route('open.projects.index'));
})->group('Opdracht11');

test('the public projects page shows project details', function() {
    $response = $this->get(route('open.projects.index'));
    $escapedNameValue = htmlspecialchars($this->project->first()->name, ENT_QUOTES);
    $escapedDescriptionValue = htmlspecialchars($this->project->first()->description, ENT_QUOTES);
    $response->assertSee($this->projects->first()->id);
    $response->assertSee($escapedNameValue);
    $response->assertSee(Str::limit($escapedDescriptionValue, 350));
})->group('Opdracht11');

test('the public projects page shows paginated projects', function() {
    $response = $this->get(route('open.projects.index'));

    // Ensure only 10 projects are shown on the first page
    $projectsOnFirstPage = $this->projects->take(10);
    $projectsOnFirstPage->each(function ($project) use ($response) {
        $escapedNameValue = htmlspecialchars($project->name, ENT_QUOTES);
        $response->assertSee($escapedNameValue);
    });

    $projectsNotOnFirstPage = $this->projects->skip(10);
    $projectsNotOnFirstPage->each(function ($project) use ($response) {
        $escapedNameValue = htmlspecialchars($project->name, ENT_QUOTES);
        $response->assertDontSee($escapedNameValue); // This should be on the second page
    });

    $response = $this->get(route('open.projects.index', ['page' => 2]));
    $projectsOnSecondPage = $this->projects->skip(10)->take(5);
    $projectsOnSecondPage->each(function ($project) use ($response) {
        $escapedNameValue = htmlspecialchars($project->name, ENT_QUOTES);
        $response->assertSee($escapedNameValue); // This should be on the second page
    });
})->group('Opdracht11');

test('the public projects page shows pagination links', function() {
    $response = $this->get(route('open.projects.index'));
    $response->assertSeeInOrder(['<nav role="navigation"', 'aria-label="Pagination Navigation"'], false);
})->group('Opdracht11');




