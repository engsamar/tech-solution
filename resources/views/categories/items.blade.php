   <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

       <ul class="list-group">
           @foreach ($items as $item)
               <li class="list-group-item d-flex justify-content-between align-items-center">
                   {{ $item->title }}
                   <span class="badge badge-primary badge-pill"
                       style="background-color: {{ $item->color }}">{{ $item->no_problems }}</span>

                   <a data-url="{{ route('categories.edit', $item->id) }}" class="edit-card" data-toggle="modal"
                       data-target="#itemModal">
                       <i class="icon-mode_edit"></i>
                   </a>
                   <form action="{{ route('categories.destroy', $item->id) }}" method="POST" style="display: inline;"
                       onsubmit="return confirm('{{ __('dashboard.RemoveMessage') }}');">
                       {{ csrf_field() }}
                       <input type="hidden" name="_method" value="DELETE">

                       <button type="submit" class="btn btn-sm btn-default"><i class="text-danger icon-trash"> حذف
                           </i>
                       </button>
                   </form>
               </li>

           @endforeach
       </ul>
   </div>
   <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
       <hr />
       {!! $items->render() !!}
   </div>
