<div class="labels-container">
    <div class="mt-5"></div>
    <div class="lablesContainerScroll">
        <div class="filters-block">
            <h5>بحث</h5>
            <div class="filters">
                <a href="{{ route('problems.index') }}" class="active">
                    <i class="icon-receipt"></i> الكل
                </a>
                @if (!empty($statuses))
                    @foreach ($statuses as $status)
                        <a href="{{ route('problems.index', ['status' => $status['id']]) }}">
                            <i class="{{ $status['icon'] }}"></i> {{ $status['title'] }}
                        </a>
                    @endforeach
                @endif

                <a href="{{ route('problems.index', ['important' => 1]) }}">
                    <i class="icon-stars"></i> مهمة
                </a>
            </div>
        </div>
        <div class="tags-block">
            <h5>الأقسام</h5>
            <div class="tags">
                @if (!empty($categories))
                    @foreach ($categories as $category)
                        <a href="{{ route('problems.index', ['category' => $category->id]) }}">
                            <i class="icon-label text-primary" style="color: {{ $category->color }} !important"></i>
                            {{ $category->title }}
                        </a>

                    @endforeach
                @endif

            </div>
        </div>
    </div>
</div>
