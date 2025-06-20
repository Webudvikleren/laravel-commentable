# Laravel Commentable

[![Latest Version on Packagist](https://img.shields.io/packagist/v/webudvikleren/laravel-commentable.svg?style=flat-square)](https://packagist.org/packages/webudvikleren/laravel-commentable)
[![Total Downloads](https://img.shields.io/packagist/dt/webudvikleren/laravel-commentable.svg?style=flat-square)](https://packagist.org/packages/webudvikleren/laravel-commentable)
[![License](https://img.shields.io/github/license/webudvikleren/laravel-commentable.svg?style=flat-square)](https://github.com/webudvikleren/laravel-commentable/blob/main/LICENSE)

**Laravel Commentable** adds a simple way to allow comments on any Eloquent model. It's modern, lightweight, and compatible with Laravel 10 and 11.

## Features

- Add comments to any Eloquent model
- Polymorphic relationship
- User tracking (via `user_id`)
- Publishable migration and config
- Clean and extensible architecture
- Compatible with Laravel 10 & 11

## Installation

```bash
composer require webudvikleren/laravel-commentable
```

### Publish the migration (optional)
```bash
php artisan vendor:publish --tag=commentable-config
php artisan vendor:publish --tag=commentable-migrations
php artisan migrate
```

If you don’t publish the migration, Laravel will auto-load it from the package.

## Usage
### Step 1: Add the trait to your model
```php
use Webudvikleren\Commentable\Traits\Commentable;

class Post extends Model
{
    use Commentable;
}
```

### Step 2: Add comments
```php
$post = Post::find(1);

$post->comments()->create([
    'body' => 'This is a comment.',
    'user_id' => auth()->id(),
]);
```

### Step 3: Access comments
```php
foreach ($post->comments as $comment) {
    echo $comment->body;
}
```

## Comment Model
By default, comments are stored in the `comments` table and use the provided `Webudvikleren\Commentable\Models\Comment` model.

You can override this in your app if needed by extending the model and binding it in a service provider.

## Configuration
You can publish the config file to override defaults:

```bash
php artisan vendor:publish --tag=commentable-config
```

Example config/commentable.php (coming soon).


## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.