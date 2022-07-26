@foreach ($items as $item)
    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-4 col-12">
        <figure class="user-card">
            <figcaption>
                <a data-url="{{ route('employees.edit', $item->id) }}" class="edit-card" data-toggle="modal"
                    data-target="#itemModal">
                    <i class="icon-mode_edit"></i>
                </a>
                <img src="{{ $item->image }}" alt="Wafi Admin" class="profile">
                <h5>{{ $item->name }}</h5>
                <ul class="list-group">
                    <li class="list-group-item">{{ $item->email }}</li>
                    <li class="list-group-item">{{ $item->phone }}</li>
                    <li class="list-group-item">
                        <form action="{{ route('employees.destroy', $item->id) }}" method="POST"
                            style="display: inline;"
                            onsubmit="return confirm('{{ __('dashboard.RemoveMessage') }}');">
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="DELETE">

                            <button type="submit" class="btn btn-sm btn-default"><i class="text-danger icon-trash"> حذف
                                </i>
                            </button>
                        </form>

                    </li>
                </ul>
            </figcaption>
        </figure>
    </div>
@endforeach
<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
    <hr />
    {!! $items->render() !!}
</div>
