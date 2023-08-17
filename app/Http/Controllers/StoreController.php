<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Validator;

class StoreController extends Controller
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

        $modelStore = new Store();

        $list = $modelStore->getListByUser($params['user_id'], $key,$page);

        return response()->json([
            'statusCode' => 0,
            'messenge' => 'Thành công',
            'data' => count($list) == 0 ? null : $list
        ]);

    }

    public function show(Request $r){

        $params = $r->all();

        $detail = Store::where('id', $r->id ?? 0)->where('user_id', $params['user_id'])->first();

        if($detail == null){
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
                'address' => $detail->address
            ]
        ]);

    }

    public function store(Request $r){

        $params = $r->all();

        $validator = Validator::make($params,[
            'name' => 'required|string',
            'address' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'statusCode' => 9,
                'messenge' => 'Dữ liệu đầu vào không đúng',
                'data' => null
            ]);
        }

        // giới hạn request để tránh việc hacker spam api
        $executed = RateLimiter::attempt('create_store:'.$params['user_id'], 10,function(){}, 60);

        if (!$executed) {
            return response()->json([
                'statusCode' => 4,
                'messenge' => 'Bạn thao tác quá nhanh vui lòng thử lại sau',
                'data' => null
            ]);
        }

        // lấy danh sách cửa hàng
        $listStore = Store::where('user_id', $params['user_id'])->get();

        // kiểm tra trùng tên đơn giản
        foreach ($listStore as  $value) {
            if(mb_strtolower(trim($params['name'])) == mb_strtolower($value->name)){
                return response()->json([
                    'statusCode' => 7,
                    'messenge' => 'Tên cửa hàng đã tồn tại',
                    'data' => null
                ]);
            }
        }

        $create = Store::create([
            'user_id' => $params['user_id'],
            'name' => trim($params['name']),
            'address' => $params['address']
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
            'address' => 'string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'statusCode' => 9,
                'messenge' => 'Dữ liệu đầu vào không đúng',
                'data' => null
            ]);
        }

        $dataUpdate = [];

        // nếu có truyền nam và nó khác rỗng thì mới kiểm tra tên
        if(isset($params['name']) && $params['name'] != ''){
            // lấy danh sách cửa hàng
            $listStore = Store::where('user_id', $params['user_id'])->get();

             // lấy thông tin chi tiết store
            $detail = Store::where('id', $r->id ?? 0)->where('user_id', $params['user_id'])->first();

            if($detail == null){
                return response()->json([
                    'statusCode' => 8,
                    'messenge' => 'Không tìm thấy thông tin của bạn',
                    'data' => null
                ]);
            }

            $params['name'] = $params['name'] == $detail->name ? '' : $params['name'];

            // kiểm tra trùng tên đơn giản
            foreach ($listStore as  $value) {
                if(mb_strtolower(trim($params['name'])) == mb_strtolower($value->name)){
                    return response()->json([
                        'statusCode' => 7,
                        'messenge' => 'Tên cửa hàng đã tồn tại',
                        'data' => null
                    ]);
                }
            }
            if($params['name'] != ''){
                $dataUpdate['name'] = $params['name'];
            }
        }

        if(isset($params['address']) && $params['address'] != ''){
            $dataUpdate['address'] = $params['address'];
        }

        $update = Store::where('id', $r->id ?? 0)->update($dataUpdate);

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

        $detail = Store::where('id', $r->id ?? 0)->where('user_id', $params['user_id'])->first();

        if($detail == null){
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
