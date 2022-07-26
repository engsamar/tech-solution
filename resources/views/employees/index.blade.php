@extends('layouts.app')
@section('title', __('dashboard.Employees'))
@section('css')
    <style>
        @media (min-width: 700px) {
            .modal-dialog {
                max-width: 700px;
                margin: 1.75rem auto;
            }
        }

    </style>
@endsection
@section('content')
    <!-- Row start -->
    <div class="row gutters">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="text-right mb-4">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary add-card" data-toggle="modal" data-target="#itemModal">إضافة
                    موظف
                    جديد</button>
                <!-- Modal -->
                <div class="modal fade" id="itemModal" tabindex="-1" role="dialog" aria-labelledby="itemModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        @include('employees.create_and_edit')
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Row end -->

    <!-- Row start -->
    <div class="row gutters" id="items">
        @if (!empty($items) && count($items) > 0)
            @include('employees.items')
        @else
            <div class="text-center">
                <img src="{{ asset('/images/empty.png') }}" class="empty-box" />
                <hr>
                <h3 class="text-xs-center text-info"> لا يوجد موظفين</h3>
            </div>
        @endif
    </div>
    <!-- Row end -->
@endsection
@section('scripts')
    <script src="{{ asset('/js/upload.js') }}"></script>
    <script src="{{ asset('/js/validate.js') }}"></script>
    <script script>
        $(document).ready(function() {
            $('.edit-card').on('click', function(e) {
                e.preventDefault();

                let url = $(this).data('url');
                $.ajax({
                    url: url,
                    method: "GET",
                    success: function(response) {
                        $('.modal-title').html("تعديل بيانات المستخدم");
                        $('.saveForm').attr('action', response.data.url);
                        $('#method').val('PUT');
                        $("#preview").attr("src", response.data.user.image);
                        $('#name').val(response.data.user.name);
                        $('#email').val(response.data.user.email);
                        $('#phone').val(response.data.user.phone);
                        $('#password').val('');
                        $('#confirmPassword').val('');
                        $('#password').prop('required', false);
                        $('#confirmPassword').prop('required', false);
                        $('#itemModal').modal('show');
                    }
                });
            })



            $('body').on('submit', function(event) {
                event.preventDefault();
                if ($('.saveForm')[0].checkValidity()) {
                    $('.btnSave').html('إرسال..');
                    var formData = new FormData($('.saveForm')[0]);
                    let type = $('#method').val() ?? 'post';
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: $('.saveForm').attr('action'),
                        type: "POST",
                        data: formData,
                        processData: false,
                        contentType: false,
                        cache: false,
                        enctype: 'multipart/form-data',
                        success: function(response) {
                            $('.btnSave').html('حفظ');
                            if (response.status == 422) {
                                jQuery.each(response.message, function(key, value) {
                                    jQuery('.alert-danger').show();
                                    jQuery('.alert-danger').append('<p>' + value +
                                        '</p>');
                                });
                            }
                            if (response.status == 200) {
                                $('#itemModal').modal('hide');

                                $('.modal-title').html("إضافة بيانات المستخدم");
                                $('.saveForm').attr('action',
                                    "{{ route('employees.store') }}");
                                $('#method').val('post');
                                $("#preview").attr("src", '{{ asset('/images/user.png') }}');
                                $('#name').val('');
                                $('#email').val('');
                                $('#password').val('');
                                $('#confirmPassword').val('');
                                $('#phone').val('');
                                $('#password').prop('required', true);
                                $('#confirmPassword').prop('required', true);
                                $('#items').html(response.data.view)

                                notes.show(
                                    response.message, {
                                        type: 'success',
                                        title: 'نجاح',
                                        icon: '<i class="icon-sentiment_satisfied"></i>'
                                    }
                                );
                            }

                        }
                    });
                }
            });
        });

    </script>
@endsection
