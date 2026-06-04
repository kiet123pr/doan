<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Rate extends Model
{
    use Notifiable;
    protected $table = "stars";
    public $timestamps = true;

    protected $fillable = [
        'id_blog',
        'id_user',
        'rate'
    ];
}
