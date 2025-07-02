<?php
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\File;
use function Pest\Laravel\seed;

// Test of de UserSeeder bestaat
test('UserSeeder exists', function () {
    $this->assertTrue(File::exists(database_path('seeders/UserSeeder.php')), 'config/permission.php file does not exist');
})->group('Opdracht13');

// Voor we beginnen, run de UserSeeder
beforeEach(function () {
    $this->seed('RoleAndPermissionSeeder');
    $this->seed('UserSeeder');
});

// Test of de correcte gebruikers zijn aangemaakt
test('correct users are created', function () {
    $this->assertDatabaseHas('users', [
        'name' => 'student',
        'email' => 'student@school.nl',
    ]);

    $this->assertDatabaseHas('users', [
        'name' => 'teacher',
        'email' => 'teacher@school.nl',
    ]);

    $this->assertDatabaseHas('users', [
        'name' => 'admin',
        'email' => 'admin@school.nl',
    ]);
})->group('Opdracht13');

//// Test of de correcte rollen zijn toegewezen aan de gebruikers
test('users have correct roles', function () {
    $student = User::where('email', 'student@school.nl')->first();
    $teacher = User::where('email', 'teacher@school.nl')->first();
    $admin = User::where('email', 'admin@school.nl')->first();

    $this->assertNotNull($student, 'Student user not found');
    $this->assertNotNull($teacher, 'Teacher user not found');
    $this->assertNotNull($admin, 'Admin user not found');

    $this->assertTrue($student->hasRole('student'), 'Student user does not have role student');
    $this->assertTrue($teacher->hasRole('teacher'), 'Teacher user does not have role teacher');
    $this->assertTrue($admin->hasRole('admin'), 'Admin user does not have role admin');
})->group('Opdracht13');
