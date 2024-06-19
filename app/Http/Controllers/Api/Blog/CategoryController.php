<?php

namespace App\Http\Controllers\Api\Blog;

use App\Http\Controllers\Blog\BaseController;
use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use Illuminate\Http\Request;

class CategoryController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $page = $request->input('page', 1);
        $perPage = $request->input('per_page', 100);

        return BlogCategory::with(['parentCategory'])->paginate($perPage, ['*'], 'page', $page);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $result = BlogCategory::create($request->input());

        if ($result)
            return $result;

        return http_response_code(400);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return BlogCategory::with(['parentCategory'])->find($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $item = BlogCategory::find($id);

        if (empty($item))
            return http_response_code(400);

        $data = $request->all();

        $result = $item->update($data);

        if ($result)
            return $result;

        return http_response_code(400);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        BlogCategory::destroy($id);
        return http_response_code(200);
    }
}
