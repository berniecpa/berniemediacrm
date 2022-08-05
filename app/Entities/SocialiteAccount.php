<?php

namespace App\Entities;

use App\Traits\BelongsToUser;
use Illuminate\Database\Eloquent\Model;

class SocialiteAccount extends Model
{
    use BelongsToUser;

    protected $fillable = ['user_id', 'provider_user_id', 'provider'];
}
