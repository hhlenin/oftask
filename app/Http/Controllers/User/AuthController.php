<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Reader;
use Illuminate\Http\Request;
use Session;

class AuthController extends Controller
{
    protected $reader;

    function __construct(Reader $reader)
    {
        $this->reader = $reader;
    }

    public function loginPage()
    {
        return view('user.auth.login');
    }
    public function registerPage()
    {
        return view('user.auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => "required"
        ]);

        $input = $request->only([
            'name', 'email', 'password'
        ]);

        $this->reader::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => bcrypt($input['password']),
        ]);

        return redirect(route('user.loginview'))->with('message', 'Please Login Now');


    }

    public function login(Request $request)
    {
        $reader = $this->reader::where('email', "$request->email")->first();
        if ($reader) {
            if (password_verify($request->password, $reader->password)) {
                Session::put('reader_id', $reader->id);
                Session::put('reader_name', $reader->name);
                Session::put('reader_email', $reader->email);

                return redirect(route('user.dashboard'))->with('message', 'Logged in successfully');
            }
        }

        return back()->with("error", "Credential doesn't match");

    }

    public function logout()
    {
        Session::forget('reader_id');
        Session::forget('reader_name');
        Session::forget('reader_email');

        return redirect(route('user.loginview'))->with('message', "Logged out successufully");

    }
    
}
