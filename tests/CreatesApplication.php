<?php

namespace Tests;

use App\User;
use Illuminate\Support\Facades\Config;
use Illuminate\Contracts\Console\Kernel as Artisan;
use Illuminate\Contracts\Console\Kernel;

trait CreatesApplication
{
    protected $coverPath;
    protected $mediaPath = __DIR__.'/profiles';

    protected static $migrationsRun = false;

    /** @var Artisan */
    private $artisan;

    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://localhost';

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $this->artisan = $app->make(Artisan::class);
        $app->make(Kernel::class)->bootstrap();

        $this->coverPath = $app->basePath().'/public/img/covers';

        return $app;
    }

    private function prepareForTests()
    {
        Config::set('database.default', 'mysql_testing');

        if (!static::$migrationsRun)
        {
            $this->artisan->call('migrate:refresh', ['--database' => 'mysql_testing']);

            if (!User::all()->count()) {
                $this->artisan->call('db:seed', ['--database' => 'mysql_testing']);
            }

            if (!file_exists($this->coverPath)) {
                mkdir($this->coverPath, 0777, true);
            }

            static::$migrationsRun = true;
        }
    }
}
