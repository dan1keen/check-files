<?php


namespace App;


use Illuminate\Support\Facades\Storage;

class CheckService
{
    public function check($filename){
        $model = Date::where('id', 1);
        $date = date("Y-m-d H:i:s", filemtime($filename));
        if(isset($model)) {
            $model->update([
                "updated_date" => $date
            ]);
        }else{
            $model->create([
                "updated_date" => $date
            ]);
        }
        return $date;
    }

}