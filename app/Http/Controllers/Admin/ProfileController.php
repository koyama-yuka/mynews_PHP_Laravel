<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Profile; //Model

class ProfileController extends Controller
{
    //add Action
    public function add(){
        return view('admin.profile.create');
    }
    
    // create Action
    public function create(Request $request){
        
        //Varidationを行う
        $this->validate($request, Profile::$rules);
        
        $profiles = new Profile;
        $form = $request->all();
        
        unset($form['_token']);
        
        //データベースに保存
        $profiles->fill($form);
        $profiles->save();
        
        return redirect('admin/profile/create');
    }
    
    // edit Action
    public function edit(Request $request){
        $profiles = Profile::find($request->id);
        if (empty($profiles)){
            abort(404);
        }
        return view('admin.profile.edit', ['profile_form' => $profiles]);
    }
    
    // update Action
    public function update(Request $request){
        
        //validationをかける
        $this->validate($request, Profile::$rules);
        
        //Profile Modelからデータ取得
        $profiles = Profile::find($request->id);
        
        //送信されてきたフォームデータを格納
        $profile_form = $request->all();
        
        unset($profile_form['_token']);
        
        //上書き保存
        $profiles->fill($profile_form)->save();
        
        $id = $profile_form['id'];

        return redirect('admin/profile/edit?id='.$profile_form['id']); //更新したプロフィールの画面に戻ってくる
    }
}
