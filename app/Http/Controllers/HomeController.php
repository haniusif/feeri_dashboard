<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function dashboard()
    {
        return view('dashboard');
    }
    public function settings()
    {
        return view('settings');
    }
    public function logout()
    {
        Auth::guard("web")->logout();
        return redirect()->route('login');
    }
    public function swap(Request $request, $locale)
    {
        if (! in_array($locale, ['en', 'ar'])) {
            abort(400);
        } else {
            $request->session()->put('locale', $locale);
        }
        App::setLocale($locale);
        return redirect()->back();
    }
}
