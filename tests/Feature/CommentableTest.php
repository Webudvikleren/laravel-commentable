<?php

use Illuminate\Database\Eloquent\Relations\MorphMany;
use Tests\Models\Post;
use Tests\Models\User;
use Webudvikleren\Commentable\Models\Comment;

it('has a comments morphMany relationship', function () {
    $post = Post::create(['title' => 'Test Post']);

    expect($post->comments())->toBeInstanceOf(MorphMany::class);
});

it('returns comments ordered by latest first', function () {
    $user = User::create(['name' => 'John']);
    $post = Post::create(['title' => 'Test Post']);

    $first = $post->comments()->create(['comment' => 'First', 'user_id' => $user->id]);

    // Ensure different timestamps
    $this->travel(1)->minutes();

    $second = $post->comments()->create(['comment' => 'Second', 'user_id' => $user->id]);

    $comments = $post->comments()->get();

    expect($comments->first()->id)->toBe($second->id)
        ->and($comments->last()->id)->toBe($first->id);
});

it('persists a comment created through the relationship', function () {
    $user = User::create(['name' => 'John']);
    $post = Post::create(['title' => 'Test Post']);

    $post->comments()->create([
        'comment' => 'A great post!',
        'user_id' => $user->id,
    ]);

    expect($post->comments)->toHaveCount(1)
        ->and($post->comments->first()->comment)->toBe('A great post!');

    $this->assertDatabaseHas('comments', [
        'comment' => 'A great post!',
        'commentable_type' => Post::class,
        'commentable_id' => $post->id,
        'user_id' => $user->id,
    ]);
});

it('can delete all comments for a commentable model', function () {
    $user = User::create(['name' => 'John']);
    $post = Post::create(['title' => 'Test Post']);

    $post->comments()->create(['comment' => 'Comment 1', 'user_id' => $user->id]);
    $post->comments()->create(['comment' => 'Comment 2', 'user_id' => $user->id]);

    expect(Comment::count())->toBe(2);

    $post->comments()->delete();

    expect(Comment::count())->toBe(0);
});
