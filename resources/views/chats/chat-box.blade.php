@if (!empty($activeItem->messages))
    @foreach ($activeItem->messages as $message)
        @if (auth()->user()->id == $message->user->id || auth()->user()->id == $problem->user->id)
            <li class="chat-left ">
                <div class="chat-avatar">
                    <img src="{{ $message->user->image }}" alt="{{ $message->user->name }}">
                    <div class="chat-name">{{ $message->user->name }}</div>
                </div>
                <div class="chat-text">
                    <p>{!! $message->message !!}</p>
                    <div class="chat-hour">{{ date('Y-m-d h:i', strtotime($message->created_at)) }} <span
                            class="icon-done_all"></span></div>
                </div>
            </li>
        @else

            <li class="chat-right">
                <div class="chat-text">
                    <p>{!! $message->message !!}</p>
                    <div class="chat-hour">{{ date('Y-m-d  h:i', strtotime($message->created_at)) }} <span
                            class="icon-done_all"></span></div>
                </div>
                <div class="chat-avatar">
                    <img src="{{ $message->user->image }}" alt="{{ $message->user->name }}">
                    <div class="chat-name">{{ $message->user->name }}</div>
                </div>
            </li>
        @endif
    @endforeach
@endif
