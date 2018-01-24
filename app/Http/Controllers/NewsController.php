<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\NewsCategory;
use App\News;
use Session;

class NewsController extends Controller
{
    public function test(){

      
    }
    /**
     * Display a listing of the resource with pagination and sorting and filter.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //

        $query  = News::query();
        if ($request->get('sortby') == "dateup") {
            $query->orderBy('created_at', 'desc');
        }
        if ($request->get('sortby') == "datedown") {
            $query->orderBy('created_at', 'asc');
        }
        if ($request->get('sortby') == "titleup") {
            $query->orderBy('title', 'desc');
        }
        if ($request->get('sortby') == "titledown") {
            $query->orderBy('title', 'asc');
        }

        if ($request->get('category') != null && $request->get('category') != 0) {
            $query->where('category_id', $request->get('category'));
        }

        if ($request->get('onlyphoto') == 1) {
            $query->whereNotNull('img');
        }

        if ($request->has('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' .$request->get('search'). '%')
                ->orWhere('text', 'like', '%' .$request->get('search'). '%');
            });
        }

        $list_news = $query->with('user')->paginate(3)->appends($request->except('page'));

        return view("news.list_for_user", ['list_news' => $list_news, 'categories' => NewsCategory::all()]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_admin()
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
        return view("news.show", ['news' => News::find($id)]);
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
