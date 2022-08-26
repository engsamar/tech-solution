@php $i=0; @endphp
@foreach ($items as $item)

    <div class="accordion-container">
        <div class="accordion-header" id="toggleIcons{{ $item->id }}">
            <a href="" class="{{ $i != 0 ? 'collapsed' : '' }}" data-toggle="collapse"
                data-target="#toggleIconsCollapse{{ $item->id }}" aria-expanded="true"
                aria-controls="toggleIconsCollapse{{ $item->id }}">
                {{ $item->title }}

            </a>

        </div>
        <div id="toggleIconsCollapse{{ $item->id }}" class="collapse {{ $i != 0 ? '' : 'show' }}"
            aria-labelledby="toggleIcons{{ $item->id }}" data-parent="#toggleIcons">
            <div class="accordion-body">
                <div class="card text-center">
                    <div class="card-header">
                        <div class="card-title">{{ $item->title }}</div>
                    </div>
                    <img src="{{ $item->image }}" class="card-img-top" alt="..." style="max-height: 200px;">
                    <div class="card-body">
                        <h5 class="card-title">{{ $item->title }}</h5>
                        <p class="card-text">{{ $item->description }}</p>
                        <p class="card-text"><small class="text-muted">أخر تحديث تم من
                                {{ date('Y-m-d @ h:i a', strtotime($item->created_at)) }}</small></p>
                        @if ($item->file != null)
                            <p class="card-text">
                                <a target="__blank" href="{{ $item->file }}"><small class="text-muted">ملف
                                        مرفوع</small></a>
                            </p>
                        @endif
                    </div>
                    @if (in_array(auth()->user()->type, ['employee']))

                        <div class="card-footer btn-group" role="group">

                            <a data-url="{{ route('common_problems.edit', $item->id) }}"
                                class="edit-card btn btn-primary text-white" data-toggle="modal"
                                data-target="#itemModal">
                                تعديل
                                <i class="icon-mode_edit"></i>
                            </a>


                            <form action="{{ route('common_problems.destroy', $item->id) }}" method="POST"
                                style="display: inline;"
                                onsubmit="return confirm('{{ __('dashboard.RemoveMessage') }}');">
                                {{ csrf_field() }}
                                <input type="hidden" name="_method" value="DELETE">

                                <button type="submit" class="btn
                            btn-danger text-white"><i class="icon-trash">
                                        حذف
                                    </i>
                                </button>
                            </form>


                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
    @php
        $i++;
    @endphp
@endforeach
<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
    <hr />
    {!! $items->render() !!}
</div>
