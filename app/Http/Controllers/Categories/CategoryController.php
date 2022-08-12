<?php

namespace App\Http\Controllers\Categories;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoriesRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Repositories\CategoryInterface;
use App\Repositories\Eloquent\CategoryRepository;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    protected $categoriesRepository;

    public function __construct(CategoryRepository $CategoriesRepository)
    {
        $this->middleware('auth');
        $this->categoriesRepository = $CategoriesRepository;
    }
    public function index()
    {
        $list = $this->categoriesRepository->getCate();
        return view('pages.categories.index',[
            'title' => 'Categories List',
            'categories' => $list
        ]);
    }

    public function getAllCate(){
        $list = $this->categoriesRepository->getCate();
        return CategoryResource::collection($list);
    }

    public function create()
    {
        return view('pages.categories.create', [
            'title' => 'Create a Category'
        ]);
    }
    public function store(StoreCategoriesRequest $request)
    {
        $this->categoriesRepository->store($request->all());
        return back()->withStatus('Your category has been added successfully');
    }

    public function show(Category $category)
    {
        //
    }
    public function edit(Category $category)
    {
        $cate = $this->categoriesRepository->find($category->id);
        return view('pages.categories.edit', [
            'title' => 'Edit Category '.$cate->name,
            'cate' => $cate
        ]);
    }
    public function update(StoreCategoriesRequest $request, Category $category)
    {
        $data = $request->all();
        $cate_update = $this->categoriesRepository->update($category->id, $data);
        if($cate_update){
            return back()->withStatus('Your category has been updated successfully');
        }
        return back()->withErrors('Your category has been updated failed');
    }
    public function destroy(Category $category)
    {
        $result = $this->categoriesRepository->delete($category->id);
        if($result){
            return response()->json([
                'message' => 'Your category has been deleted successfully'
            ]);
        }else{
            return response()->json([
                'message' => 'Your category has been deleted failed'
            ]);
        }
    }
}
