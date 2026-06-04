<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Brand extends Model
{
    use Notifiable;
    protected $table = "brand";
    public $timestamps = false;

    protected $fillable = [
        'brand'
    ];
}
