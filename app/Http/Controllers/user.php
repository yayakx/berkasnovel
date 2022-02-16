<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use Validator;

class user extends Controller
{
    public function login()
    {
        if (Auth::check()) {
            return redirect('/');
        }else{
            return view('login');
        }
    }

    public function p_login(Request $request)
    {        
        $rules = [
            'email'                 => 'required|email',
            'password'              => 'required|string'
        ];
 
        $messages = [
            'email.required'        => 'Email wajib diisi',
            'email.email'           => 'Email tidak valid',
            'password.required'     => 'Password wajib diisi',
            'password.string'       => 'Password harus berupa string'
        ];
 
        $validator = Validator::make($request->all(), $rules, $messages);
 
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }
 
        $data = [
            'email'     => $request->input('email'),
            'password'  => $request->input('password'),
        ];
 
        Auth::attempt($data);        
        
        if (Auth::check()) { //true
            if (Auth::user()->role == '0') {                              
                return redirect()->route('main');
            }
            if (Auth::user()->role == '1') { 
                return redirect()->route('main');
            }
        
                
        } else { // false
 
            Session::flash('error', 'Email atau password salah');
            return redirect()->route('login');
        }    
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
