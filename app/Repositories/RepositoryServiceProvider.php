<?php
namespace App\Repositories;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Eloquent\CategoryRepository;
use App\Repositories\CategoryInterface;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\RepositoriesInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(CategoryInterface::class, CategoryRepository::class);
    }
}
