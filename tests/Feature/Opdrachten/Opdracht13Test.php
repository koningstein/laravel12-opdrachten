<?php

use App\Models\User;
use App\Livewire\Auth\Login;
use Livewire\Livewire;

beforeEach(function (){
    $this->seed('RoleAndPermissionSeeder');
    $this->seed('UserSeeder');
});

test('the student user can login with email and correct password', function()
{
    $this->withoutExceptionHandling();

    $response = Livewire::test(Login::class)
        ->set('email', 'student@school.nl')
        ->set('password', 'student')
        ->call('login');

    $response->assertHasNoErrors();
    $this->assertAuthenticated();
})->group('Opdracht13');

test('the teacher user can login with email and correct password', function()
{
    $this->withoutExceptionHandling();

    $response = Livewire::test(Login::class)
        ->set('email', 'teacher@school.nl')
        ->set('password', 'teacher')
        ->call('login');

    $response->assertHasNoErrors();
    $this->assertAuthenticated();
})->group('Opdracht13');

test('the admin user can login with email and correct password', function()
{
    $this->withoutExceptionHandling();

    $response = Livewire::test(Login::class)
        ->set('email', 'admin@school.nl')
        ->set('password', 'admin')
        ->call('login');

    $response->assertHasNoErrors();
    $this->assertAuthenticated();
})->group('Opdracht13');

