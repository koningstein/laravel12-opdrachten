<?php

use App\Models\User;
use App\Models\Project;
use App\Models\Activity;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

beforeEach(function () {
    $this->seed('RoleAndPermissionSeeder');
    $this->seed('UserSeeder');
    $this->seed('ActivitySeeder');
    $this->seed('ProjectSeeder');
    $this->seed('TaskSeeder');
});

// Test of de edit pagina toegankelijk is voor gebruikers met de juiste permissies
test('task edit page is accessible for users with edit task permission', function () {
    $user = User::where('email', 'student@school.nl')->first();
    $this->actingAs($user);
    $task = Task::first();
    $response = $this->get(route('tasks.edit', $task->id));

    $response->assertStatus(200)
        ->assertViewIs('admin.tasks.edit');
})->group('Opdracht24');

// Test of de edit pagina de correcte inputvelden bevat
test('task edit page contains the correct input fields', function () {
    $user = User::where('email', 'student@school.nl')->first();
    $this->actingAs($user);
    $task = Task::first();
    $response = $this->get(route('tasks.edit', $task->id));

    $escapedTaskValue = htmlspecialchars($task->task, ENT_QUOTES);
    $response->assertStatus(200)
        ->assertViewIs('admin.tasks.edit')
        ->assertSee('name="task"', false)
        ->assertSee('name="begindate"', false)
        ->assertSee('name="enddate"', false)
        ->assertSee('name="user_id"', false)
        ->assertSee('name="project_id"', false)
        ->assertSee('name="activity_id"', false)
        ->assertSee('value="'.$escapedTaskValue.'"', false)
        ->assertSee('value="'.$task->begindate.'"', false)
        ->assertSee('value="'.$task->enddate.'"', false)
        ->assertSee('action="'.route('tasks.update', $task->id).'"', false);
})->group('Opdracht24');

// Test of de edit pagina de correcte dropdown opties voor users bevat en de huidige waarde geselecteerd is
test('tasks edit page displays correct user dropdown options and selected value', function () {
    $user = User::where('email', 'admin@school.nl')->first();
    $this->actingAs($user);
    $task = Task::first();
    $response = $this->get(route('tasks.edit', $task->id));
    $users = User::all();

    foreach ($users as $dropdownUser) {
        $response->assertSee('value="'.$dropdownUser->id.'"', false);
        $response->assertSee($dropdownUser->name, false);
        if ($task->user_id == $dropdownUser->id) {
            $response->assertSeeInOrder(['value="'.$dropdownUser->id.'"', 'selected'], false);
        }
    }
})->group('Opdracht24');

// Test of de edit pagina de correcte dropdown opties voor projects bevat en de huidige waarde geselecteerd is
test('tasks edit page displays correct project dropdown options and selected value', function () {
    $user = User::where('email', 'admin@school.nl')->first();
    $this->actingAs($user);
    $task = Task::first();
    $response = $this->get(route('tasks.edit', $task->id));
    $projects = Project::all();

    foreach ($projects as $dropdownProject) {
        $response->assertSee('value="'.$dropdownProject->id.'"', false);
        $response->assertSee($dropdownProject->name, false);
        if ($task->project_id == $dropdownProject->id) {
            $response->assertSeeInOrder(['value="'.$dropdownProject->id.'"', 'selected'], false);
        }
    }
})->group('Opdracht24');

// Test of de edit pagina de correcte dropdown opties voor activities bevat en de huidige waarde geselecteerd is
test('tasks edit page displays correct activity dropdown options and selected value', function () {
    $user = User::where('email', 'admin@school.nl')->first();
    $this->actingAs($user);
    $task = Task::first();
    $response = $this->get(route('tasks.edit', $task->id));
    $activities = Activity::all();

    foreach ($activities as $activity) {
        $response->assertSee('value="'.$activity->id.'"', false);
        $response->assertSee($activity->name, false);
        if ($task->activity_id == $activity->id) {
            $response->assertSeeInOrder(['value="'.$activity->id.'"', 'selected'], false);
        }
    }
})->group('Opdracht24');
