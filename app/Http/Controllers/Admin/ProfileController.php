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
    public function edit(){
        return view('admin.profile.edit');
    }
    
    // update Action
    public function update(){
        return redirect('admin/profile/edit');
    }
}
