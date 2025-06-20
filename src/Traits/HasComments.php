<?php

namespace Webudvikleren\Commentable\Traits;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Webudvikleren\Commentable\Models\Comment;

trait HasComments
{
    /**
     * Get all comments made by this model (usually a User).
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class, 'user_id');
    }
}
