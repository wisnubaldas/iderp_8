<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class BackupDb extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:backup-db';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new backup database.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $databaseName = $this->ask('DB Name ?');
        $userName = $this->ask('DB User ?');
        $password = $this->secret('What is the password ?');

        $this->table(
            ['db name', 'db user', 'db password'],
            [[$databaseName,$userName,Hash::make($password)]]
        );

        \Spatie\DbDumper\Databases\MySql::create()
                        ->setDbName($databaseName)
                        ->setUserName($userName)
                        ->setPassword($password)
                        ->dumpToFile('dump.sql');

        $this->info('Backup database selesai....');
        return 0;
    }
}
