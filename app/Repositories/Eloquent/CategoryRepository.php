<?php

namespace App\Repositories\Eloquent;

use App\Models\Category;
use App\Repositories\CategoryInterface;
use App\Repositories\Eloquent\BaseRepository;

class CategoryRepository extends BaseRepository implements CategoryInterface{

    public function getModel(){
        return Category::class;
    }

    public function getCate()
    {
        return $this->model::orderBy('id', 'desc')->paginate(10);
    }


}