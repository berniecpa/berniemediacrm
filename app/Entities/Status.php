<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $fillable = ['name', 'color'];
    protected $table = 'status';
    public $timestamps = false;
}
