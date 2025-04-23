<?php

namespace App\Http\Controllers;

use App\Models\PostCategory;
use Illuminate\Http\Request;
use Flash;
use Modules\Common\app\Http\Controllers\BackendController;


class PostCategoryController extends BackendController
{
    /**
     * Display a listing of the PostCategory.
     */
    public function index()
    {
        $postCategories = PostCategory::paginate(10);
        return view('post_categories.index', compact('postCategories'));
    }

    /**
     * Show the form for creating a new PostCategory.
     */
    public function create()
    {
        return view('post_categories.create');
    }

    /**
     * Store a newly created PostCategory in storage.
     */
    public function store(Request $request)
    {
        $request['category_name'] = 'Nisha';
        $request['slug'] = 'Slug';
        $request['publish'] = 1;
        $request['is_reserved'] = 1;
        $input = $request->all();
        $postCategory = PostCategory::create($input);


        return redirect(route('cmsadmin.postCategories.index'))->with('Message you want show in View' );
    }

    /**
     * Display the specified PostCategory.
     */
    public function show($id)
    {
        $postCategory = PostCategory::find($id);

        if (empty($postCategory)) {
            Flash::error('PostCategory not found');
            return redirect(route('cmsadmin.postCategories.index'));
        }

        return view('post_categories.show')->with('postCategory', $postCategory);
    }

    /**
     * Show the form for editing the specified PostCategory.
     */
    public function edit($id)
    {
        $postCategory = PostCategory::find($id);

        if (empty($postCategory)) {
            Flash::error('PostCategory not found');
            return redirect(route('cmsadmin.postCategories.index'));
        }

        return view('post_categories.edit')->with('postCategory', $postCategory);
    }

    /**
     * Update the specified PostCategory in storage.
     */
    public function update($id, Request $request)
    {
        $postCategory = PostCategory::find($id);

        if (empty($postCategory)) {
            Flash::error('PostCategory not found');
            return redirect(route('cmsadmin.postCategories.index'));
        }

        $postCategory->update($request->all());

        Flash::success('PostCategory updated successfully.');

        return redirect(route('cmsadmin.postCategories.index'));
    }

    /**
     * Remove the specified PostCategory from storage.
     */
    public function destroy($id)
    {
        $postCategory = PostCategory::find($id);

        if (empty($postCategory)) {
            Flash::error('PostCategory not found');
            return redirect(route('cmsadmin.postCategories.index'));
        }

        $postCategory->delete();

        Flash::success('PostCategory deleted successfully.');

        return redirect(route('cmsadmin.postCategories.index'));
    }
}