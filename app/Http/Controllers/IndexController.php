<?php
/**
 * Created by PhpStorm.
 * User: wangyuxiang
 * Date: 18/6/3
 * Time: 下午1:08
 */

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Request;
use Symfony\Component\HttpFoundation\Cookie as SCookie;
class IndexController extends Controller
{
    public function index()
    {
        \Illuminate\Support\Facades\View::addExtension('html', 'php');

        return response(view('index'))->withCookie(new SCookie('sid', 'sid9999', time()+3600));
    }

    public function request()
    {
        header("Access-Control-Allow-Origin: *");
        var_dump('aaa');
        var_dump(Request::header('Authorization'));die;
    }
    
}