<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Log;

class MakeCrudCommand extends Command
{
    protected $signature = 'make:scaffold {name} {--fields=} {--prefix=} {--datatables}';

    protected $description = 'Create InfyOm-style scaffold';

    protected $config;

    public function handle()
    {
        $this->setupConfig();
        $this->createModel();
        $this->createController();
        $this->createViews();
        $this->addRoutes(); // Add routes to routes/web.php

        $this->info("Scaffold for {$this->config->modelNames->name} created successfully!");
    }

    protected function setupConfig()
    {
        $name = $this->argument('name');
        $this->config = (object) [
            'modelNames' => (object) [
                'name' => $name,
                'camel' => Str::camel($name),
                'camelPlural' => Str::plural(Str::camel($name)),
                'snakePlural' => Str::plural(Str::snake($name)),
                'snake' => Str::snake($name),
            ],
            'prefixes' => (object) [
                'route' => $this->option('prefix') ? $this->option('prefix') . '.' : '',
                'view' => $this->option('prefix') ? $this->option('prefix') . '/' : '',
            ],
            'namespaces' => (object) [
                'controller' => 'App\Http\Controllers',
                'model' => 'App\Models',
                'request' => 'App\Http\Requests',
                'dataTables' => 'App\DataTables',
            ],
            'fields' => $this->parseFields(),
            'datatables' => $this->option('datatables'),
        ];
    }

    protected function parseFields()
    {
        return collect(explode(',', $this->option('fields')))
            ->map(function ($field) {
                [$name, $type] = explode(':', $field);

                return ['name' => $name, 'type' => $type];
            });
    }

    protected function createModel()
    {
        $this->call('make:model', [
            'name' => "{$this->config->namespaces->model}\\{$this->config->modelNames->name}",
            '-m' => true,
        ]);
    }

    protected function createController()
    {
        $controllerStub = File::get(app_path('Console/Commands/stubs/controller.stub'));

        // Prepare replacements
        $replacements = [
            '{{namespaces}}' => $this->generateControllerNamespaces(),
            '{{controllerNameSpace}}' => $this->config->namespaces->controller,
            '{{dataTableNameSpace}}' => $this->config->namespaces->dataTables,
            '{{modelNameSpace}}' => $this->config->namespaces->model,
            '{{modelName}}' => $this->config->modelNames->name,
            '{{modelCamel}}' => $this->config->modelNames->camel,
            '{{modelCamelPlural}}' => $this->config->modelNames->camelPlural,
            '{{modelSnakePlural}}' => $this->config->modelNames->snakePlural,
            '{{routePrefix}}' => $this->config->prefixes->route,
            '{{viewPrefix}}' => $this->config->prefixes->view,
            '{{datatables}}' => $this->config->datatables ? 'true' : 'false',
        ];

        // Process the controller stub
        $controllerContent = str_replace(
            array_keys($replacements),
            array_values($replacements),
            $controllerStub
        );

        // Save the controller file
        $controllerPath = app_path("Http/Controllers/{$this->config->modelNames->name}Controller.php");

        File::put($controllerPath, $controllerContent);
        $this->info("Controller created: {$this->config->modelNames->name}Controller.php");
    }

    protected function generateControllerNamespaces()
    {
        $namespaces = [
            'use Illuminate\Http\Request;',
            'use Flash;',
            "use {$this->config->namespaces->model}\\{$this->config->modelNames->name};",
            "use {$this->config->namespaces->request}\\Update{$this->config->modelNames->name}Request;",
            'use App\Http\Controllers\AppBaseController;',
        ];

        if ($this->config->datatables) {
            $namespaces[] = "use {$this->config->namespaces->dataTables}\\{$this->config->modelNames->name}DataTable;";
        }

        return implode("\n", $namespaces);
    }

    protected function createViews()
    {
        $viewDirectory = resource_path("views/{$this->config->prefixes->view}" . Str::kebab(Str::plural($this->config->modelNames->name)));

        // Create view directory
        File::ensureDirectoryExists($viewDirectory, 0755, true);

        // Generate view files from stubs
        $views = ['index', 'fields', 'create', 'edit', 'show', 'show_fields'];

        foreach ($views as $viewName) {
            $viewContent = $this->generateViewContent($viewName);
            Log::Info('View Details' . $viewContent);
            File::put("$viewDirectory/{$viewName}.blade.php", $viewContent);
            $this->info("View created: {$viewName}.blade.php");
        }
    }

    protected function generateViewContent($viewName)
    {
        $stub = File::get(app_path("Console/Commands/stubs/views/{$viewName}.blade.php"));

        // Define the replacements array
        $replacements = [
            'modelName' => $this->config->modelNames->name,                      // Example: "PostCategory"
            'modelNamePlural' => Str::plural($this->config->modelNames->name),  // Example: "PostCategories"
            'modelNameSnake' => $this->config->modelNames->snake,               // Example: "post_category"
            'modelNamePluralSnake' => $this->config->modelNames->snakePlural,   // Example: "post_categories"
            'routePrefix' => $this->config->prefixes->route,                    // Example: "admin."
            'viewPrefix' => $this->config->prefixes->view,                      // Example: "admin/"
            'formFields' => $this->generateFormFields(),                        // If used in the view
            'modelSnakePlural' => $this->config->modelNames->snakePlural,
            'modelCamelPlural' => $this->config->modelNames->camelPlural,
            'modelCamel' => $this->config->modelNames->camel,

        ];

        // Replace placeholders in the stub file with actual values
        foreach ($replacements as $key => $value) {
            $stub = str_replace("{{ {$key} }}", $value, $stub);
        }

        // Return the processed content
        return $stub;
    }

    protected function generateFormFields()
    {
        return collect($this->config->fields)->map(function ($field) {
            $name = Str::snake($field['name']);
            $type = $field['type'];

            return match ($type) {
                'text' => <<<HTML
                <div class="form-group">
                    <label for="$name">{$field['name']}:</label>
                    <textarea name="$name" id="$name" class="form-control" required></textarea>
                </div>
                HTML,
                'boolean' => <<<HTML
                <div class="form-check">
                    <input type="checkbox" name="$name" id="$name" class="form-check-input">
                    <label class="form-check-label" for="$name">{$field['name']}</label>
                </div>
                HTML,
                default => <<<HTML
                <div class="form-group">
                    <label for="$name">{$field['name']}:</label>
                    <input type="{$this->getHtmlInputType($type)}" 
                           name="$name" 
                           id="$name" 
                           class="form-control" 
                           required>
                </div>
                HTML
            };
        })->implode("\n");
    }

    protected function getHtmlInputType($dbType)
    {
        return match ($dbType) {
            'integer', 'bigInteger' => 'number',
            'date' => 'date',
            'datetime' => 'datetime-local',
            'boolean' => 'checkbox',
            'text' => 'textarea',
            default => 'text'
        };
    }

    protected function addRoutes()
    {
        $routes = [
            "Route::resource('{$this->config->prefixes->route}{$this->config->modelNames->snakePlural}', {$this->config->modelNames->name}Controller::class);",
        ];

        // Add routes to the routes/web.php file
        $routesContent = File::get(base_path('routes/web.php'));

        foreach ($routes as $route) {
            if (strpos($routesContent, $route) === false) {
                $routesContent .= "\n" . $route; // Append the route if not already present
            }
        }

        File::put(base_path('routes/web.php'), $routesContent);

        $this->info("Routes added for {$this->config->modelNames->name} successfully!");
    }
}
