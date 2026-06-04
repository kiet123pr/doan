<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Country extends Model
{
    use Notifiable;
    protected $table = "country";
    public $timestamps = false;

    protected $fillable = [
        'name'
    ];
}
