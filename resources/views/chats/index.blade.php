@extends('layouts.app')
@section('title', __('dashboard.Chats'))

@section('content')
    <!-- Row start -->
    <div class="row gutters">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="chat-section">
                <!-- Row start -->
                <div class="row no-gutters">
                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-2 col-3">
                        <div class="users-container">
                            <div class="chat-search-box">
                                <div class="input-group">
                                    <input class="form-control" placeholder="Search">
                                    <div class="input-group-btn">
                                        <button type="button" class="btn btn-primary">
                                            <i class="icon-magnifying-glass"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="usersContainerScroll">
                                <ul class="users">
                                    @if (!empty($items))
                                        @foreach ($items as $item)
                                            @if (!empty($item->problem))
                                                <li class="person"
                                                    style="{{ !empty($activeItem) && $activeItem->id == $item->id ? 'background: aliceblue;' : '' }}">
                                                    <div class="user">
                                                        <a
                                                            href="{{ route('chats.index', ['problem' => $item->problem_id]) }}">
                                                            <img src="{{ $item->problem->user->image }}"
                                                                alt="{{ $item->problem->user->name }}">
                                                            <span class="status online"></span>
                                                        </a>
                                                    </div>
                                                    <p class="name-time">
                                                        <a
                                                            href="{{ route('chats.index', ['problem' => $item->problem_id]) }}">
                                                            <span
                                                                class="name">{{ $item->problem->title . ' #(' . $item->problem->problem_number . ')' }}</span>
                                                            <span class="time">{{ $item->dateFormatted() }}</span>
                                                        </a>
                                                    </p>

                                                </li>
                                            @endif
                                        @endforeach

                                    @endif

                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-9 col-lg-9 col-md-8 col-sm-10 col-9">
                        @if (!empty($problem))
                            <div class="active-user-chatting">
                                <div class="active-user-info">
                                    <img src="{{ $problem->user->image }}" class="avatar" alt="avatar">
                                    <div class="avatar-info">
                                        <h5>{{ $problem->user->name }}</h5>
                                        <div class="typing">
                                            {{ $problem->title . ' #(' . $problem->problem_number . ')' }}</div>
                                    </div>
                                </div>
                                <div class="chat-actions">
                                    @if (!empty($activeItem) && $activeItem->status != 1)
                                        <form action="{{ route('chats.destroy', $activeItem->id) }}" method="POST"
                                            style="display: inline;" onsubmit="return confirm('هل تريد إنهاء المحادثة');">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="_method" value="DELETE">

                                            <button type="submit" class="btn btn-sm btn-default"><i
                                                    class="text-primary icon-close"> إنهاء المحادثة
                                                </i>
                                            </button>
                                        </form>

                                    @endif

                                    {{-- <a href="#" data-toggle="modal" data-target="#audioCall">
                                    <i class="icon-phone1"></i>
                                </a> --}}
                                </div>

                            </div>
                        @endif
                        <div class="chat-container">
                            <div class="chatContainerScroll">
                                <ul class="chat-box">
                                    @if (!empty($activeItem))
                                        @include('chats.chat-box')
                                    @else
                                        @if (!empty($problem))
                                            <form action="{{ route('chats.store') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="problem_id" value="{{ $problem->id }}">
                                                <li class="chat-left">
                                                    <div class="chat-avatar">
                                                        <img src="{{ auth()->user()->image }}"
                                                            alt="{{ auth()->user()->name }}">
                                                        <div class="chat-name">{{ auth()->user()->name }}</div>
                                                    </div>
                                                    <div class="chat-text">
                                                        <p>{{ $problem->title ?? '' }}<br>{{ $problem->description ?? '' }}
                                                        </p>
                                                        <button type="submit" class="btn btn-primary">ابدء المحادثة</button>

                                                    </div>
                                                </li>

                                            </form>
                                        @endif
                                    @endif
                                </ul>
                            </div>
                            @if (!empty($activeItem) && $activeItem->status != 1)
                                <form action="{{ route('chats.update', $activeItem->id) }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <div class="chat-form">
                                        <div class="form-group">
                                            <textarea name="message" required class="form-control"
                                                placeholder="اكتب رسالتك هنا..."></textarea>
                                            <button class="btn btn-primary" type="submit">
                                                <i class="icon-send"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            @endif

                        </div>
                    </div>
                </div>
                <!-- Row end -->
            </div>
        </div>
    </div>
@endsection
