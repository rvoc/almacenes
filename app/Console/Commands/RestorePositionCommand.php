<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class RestorePositionCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'keyrus:RestorePosition';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Restaura los cargos de la tabla de usuario a la tabla persona en caso de una migracion utilizar este comando';

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
        //
        $this->info("Restableciendo Cargos");
    }
}
