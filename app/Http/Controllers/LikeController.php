<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Like;

class LikeController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $items = \Auth::user()->likeItems()->latest()->paginate(5);
        return view('likes.index', [
            'title'=>'お気に入り一覧',
            'like_items' => $items,
            ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Store a newly created resource in storage.
     */
    // お気に入り追加処理
    public function store(LikeRequest $request)
    {
        $item = Like::create([
            
            'user_id' => \Auth::user()->id,
            'name' => $request->name,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'price' => $request->price,
        ]);
        session()->flash('success', 'お気に入りに追加しました');
        return redirect()->route('items.show', $item);
    }

    public function toggleLike($id){
          $user = \Auth::user();
          $item = Item::find($id);
 
          if($item->isLikedBy($user)){
              // お気に入りの取り消し
              $item->likes->where('user_id', $user->id)->first()->delete();
              \Session::flash('success', 'お気に入りを取り消しました');
          } else {
              // お気に入りを設定
              Like::create([
                  'user_id' => $user->id,
                  'item_id' => $item->id,
              ]);
              \Session::flash('success', 'お気に入りに追加しました');
          }
          return redirect('/items');
      }
    
}

    /**
     * Display the specified resource.
     */


    /**
     * Show the form for editing the specified resource.
     */
 
    /**
     * Update the specified resource in storage.
     */


    /**
     * Remove the specified resource from storage.
     */
