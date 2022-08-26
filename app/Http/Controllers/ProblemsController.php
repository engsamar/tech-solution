<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Problem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProblemsController extends ResponseController
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request, Problem $problem)
    {
        $items = Problem::Recent();
        $search = $request->search;
        $date = $request->date;
        $to_date = $request->to_date;
        $status = $request->status;
        $important = $request->important;
        $category = $request->category;

        if (isset($search) && $search != '') {
            $items = $items->where(function ($q) use ($search) {
                $q->where('id', 'like', '%' . $search . '%');
                $q->orWhere('title', 'like', '%' . $search . '%');
                $q->orWhere('problem_number', 'like', '%' . $search . '%');
            });
        }
        if (isset($date) && $date != '') {
            $items = $items->whereDate('created_at', '>=', $date);
        }
        if (isset($to_date) && $to_date != '') {
            $items = $items->whereDate('created_at', '<=', $to_date);
        }
        if (isset($status) && $status != '-1') {
            $items = $items->where('status', $status);
        }
        if (isset($important) && $important != '-1') {
            $items = $items->where('important', $important);
        }

        if (isset($category) && $category != '-1') {
            $items = $items->where('category_id', $category);
        }

        if (auth()->user()->type == 'user') {
            $items = $items->where('user_id', auth()->user()->id);
        }

        $counts = $items->count();
        $items = $items->paginate(12);

        $categories = Category::get();
        $statuses = [
            ["id" => 0, "title" => "قيد الإنتظار" ,'icon'=>'icon-error'],
            ["id" => 1, "title" => "منتهية" ,'icon'=>'icon-check_circle'],
            ["id" => 2, "title" => " ملغية" ,'icon'=>'icon-trash'],
        ];
        return view(
            'problems.index',
            compact(
                'date',
                'to_date',
                'items',
                'counts',
                'status',
                'search',
                'problem',
                'categories',
                'statuses'
            )
        );
    }

    public function show(Problem $problem)
    {
        return view('problems.show', compact('problem'));
    }

    public function create(Problem $problem)
    {
        return view('problems.create_and_edit', compact('problem'));
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
        $data['user_id'] = auth()->user()->id;
        $data['problem_number'] = time();
        $problem = Problem::create($data);
        $items = Problem::Recent();

        if (auth()->user()->type == 'user') {
            $items = $items->where('user_id', auth()->user()->id);
        }
        $items = $items->paginate(12);

        return $this->successResponse(
            ['view'=>view(
                'problems.items',
                compact('items')
            )->render()
            ],
            __('dashboard.SaveSuccess'),
            200
        );
    }

    public function edit(Problem $problem)
    {
        return $this->successResponse(
            [
                'problem'=> $problem,
                'url'=> route('problems.update', $problem->id)
            ],
            '',
            200
        );
    }

    public function update(Request $request, Problem $problem)
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
        $problem->update($data);


        $items = Problem::Recent();

        if (auth()->user()->type == 'user') {
            $items = $items->where('user_id', auth()->user()->id);
        }
        $items = $items->paginate(12);


        return $this->successResponse(
            ['view'=>view(
                'problems.items',
                compact('items')
            )->render()
            ],
            __('dashboard.UpdateSuccess'),
            200
        );
    }

    public function destroy(Problem $problem)
    {
        $problem->delete();
        return redirect()->route('problems.index')->with('message', 'تم حذف البيانات بنجاح');
    }

    public function changeStatus(Request $request, $id)
    {
        $problem = Problem::find($id);
        $problem->update(['status' => 1 ]);
        return redirect()->route('problems.index')
            ->with('message', __('dashboard.UpdateSuccess'));
    }

    public function changeImportant(Request $request, $id)
    {
        $problem = Problem::find($id);
        $problem->update(['important'=>$problem->important == 1 ? 0 : 1]);

        return redirect()->route('problems.index')->with('message', 'تم تعديل البيانات بنجاح');
    }
}