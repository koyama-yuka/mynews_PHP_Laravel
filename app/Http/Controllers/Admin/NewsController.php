<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\News; //Model
use App\History; //Model

use Carbon\Carbon;
use Storage;

class NewsController extends Controller
{
    //add Action
    public function add(){
        return view('admin.news.create'); // resources/views/admin/news/create.blade.phpを返す
    }
    
    
    // create Action
    public function create(Request $request){
        
        //Varidationを行う
        $this->validate($request, News::$rules);
        
        $news = new News;
        $form = $request->all();
        
        //フォームから画像が送信されてきたら、保存して、$news->image_path　に画像のパスを保存する
        if (isset($form['image'])){
            $path = Storage::disk('s3')->putFile('/',$form['image'],'public');
            $news->image_path = Storage::disk('s3')->url($path);
        } else {
            $news->image_path = null;
        }
        
        //フォームから送信されてきた_tokenを削除する
        unset($form['_token']);
        //フォームから送信されてきたimageを削除する
        unset($form['image']);
        
        //データベースに保存する
        $news->fill($form);
        $news->save();
        
        // admin/news/createにリダイレクトする
        return redirect('admin/news/create');
    }
    
    
    // index Action
    public function index(Request $request){
        
        $cond_title = $request->cond_title;
        if ($cond_title !=''){
            //検索されたら検索結果を取得する
            $posts = News::where('title', $cond_title)->get();
        } else{
            //それ以外はすべてのニュースを取得する
            $posts = News::all();
        }
        return view('admin.news.index', ['posts' => $posts, 'cond_title' => $cond_title]);
    }
    
    
    //edit Action
    public function edit(Request $request){
        
        //News Modelからデータを取得
        $news = News::find($request->id);
        
        if (empty($news)){
            abort(404);
        }
        return view('admin.news.edit', ['news_form' => $news]);
    }
    
    
    //update Action
    public function update(Request $request){
        
        //validationをかける
        $this->validate($request, News::$rules);
        
        //News Modelからデータを取得
        $news = News::find($request->id);
        
        //送信されてきたフォームデータを格納
        $news_form = $request->all();
        
        //更新する際にフォームから画像が送信されてきたら、保存して、$news_form['image_path']　に画像のパスを保存する
        if ($request->remove == 'true'){ //削除だったらnull
            $news_form['image_path'] = null;
        } elseif ($request->file('image')) { //新しい画像があればパス保存
            $path = Storage::disk('s3')->putFile('/',$news_form['image'],'public');
            $news->image_path = Storage::disk('s3')->url($path);
        } else { //そのままだったら取得したデータのパス
            $news_form['image_path'] = $news->image_path;
        }
        
        unset($news_form['image']);
        unset($news_form['remove']);
        unset($news_form['_token']);
        
        //該当するデータを上書きして保存
        $news->fill($news_form)->save();
        
        $history = new History;
        $history->profile_id = 0; //news_idと重複しないために0代入
        $history->news_id = $news->id;
        $history->edited_at = Carbon::now();
        $history->save();
        
        return redirect('admin/news/');
    }
    
    
    //delete Action
    public function delete(Request $request){
        
        //News Modelからデータを取得
        $news = News::find($request->id);
        
        //削除する
        $news->delete();
        
        return redirect('admin/news/');
    }
}
