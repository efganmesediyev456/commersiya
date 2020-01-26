<?php

namespace App\Http\Controllers\Admin;

use App\Content;
use App\Language;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use function GuzzleHttp\Promise\all;

class ContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contents = Content::orderby('id', 'desc')->get();
        return view('admin.content.index', compact('contents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $locales = Language::all();
        return view('admin.content.create', compact('locales'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|array|min:1',
            'text' => 'required|array|min:1',
            'icon' => 'required',
        ]);

        $content = new Content();
        if($request->is_active){
            $content->is_active =1;
        }
        else{
            $content->is_active =0;
        }
        $content->title= $request->title;
        $content->text = $request->text;
        $content->icon = $request->icon;
        $content->save();
        return redirect()->route('content.index')->with('success', 'Content added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Content $content)
    {
        return view('admin.content.show', compact('content'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Content $content)
    {
        $locales = Language::all();
        return view('admin.content.edit', compact('locales', 'content'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Content $content)
    {
        $request->validate([
            'title' => 'required|array|min:1',
            'text' => 'required|array|min:1',
            'icon' => 'required',
        ]);

        if($request->is_active){
            $content->is_active =1;
        }
        else{
            $content->is_active =0;
        }
        $content->title= $request->title;
        $content->text = $request->text;
        $content->icon = $request->icon;
        $content->save();

        return redirect()->route('content.index')
            ->with('success', 'Content successfully updated');
    }

    public function activate(Request $request)
    {
        $content = Content::find($request->id);
        $content->is_active = !$content->is_active;
        $content->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Content $content)
    {
        $content->delete();
        return redirect()->route('content.index')
            ->with('success','Content deleted successfully');
    }
}
