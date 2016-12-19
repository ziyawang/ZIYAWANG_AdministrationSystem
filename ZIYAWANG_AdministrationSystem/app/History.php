<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $connection='mysql_talk';
    protected $table = 'history';
    protected $primaryKey = 'NewsId';
}
