<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\NewsCategory;
use App\News;
use Session;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view("news.list", ['news' => News::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view("news.create", ['categories' => NewsCategory::all()]);
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
          'title' => 'required|string|max:60|unique:news',
          'text' => 'required|string|max:2500',
          'attach' => 'image:jpg,png'
        ]);

        $news = new News();
        $news->user_id = $request->input('user_id');
        $news  = $this->update_create($request, $news);

        $news->save();

        return redirect()->route('news.index')->with(['message_success' => 'News successful added']);
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
        $news = News::find($id);

        if ($news->user_id != (Session::get('user'))->id && !(Session::get('user'))->is_admin()) {
            return redirect()->route("news.index")->with(["message_danger" => "You don't access to this page!"]);
        }

        return view("news.edit", ["news" => $news, 'categories' => NewsCategory::all()]);
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
        $news = News::find($id);

        if ($news->user_id != (Session::get('user'))->id && !(Session::get('user'))->is_admin()) {
            return redirect()->route("news.index")->with(["message_danger" => "You don't access to this page!"]);
        }

        $request->validate([
          'title' => 'required|string|max:60|unique:news,title,'.$id,
          'text' => 'required|string|max:2500',
          'attach' => 'image:jpg,png'
        ]);

        $news = News::find($id);
        $news  = $this->update_create($request, $news);

        $news->save();

        return redirect()->route('news.index')->with(['message_success' => 'News successful added']);
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
        $news = News::find($id);

        if ($news->user_id != (Session::get('user'))->id && !(Session::get('user'))->is_admin()) {
            return redirect()->route("news.index")->with(["message_danger" => "You don't access to delete this news!"]);
        }

        if (!empty($news->img)) {
            Storage::delete('public/'.$news->img);
        }
        $news->delete();

        return redirect()->back()->with(['message_success' => "News was removed"]);
    }

    /**
     * Same functions for update and store.
     *
     * @param  Request  $request
     * @param  News  $news
     * @return News  $news
     */
    private function update_create(Request $request, News $news)
    {
        //
        $news->category_id = $request->input('category_id');
        $news->title = $request->input('title');
        $news->text = $request->input('text');

        if ($request->hasFile('attach')) {
            if (!empty($news->img)) {
                Storage::delete('public/'.$news->img);
            }

            $filename = time().".".$request->file('attach')->getClientOriginalExtension();
            $request->file('attach')->storeAs('public/', $filename);
            $news->img = $filename;
        }

        return $news;
    }
}
