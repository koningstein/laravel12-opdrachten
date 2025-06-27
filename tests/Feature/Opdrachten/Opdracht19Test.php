<?php

use App\Http\Controllers\Admin\TaskController;
use App\Models\Task;
use App\Models\User;
use App\Models\Project;
use App\Models\Activity;
use Illuminate\Support\Str;

beforeEach(function () {
    $this->seed('RoleAndPermissionSeeder');
    $this->seed('UserSeeder');
    $this->seed('ActivitySeeder');
    $this->seed('ProjectSeeder');
    $this->seed('TaskSeeder');
});

// Test of de tasks index pagina toegankelijk is voor niet-ingelogde gebruikers
test('tasks index page is accessible for non-authenticated users', function () {
    $response = $this->get(route('tasks.index'));

    $response->assertStatus(200);
    $response->assertViewIs('admin.tasks.index');
})->group('Opdracht19');

// Test of de tasks index pagina de correcte data weergeeft
test('tasks index page displays correct data', function () {
    $tasks = Task::with(['user', 'project', 'activity'])->paginate(15);
    $response = $this->get(route('tasks.index'));

    foreach ($tasks as $task) {
        $response->assertSee((string) $task->id);
        $response->assertSee(Str::limit($task->task, 50));
        $response->assertSee($task->begindate);
        $response->assertSee($task->enddate ? $task->enddate : '');
        $response->assertSee($task->user ? $task->user->name : 'N/A');
        $response->assertSee($task->project->name);
        $response->assertSee($task->activity->name);
    }
})->group('Opdracht19');

// Test specifiek voor taken zonder gebruiker (user_id = null)
test('tasks index page displays N/A for tasks without user', function () {
    // Maak een taak aan zonder gebruiker
    $task = Task::factory()->create([
        'user_id' => null,
        'project_id' => Project::first()->id,
        'activity_id' => Activity::first()->id,
    ]);

    // Haal het totale aantal pagina's op
    $totalTasks = Task::count();
    $tasksPerPage = 15;
    $lastPage = (int) ceil($totalTasks / $tasksPerPage);

    // Haal de laatste pagina op waar de nieuwe taak staat
    $response = $this->get(route('tasks.index', ['page' => $lastPage]));

    // Controleer dat 'N/A' voorkomt in de response
    $response->assertSee('N/A');

    // Controleer dat de taak zelf wel wordt getoond
    $response->assertSee((string) $task->id);
    $response->assertSee(Str::limit($task->task, 50));
})->group('Opdracht19');

// Test specifiek voor taken zonder einddatum (enddate = null)
test('tasks index page displays empty string for tasks without enddate', function () {
    // Maak een taak aan zonder einddatum
    $task = Task::factory()->create([
        'enddate' => null,
        'user_id' => User::first()->id,
        'project_id' => Project::first()->id,
        'activity_id' => Activity::first()->id,
    ]);

    // Haal het totale aantal pagina's op
    $totalTasks = Task::count();
    $tasksPerPage = 15;
    $lastPage = (int) ceil($totalTasks / $tasksPerPage);

    // Haal de laatste pagina op waar de nieuwe taak staat
    $response = $this->get(route('tasks.index', ['page' => $lastPage]));

    // Controleer dat de taak wordt getoond
    $response->assertSee((string) $task->id);
    $response->assertSee(Str::limit($task->task, 50));
    $response->assertSee($task->begindate);

    // Voor null enddate is het moeilijk om exact te testen wat er NIET staat
    // We kunnen wel controleren dat de taak correct wordt weergegeven
    $responseContent = $response->getContent();

    // Zoek naar de rij van deze specifieke taak en controleer dat er geen datum in de enddate kolom staat
    $taskRowPattern = '/<tr[^>]*>.*?' . preg_quote((string) $task->id) . '.*?<\/tr>/s';
    preg_match($taskRowPattern, $responseContent, $matches);

    expect($matches)->not()->toBeEmpty('Task row not found in response');

    // In de gevonden rij, tel het aantal <td> elementen en controleer de enddate kolom (4e kolom)
    $taskRow = $matches[0];
    preg_match_all('/<td[^>]*>(.*?)<\/td>/s', $taskRow, $cells);

    // De enddate kolom (index 3, omdat we bij 0 beginnen) moet leeg zijn of alleen whitespace bevatten
    expect(trim(strip_tags($cells[1][3])))->toBe('');
})->group('Opdracht19');

// Test voor combinatie van ontbrekende gebruiker EN einddatum
test('tasks index page handles task with no user and no enddate correctly', function () {
    // Maak een taak aan zonder gebruiker en zonder einddatum
    $task = Task::factory()->create([
        'user_id' => null,
        'enddate' => null,
        'project_id' => Project::first()->id,
        'activity_id' => Activity::first()->id,
    ]);

    // Haal het totale aantal pagina's op
    $totalTasks = Task::count();
    $tasksPerPage = 15;
    $lastPage = (int) ceil($totalTasks / $tasksPerPage);

    // Haal de laatste pagina op waar de nieuwe taak staat
    $response = $this->get(route('tasks.index', ['page' => $lastPage]));

    // Controleer dat de taak wordt getoond
    $response->assertSee((string) $task->id);
    $response->assertSee(Str::limit($task->task, 50));
    $response->assertSee($task->begindate);
    $response->assertSee('N/A'); // Voor de gebruiker

    // Controleer dat de project en activity wel correct worden getoond
    $response->assertSee($task->project->name);
    $response->assertSee($task->activity->name);
})->group('Opdracht19');
// Test of de paginering werkt op de tasks index pagina
test('tasks index page pagination works', function () {
    $initialTaskCount = Task::count(); // Aantal taken dat al door de seeders is aangemaakt
    $totalTasksToAdd = 30;
    Task::factory()->count($totalTasksToAdd)->create();

    $response = $this->get(route('tasks.index'));

    // Bepaal het totale aantal pagina's op basis van de totale taken
    $totalTasks = $initialTaskCount + $totalTasksToAdd;
    $tasksPerPage = 15;
    $totalPages = (int) ceil($totalTasks / $tasksPerPage);

    // Controleer of de juiste paginering links zichtbaar zijn
    for ($page = 1; $page <= $totalPages; $page++) {
        if ($page > 1) {
            $response->assertSee('href="' . route('tasks.index') . '?page=' . $page . '"', false);
        }
    }
})->group('Opdracht19');

// Test of de show-, edit-, en delete-links correct worden weergegeven op de tasks index pagina
test('tasks index page displays show, edit, and delete links', function () {
    $task = Task::first();
    $response = $this->get(route('tasks.index'));

    $response->assertSee('href="' . route('tasks.show', $task->id) . '"', false);
    $response->assertSee('href="' . route('tasks.edit', $task->id) . '"', false);
    $response->assertSee('href="' . route('tasks.delete', $task->id) . '"', false);
})->group('Opdracht19');

// Test of de delete-methode bestaat in de TaskController
test('TaskController has delete method', function () {
    $this->assertTrue(method_exists(TaskController::class, 'delete'), 'TaskController does not have a delete method.');
})->group('Opdracht19');
