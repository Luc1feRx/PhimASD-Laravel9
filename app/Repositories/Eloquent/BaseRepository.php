<?php

namespace App\Repositories\Eloquent;

use App\Repositories\RepositoriesInterface;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository implements RepositoriesInterface
{
    protected $model;
    public function __construct()
    {
        $this->setModel();
    }

    abstract public function getModel();

    public function setModel()
    {
        $this->model = $this->getModel();
    }

    public function getPaginated($itemOnPage){
        return $this->model->paginate($itemOnPage);
    }

    //get list
    public function getAll()
    {
        return $this->model->all();
    }

    //store data
    public function store(array $data)
    {
        return $this->model::create($data);
    }

    //find data
    public function find($id)
    {
        $result = $this->model::findOrFail($id);
        return $result;
    }

    public function update($id, array $data)
    {
        $result = $this->model::findOrFail($id);
        if($result){
            $result->update($data);
            return $result;
        }
        return false;
    }

    public function delete($id)
    {
        $result = $this->model::findOrFail($id);
        if($result){
            $result->delete();
            return $result;
        }
        return false;
    }
}
