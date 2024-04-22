<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\User;
use App\Models\Category;
use App\Models\Order;
use App\Http\Requests\ItemEditRequest;
use App\Http\Requests\ItemRequest;
use App\Http\Requests\ItemImageRequest;
use App\Services\FileUploadService;

class ItemController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    
    public function index()
    {
        $user = \Auth::user();
        $items = Item::where('user_id', '!=', $user->id)->latest()->paginate(5);
        return view('items.index', [
            'title'=>'美味しいものを買おう♪',
            'items' => $items,
        ]);
    }
    
    public function create()
    {
        return view('items.create',[
            'title' => '商品を出品' ,
            'categories' => Category::all(),
        ]);
    }
    
    public function store(ItemRequest $request, FileUploadService $service)   
    {
        $path = $service->saveImage($request->file('image'));
        
        $item = Item::create([
            'user_id' => \Auth::user()->id,
            'name' => $request->name,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'image' => $path, //ファイルパスを保存
        ]);
        session()->flash('success', '商品を出品しました');
        return redirect()->route('items.show', $item);
    }

     // 商品詳細画面
    public function show($id)
    {
        $item = Item::find($id);
        if ($item === null) {                               // Item::find($id) で該当する商品が存在しなければ、$itemにはnullが入ります。
        return back()->withErrors('その商品はありません');  // Laravelのback()関数は、直前のページに戻る処理を行います。withErrors()は、セッションにエラーメッセージを保存する処理です。
    }
        return view('items.show', [
            'title' => '商品詳細',
            'item' => $item,
        ]);
    }
    
     //購入確認画面
    public function confirm($id) {
        $item = Item::find($id);
        return view('items.confirm', [
            'item' => $item,
            'title' => '購入確認',
        ]);
    }
    
     //購入完了画面
    public function finish($id) {
        $item = Item::find($id);
        if ($item->isSoldout()) {
            return redirect()->route('items.show', $id)->withErrors('申し訳ありません。ちょっと前に売り切れました。');
    }
        Order::create([
            'user_id' => \Auth::id(),
            'item_id' => $id,
        ]);
       
        return view('items.finish', [
            'title' => 'ご購入ありがとうございました。',
            'item' => $item,
        ]);
    }


    public function edit(Item $item)
    {
        return view('items.edit',[
            'title' => '商品情報の編集',
            'categories' => Category::all(),
            'item' => $item,
        ]);
    }

    public function update(ItemEditRequest $request, $id)
    {
        $items = Item::find($id);
        $items->update($request->only(['description','price', 'category_id', 'name']));
        session()->flash('success', '出品しました');
        return redirect()->route('items.show', $id);
    }

    public function destroy($id)
    {
        $items = Item::find($id);
        $items ->delete();
        \Session::flash('success', '商品を削除しました');
        return redirect()->route('items.index');
    }
    
    public function editImage($id)
    {
        $item = Item::find($id);
        return view('items.edit_image',[
            'title' => '商品画像の変更',
            'item' => $item,
        ]);
    }
    
    public function updateImage($id, ItemImageRequest $request, FileUploadService $service)
        {
          
        //画像投稿処理
        $path = '';
        $image = $request->file('image');
          
        if(isset($image) === true){
              // publicディスク(storage/app/)のphotosディレクトリに保存
        $path = $image->store('photos', 'public');
        }
          
        $items = Item::find($id);
          
          // 変更前の画像の削除
        if($items->image !== ''){
              // publicディスクから、該当の投稿画像($user->image)を削除
              \Storage::disk('public')->delete(\Storage::url($items->image));
        }
          
        $items->update([
            'image' => $path, //ファイル名を保存
        ]);
          
        session()->flash('success', '画像を変更しました！');
        return redirect()->route('items.show', $id);
        }
      
        private function saveImage($image){
                // 画像投稿処理
        $path = '';
        if(isset($image) === true){
               // publicディスク(storage/app/)のphotosディレクトリに保存
           $path = $image->store('photos', 'public');
        }
            return $path;; // 画像が存在しない場合は空文字
        }

}
