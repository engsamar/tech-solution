<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Problem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\ChatMessage;

class ChatsController extends Controller
{
    public function index(Request $request)
    {
        $items = Chat::Recent();
        $activeItem = null;
        $problem = null;
        $search = $request->search;
        $problem = $request->problem;
        if (isset($search) && $search != '') {
            $items = $items->where(
                function ($q) use ($search) {
                    $q->where('id', 'like', '%' . $search . '%');
                }
            );
        }

        if (isset($problem) && $problem != '') {
            $activeItem = Chat::where('problem_id', $problem)->first();
            $problem = Problem::where('id', $problem)->first();
        }

        $counts = $items->count();
        $items = $items->paginate();

        return view(
            'chats.index',
            compact('activeItem', 'items', 'counts', 'search', 'problem')
        );
    }

    public function store(Request $request)
    {
        $chat = Chat::where('problem_id', $request->problem_id)->first();
        $problem = Problem::where('id', $request->problem_id)->first();

        if (empty($chat) && ! empty($problem)) {
            $data = $request->all();
            $data['user_id'] = auth()->user()->id;
            $data['status'] = 0;
            $item = Chat::create($data);
            ChatMessage::create(
                [
                    'chat_id'=>$item->id,
                    'user_id'=> auth()->user()->id,
                    'is_read'=>0,
                    'message'=>$problem->title .'<br/>'. $problem->description
                ]
            );
            return redirect()->route(
                'chats.index',
                ['problem'=>$request->problem_id]
            )->with('message', 'Data added successfully');
        }
        return back();
    }

    public function edit($id)
    {
        $item = Chat::find($id);
        return view('chats.create_and_edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $item = Chat::find($id);
        if (! empty($item)) {
            ChatMessage::create(
                [
                    'chat_id'=> $item->id,
                    'user_id'=> auth()->user()->id,
                    'is_read'=> 0,
                    'message'=> $request->message
                ]
            );
            return redirect()->route(
                'chats.index',
                ['problem'=>$item->problem_id]
            )->with('message', 'Data added successfully');
        }
        return back();
    }

    public function destroy($id)
    {
        $item = Chat::find($id);
        $item->update(['status'=>1]);

        return redirect()->route(
            'chats.index',
            ['problem'=> $item->problem_id]
        )->with('message', 'تم إنهاء المحادثة بنجاح');
    }
}