<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Laravel Opdrachten

Deze repository is voor studenten die aan de slag willen met het leren van Laravel12. De opdrachten zijn gekoppeld aan de lessenserie die
geschreven is om stap voor stap het framework te leren. De eisen van de opdrachten staan dan ook in het document beschreven, met daarbij
het commando wat je kan uitvoeren als controle.

🎯 De Opdracht: Project Management Tool
Voor de opdracht ga je aan de slag met een project management tool. Dit is om bij te houden hoever een project staat, welke taken er zijn en wie de taken moeten uitvoeren. De functionaliteit bestaat uit het volgende:
<ul>
<li><strong>Projecten</strong>: Studenten kunnen projecten aanmaken en beheren</li>
<li><strong>Taken</strong>: Bij een project kunnen allerlei taken horen</li>
<li><strong>Activiteiten</strong>: Een taak heeft een status/activiteit, bijvoorbeeld: Todo, Doing, Testing, Verify, Done</li>
<li><strong>Labels</strong>: Een taak kan verschillende labels hebben, zoals: frontend, backend, documentation, bug, feature</li>
<li><strong>Gebruikers</strong>: Taken kunnen worden toegewezen aan verschillende gebruikers</li>
</ul>

En ja, het ziet er misschien lastig uit, maar de opdrachten zullen steeds een klein stapje zijn. De opdrachten zullen ook heel precies zijn,
er zijn namelijk automatische testen beschikbaar waar op alle details wordt gelet.

## De installatie (bijv wampserver)
Voer de volgende stappen uit om met deze opdrachten aan de slag te gaan.
<ul>
    <li>Clone het project in een directory</li>
    <li>Maak in wampserver een virtualhost aan en zet de document root op de public map. Gebruik minimaal php versie 8.2</li>
    <li>Zorg dat je bij de phpMyAdmin kan komen</li>
    <li>Maak 1 databases aan: laravelopdr</li>
    <li>Maak een .env file aan, en kopier de .env.example daar naartoe</li>
    <li>In de .env file, check de database naam (laravelopdr) en de username (root)</li>
    <li>Ga naar je root directory van je project in de terminal, en voer daar uit: composer install</li>
    <li>Voer dan in de terminal uit: php artisan key:generate</li>
    <li>Voer dan in de terminal uit: php artisan migrate</li>
</ul>

Gebruik je een andere omgeving, dan zal je soortgelijke stappen moeten nemen om de opdrachten klaar te zetten.

<h1>🛠️ Kerntechnieken</h1>
<h2>Fundamentele Concepten</h2>
<ul>
<li><strong>MVC Design Pattern</strong>: Clean code architectuur</li>
<li><strong>ORM (Eloquent)</strong>: Database communicatie zonder SQL</li>
<li><strong>Laravel Conventies</strong>: Professionele naamgeving en structuur</li>
</ul>
<h2>Database & Datamodeling</h2>
<ul>
<li><strong>Models</strong>: Eloquent models voor elke entiteit</li>
<li><strong>Migrations</strong>: Database schema beheer in code</li>
<li><strong>Seeders</strong>: Testdata generatie</li>
<li><strong>Factories</strong>: Automated fake data met relaties</li>
<li><strong>Relationships</strong>: BelongsTo en HasMany koppelingen</li>
</ul>
<h2>Frontend Development</h2>
<ul>
<li><strong>Blade Templates</strong>: Laravel's template engine</li>
<li><strong>Master Pages</strong>: Herbruikbare layouts met <code>@extends</code> en <code>@yield</code></li>
<li><strong>Livewire Starterkit</strong>: Interactieve componenten (vervangt Breeze in Laravel 12)</li>
<li><strong>TailwindCSS</strong>: Modern utility-first styling</li>
<li><strong>Responsive Design</strong>: Mobile-first development</li>
</ul>
<h2>Controllers & Routing</h2>
<ul>
<li><strong>Resource Controllers</strong>: Complete CRUD operaties
<ul>
<li><code>index</code> - Overzichtspagina's</li>
<li><code>create</code> - Formulieren voor nieuwe items</li>
<li><code>store</code> - Opslaan van nieuwe data</li>
<li><code>show</code> - Detailpagina's</li>
<li><code>edit</code> - Bewerkingsformulieren</li>
<li><code>update</code> - Bijwerken van bestaande data</li>
<li><code>destroy</code> - Verwijderen van items</li>
</ul>
</li>
<li><strong>Named Routes</strong>: Onderhoudbare URL structuur</li>
<li><strong>Route Middleware</strong>: Beveiliging en toegangscontrole</li>
</ul>
<h2>Formulieren & Validatie</h2>
<ul>
<li><strong>Form Request Validation</strong>: Aparte validatieklassen</li>
<li><strong>Validation Rules</strong>: <code>required</code>, <code>string</code>, <code>unique</code>, <code>min/max</code>, <code>exists</code></li>
<li><strong>Error Handling</strong>: Gebruiksvriendelijke foutmeldingen</li>
<li><strong>Old Input</strong>: Behouden formulierdata bij fouten</li>
<li><strong>Flash Messages</strong>: Successmeldingen na acties</li>
</ul>
<h2>Authenticatie & Beveiliging</h2>
<ul>
<li><strong>User Authentication</strong>: Volledige login/logout functionaliteit</li>
<li><strong>Roles & Permissions</strong>: Spatie Laravel-Permission package</li>
<li><strong>Middleware</strong>: Route bescherming</li>
<li><strong>Authorization</strong>: Controller-level toegangscontrole</li>
</ul>
<h2>Development Tools</h2>
<ul>
<li><strong>Artisan Commands</strong>:
<ul>
<li><code>make:model --all</code> - Complete CRUD setup</li>
<li><code>make:request</code> - Validatieklassen</li>
<li><code>make:migration</code> - Database wijzigingen</li>
<li><code>make:seeder</code> - Testdata generators</li>
</ul>
</li>
<li><strong>Composer</strong>: Package management</li>
<li><strong>Git Integration</strong>: Versiebeheer voor team development</li>
</ul>

