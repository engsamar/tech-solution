<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['showLoginForm', 'postLogin']]);
    }

    public function showLoginForm()
    {
        return view('login');
    }

    public function postLogin(LoginRequest $request)
    {
        $user = auth()->attempt(['email' => $request->email, 'password' => $request->password], 1);
        if ($user) {
            return redirect()->route('home');
        }

        return back()->withErrors(['message' => 'البريد الإلكتروني / كلمة المرور غير صحيحة'])
            ->withInput($request->only('email', 'remember'));
    }

    public function logout()
    {
        auth()->logout();

        return redirect()->route('home');
    }


    public function profile()
    {
        $user = auth()->user();
        return view('profile', compact('user'));
    }

    //updateProfile

    public function updateProfile(Request $request)
    {
        $user = User::find(auth()->user()->id);
        $request->validate(
            [
                'email' => [
                    'required',
                    'email',
                    'unique:users,email,'.$user->id
                ],
                'phone' => [
                    'required',
                    'unique:users,phone,'.$user->id
                ],
                'name' => 'required',
            ]
        );

        if ($request->password != null) {
            $request->validate(
                [
                    'password' => 'required|confirmed|min:6',
                ]
            );
        }

        $data = $request->all();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $image->hashName();
            $request->image->move(public_path('images/employees'), $imageName);
            $data['image'] = 'images/employees/' . $imageName;
        }

        $user->update($data);

        return redirect()->route('profile')->with('message', 'تم تعديل البيانات بنجاح');
    }


    public function home()
    {
        $count_users = User::count();
        $users = User::take(6)->get();

        return view('home', compact('users', 'count_users'));
    }
}