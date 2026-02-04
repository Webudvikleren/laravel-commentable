<?php

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Tests\Models\Post;
use Tests\Models\User;
use Webudvikleren\Commentable\Models\Comment;

it('belongs to a user', function () {
    $user = User::create(['name' => 'John']);
    $post = Post::create(['title' => 'Test Post']);

    $comment = $post->comments()->create([
        'comment' => 'Nice!',
        'user_id' => $user->id,
    ]);

    expect($comment->user())->toBeInstanceOf(BelongsTo::class)
        ->and($comment->user->id)->toBe($user->id);
});

it('has a polymorphic commentable relationship', function () {
    $user = User::create(['name' => 'John']);
    $post = Post::create(['title' => 'Test Post']);

    $comment = $post->comments()->create([
        'comment' => 'Nice!',
        'user_id' => $user->id,
    ]);

    expect($comment->commentable())->toBeInstanceOf(MorphTo::class)
        ->and($comment->commentable)->toBeInstanceOf(Post::class)
        ->and($comment->commentable->id)->toBe($post->id);
});

it('stores the correct commentable_type and commentable_id', function () {
    $user = User::create(['name' => 'John']);
    $post = Post::create(['title' => 'Test Post']);

    $comment = $post->comments()->create([
        'comment' => 'Nice!',
        'user_id' => $user->id,
    ]);

    $fresh = Comment::find($comment->id);

    expect($fresh->commentable_type)->toBe(Post::class)
        ->and($fresh->commentable_id)->toBe($post->id);
});
