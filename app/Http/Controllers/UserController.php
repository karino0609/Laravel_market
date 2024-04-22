<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Requests\UserImageRequest;
use App\Services\FileUploadService;

use App\User;


class UserController extends Controller
{
    public function show() {
        $user = \Auth::user();
        return view('users.index', [
            'title'=>'プロフィール',
            'user'=>$user,
            ]);
    }
    
    public function edit() {
        $user = \Auth::user();
        return view('users.edit',[
            'title'=>'プロフィール編集',
            'user'=>$user,
        ]);
    }
    
    public function update(UserRequest $request) {
        $user = \Auth::user();
        $user->update($request->only(['name', 'profile']));
        
        session()->flash('success', 'プロフィールを変更しました');
        return redirect()->route('users.show', $user);
    }
    
    public function editImage() {
        $user = \Auth::user();
        return view('users.edit_image',[
            'title'=>'プロフィール画像編集',
            'user'=>$user,
        ]);
    }
    
    public function updateImage(UserImageRequest $request, FileUploadService $service) {
        $user = \Auth::user();
        $path = $service->saveImage($request->file('image'));
        
        if($user->image !== '') {
            \Storage::disk('public')->delete($user->image);
        }
        $user->update([
            'image' => $path,   
        ]);
        
        session()->flash('success', 'プロフィール画像を変更しました');
        return redirect()->route('users.show', $user);
        
    }
    
    //出品商品一覧
    public function exhibitions($id) {
        $user = \Auth::user();
        $items = $user->items()->latest()->get();
        return view('items.exhibitions', [
            'title'=>'出品商品一覧',
            'items' => $items,
            ]);
    }
}
