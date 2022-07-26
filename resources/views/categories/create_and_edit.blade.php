<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="itemModalLabel">
            إضافة قسم جديد

        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <form class="saveForm gutters needs-validation" action="{{ route('categories.store') }}" method="POST"
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
                        <label for="title">إسم القسم:</label>
                        <input required value="{{ !empty($user->id) ? $user->title : '' }}" name="title" type="text"
                            class="form-control" id="title">
                        @if ($errors->has('title'))
                            <span class="invalid-feedback">{{ $errors->first('title') }}</span>
                        @else
                            <span class="invalid-feedback">من فضلك ادخل إسم القسم</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="color"> اللون:</label>
                        <input required value="{{ !empty($user->id) ? $user->color : '' }}" name="color" type="color"
                            class="form-control" id="color">
                        @if ($errors->has('color'))
                            <span class="invalid-feedback">{{ $errors->first('color') }}</span>
                        @else
                            <span class="invalid-feedback">من فضلك ادخل اللون</span>
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
