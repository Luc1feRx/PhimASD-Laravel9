<?php
namespace App\Repositories;

interface RepositoriesInterface
{
    //paginate
    public function getPaginated($itemOnPage);
    //get list
    public function getAll();

    //store data
    public function store(array $data);

    //find data
    public function find($id);

    public function update($id, array $attributes);

    public function delete($id);
    
}
