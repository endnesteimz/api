<?php

namespace App\Http\Controllers\Api\Categories;

use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Tutorials\TutorialResource;
use App\Models\Category;
use App\Http\Requests\Category\CategoryStoreRequest;
use App\Http\Requests\Category\CategoryUpdateRequest;
use App\Http\Controllers\Controller;
use App\Models\Tutorial;

class CategoriesController extends Controller
{

    public function index()
    {
        return CategoryResource::collection(Category::where('parent_id',0)->with('children')->paginate(25));
    }

    /**
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryStoreRequest $request)
    {
        try {
            $parentID = $request->parent_id ?? 0;
            $category = Category::create([
                'name' => $request->name,
                'icon' => $request->icon,
                'parent_id'=>$parentID,
            ]);

            return new CategoryResource($category);

        } catch(\Exception $exception) {
            return response([
                'status' => 'error',
                'message' => "Error: Category not created!, please try again. - {$exception->getMessage()}"
            ], 500);
        }
    }

    /**
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::findOrfail($id);

        return new CategoryResource($category);
    }

    /**
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryUpdateRequest $request, Category $category)
    {
        try {

            $category->update($request->only(['name','icon','parent_id']));

            return new CategoryResource($category);

        } catch(\Exception $exception) {
            return response([
                'status' => 'error',
                'message' => "Error: Category not updated!, please try again. - {$exception->getMessage()}"
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrfail($id);
        if ($category) {
            $parentCategories = Category::parent($category->id);
            if ($parentCategories->exists()) {
                $parentCategories->delete();
            }
        }
        $category->delete();

        return response()->json(null, 204);
    }

    public function tutorialList($id)
    {
        return TutorialResource::collection(Tutorial::where('category_id',$id)->get());
    }

}
