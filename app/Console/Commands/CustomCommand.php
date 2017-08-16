<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Activity;

class CustomCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'custom:command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update activitiy status if date lapas sa date';

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
        Activity::where('date','>=',Carbon\Carbon::today()->format('Y-m-d'))->update(['status'=> true]);
        Usere::delete('')
        
    }
}
