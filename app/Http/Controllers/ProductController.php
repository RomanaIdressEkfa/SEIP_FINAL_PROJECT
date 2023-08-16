<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Exception;
// use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Session;
// use Spatie\Backtrace\File;
use File;

class ProductController extends Controller
{
    public function index(){
        $products=Product::all();
        return view('backend.layouts.products.index',compact('products'));
    }


    public function create(){
        return view('backend.layouts.products.create');
    }


    public function store(Request $request){

//ONLY for data show---->START CODE//

        // try{
        //     $data = $request->all();
        //     Product::create($data);
        //     return redirect()->route('index');
        // }catch(Exception $e){
        //     dd($e->getMessage());
        // }

        //ONLY for data show---->END CODE//

        //for image and data show---->START CODE//

        $request->validate([
            'name'=>'required',
            'image'=>'required|mimes:png,jpg,jpeg',
            'price'=>'required',
        ]);
        $imageName='';
        if($image=$request->file('image')){
            $imageName=time().'-'.uniqid().'.'.$image->getClientOriginalExtension();
            $image->move('images/products',$imageName);
        }

        Product::create([
            'name'=>$request->name,
            'image'=>$imageName,
            'price'=>$request->price,
        ]);
        session()->flash('message', 'Post successfully updated.');
        return redirect()->route('index');

        //for image and data show---->END CODE//
    }


    public function edit($id)
    {
        $product = Product::find($id);
        return view('backend.layouts.products.edit', compact('product'));
    }


    public function update(Request $request, $id)
    {
        // try{
        //     $data = $request->except('_token');
        //     Product::where('id', $id)->update($data);
        //     return redirect()->route('index');

        // }catch(Exception $e){
        //     dd($e->getMessage());
        // }

        //for image and data show---->START CODE//
$product= Product::findOrFail($id);
        $request->validate([
            'name'=>'required',
            'price'=>'required',
        ]);
        $imageName='';
        $deleteOldImage= 'images/products/'.$product->image;

        if($image=$request->file('image')){
            if(file_exists($deleteOldImage)){
                File::delete($deleteOldImage);
            }
            else{
                $imageName=$product->image;
            }
            $imageName=time().'-'.uniqid().'.'.$image->getClientOriginalExtension();
            $image->move('images/products',$imageName);
        }

        Product::where('id', $id)->update([
            'name'=>$request->name,
            'image'=>$imageName,
            'price'=>$request->price,
        ]);
        session()->flash('message', 'Post successfully updated.');
        return redirect()->route('index');

        //for image and data show---->END CODE//
    }

    public function delete($id)
    {
        $product =Product::find($id);
        $product->delete();
        return redirect()->back();
    }
}
