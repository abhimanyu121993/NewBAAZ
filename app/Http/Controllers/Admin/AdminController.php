<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\BrandModel;
use App\Models\Customer;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function admin()
    {
        return view('Backend.login');
    }

    public function login(Request $req)
    {
        if(Auth::attempt(['email' => $req->email, 'password' => $req->password], $req->remember_me))
        {
            $role = Auth::user()->roles[0]->name;
            session()->flash('success','Welcome '. $role .'!');
            return redirect('Backend/dashboard');
        }
        else {
            session()->flash('error','Invalid Username or Password !');
            return redirect('/');
        }
    }

    public function dashboard()
    {
        $user = User::count();
        $brand = Brand::count();
        $model = BrandModel::count();
        $order = Order::count();
        return view('Backend.dashboard', compact('user', 'brand', 'model', 'order'));
    }

    public function logout()
    {
        Auth::logout();
        Session::flush();
        session()->flash('success','Logout Successfully !');
        return redirect('/');
    }

    public function userList()
    {
        $customers = Customer::latest()->get();
        return view('Backend.customerlist', compact('customers'));
    }

    public function optimize()
    {
        Artisan::call('optimize');

    }
}
