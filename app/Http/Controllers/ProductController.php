<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Exception;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;

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

        // try{
        //     $data = $request->all();
        //     Product::create($data);
        //     return redirect()->route('index');
        // }catch(Exception $e){
        //     dd($e->getMessage());
        // }

        $request->validate([
            'name'=>'required',
            'image'=>'required|mimes:png,jpg,jpeg',
        ]);
        $imageName='';
        if($image=$request->file('image')){
            $imageName=time().'-'.uniqid().'.'.$image->getClientOriginalExtension();
            $image->move('images/products'.$imageName);
        }

        Product::create([
            'name'=>$request->name,
            'image'=>$imageName,
        ]);
        $request->session()->flash('status', 'Task was successful!');
        return redirect()->route('index');
    }


    public function edit($id)
    {
        $product = Product::find($id);
        return view('backend.layouts.products.edit', compact('product'));
    }


    public function update(Request $request, $id)
    {
        try{
            $data = $request->except('_token');
            Product::where('id', $id)->update($data);
            return redirect()->route('index');

        }catch(Exception $e){
            dd($e->getMessage());
        }
    }

    public function delete($id)
    {
        $product =Product::find($id);
        $product->delete();
        return redirect()->back();
    }
}
