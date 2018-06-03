<?php
/**
 * Created by PhpStorm.
 * User: wangyuxiang
 * Date: 18/6/3
 * Time: 下午1:08
 */

namespace App\Http\Controllers;

class IndexController extends Controller
{
    public function index()
    {
        \Illuminate\Support\Facades\View::addExtension('html', 'php');

        return view('index');
    }
    
}