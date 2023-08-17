<?php

namespace App\Http\Controllers;

use App\Models\AccessTokens;
use App\Models\User;
use Carbon\Carbon;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function login(Request $r){

        $validator = Validator::make($r->all(),[
            'name' => 'required|max:100|string',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'statusCode' => 9,
                'messenge' => 'Dữ liệu đầu vào không đúng',
                'data' => null
            ]);
        }

        $params = $r->all();

        $name = $params['name'];
        $password = $params['password'];

        // tạo một logic authen đơn giản
        // 1. xác minh với tài khoản và mật khẩu
        // 2. tạo ra một accessToken với expires time là 30p
        // 3. trả về ra cho user để cầm access này đi thao tác các tính năng cần

        // authen user
        $modelUser = new User();
        $detail = $modelUser->authen($name, $password);

        if($detail == null){
            return response()->json([
                'statusCode' => 5,
                'messenge' => 'Tài khoản hoặc mật khẩu của bạn chưa đúng',
                'data' => null
            ]);
        }

        if(!Hash::check($password, $detail->password)) {
            return response()->json([
                'statusCode' => 5,
                'messenge' => 'Tài khoản hoặc mật khẩu của bạn chưa đúng',
                'data' => null
            ]);
        }

        // xóa đi các token cũ để bảo mật(thực ra đối với các dự án lớn thì ko nên xóa vì nên để lại làm report và đồng thời xử lí cách khác để token cũ ko còn sử dụng dc)
        $modemAccessTokens = new AccessTokens();
        $modemAccessTokens->where('user_id', $detail->id)->delete();

        // tạo access token
        $timeExpire = Carbon::now()->addMinutes(30);
        $accessToken = md5($name.date('Y-m-d H:i:s').$password);

        $modemAccessTokens->id = Str::uuid();
        $modemAccessTokens->user_id = $detail->id;
        $modemAccessTokens->accessToken = $accessToken;
        $modemAccessTokens->expires_at = $timeExpire->setTimezone(new DateTimeZone('Asia/Ho_Chi_Minh'));
        $modemAccessTokens->save();

        // lưu id user vào session

        Cache::put('user_id_'.$accessToken, $detail->id, 30*60);

        return response()->json([
            'statusCode' => 0,
            'messenge' => 'Thành công',
            'data' => [
                'accessToken' => $modemAccessTokens->accessToken
            ]
        ]);

    }
}
