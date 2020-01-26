<?php

namespace App\Http\Controllers\Admin;

use App\Article;
use App\Language;
use App\Rules\ArrayValid;
use App\Rules\UniqueUpdateValid;
use App\Rules\UniqueValid;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $articles = Article::orderBy('id','desc') -> get();
        return view('admin.article.index')-> with([
            'articles' => $articles,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $locales = Language::all();
        return view('admin.article.create')->with([
            'locales'=>$locales,
        ]);
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
            'title' => new ArrayValid,
            'text' => new ArrayValid,
            'image' => 'required',
            'slug'=> [new UniqueValid,new ArrayValid],
            'subtitle'=>new ArrayValid,
        ]);

//image upload
        $image=$request->file('image');
        $image_name=uniqid().'.'.$image->getClientOriginalExtension();
        $image->move('uploads/article',$image_name);



        $article=new Article();
        $article->title=$request->title;
        $article->text=$request->text;
        $article->image=$image_name;
        $article->slug=$request->slug;
        $article->subtitle=$request->subtitle;
        $article->save();


        return redirect()->route('article.index')
            ->with('success', 'Article added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show(Article $article)
    {
        return view('admin.article.show', compact('article'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        $locales = Language::all();
        return view('admin.article.edit', compact('article', 'locales'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {



        $request->validate([
            'title' => new ArrayValid,
            'text' => new ArrayValid,
            'slug'=>[new ArrayValid, new UniqueUpdateValid($article->id)],
            'subtitle' => [new ArrayValid],
        ]);



        $image_name=$article->image;

        if($request->hasFile('image')){

            $image=$request->file('image');
            $image_name=uniqid().'.'.$image->getClientOriginalExtension();
            $image->move('uploads/article',$image_name);

            $old_image=$article->image;
            if(File::exists('uploads/article/'.$old_image)){
                File::delete('uploads/article/'.$old_image);
            }
        }


        if($request->is_active){
            $article->is_active =1;
        }
        else{
            $article->is_active =0;
        }
        $article->text = $request->text;
        $article->title = $request->title;
        $article->subtitle = $request->subtitle;
        $article->slug = $request->slug;
        $article->image=$image_name;
        $article->save();
//        $faq->update($request->all());

        return redirect()->route('article.index')
            ->with('success', 'Article successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function activate(Request $request)
    {
        $article = Article::find($request->id);
        $article->is_active = !$article->is_active;
        $article->save();
    }


    public function destroy(Article $article)
    {
        $image=$article->image;
        if(File::exists('uploads/article/'.$image)){
            File::delete('uploads/article/'.$image);
        }

        $article->delete();


        return redirect()->route('article.index')
            ->with('success','Article deleted successfully');
    }
}
