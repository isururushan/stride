<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Passengers extends Model
{
    use HasFactory;

    protected $tasble= 'passengers';

    protected $guarded = [];
}
