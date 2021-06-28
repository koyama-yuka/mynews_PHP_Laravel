<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\HTML;

use App\Profile;

class ProfileController extends Controller
{
    public function index(Request $request){
        
        $id = 1;
        $admin_users = Profile::find($id);
        
             if ($admin_users->gender == 1){
                $admin_users->gender = '男性';
            } elseif ($admin_users->gender == 2){
                $admin_users->gender = '女性';
            } elseif ($admin_users->gender == 3) {
                $admin_users->gender = 'ひみつ♪';
            } else {
                $admin_users->gender = 'ひみつ♪';
            }
            
        
        return view('profile.index', ['admin_users' => $admin_users]);
    }
}
