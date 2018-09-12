<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use Laravel\Passport\Client;

/**
 *
 * @author Jack.Xu1
 *         1.composer require laravel/passport
 *         2.php artisan migrate
 *         3.php artisan passport:install
 *         4.你需要在 app/Providers/AuthServiceProvider.php 的 boot 方法中调用
 *         Passport::routes 方法
 *         5.config/auth.php 中，需要设置 api 认证 guard 的 driver 选项为 passport
 *         6.生成前端vue组件：php artisan vendor:publish --tag=passport-components
 *         Vue.component(
 *         'passport-clients',
 *         require('./components/passport/Clients.vue')
 *         );
 *        
 *         Vue.component(
 *         'passport-authorized-clients',
 *         require('./components/passport/AuthorizedClients.vue')
 *         );
 *        
 *         Vue.component(
 *         'passport-personal-access-tokens',
 *         require('./components/passport/PersonalAccessTokens.vue')
 *         );
 *         npm run dev
 *         <passport-clients></passport-clients>
 *         <passport-authorized-clients></passport-authorized-clients>
 *         <passport-personal-access-tokens></passport-personal-access-tokens>
 *         7.部署 Passport： php artisan passport:keys
 *         8.创建客户端：php artisan passport:client
 *        
 */
class OauthController extends Controller
{

    //以下是第三方授权方式
    const CLIENT_ID = 5;

    const CLIENT_SECRET = 'EF8Ie2RkV5lBuRpHtwW73vHBG9RgO6wJxEZp90JV';

    const REDIRECT_URI = 'http://la57.org/api/callback';

    const ACCESS_TOKEN = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImZlNjJhZWU4OTU3MjJjMTY0ZWNiYWMxYTE5ZGZlNTY5MjAwODkwYmM4N2U0YzNkNTgwMTA4ZDgxYTc0MTI0MmE4NWY2Y2YzYzgzMTQ3MTE4In0.eyJhdWQiOiI1IiwianRpIjoiZmU2MmFlZTg5NTcyMmMxNjRlY2JhYzFhMTlkZmU1NjkyMDA4OTBiYzg3ZTRjM2Q1ODAxMDhkODFhNzQxMjQyYTg1ZjZjZjNjODMxNDcxMTgiLCJpYXQiOjE1MjYzNjg3OTQsIm5iZiI6MTUyNjM2ODc5NCwiZXhwIjoxNTI5MDQ3MTk0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iapCEHBuRBlMg1-J4De-Zh3fCJYoWHahqmRGI5Lc2iBjoJ8v48aVUeaAmE7gz3g_aNeaycK6nDBfGun6OX3LBI8LLHsJtYWfTNwzFfDsJpCUPeaAZrr2KPEl3RYVVVCNpHDI4SPVLot-lHY3cHkkPFFWgx1ddshzAFf-CUBpnexOXIyrKyErWEXAqASPI-77tMCbPUWnFTo7Pxn8eCbTswLgkOfb5ekEtOJVGAyvpayPsVh8805-ytrh_163lYmzNfkiTCzvyHLujhr1MwrDgwS0Gc3DuKGdyY9ZlwkiKj6IrDUAZUi2csV-nD9ajlHPi8vHfBwYR-c2_9q882Y8eKgdrn57WFkcDZJTNCj7RhFsTWXXJkcHrn70N_28TW8-QqqZGPR05HbKDWgRN_DjeNQwDKe5-0-j4vQPJUWw_gsfHHmLWT5_9qZurY_rW1vw6DxNEsQtaMjcw3-XZjl3hDS0xyWIFParM5Xz8Kyro3CsxC5ChFAm9eloY8J7q009c4Os9jGHi9ou4hPCSlq7Ujb8v2LZIVNMWgKbqEsXRVmZnEJMvr7KLRmvJu_nQCxaO-KrlEYW6vn0fHseK4zEuMMBymy6HAYVjrnAdyxdD9QiGYQB1yx8dIO6KeDq3b5fUR_0Y8bALKzEp1Gijipev-AoBmu4IyTuiadHAKvOtLE';

    const REFRESH_TOKEN = 'def50200898e80486d8d2e2ab0b5b89e7193651a18301114ff0d97b0e4a00c1b71c683d4ddb6036ac6f313cd630aed4b677162d9ea72e75c0dc8b525dfa039137685d8250098380a280cade53976fa65889161eecf768ef986ebdf6b701d67dd4bbd0808ecb3697c1ae9d74c00d8ab3014984420432ae4a7368a520e078c165a65d1b412e02a5e20c78fc6af3168264617b84aa85d11a50361274790946cdfb763574c0472dffee3d3572518732239e4f4e5b624a7ef15aa0d6dcae9ca35f49cc87316b3c72291ee6e20af63c094d8b7aeb7091b4a9914d3472c6186b1e4497e25f18b764f774c2fab3e176e6fe67bebcef002f80ea5ca06b5439f8e3e969448e688d60be8bc2ee2ab546516101999f374852d253264c7b53b9f71ae96d46096371e718f54de8bff944a1fdaef6506e534f96637baf1f23a4361174ad10c8391545b96ceb2b784b18ac1984e1653e80176ff6ca5f6df21b6b02d6ae9bfaf2031c3';

