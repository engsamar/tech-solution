@extends('layouts.app')
@section('title', __('dashboard.Profile'))
@section('content')
    <div class="row gutters">
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
            <div class="card h-100">
                <div class="card-body">
                    <div class="account-settings">
                        <div class="user-profile">
                            <div class="user-avatar">
                                <img src="{{ $user->image }}" alt="{{ $user->name }}">
                            </div>
                            <h5 class="user-name">{{ $user->name }}</h5>
                            <h6 class="user-email">{{ $user->email }}</h6><br />
                            <h6 class="user-email">{{ $user->phone }}</h6><br />
                            <h6 class="user-email">{{ $user->type }}</h6><br />
                        </div>
                        <div class="setting-links">

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-9 col-lg-9 col-md-9 col-sm-12 col-12">
            <div class="card h-100">
                <div class="card-header">
                    <div class="card-title">تعديل بياناتي الشخصية</div>
                </div>
                <form class="saveForm gutters needs-validation" action="{{ route('profile.update') }}" method="POST"
                    enctype='multipart/form-data' novalidate>
                    <input id="method" type="hidden" name="_method" value="POST">
                    @csrf
                    <div class="card-body">
                        <div class="row gutters">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="form-group">

                                    <div class="upload-photo-container">
                                        <img id="preview"
                                            src="{{ !empty($user->id) ? $user->image : asset('/images/user.png') }}"
                                            class="user-thumb" alt="Upload">
                                        <div class="form-group m-0">
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input accept="image/*" name="image" type="file"
                                                        class="custom-file-input" id="uploadPhoto">
                                                    <label class="custom-file-label" for="uploadPhoto"
                                                        aria-describedby="uploadPhotoAddon">رفع صورة البروفايل</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group @if ($errors->has('name')) is-invalid @endif">
                                    <label for="fullName">الإسم بالكامل</label>
                                    <input required name="name" value="{{ old('name', $user->name) }}" type="text"
                                        class="form-control" id="fullName" placeholder=" الإسم بالكامل">
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback">{{ $errors->first('name') }}</span>
                                    @else
                                        <span class="invalid-feedback">من فضلك ادخل الإسم </span>
                                    @endif
                                </div>
                                <div class="form-group @if ($errors->has('email')) is-invalid @endif">
                                    <label for="eMail">البريد الإلكتروني</label>
                                    <input required name="email" value="{{ old('email', $user->email) }}" type="email"
                                        class="form-control" id="eMail" placeholder="البريد الإلكتروني">
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback">{{ $errors->first('email') }}</span>
                                    @else
                                        <span class="invalid-feedback">من فضلك ادخل البريد الإلكتروني</span>
                                    @endif
                                </div>
                                <div class="form-group @if ($errors->has('phone')) is-invalid @endif">
                                    <label for="phone">رقم الجوال</label>
                                    <input required name="phone" value="{{ old('phone', $user->phone) }}" type="text"
                                        class="form-control" id="phone" placeholder="رقم الجوال">
                                </div>


                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group @if ($errors->has('password')) is-invalid @endif">
                                    <label for="password">كلمة المرور:</label>
                                    <input {{ empty($user->id) ? 'required' : '' }} name="password" type="password"
                                        class="form-control" id="password">
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback">{{ $errors->first('password') }}</span>
                                    @else
                                        <span class="invalid-feedback">من فضلك ادخل كلمة المرور </span>
                                    @endif
                                </div>
                                <div class="form-group @if ($errors->has('password_confirmation')) is-invalid @endif">
                                    <label for="confirmPassword">تأكيد كلمة المرور :</label>
                                    <input {{ empty($user->id) ? 'required' : '' }} name="password_confirmation"
                                        type="password" class="form-control" id="confirmPassword">
                                    @if ($errors->has('password_confirmation'))
                                        <span
                                            class="invalid-feedback">{{ $errors->first('password_confirmation') }}</span>
                                    @else
                                        <span class="invalid-feedback">من فضلك ادخل تأكيد كلمة المرور </span>
                                    @endif
                                </div>

                            </div>
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="text-right">
                                    <button type="submit" id="submit" name="submit" class="btn btn-success">حفظ</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('/js/upload.js') }}"></script>
    <script src="{{ asset('/js/validate.js') }}"></script>
@endsection
