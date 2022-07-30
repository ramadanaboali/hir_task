<?php

namespace App\Console\Commands;

use App\Models\Ads;
use Illuminate\Console\Command;
use Mail;
use App\Mail\AdsMail;
use Illuminate\Mail\Message;
class EmailCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $ads=Ads::whereDate('start_date', '=', \Carbon\Carbon::tomorrow())->get();
        foreach($ads as $ad){
            $message = "Your have ads tomorrow with id " . $ad->id;
            $mailData = [
                'title' => 'Check ads',
                'body' => $message
            ];

            $ad->advertiser ?  Mail::to($ad->advertiser->email)->send(new AdsMail($mailData)) : '';
            }

        \Log::info("Email Cron is working fine!");
        return 0;
    }
}
