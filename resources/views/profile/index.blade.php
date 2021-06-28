@extends('layouts.front')
@section('title', 'プロフィール')

@section('content')
    <div class="container">
        <hr color="#c0c0c0">
        <div class="row">
            <div class="headline col-md-10 mx-auto">
                <h2>プロフィール</h2>
            </div>
        </div>
        
        <div class="profile">  
            <div class="row">
                <div class="col-4">
                    <h3>名前</h3>
                </div>
                <div class="col-8">
                    <h3>{{ $admin_users->name }}</h3>
                </div>
            </div>
            
            <div class="row">
                <div class="col-4">
                    <h3>性別</h3>
                </div>
                <div class="col-8">
                    <h3>{{ $admin_users->gender }}</h3>
                </div>
            </div>
        
            <div class="row">
                <div class="col-4">
                    <h3>趣味</h3>
                </div>
                <div class="col-8">
                    <h3>{{ $admin_users->hobby }}</h3>
                </div>
            </div>
        
            <div class="row">
                <div class="col-4">
                    <h3>自己紹介</h3>
                </div>
                <div class="col-8">
                    <h3>{{ $admin_users->introduction }}</h3>
                </div>
            </div>
        </div>
    </div>
@endsection