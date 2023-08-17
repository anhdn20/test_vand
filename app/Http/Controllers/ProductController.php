<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index(Request $r){

        $params = $r->all();

        $validator = Validator::make($r->all(),[
            'page' => 'min:0',
            'key' => 'string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'statusCode' => 9,
                'messenge' => 'Dữ liệu đầu vào không đúng',
                'data' => null
            ]);
        }

        $page = $params['page'] ?? 1;
        $key = $params['key'] ?? '';

        $modelProduct = new Product();
        $list = $modelProduct->getListByStore($params['user_id'], $key,$page);


        return response()->json([
            'statusCode' => 0,
            'messenge' => 'Thành công',
            'data' => count($list) == 0 ? null : $list
        ]);

    }

    public function show(Request $r){

        $params = $r->all();

        $detail = Product::where('id', $r->id ?? 0)->first();

        if($detail == null){
            return response()->json([
                'statusCode' => 8,
                'messenge' => 'Không tìm thấy thông tin của bạn',
                'data' => null
            ]);
        }

        $checkStore = Store::where('user_id', $params['user_id'])->where('id', $detail->store_id)->first();

        if($checkStore == null){
            return response()->json([
                'statusCode' => 8,
                'messenge' => 'Không tìm thấy thông tin của bạn',
                'data' => null
            ]);
        }

        return response()->json([
            'statusCode' => 0,
            'messenge' => 'Thành công',
            'data' => [
                'id' => $detail->id,
                'name' => $detail->name,
                'price' => $detail->price,
                'quantity' => $detail->quantity,
                'nameStore' => $checkStore->name,
            ]
        ]);

    }

    public function store(Request $r){

        $params = $r->all();

        $validator = Validator::make($params,[
            'name' => 'required|string',
            'store_id' => 'required|integer',
            'price' => 'required|integer|min:0',
            'quantity' => 'required|integer|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'statusCode' => 9,
                'messenge' => 'Dữ liệu đầu vào không đúng',
                'data' => null
            ]);
        }

        // giới hạn request để tránh việc hacker spam api
        $executed = RateLimiter::attempt('create_product:'.$params['user_id'], 10,function(){}, 60);

        if (!$executed) {
            return response()->json([
                'statusCode' => 4,
                'messenge' => 'Bạn thao tác quá nhanh vui lòng thử lại sau',
                'data' => null
            ]);
        }

        $checkStore = Store::where('user_id', $params['user_id'])->where('id', $params['store_id'])->first();

        if($checkStore == null){
            return response()->json([
                'statusCode' => 8,
                'messenge' => 'Không tìm thấy thông tin của bạn',
                'data' => null
            ]);
        }

        $create = Product::create([
            'user_id' => $params['user_id'],
            'name' => trim($params['name']),
            'store_id' => $params['store_id'],
            'price' => $params['price'],
            'quantity' => $params['quantity']
        ]);

        if(!$create->id){
            return response()->json([
                'statusCode' => 2,
                'messenge' => 'Có lỗi trong quá trình xử lý',
                'data' => null
            ]);
        }

        return response()->json([
            'statusCode' => 0,
            'messenge' => 'Thành công',
            'data' => null
        ]);

    }

    public function update(Request $r){

        $params = $r->all();

        $validator = Validator::make($params,[
            'name' => 'string',
            'store_id' => 'integer',
            'price' => 'integer|min:0',
            'quantity' => 'integer|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'statusCode' => 9,
                'messenge' => 'Dữ liệu đầu vào không đúng',
                'data' => null
            ]);
        }

        $dataUpdate = [];

        // kiểm tra store truyền vào có tồn tại
        if(isset($params['store_id'])){
            $checkStore = Store::where('user_id', $params['user_id'])->where('id', $params['store_id'])->first();

            if($checkStore == null){
                return response()->json([
                    'statusCode' => 8,
                    'messenge' => 'Không tìm thấy thông tin của bạn',
                    'data' => null
                ]);
            }
            $dataUpdate['store_id'] = $params['store_id'];
        }

        if(isset($params['name']) && $params['name'] != ''){
            $dataUpdate['name'] = $params['name'];
        }

        if(isset($params['price'])){
            $dataUpdate['price'] = $params['price'];
        }

        if(isset($params['quantity'])){
            $dataUpdate['quantity'] = $params['quantity'];
        }

        $update = Product::where('id', $r->id ?? 0)->update($dataUpdate);

        if($update == false){
            return response()->json([
                'statusCode' => 2,
                'messenge' => 'Có lỗi trong quá trình xử lý',
                'data' => null
            ]);
        }

        return response()->json([
            'statusCode' => 0,
            'messenge' => 'Thành công',
            'data' => null
        ]);

    }

    public function destroy(Request $r){

        $params = $r->all();

        $detail = Product::where('id', $r->id ?? 0)->first();

        if($detail == null){
            return response()->json([
                'statusCode' => 8,
                'messenge' => 'Không tìm thấy thông tin của bạn',
                'data' => null
            ]);
        }

        $checkStore = Store::where('user_id', $params['user_id'])->where('id', $detail->store_id)->first();

        if($checkStore == null){
            return response()->json([
                'statusCode' => 8,
                'messenge' => 'Không tìm thấy thông tin của bạn',
                'data' => null
            ]);
        }

        $del = $detail->delete();

        if($del == false){
            return response()->json([
                'statusCode' => 2,
                'messenge' => 'Có lỗi trong quá trình xử lý',
                'data' => null
            ]);
        }

        return response()->json([
            'statusCode' => 0,
            'messenge' => 'Thành công',
            'data' => null
        ]);

    }
}
