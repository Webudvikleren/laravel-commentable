<?php

it('merges the commentable config', function () {
    expect(config('commentable'))->toBeArray()
        ->and(config('commentable.comment_model'))->not->toBeNull()
        ->and(config('commentable.user_model'))->not->toBeNull()
        ->and(config('commentable.comments_table'))->toBe('comments')
        ->and(config('commentable.load_migrations'))->toBeTrue();
});
