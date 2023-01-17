<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductsController extends Controller
{
    private $errors;

    public function sendResponse($header, $message){
        return response()->json([
            'status'    => $header,
            'message'   => $message
        ]);
    }

    public function doValidation($collections){
        $validator = Validator::make($collections->all(),[
            'product_name'          => 'required',
            'product_description'   => 'required',
            'price'                 => 'required|numeric'
        ]);
        if($validator->fails()){
            $this->errors = $validator->errors();
            return 0;
        }
        return 1;
    }

    public function get($id){
        $product = Products::where('id',$id)->get();
        if($product->isEmpty()){
            return $this->sendResponse('error', 'cannot find selected record');
        }
        return $this->sendResponse('sucess', $product);
    }

    public function getRange($start, $length){
        $product = Products::offset($start - 1)->limit($length)->get();
        return $this->sendResponse('success', $product);
    }

    public function store(Request $request){
        if(!$this->doValidation($request)){
            return $this->sendResponse('error', $this->error);
        }
        Products::insert([
            'product_name'          => $request['product_name'],
            'product_description'   => $request['product_description'],
            'price'                 => $request['price']
        ]);
        return $this->sendResponse('success', 'sucessfully insert data');
    }

    public function update(Request $request, $id)
    {
        if(!$this->doValidation($request)){
            return $this->sendResponse('error', $this->errors);
        }
        $product = Products::where('id', $id);
        if($product->get()->isEmpty()){
            return $this->sendResponse('error','cannot find selected record');
        }
        $product->update([
            'product_name' => $request['product_name'],
            'product_description' => $request['product_description'],
            'price' => $request['price']
        ]);
        return $this->sendResponse('success','success editing data');
    }

    public function destroy($id)
    {
        $product = Products::where('id',$id);
        if($product->get()->isEmpty()){
            return $this->sendResponse('error','cannot find selected record');
        }
        $product->delete();
    }

    public function countData(){
        $count = Products::count();
        return $this->sendResponse('success',$count);
    }
}
