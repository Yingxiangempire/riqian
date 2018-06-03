<?php
/**
 * Created by PhpStorm.
 * User: wangyuxiang
 * Date: 18/6/3
 * Time: 下午1:08
 */

namespace App\Http\Controllers;
use Symfony\Component\HttpFoundation\Cookie as SCookie;
class IndexController extends Controller
{
    public function index()
    {
        \Illuminate\Support\Facades\View::addExtension('html', 'php');

        return response(view('index'))->withCookie(new SCookie('sid', 'sid9999', time()+3600));
    }
    
}