<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trips extends Model
{
    use HasFactory;

    protected $table= 'trips';
    protected $guarded = [];

    public function deivers() {
        return $this->hasMany('App\Models\Drivers');
    }
    public function passengers() {
        return $this->hasMany('App\Models\Passengers');
    }
}
