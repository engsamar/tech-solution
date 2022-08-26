<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoriesController extends ResponseController
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request, Category $category)
    {
        $items = Category::Recent();
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

        return view(
            'categories.index',
            compact('date', 'to_date', 'items', 'counts', 'status', 'search', 'category')
        );
    }

    public function show(Category $category)
    {
        return view('categories.show', compact('category'));
    }

    public function create(Category $category)
    {
        return view('categories.create_and_edit', compact('category'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => [
                'required',
                'unique:categories,title'
            ],

        ]);
        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), 422);
        }
        $data = $request->all();
        $category = Category::create($data);
        $items = Category::Recent()->paginate(12);

        return $this->successResponse(
            ['view'=>view(
                'categories.items',
                compact('items')
            )->render()
            ],
            __('dashboard.SaveSuccess'),
            200
        );
    }

    public function edit(Category $category)
    {
        return $this->successResponse(
            [
                'category'=> $category,
                'url'=> route('categories.update', $category->id)
            ],
            '',
            200
        );
    }

    public function update(Request $request, Category $category)
    {
        $validator = Validator::make($request->all(), [
            'title' => [
                'required',
                'unique:categories,title,id'.$category->id
            ],
        ]);
        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), 422);
        }

        $data = $request->all();
        $category->update($data);

        $items = Category::Recent()->paginate(12);

        return $this->successResponse(
            ['view'=>view(
                'categories.items',
                compact('items')
            )->render()
            ],
            __('dashboard.UpdateSuccess'),
            200
        );
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('message', 'تم حذف البيانات بنجاح');
    }
}