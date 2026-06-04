<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class history extends Model
{
    use Notifiable;
    protected $table = "history";
    public $timestamps = false;

    protected $fillable = [
        'name',
        'phone',
        'email',
        'id_user',
        'price'
    ];
}
