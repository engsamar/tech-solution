<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="itemModalLabel">
            إضافة حلول عامة جديد

        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <form class="saveForm gutters needs-validation" action="{{ route('common_problems.store') }}" method="POST"
        enctype='multipart/form-data' novalidate>
        <input id="method" type="hidden" name="_method" value="POST">

        <div class="modal-body">
            <div class="row">
                @csrf
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="upload-photo-container">
                        <img id="preview"
                            src="{{ !empty($common_problem->id) ? $common_problem->image : asset('/images/user.png') }}"
                            class="user-thumb" alt="Upload">
                        <div class="form-group m-0">
                            <div class="input-group">
                                <div class="custom-file">
                                    <input accept="image/*" name="image" type="file" class="custom-file-input"
                                        id="uploadPhoto">
                                    <label class="custom-file-label" for="uploadPhoto"
                                        aria-describedby="uploadPhotoAddon">رفع صورة للمشكلة</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="alert alert-danger" style="display:none"></div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label for="title">عنوان الحل:</label>
                        <input required value="{{ !empty($common_problem->id) ? $common_problem->title : '' }}"
                            name="title" type="text" class="form-control" id="title">
                        @if ($errors->has('title'))
                            <span class="invalid-feedback">{{ $errors->first('title') }}</span>
                        @else
                            <span class="invalid-feedback">من فضلك ادخل عنوان الحل</span>
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
                        <label for="tags">كلمات :</label>
                        <input  value="{{ !empty($problem->id) ? $problem->tags : '' }}" name="tags"
                            type="text" data-role="tagsinput" class="form-control" id="tags">
                        @if ($errors->has('tags'))
                            <span class="invalid-feedback">{{ $errors->first('tags') }}</span>
                        @else
                            <span class="invalid-feedback">من فضلك ادخل كلمات </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="file">رفع ملف الحل:</label>
                        <input  name="file" type="file" class="form-control" id="file"
                            accept=".doc,.docx,.pdf">
                        @if ($errors->has('file'))
                            <span class="invalid-feedback">{{ $errors->first('file') }}</span>
                        @else
                            <span class="invalid-feedback">من فضلك رفع ملف الحل</span>
                        @endif
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label for="description">حل المشكلة:</label>
                        <textarea required name="description" class="form-control" rows="12"
                            id="description">{{ !empty($problem->id) ? $problem->description : '' }}</textarea>
                        @if ($errors->has('description'))
                            <span class="invalid-feedback">{{ $errors->first('description') }}</span>
                        @else
                            <span class="invalid-feedback">من فضلك ادخل حل المشكلة</span>
                        @endif
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
