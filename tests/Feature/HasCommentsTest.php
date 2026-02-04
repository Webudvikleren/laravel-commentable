<?php

use Illuminate\Database\Eloquent\Relations\HasMany;
use Tests\Models\Post;
use Tests\Models\User;
use Webudvikleren\Commentable\Models\Comment;

it('has a comments hasMany relationship', function () {
    $user = User::create(['name' => 'John']);

    expect($user->comments())->toBeInstanceOf(HasMany::class);
});

it('can retrieve all comments made by a user', function () {
    $user = User::create(['name' => 'John']);
    $post = Post::create(['title' => 'Test Post']);

    $post->comments()->create(['comment' => 'Comment 1', 'user_id' => $user->id]);
    $post->comments()->create(['comment' => 'Comment 2', 'user_id' => $user->id]);

    expect($user->comments)->toHaveCount(2);
});

it('cascades delete when a user is deleted', function () {
    $user = User::create(['name' => 'John']);
    $post = Post::create(['title' => 'Test Post']);

    $post->comments()->create(['comment' => 'Comment 1', 'user_id' => $user->id]);

    expect(Comment::count())->toBe(1);

    $user->delete();

    expect(Comment::count())->toBe(0);
});