    //以下是密码授权方式
    const PASSWORD_CLIENT_ID = 2;

    const PASSWORD_CLIENT_SECRET = "ubOdp9mYYax2oGGmmmszTNxjJXgGmpvMdKVre90b";

    const USERNAME = "user01@163.com";

    const PASSWORD = "111111";

    /**
     * passport验证控制器
     *
     * {@inheritdoc}
     *
     * @see \App\Http\Controllers\API\Controller::index()
     */
    public function index ()
    {
        return parent::index();
    }

    /**
     * php artisan passport:client 生成客户端，一个app应用只要生成1次
     *
     * @method get
     * @param number $client_id            
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function redirect ($client_id )
    {
        $client=Client::find($client_id);
        $query = http_build_query(
                [
                        'client_id' => $client_id,
                        'redirect_uri' => $client->redirect,
                        'response_type' => 'code',
                        'scope' => ''
                ]);
        
        return redirect(url('oauth/authorize') . '?' . $query);
    }

    /**
     * 获取服务器授权token
     * http://la.org/api/callback?password
     * http://la.org/api/callback?credentials
     * http://la.org/api/callback?refresh_token
     *
     * @param \Illuminate\Http\Request $request            
     * @return string|mixed
     */
    public function callback (\Illuminate\Http\Request $request)
    {
        // 密码token
        if ($request->has('password')) {
            return $this->passwordToken();
        } // 刷新token
        elseif ($request->has('refresh_token')) {
                    return $this->refreshToken();
        } // 获取token,第三方登录方式获取token,跳转的url是组件自动生成的。redirect(url('oauth/authorize') . '?' . $query);
        elseif ($request->get('code')) {
                    return $this->getTokenByCode($request);
        } // 客户端凭证授权令牌
        elseif ($request->has('credentials')) {
            return $this->credentialsToken();
        } else {
            return 'Access Denied';
        }
    }

    /**
     * 通过code获取token
     * 这个ajax请求是写在三方平台上的ajax请求，需要填写申请的your client id、 your lient  secret、REDIRECT_URI
     * @param unknown $request            
     * @return mixed
     */
    private function getTokenByCode ($request)
    {
        $http = new \GuzzleHttp\Client();
        $response = $http->post(url('oauth/token'), 
                [
                        'form_params' => [
                                'grant_type' => 'authorization_code',
                                'client_id' => self::CLIENT_ID, // your client id
                                'client_secret' => self::CLIENT_SECRET, // your lient  secret
                                'redirect_uri' => self::REDIRECT_URI,   
                                'code' => $request->code
                        ]
                ]);
        
        return json_decode((string) $response->getBody(), true);
    }

    /**
     * 刷新token
     *
     * @return mixed
     */
    private function refreshToken ()
    {
        $http = new \GuzzleHttp\Client();
        $response = $http->post(url('oauth/token'), 
                [
                        'form_params' => [
                                'grant_type' => 'refresh_token',
                                'refresh_token' => self::REFRESH_TOKEN,
                                'client_id' => self::CLIENT_ID,
                                'client_secret' => self::CLIENT_SECRET,
                                'scope' => ''
                        ]
                ]);
        
        return json_decode((string) $response->getBody(), true);
    }

    /**
     * 密码token
     * php artisan passport:client --password //生成密码授权客户端
     *  http://la57.org/api/callback?password
     * @return mixed
     */
    private function passwordToken ()
    {
        $http = new \GuzzleHttp\Client();
        
        $response = $http->post(url('oauth/token'), 
                [
                        'form_params' => [
                                'grant_type' => 'password',
                                'client_id' => self::PASSWORD_CLIENT_ID,
                                'client_secret' => self::PASSWORD_CLIENT_SECRET,
                                'username' => self::USERNAME,
                                'password' => self::PASSWORD,
                                'scope' => ''
                        ]
                ]);
        
        $data = json_decode((string) $response->getBody(), true);
        
        $data['grant_type'] = 'password';
        
        return $data;
    }

    /**
     * 客户端凭证授权令牌
     * http://la57.org/api/callback?credentials
     * @return mixed
     */
    private function credentialsToken ()
    {
        $guzzle = new \GuzzleHttp\Client();
        
        $response = $guzzle->post(url('oauth/token'), 
                [
                        'form_params' => [
                                'grant_type' => 'client_credentials',
                                'client_id' => self::CLIENT_ID,
                                'client_secret' => self::CLIENT_SECRET,
                                'scope' => '*'
                        ]
                ]);
        
        return json_decode((string) $response->getBody(), true);
    }
}
