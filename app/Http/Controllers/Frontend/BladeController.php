<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Frontend\Controller;

class BladeController extends Controller
{

    /**
     * blade模板测试
     * 
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    function index()
    {
        return parent::index();
    }

    /**
     * solt演示
     * 
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    function solt()
    {
        return view('frontend.blade.solt', [
            'title' => 'solt演示'
        ]);
    }
}

