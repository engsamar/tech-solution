<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\CommonProblem;
use Illuminate\Support\Facades\Validator;

class CommonProblemsController extends ResponseController
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request, CommonProblem $common_problem)
    {
        $items = CommonProblem::Recent();
        $search = $request->search;
        $date = $request->date;
        $to_date = $request->to_date;
        $status = $request->status;

        if (isset($search) && $search != '') {
            $items = $items->where(function ($q) use ($search) {
                $q->where('id', 'like', '%' . $search . '%');
                $q->orWhere('title', 'like', '%' . $search . '%');
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

        $categories = Category::get();

        return view(
            'common_problems.index',
            compact('date', 'to_date', 'items', 'counts', 'status', 'search', 'common_problem', 'categories')
        );
    }

    public function show(CommonProblem $common_problem)
    {
        return view('common_problems.show', compact('common_problem'));
    }

    public function create(CommonProblem $common_problem)
    {
        return view('common_problems.create_and_edit', compact('common_problem'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => [
                'required',
            ],

        ]);
        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), 422);
        }
        $data = $request->all();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().$image->hashName();
            $request->image->move(public_path('images/common_problem/images'), $imageName);
            $data['image'] = 'images/common_problem/images/' . $imageName;
        }


        if ($request->hasFile('file')) {
            $image = $request->file('file');
            $imageName = time().$image->hashName();
            $request->image->move(public_path('images/common_problem/files'), $imageName);
            $data['file'] = 'images/common_problem/files/' . $imageName;
        }


        $common_problem = CommonProblem::create($data);



        $items = CommonProblem::Recent()->paginate(12);

        return $this->successResponse(
            ['view'=>view(
                'common_problems.items',
                compact('items')
            )->render()
            ],
            __('dashboard.SaveSuccess'),
            200
        );
    }

    public function edit(CommonProblem $common_problem)
    {
        return $this->successResponse(
            [
                'common_problem'=> $common_problem,
                'url'=> route('common_problems.update', $common_problem->id)
            ],
            '',
            200
        );
    }

    public function update(Request $request, CommonProblem $common_problem)
    {
        $validator = Validator::make($request->all(), [
            'title' => [
                'required',
            ],
        ]);
        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), 422);
        }

        $data = $request->all();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().$image->hashName();
            $request->image->move(public_path('images/common_problem/images'), $imageName);
            $data['image'] = 'images/common_problem/images/' . $imageName;
        }


        if ($request->hasFile('file')) {
            $image = $request->file('file');
            $imageName = time().$image->hashName();
            $request->file->move(public_path('images/common_problem/files'), $imageName);
            $data['file'] = 'images/common_problem/files/' . $imageName;
        }

        $common_problem->update($data);

        $items = CommonProblem::Recent()->paginate(12);

        return $this->successResponse(
            ['view'=>view(
                'common_problems.items',
                compact('items')
            )->render()
            ],
            __('dashboard.UpdateSuccess'),
            200
        );
    }

    public function destroy(CommonProblem $common_problem)
    {
        $common_problem->delete();
        return redirect()->route('common_problems.index')->with('message', 'تم حذف البيانات بنجاح');
    }
}