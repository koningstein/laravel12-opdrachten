<?php

use App\Models\User;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;

beforeEach(function () {
    $this->seed('RoleAndPermissionSeeder');
    $this->seed('UserSeeder');
    $this->seed('ProjectSeeder');
});

// --- STUDENT TESTS ---

test('student can access projects.index', function () {
    $student = User::where('email', 'student@school.nl')->first();
    $this->actingAs($student)
        ->get(route('projects.index'))
        ->assertStatus(200, 'Student should be able to access projects.index');
})->group('Opdracht15');

test('student can access projects.create', function () {
    $student = User::where('email', 'student@school.nl')->first();
    $this->actingAs($student)
        ->get(route('projects.create'))
        ->assertStatus(200, 'Student should be able to access projects.create');
})->group('Opdracht15');

test('student can store a new project', function () {
    $student = User::where('email', 'student@school.nl')->first();
    $this->actingAs($student)
        ->post(route('projects.store'), [
            'name' => 'New Project',
            'description' => 'Project description',
        ])->assertStatus(302, 'Student should be able to store a new project');
})->group('Opdracht15');

test('student can access projects.edit', function () {
    $student = User::where('email', 'student@school.nl')->first();
    $project = Project::first();
    $this->actingAs($student)
        ->get(route('projects.edit', $project->id))
        ->assertStatus(200, 'Student should be able to access projects.edit');
})->group('Opdracht15');

test('student can update a project', function () {
    $student = User::where('email', 'student@school.nl')->first();
    $project = Project::first();
    $this->actingAs($student)
        ->patch(route('projects.update', $project->id), [
            'name' => 'Updated Project',
            'description' => 'Updated description',
        ])->assertStatus(302, 'Student should be able to update a project');
})->group('Opdracht15');

test('student cannot access projects.delete', function () {
    $student = User::where('email', 'student@school.nl')->first();
    $project = Project::first();
    $this->actingAs($student)
        ->get(route('projects.delete', $project->id))
        ->assertStatus(403, 'Student should NOT be able to access projects.delete');
})->group('Opdracht15');

test('student cannot destroy a project', function () {
    $student = User::where('email', 'student@school.nl')->first();
    $project = Project::first();
    $this->actingAs($student)
        ->delete(route('projects.destroy', $project->id))
        ->assertStatus(403, 'Student should NOT be able to destroy a project');
})->group('Opdracht15');

// --- TEACHER TESTS ---

test('teacher can access projects.index', function () {
    $teacher = User::where('email', 'teacher@school.nl')->first();
    $this->actingAs($teacher)
        ->get(route('projects.index'))
        ->assertStatus(200, 'Teacher should be able to access projects.index');
})->group('Opdracht15');

test('teacher can access projects.create', function () {
    $teacher = User::where('email', 'teacher@school.nl')->first();
    $this->actingAs($teacher)
        ->get(route('projects.create'))
        ->assertStatus(200, 'Teacher should be able to access projects.create');
})->group('Opdracht15');

test('teacher can store a new project', function () {
    $teacher = User::where('email', 'teacher@school.nl')->first();
    $this->actingAs($teacher)
        ->post(route('projects.store'), [
            'name' => 'New Project',
            'description' => 'Project description',
        ])->assertStatus(302, 'Teacher should be able to store a new project');
})->group('Opdracht15');

test('teacher can access projects.edit', function () {
    $teacher = User::where('email', 'teacher@school.nl')->first();
    $project = Project::first();
    $this->actingAs($teacher)
        ->get(route('projects.edit', $project->id))
        ->assertStatus(200, 'Teacher should be able to access projects.edit');
})->group('Opdracht15');

test('teacher can update a project', function () {
    $teacher = User::where('email', 'teacher@school.nl')->first();
    $project = Project::first();
    $this->actingAs($teacher)
        ->patch(route('projects.update', $project->id), [
            'name' => 'Updated Project',
            'description' => 'Updated description',
        ])->assertStatus(302, 'Teacher should be able to update a project');
})->group('Opdracht15');

test('teacher can access projects.delete', function () {
    $teacher = User::where('email', 'teacher@school.nl')->first();
    $project = Project::first();
    $this->actingAs($teacher)
        ->get(route('projects.delete', $project->id))
        ->assertStatus(200, 'Teacher should be able to access projects.delete');
})->group('Opdracht15');

test('teacher can destroy a project', function () {
    $teacher = User::where('email', 'teacher@school.nl')->first();
    $project = Project::first();
    $this->actingAs($teacher)
        ->delete(route('projects.destroy', $project->id))
        ->assertStatus(302, 'Teacher should be able to destroy a project');
})->group('Opdracht15');

// --- ADMIN TESTS ---

test('admin can access projects.index', function () {
    $admin = User::where('email', 'admin@school.nl')->first();
    $this->actingAs($admin)
        ->get(route('projects.index'))
        ->assertStatus(200, 'Admin should be able to access projects.index');
})->group('Opdracht15');

test('admin can access projects.create', function () {
    $admin = User::where('email', 'admin@school.nl')->first();
    $this->actingAs($admin)
        ->get(route('projects.create'))
        ->assertStatus(200, 'Admin should be able to access projects.create');
})->group('Opdracht15');

