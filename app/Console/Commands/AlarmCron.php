<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Alarm;
use App\Models\UserRoomDevice;
use App\Http\Repositories\Eloquent\FirebaseRepo;
use Carbon\Carbon;
class AlarmCron extends Command
{
     /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'alarm:cron';

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
        \Log::info($time);
        $alarms=Alarm::with("userRoomDevice")->where("time",$time)->where("active",1)->get();
        foreach($alarms as $alarm){
            if($alarm->userRoomDevice){
                $alarm->userRoomDevice->relay=$alarm->notify;
                $alarm->userRoomDevice->bother=$alarm->bother;
                $alarm->userRoomDevice->reading=$alarm->notify;
                $alarm->userRoomDevice->event_action=$alarm->notify;
                $alarm->userRoomDevice->reading_type="status";
                $alarm->userRoomDevice->save();
                \Log::info($alarm->userRoomDevice->refresh());
                $values=$database->getReference('userRoomDevices')->getValue();
                         if(is_array($values)){
                        foreach($values as $key=>$value){
                                    if($value["id"]==$alarm->userRoomDevice->id){
                                        $device=UserRoomDevice::find($alarm->userRoomDevice->id);
                                        $insert=$database->getReference("userRoomDevices/".$key)->set($device->refresh());
                                    }
                                }
                }
            }
        }
        \Log::info("Alarm Cron is working fine!");


    }
}
