<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Comment Model
    |--------------------------------------------------------------------------
    |
    | If you want to use your own custom Comment model, you can override it here.
    | The model must extend Webudvikleren\Commentable\Models\Comment.
    |
    */

    'comment_model' => Webudvikleren\Commentable\Models\Comment::class,

    /*
    |--------------------------------------------------------------------------
    | User Model
    |--------------------------------------------------------------------------
    |
    | Define the user model that will be related to each comment.
    | Usually, this is App\Models\User — but you can customize it.
    |
    */

    'user_model' => App\Models\User::class,

    /*
    |--------------------------------------------------------------------------
    | Table Name
    |--------------------------------------------------------------------------
    |
    | If you want to customize the table name used for comments, change it here.
    | Make sure to also update the migration if needed.
    |
    */

    'comments_table' => 'comments',

    /*
    |--------------------------------------------------------------------------
    | Load Default Migrations
    |--------------------------------------------------------------------------
    |
    | Set this to false if you want to disable the package's default migrations.
    | You can then publish and modify them yourself.
    |
    */

    'load_migrations' => true,

];
