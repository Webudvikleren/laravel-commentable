<?php

namespace Tests\Models;

use Illuminate\Database\Eloquent\Model;
use Webudvikleren\Commentable\Traits\HasComments;

class User extends Model
{
    use HasComments;

    protected $guarded = [];
}
