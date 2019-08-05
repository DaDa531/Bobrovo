<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded  = [];


    public function canDelete()
    {
        return true;
        //nikto ho este neriesil
    }

    /**
     * Return date in string format d. m. Y
     * @return string
     */
    public function dateToString($date) {
        return date('d. m. Y H : i' , $date->getTimestamp());
    }
}
