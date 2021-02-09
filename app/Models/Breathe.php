<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Breathe extends Model
{
    protected $fillable  = [
        'name','status','Start_time','duration','hour','min','sec'
    ];

    protected $casts = [
        'Start_time' => 'datetime'
    ];



    public static function checkStatus(){
       $row =  Breathe::latest()->first();
       if($row)
           return $row->status;
        else
            return 1;
    }
}
