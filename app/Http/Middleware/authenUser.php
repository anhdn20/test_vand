<?php

namespace App\Http\Middleware;

use App\Models\AccessTokens;
use Carbon\Carbon;
use Closure;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class authenUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        $token          = $request->headers->get('Token') ?? '';

        $user_id = Cache::get('user_id_'.$token);

        if($token == '' || $user_id == null) {
            return response()->json([
                'statusCode' => 10,
                'messenge' => 'Phiên làm việc đã hết hạn',
                'data' => null
            ]);
        }

        $request->request->set('user_id', $user_id);


        $detailAccessToken = AccessTokens::where('accessToken',$token)->where('user_id',$user_id)->first();

        if($detailAccessToken == null){
            return response()->json([
                'statusCode' => 10,
                'messenge' => 'Phiên làm việc đã hết hạn',
                'data' => null
            ]);
        }

        $timeNow = Carbon::now();
        $timeNow = $timeNow->setTimezone(new DateTimeZone('Asia/Ho_Chi_Minh'));

        // kiểm tra token còn hạn hay ko?
        if($timeNow > $detailAccessToken->expires_at){
            return response()->json([
                'statusCode' => 10,
                'messenge' => 'Phiên làm việc đã hết hạn',
                'data' => null
            ]);
        }

        return $next($request);
    }
}
