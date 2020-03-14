<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\HotDeal;
use Carbon\Carbon;

class DeleteExpiredHotDeals extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'hotdeal:DeleteHotDeal';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete the expired hot deals that are out dated';

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
        $allDeals = HotDeal::all();
        foreach ($allDeals as $value) {
            $date = $value->deadline;
            $deadlinetime = $value->deadlinetime;

            $currentDate = Carbon::now()->format('Y-m-d');
            $currenttime = Carbon::now()->format('h:m');
            $databaseDate = $date.' '.$deadlinetime.':00';

            if ($date <= $currentDate) {
                if ($date == $currentDate) {
                    // if ($deadlinetime >= $currenttime) {
                        // echo "valid | d : $deadlinetime c: $currenttime \n";
                        if ($databaseDate <= Carbon::now()) {
                        // echo " EX , Dat : ".$databaseDate."\n";
                        // echo "Now : ".Carbon::now()."\n";
                        // echo " \n";
                        //Write Delete Code Here
                        $dataToDelete = HotDeal::where('deadline', $date)->where('deadlinetime', $deadlinetime)->delete();
                        echo "Deleted"."\n";
                        }
                        else {
                        // echo " Va Dat : " . $databaseDate . "\n";
                        // echo "Now : " . Carbon::now() . "\n";
                        // echo " \n";
                        }
                    // }
                }
                else{
                    // echo "Expired | d : $deadlinetime c: $currenttime \n";
                    //Write Delete Code Here
                    HotDeal::where('deadline', $date)->where('deadlinetime', $deadlinetime)->delete();
                    echo "Deleted \n";
                }
            }


        }
    }
}
