<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="itemModalLabel">
            إضافة مشكلة جديد

        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <form class="saveForm gutters needs-validation" action="{{ route('problems.store') }}" method="POST"
        enctype='multipart/form-data' novalidate>
        <input id="method" type="hidden" name="_method" value="POST">

        <div class="modal-body">
            <div class="row">
                @csrf

                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="alert alert-danger" style="display:none"></div>
                </div>
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="form-group">
                        <label for="title">إسم المشكلة:</label>
                        <input required value="{{ !empty($problem->id) ? $problem->title : '' }}" name="title"
                            type="text" class="form-control" id="title">
                        @if ($errors->has('title'))
                            <span class="invalid-feedback">{{ $errors->first('title') }}</span>
                        @else
                            <span class="invalid-feedback">من فضلك ادخل إسم المشكلة</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="description">وصف المشكلة:</label>
                        <textarea required name="description" class="form-control"
                            id="description">{{ !empty($problem->id) ? $problem->description : '' }}</textarea>
                        @if ($errors->has('description'))
                            <span class="invalid-feedback">{{ $errors->first('description') }}</span>
                        @else
                            <span class="invalid-feedback">من فضلك ادخل وصف المشكلة</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="category_id"> القسم:</label>
                        <select required name="category_id" class="form-control" id="category_id">
                            @if (!empty($categories))
                                @foreach ($categories as $category)
                                    <option
                                        {{ !empty($problem->id) && $problem->category_id == $category->id ? 'selected' : '' }}
                                        value="{{ $category->id }}">{{ $category->title }}</option>
                                @endforeach

                            @endif
                        </select>
                        @if ($errors->has('category_id'))
                            <span class="invalid-feedback">{{ $errors->first('category_id') }}</span>
                        @else
                            <span class="invalid-feedback">من فضلك ادخل القسم</span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="status"> الحالة:</label>
                        <select required name="status" class="form-control" id="status">
                            @if (!empty($statuses))
                                @foreach ($statuses as $status)
                                    <option
                                        {{ !empty($problem->id) && $problem->status == $status['id'] ? 'selected' : '' }}
                                        value="{{ $status['id'] }}">{{ $status['title'] }}</option>
                                @endforeach

                            @endif
                        </select>
                        @if ($errors->has('status'))
                            <span class="invalid-feedback">{{ $errors->first('status') }}</span>
                        @else
                            <span class="invalid-feedback">من فضلك ادخل القسم</span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="tags">كلمات :</label>
                        <input required value="{{ !empty($problem->id) ? $problem->tags : '' }}" name="tags"
                            type="text" data-role="tagsinput" class="form-control" id="tags">
                        @if ($errors->has('tags'))
                            <span class="invalid-feedback">{{ $errors->first('tags') }}</span>
                        @else
                            <span class="invalid-feedback">من فضلك ادخل كلمات </span>
                        @endif
                    </div>

                    <div class="form-group custom-control custom-checkbox">
                        <input value="{{ !empty($problem->id) ? $problem->important : '' }}" name="important"
                            type="checkbox" class="custom-control-input" id="important">
                        @if ($errors->has('important'))
                            <span class="invalid-feedback">{{ $errors->first('important') }}</span>
                        @else
                            <span class="invalid-feedback">من فضلك ادخل كلمات </span>
                        @endif
                        <label class="custom-control-label" for="important">مهمة </label>

                    </div>

                </div>

            </div>
            <div class="modal-footer custom">

                <div class="left-side">
                    <button type="button" class="btn btn-link danger btn-block" data-dismiss="modal">إلغاء</button>
                </div>
                <div class="divider"></div>
                <div class="right-side">
                    <button type="submit" class="btn btn-link success btn-block btnSave">حفظ</button>
                </div>
            </div>
        </div>
    </form>
</div>
