<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Cmt extends Model
{
    use Notifiable;
    protected $table = "cmt";
    public $timestamps = true;

    protected $fillable = [
        'id_blog',
        'id_user',
        'name_user',
        'cmt',
        'avatar',
        'level'
    ];
}
