<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Timing;
use App\Http\Repositories\Eloquent\FirebaseRepo;
use Carbon\Carbon;
class TimeCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'time:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';
    protected $firebaseRepo;
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
        $this->firebaseRepo = new FirebaseRepo();
        $uri=config('service.firebase.database_url');
        $database = $this->firebaseRepo->createDatabase($uri);
        $time = Carbon::now()->format('H:i');
        $day = Carbon::now()->format('l');
        \Log::info($time." ==== " .$day);
        $timings=Timing::with("userRoomDevice")->where("start_time","<=",$time)->where("end_time",">=",$time)->where("active",1)->get();
        foreach($timings as $timing){
            $days=json_decode($timing->days,true);
            if($timing->userRoomDevice && in_array($day,$days)){
                $timing->userRoomDevice->relay=$timing->event_action;
                $timing->userRoomDevice->event_action=$timing->event_action;
                $timing->userRoomDevice->device_action=$timing->device_action;
                $timing->userRoomDevice->save();
                \Log::info($timing->userRoomDevice->refresh());
                $values=$database->getReference('userRoomDevices')->getValue();
                         if(is_array($values)){
                        foreach($values as $key=>$value){
                                    if($value["id"]==$timing->userRoomDevice->id){
                                        $insert=$database->getReference("userRoomDevices/".$key)->set($timing->userRoomDevice->refresh());
                                    }
                                }
                }
            }
        }
        \Log::info("Timing Cron is working fine!");


    }
}
