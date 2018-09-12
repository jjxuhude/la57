<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;
use Carbon\Carbon;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
        //
        Passport::routes();
        Passport::tokensExpireIn((new \DateTime())->add(new \DateInterval('PT1M')));
        Passport::refreshTokensExpireIn((new \DateTime())->add(new \DateInterval('P1M')));
        
        //隐式授权令牌
        // 隐式授权类似于授权码授权，但是它只令牌将返回给客户端而不交换授权码。这种授权最常用于无法安全存储客户端凭据的 JavaScript 或移动应用程序。通过调用 AuthServiceProvider 中的 enableImplicitGrant 方法来启用这种授权：
        Passport::enableImplicitGrant();
        
        //         Passport::tokensCan([
        //             'place-orders' => 'Place orders',
        //             'check-status' => 'Check order status',
        //         ]);
    }
}
