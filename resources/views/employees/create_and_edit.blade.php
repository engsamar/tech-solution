<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="itemModalLabel">
            إضافة موظف جديد

        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <form class="saveForm gutters needs-validation" action="{{ route('employees.store') }}" method="POST"
        enctype='multipart/form-data' novalidate>
        <input id="method" type="hidden" name="_method" value="POST">

        <div class="modal-body">
            <div class="row">
                @csrf
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="upload-photo-container">
                        <img id="preview" src="{{ !empty($user->id) ? $user->image : asset('/images/user.png') }}"
                            class="user-thumb" alt="Upload">
                        <div class="form-group m-0">
                            <div class="input-group">
                                <div class="custom-file">
                                    <input accept="image/*" name="image" type="file" class="custom-file-input"
                                        id="uploadPhoto">
                                    <label class="custom-file-label" for="uploadPhoto"
                                        aria-describedby="uploadPhotoAddon">رفع صورة البروفايل</label>
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
                        <label for="name">إسم الموظف:</label>
                        <input required value="{{ !empty($user->id) ? $user->name : '' }}" name="name" type="text"
                            class="form-control" id="name">
                        @if ($errors->has('name'))
                            <span class="invalid-feedback">{{ $errors->first('name') }}</span>
                        @else
                            <span class="invalid-feedback">من فضلك ادخل إسم الموظف</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="email">البريد الإلكتروني:</label>
                        <input required value="{{ !empty($user->id) ? $user->email : '' }}" name="email" type="email"
                            class="form-control" id="email">
                        @if ($errors->has('email'))
                            <span class="invalid-feedback">{{ $errors->first('email') }}</span>
                        @else
                            <span class="invalid-feedback">من فضلك ادخل البريد الإلكتروني</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="phone">رقم الجوال:</label>
                        <input required value="{{ !empty($user->id) ? $user->phone : '' }}" name="phone" type="text"
                            class="form-control" id="phone">
                        @if ($errors->has('phone'))
                            <span class="invalid-feedback">{{ $errors->first('phone') }}</span>
                        @else
                            <span class="invalid-feedback">من فضلك ادخل رقم الجوال </span>
                        @endif
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label for="password">كلمة المرور:</label>
                        <input {{ empty($user->id) ? 'required' : '' }} name="password" type="password"
                            class="form-control" id="password">
                        @if ($errors->has('password'))
                            <span class="invalid-feedback">{{ $errors->first('password') }}</span>
                        @else
                            <span class="invalid-feedback">من فضلك ادخل كلمة المرور </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="confirmPassword">تأكيد كلمة المرور :</label>
                        <input {{ empty($user->id) ? 'required' : '' }} name="password_confirmation" type="password"
                            class="form-control" id="confirmPassword">
                        @if ($errors->has('password_confirmation'))
                            <span class="invalid-feedback">{{ $errors->first('password_confirmation') }}</span>
                        @else
                            <span class="invalid-feedback">من فضلك ادخل تأكيد كلمة المرور </span>
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
