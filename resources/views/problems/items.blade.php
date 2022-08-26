   <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

       <ul class="list-group">
           @foreach ($items as $item)
               <div class="task-block {{ $item->status == 2 ? 'task-checked' : '' }}">
                   <div class="task-checkbox">
                       <input {{ $item->status == 2 ? 'checked' : '' }} type="checkbox"
                           name="task_{{ $item->id }}" disabled>
                       <div class="ripple-container">
                           <div class="check-off"></div>
                           <div class="check-on">
                               <i class="icon-check1"></i>
                           </div>
                       </div>
                   </div>
                   <div class="task-details">

                       <div class="task-name">{{ $item->title }}</div>
                       <div class="task-name"><strong class="text-primary"> رقم المشكلة </strong>
                           #{{ $item->problem_number }}</div>
                       <div class="task-desc">
                           <strong class="text-primary"> تم إضافة بواسطة </strong>
                           {{ !empty($item->user) ? $item->user->name : '' }}<br />
                           <strong class="text-primary">التوقيت: </strong>
                           {{ date('Y-m-d @ h:i a', strtotime($item->created_at)) }}<br />
                           {!! $item->status_span !!}<br />

                           <strong class="text-primary"> المشكلة: </strong> {{ $item->description }}
                       </div>
                       <div class="task-types">
                           @if (!empty($item->tags_array))
                               @foreach ($item->tags_array as $tag)
                                   <span class="badge badge-primary">{{ $tag }}</span>
                               @endforeach

                           @endif
                           @if (!empty($item->category))
                               <span class="badge badge-primary"
                                   style=" background : {{ $item->category->color }}">{{ $item->category->title }}</span>
                           @endif


                       </div>
                   </div>
                   <ul class="task-actions">
                       @if (in_array(auth()->user()->type, ['user', 'employee']))
                           <li>
                               <a href="{{ route('chats.index', ['problem' => $item->id]) }}">
                                   <i class="icon-message text-primary"></i>
                               </a>
                           </li>
                       @endif
                       <li>
                           <a href="{{ route('problems.chang-important', $item->id) }}"
                               class="star {{ $item->important == 1 ? 'active' : '' }}" data-toggle="tooltip"
                               data-placement="top" title="Star">
                               <i class="icon-stars"></i>
                           </a>
                       </li>
                       <li class="dropdown">
                           <a href="#" id="task-actions" data-toggle="dropdown" aria-haspopup="true">
                               <i class="icon-more_vert"></i>
                           </a>
                           <div class="dropdown-menu" aria-labelledby="task-actions">
                               @if ($item->status != 1)
                                   <a href="{{ route('problems.chang-status', $item->id) }}">
                                       <i class="icon-done_all"></i>تم انجازه
                                   </a>
                               @endif
                               <a class="edit-card" data-url="{{ route('problems.edit', $item->id) }}"
                                   data-toggle="modal" data-target="#itemModal">
                                   <i class="icon-mode_edit"></i> تعديل
                               </a>
                               <form action="{{ route('problems.destroy', $item->id) }}" method="POST"
                                   style="display: inline;"
                                   onsubmit="return confirm('{{ __('dashboard.RemoveMessage') }}');">
                                   {{ csrf_field() }}
                                   <input type="hidden" name="_method" value="DELETE">

                                   <button type="submit" class="btn btn-sm btn-default"
                                       style="float: right;margin-right: 6px;"><i class="text-white icon-trash"> حذف
                                       </i>
                                   </button>
                               </form>

                           </div>
                       </li>
                   </ul>
               </div>
               {{-- <li class="list-group-item d-flex justify-content-between align-items-center">
                   {{ $item->title }}
                   <span class="badge badge-primary badge-pill"
                       style="background-color: {{ $item->color }}">{{ $item->no_problems }}</span>

                   <a data-url="{{ route('problems.edit', $item->id) }}" class="edit-card" data-toggle="modal"
                       data-target="#itemModal">
                       <i class="icon-mode_edit"></i>
                   </a>
                   <form action="{{ route('problems.destroy', $item->id) }}" method="POST" style="display: inline;"
                       onsubmit="return confirm('{{ __('dashboard.RemoveMessage') }}');">
                       {{ csrf_field() }}
                       <input type="hidden" name="_method" value="DELETE">

                       <button type="submit" class="btn btn-sm btn-default"><i class="text-danger icon-trash"> حذف
                           </i>
                       </button>
                   </form>
               </li> --}}

           @endforeach
       </ul>
   </div>
   <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
       <hr />
       {!! $items->render() !!}
   </div>
