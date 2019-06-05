<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use App\Person;
use DB;
use Auth;
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
        $this->info("Restaurando cargos de la tabla usuario XD");
        $personas = Person::all();
        foreach ($personas as $persona) {
            # code...
            $persona->prs_ga_id = $persona->getUser()->usr_ga_id;
            $persona->save();
            $this->info($persona);
        }
        // $users = User::all();
        // foreach($users as $user){
        //     $this->info($user->person);
        // }
        // $this->info($users);
    }
}
