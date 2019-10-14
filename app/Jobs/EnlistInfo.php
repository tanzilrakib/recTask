<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Session;
use App\Info;

class EnlistInfo implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $info;

    public function __construct($info)
    {
        $this->info = $info;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if(Info::create($this->info)){
            Session::flash('message', 'Info enlisted!'); 
            Session::flash('alert-class', 'alert-success'); 
        }
        else{
            Session::flash('message', 'Failed to enlist info!'); 
            Session::flash('alert-class', 'alert-danger'); 
        }
    }
}
