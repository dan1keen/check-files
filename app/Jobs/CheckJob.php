<?php

namespace App\Jobs;

use App\CheckService;
use App\Date;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class CheckJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $service = new CheckService;
        $date = Date::findOrfail(1);
        $filename = Storage::disk('public')->path('file.txt');
        //Сравниваем дату файла с сохраненной датой в базе, если не совпадает то переносим контент на новый файл
        if($date->updated_date !== $service->check($filename)){
            $fileContents1 = file_get_contents($filename);
            Storage::disk('public')->put(filemtime($filename).'.txt', $fileContents1);


        }


    }
}
