<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UsersController extends ResponseController
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request, User $user)
    {
        $items = User::User()->Recent();
        $search = $request->search;
        $date = $request->date;
        $to_date = $request->to_date;
        $status = $request->status;

        if (isset($search) && $search != '') {
            $items = $items->where(function ($q) use ($search) {
                $q->where('id', 'like', '%' . $search . '%');
                $q->orWhere('name', 'like', '%' . $search . '%');
                $q->orWhere('email', 'like', '%' . $search . '%');
                $q->orWhere('phone', 'like', '%' . $search . '%');
            });
        }
        if (isset($date) && $date != '') {
            $items = $items->whereDate('created_at', '>=', $date);
        }
        if (isset($to_date) && $to_date != '') {
            $items = $items->whereDate('created_at', '<=', $to_date);
        }
        if (isset($status) && $status != '-1') {
            $items = $items->where('block', $status);
        }

        $counts = $items->count();
        $items = $items->paginate(12);

        return view(
            'users.index',
            compact('date', 'to_date', 'items', 'counts', 'status', 'search', 'user')
        );
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function create(User $user)
    {
        return view('users.create_and_edit', compact('user'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => [
                'required',
                'email',
                'unique:users,email'
            ],
            'phone' => [
                'required',
                'unique:users,phone'
            ],
            'name' => 'required',
            'password'=>'required|confirmed|min:6'
        ]);
        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), 422);
        }

        $data = $request->all();
        $data['type']='user';
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $image->hashName();
            $request->image->move(public_path('images/users'), $imageName);
            $data['image'] = 'images/users/' . $imageName;
        }
        $user = User::create($data);
        $items = User::User()->Recent()->paginate(12);

        return $this->successResponse(
            ['view'=>view(
                'users.items',
                compact('items')
            )->render()
            ],
            __('dashboard.SaveSuccess'),
            200
        );
    }

    public function edit(User $user)
    {
        return $this->successResponse(
            [
                'user'=> $user,
                'url'=> route('users.update', $user->id)
            ],
            '',
            200
        );
        // return view('users.create_and_edit', compact('user'))->render();
    }

    public function update(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
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
            // 'password'=>'sometimes|required|confirmed|min:6'
        ]);

        if (! empty($request->input("password")) && $request->input("password") != "") {
            $validator = Validator::make(
                $request->all(),
                [
                    'password' => 'required|confirmed|min:6',
                ]
            );
        }

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), 422);
        }

        $data = $request->all();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $image->hashName();
            $request->image->move(public_path('images/users'), $imageName);
            $data['image'] = 'images/users/' . $imageName;
        }
        $user->update($data);

        $items = User::User()->Recent()->paginate(12);

        return $this->successResponse(
            ['view'=>view(
                'users.items',
                compact('items')
            )->render()
            ],
            __('dashboard.UpdateSuccess'),
            200
        );
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('message', 'تم حذف البيانات بنجاح');
    }
}