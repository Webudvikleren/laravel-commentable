<?php

namespace Tests\Models;

use Illuminate\Database\Eloquent\Model;
use Webudvikleren\Commentable\Traits\Commentable;

class Post extends Model
{
    use Commentable;

    protected $guarded = [];
}
