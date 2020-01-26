<?php

namespace App\Console\Commands;

use App\Subscription;
use App\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class DeadlineOfTheDay extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'deadline:day';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check deadlines daybyday';

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
        $subscriptions = Subscription::where('deadline', '<', Carbon::now())->get();
        foreach ($subscriptions as $subscription) {
            $subscription->status = 0;
            $subscription->save();
        }
        $this->info('Function worked successfully ');
    }
}