test('admin can store a new project', function () {
    $admin = User::where('email', 'admin@school.nl')->first();
    $this->actingAs($admin)
        ->post(route('projects.store'), [
            'name' => 'New Project',
            'description' => 'Project description',
        ])->assertStatus(302, 'Admin should be able to store a new project');
})->group('Opdracht15');

test('admin can access projects.edit', function () {
    $admin = User::where('email', 'admin@school.nl')->first();
    $project = Project::first();
    $this->actingAs($admin)
        ->get(route('projects.edit', $project->id))
        ->assertStatus(200, 'Admin should be able to access projects.edit');
})->group('Opdracht15');

test('admin can update a project', function () {
    $admin = User::where('email', 'admin@school.nl')->first();
    $project = Project::first();
    $this->actingAs($admin)
        ->patch(route('projects.update', $project->id), [
            'name' => 'Updated Project',
            'description' => 'Updated description',
        ])->assertStatus(302, 'Admin should be able to update a project');
})->group('Opdracht15');

test('admin can access projects.delete', function () {
    $admin = User::where('email', 'admin@school.nl')->first();
    $project = Project::first();
    $this->actingAs($admin)
        ->get(route('projects.delete', $project->id))
        ->assertStatus(200, 'Admin should be able to access projects.delete');
})->group('Opdracht15');

test('admin can destroy a project', function () {
    $admin = User::where('email', 'admin@school.nl')->first();
    $project = Project::first();
    $this->actingAs($admin)
        ->delete(route('projects.destroy', $project->id))
        ->assertStatus(302, 'Admin should be able to destroy a project');
})->group('Opdracht15');

// --- UNAUTHENTICATED USER TESTS ---

test('unauthenticated user cannot access projects.index', function () {
    Auth::logout();
    $this->get(route('projects.index'))
        ->assertStatus(403, 'Unauthenticated user should NOT access projects.index');
})->group('Opdracht15');

test('unauthenticated user cannot access projects.create', function () {
    Auth::logout();
    $this->get(route('projects.create'))
        ->assertStatus(403, 'Unauthenticated user should NOT access projects.create');
})->group('Opdracht15');

test('unauthenticated user cannot store a project', function () {
    Auth::logout();
    $this->post(route('projects.store'), [
        'name' => 'New Project',
        'description' => 'Project description',
    ])->assertStatus(403, 'Unauthenticated user should NOT store a project');
})->group('Opdracht15');

test('unauthenticated user cannot access projects.edit', function () {
    Auth::logout();
    $project = Project::first();
    $this->get(route('projects.edit', $project->id))
        ->assertStatus(403, 'Unauthenticated user should NOT access projects.edit');
})->group('Opdracht15');

test('unauthenticated user cannot update a project', function () {
    Auth::logout();
    $project = Project::first();
    $this->patch(route('projects.update', $project->id), [
        'name' => 'Updated Project',
        'description' => 'Updated description',
    ])->assertStatus(403, 'Unauthenticated user should NOT update a project');
})->group('Opdracht15');

test('unauthenticated user cannot access projects.delete', function () {
    Auth::logout();
    $project = Project::first();
    $this->get(route('projects.delete', $project->id))
        ->assertStatus(403, 'Unauthenticated user should NOT access projects.delete');
})->group('Opdracht15');

test('unauthenticated user cannot destroy a project', function () {
    Auth::logout();
    $project = Project::first();
    $this->delete(route('projects.destroy', $project->id))
        ->assertStatus(403, 'Unauthenticated user should NOT destroy a project');
})->group('Opdracht15');

// --- LINK VISIBILITY TESTS ---

test('project creation link is visible for users with create permission', function () {
    $users = [
        'admin@school.nl' => 'Admin',
        'teacher@school.nl' => 'Teacher',
        'student@school.nl' => 'Student',
    ];
    foreach ($users as $email => $role) {
        $user = User::where('email', $email)->first();
        $this->actingAs($user)
            ->get(route('projects.index'))
            ->assertSee('href="' . route('projects.create') . '"', false, "$role should see the project creation link");
    }
})->group('Opdracht15');

test('project edit link is visible for users with edit permission', function () {
    $project = Project::first();
    $users = [
        'admin@school.nl' => 'Admin',
        'teacher@school.nl' => 'Teacher',
        'student@school.nl' => 'Student',
    ];
    foreach ($users as $email => $role) {
        $user = User::where('email', $email)->first();
        $this->actingAs($user)
            ->get(route('projects.index'))
            ->assertSee('href="' . route('projects.edit', $project->id) . '"', false, "$role should see the project edit link");
    }
})->group('Opdracht15');

test('project delete link is visible for users with delete permission', function () {
    $project = Project::first();
    $users = [
        'admin@school.nl' => 'Admin',
        'teacher@school.nl' => 'Teacher',
    ];
    foreach ($users as $email => $role) {
        $user = User::where('email', $email)->first();
        $this->actingAs($user)
            ->get(route('projects.index'))
            ->assertSee('href="' . route('projects.delete', $project->id) . '"', false, "$role should see the project delete link");
    }
})->group('Opdracht15');

test('project delete link is not visible for users without delete permission', function () {
    $project = Project::first();
    $student = User::where('email', 'student@school.nl')->first();
    $this->actingAs($student)
        ->get(route('projects.index'))
        ->assertDontSee('href="' . route('projects.delete', $project->id) . '"', false, 'Student should NOT see the project delete link');
})->group('Opdracht15');
