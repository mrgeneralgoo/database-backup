<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SQLBackup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:sql-backup {database} {email}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Backup database to your email';

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
     * @return mixed
     */
    public function handle()
    {
        $email    = $this->argument('email');
        $result   = [];
        $fileName = date('Y-m-d-H-i', time());
        $mimeType = '.gz';

        foreach (array_unique(array_filter(explode(',', $this->argument('database')))) as $database) {
            $commandResult = $this->callSilent('db:backup', [
                '--database'        => $database,
                '--destination'     => 'local',
                '--destinationPath' => $fileName,
                '--compression'     => 'gzip',
            ]);

            $result[] = [
                'database'  => $database,
                'isSuccess' => $commandResult === 0,
                'time'      => date('Y-m-d H:i:s', time()),
            ];
        }

        Mail::to($email)->queue(new \App\Mail\SQLBackup($result, [storage_path('databases/' . $fileName . $mimeType)]));
    }
}
