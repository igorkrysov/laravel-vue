<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\NewsCategory;
use Session;
use Response;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view("news_categories.categories", ['categories' => NewsCategory::all()]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get_list()
    {
        //
        return NewsCategory::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view("news_categories.new");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
          'category' => 'required|string|max:100|unique:news_categories'
        ]);

        $category = new NewsCategory();
        $category->category = $request->input('category');
        $category->user_id = $request->input('user_id');
        $category->save();

        //return redirect()->back()->with(['message_success' => 'Category successful added']);
        return Response::json(['message_success' => 'Category successful added']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $category = NewsCategory::find($id);

        if ($category->user_id != (Session::get('user'))->id && !(Session::get('user'))->is_admin()) {
            return redirect()->route("category.index")->with(["message_danger" => "You don't access to this page!"]);
        }

        return view("news_categories.edit", ["category" => NewsCategory::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
          'category' => 'required|string|max:100|unique:news_categories,category,'.$id
        ]);

        $category = NewsCategory::find($id);

        if ($category->user_id != (Session::get('user'))->id && !(Session::get('user'))->is_admin()) {
            return Redirect()->route("category.index")->with(["message_danger" => "You don't access to this page!"]);
        }

        $category->category = $request->input('category');
        $category->save();

        return Response::json(['message_success' => 'Category successful updated']);
        //return redirect()->route('category.index')->with(['message_success' => 'Category successful updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $category = NewsCategory::find($id);

        if ($category->user_id != (Session::get('user'))->id && !(Session::get('user'))->is_admin()) {
            return redirect()->route("category.index")->with(["message_danger" => "You don't access to this page!"]);
        }

        NewsCategory::destroy($id);

        return Response::json(['message_success' => 'Category successful removed']);
        //return redirect()->back()->with(['message_success' => "Category was removed"]);
    }
}
