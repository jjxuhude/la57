<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::get('index', 'API\PassportController@index');
Route::post('login', 'API\PassportController@login');
Route::post('register', 'API\PassportController@register');
Route::get('getDetails', 'API\PassportController@getDetails');




//第三方客户端授权方式跳转控制，使用client_id的方式，会使用vue组件
//1.首先会验证用户登录
//2.登录以后就会用code方式(服务器自动生成)，获取token。
//3.会跳转到url：http://la.org/api/callback?code=def5020021ba50479641de4ff602d8d56123909f317b38f7b0f68bcf9c9f8301f99f5a03cbc1cc2a9f9459566e7301b3431f196bc9795217f5a960392c3632484c9218c25d20e852307f1e2c674296c2080af19f9b05fb3cb89f6e17d0ea41ae28a2537a8366a8397e967504d0463a3755ad312765739101de4c2053b9454dad07f87c34b699ada9743621b17ee2e5a697b88db33003da0cf3d5ab52a19625af31fdd009e0ed72fb961459d6ed3bf1f5b42eac977282ed5123f826e088a0a9b2049b7e4fe2e7bd1dd6dc2f775f839f87156d13b893434e43fb8406f01f48c5b6a90d522d7ca3419c7faadf2a88aa3c031ae1b367c2e05b0049e14fdb5cb3576e5df9a3bfdf5744a1f82c5412ae76d96b3e53ab349414a0ac652203a188e5c5f29839245ca3eeb9673ca9c9ac2578b4ef0288448eebb01d05b7a25bda7bd0dba7fc73e31c969bd755e7f0d3fdef81adc9a66b1682a381b37214b689e54e
Route::get('/redirect/{client_id?}', 'API\OauthController@redirect')->where(['client_id'=>'[0-9]+']);
//成功后添加 header("Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImIxMGQ3Zjc5MTZmMjc3ZTAxZjUyYmM5NjAxZjQ3NGIyMjg0MjYzOTFhNjZhYTA0N2FjYzY3MGQ1ZDJlOGY1ODdhMDJlYmUxMmY3ZGEwMzBhIn0.eyJhdWQiOiI1IiwianRpIjoiYjEwZDdmNzkxNmYyNzdlMDFmNTJiYzk2MDFmNDc0YjIyODQyNjM5MWE2NmFhMDQ3YWNjNjcwZDVkMmU4ZjU4N2EwMmViZTEyZjdkYTAzMGEiLCJpYXQiOjE1MjYzNTM4MzEsIm5iZiI6MTUyNjM1MzgzMSwiZXhwIjoxNTI5MDMyMjMxLCJzdWIiOiIyIiwic2NvcGVzIjpbXX0.PJU3Go9ULcTYWQioxZijQ0lNDjyqkTrfGh-C0M4SOou-i2_RKbCzWWbrrcKQ28wnx5zsPvRcB3kzNK28iIZz8cpGvgHEK3fzHALmvVjv2MYjdbBJc36zapAvKzVL_4KC0gXsK9X6X0eL2AtpQTD3fJeK8ZAp_5ueg1H5R2OpQ0UaZhwIbEm0dF4RV2Hqma4gNItPtEM-rqKgvb5qDNgqo-grbgyxprFITAL9WfxNjc-caGGnlwMFyTbX6kIHpF2-haQZQJnZZ8lHk0fP8w7-Iqfs5Vfsdqik0FJZdKekFH6tfZNYDYOMhsmC0EdtkO1MUYTmCyPKHdOQ6saZL6dJz47YIWVkEwOAlkCY_E4nzJ2LHUk1hmNZUqHRFks40tnbh-DwCZhNY85VgF5brg3UBDPfc4iiaxazqhxvviLwH8tEfxrcmjL78518Jr96C2-JNLEK9f4cKIY7ZXo44MdHtowkKvJJOx4h2zUmxq84dEGnB30_V7DcnUmNxfcpDsA2LyoKlgj03HHUfVni9Q7DOdysTytnMPMKQ6MNla0NSHc3KXp7Huqitl_WjXR4kwZxviWxNlyxmMriovn7C54w3_ZnFZXj9f8iADby2K04V8q-mDSV9YeXhmBO3lVR6jbJbyOo7vytwDshbFyIpyx5fCckF_vwiqY--4Pc_axDOts");
Route::get('/callback', 'API\OauthController@callback');

//http://la.org/api/callback?password和用户注册和登录方式可以使用。
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//http://la.org/api/callback?credentials：获取token后使用client中间件检测
Route::middleware('client')->get('/client', function (Request $request) {
    return ['测试客户端凭证授权令牌'];
});