<h2>📋 Complete Opdrachten Overzicht</h2>
<ul>
<li><strong>Opdracht 1</strong>: Model en Migration - Project tabel aanmaken</li>
<li><strong>Opdracht 2</strong>: Factory & Seeder - Project testdata genereren</li>
<li><strong>Opdracht 3</strong>: Resource Controller - ProjectController aanmaken</li>
<li><strong>Opdracht 4</strong>: Index - Project overzichtspagina bouwen</li>
<li><strong>Opdracht 5</strong>: Create & Store - Project toevoegen functionaliteit</li>
<li><strong>Opdracht 6</strong>: Validatie - ProjectStoreRequest implementeren</li>
<li><strong>Opdracht 7</strong>: Show - Project detailpagina</li>
<li><strong>Opdracht 8</strong>: Edit & Update - Project bewerkingsfunctionaliteit</li>
<li><strong>Opdracht 9</strong>: Delete & Destroy - Project verwijderen</li>
<li><strong>Opdracht 10</strong>: Publieke Pagina - Categorieën publiek tonen</li>
<li><strong>Opdracht 11</strong>: Publieke Projects - Project overzicht voor bezoekers</li>
<li><strong>Opdracht 12</strong>: Roles & Permissions - Gebruikersrechten systeem</li>
<li><strong>Opdracht 13</strong>: User Seeder - Test gebruikers aanmaken</li>
<li><strong>Opdracht 14</strong>: Middleware Routes - Route beveiliging</li>
<li><strong>Opdracht 15</strong>: Rolgebaseerde Toegang - Permissies aan controllers koppelen</li>
<li><strong>Opdracht 16</strong>: Task & Activity Models - Database structuur voor taken</li>
<li><strong>Opdracht 17</strong>: Activity & Task Factory - Testdata voor taken</li>
<li><strong>Opdracht 18</strong>: Activity & Task Seeder - Database vullen met taken</li>
<li><strong>Opdracht 19</strong>: Task Index - Taken overzichtspagina</li>
<li><strong>Opdracht 20</strong>: Task Permissions - Rechten voor taken beheer</li>
<li><strong>Opdracht 21</strong>: Task Create - Nieuwe taken aanmaken</li>
<li><strong>Opdracht 22</strong>: Task Store & Validatie - Taken opslaan met controles</li>
<li><strong>Opdracht 23</strong>: Task Show - Taak detailpagina</li>
<li><strong>Opdracht 24</strong>: Task Edit - Taken bewerken</li>
<li><strong>Opdracht 25</strong>: Task Update & Validatie - Taken bijwerken</li>
<li><strong>Opdracht 26</strong>: Task Delete - Verwijderen bevestigingspagina</li>
<li><strong>Opdracht 27</strong>: Task Destroy - Taken definitief verwijderen</li>
</ul>

## Contact
Wil je ook aan de slag met deze opdrachten en heb je hiervoor de lessenserie met opdracht beschrijvingen nodig. Neem dan contact op met mij via m.koningstein@tcrmbo.nl
