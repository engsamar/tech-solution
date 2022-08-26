@extends('layouts.app')
@section('title', __('dashboard.CommonProblems'))
@section('css')
    <style>
        @media (min-width: 700px) {
            .modal-dialog {
                max-width: 700px;
                margin: 1.75rem auto;
            }
        }

    </style>
    <link rel="stylesheet" href="css/tagsinput.css">

@endsection
@section('content')
    <!-- Row start -->
    <div class="row gutters">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="text-right mb-4">
                <!-- Button trigger modal -->
                @if (in_array(auth()->user()->type, ['employee']))
                    <button type="button" class="btn btn-primary add-card" data-toggle="modal"
                        data-target="#itemModal">إضافة
                        حل
                        جديد</button>
                    <!-- Modal -->
                    <div class="modal fade" id="itemModal" tabindex="-1" role="dialog" aria-labelledby="itemModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            @include('common_problems.create_and_edit')
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <!-- Row end -->

    <!-- Row start -->
    <div class="row gutters" id="items">
        @if (!empty($items) && count($items) > 0)
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

                <div class="accordion toggle-icons" id="toggleIcons">

                    @include('common_problems.items')
                </div>
            </div>
        @else
            <div class="text-center">
                <img src="{{ asset('/images/empty.png') }}" class="empty-box" />
                <hr>
                <h3 class="text-xs-center text-info"> لا يوجد حلول عامة مضافة</h3>
            </div>
        @endif
    </div>
    <!-- Row end -->
@endsection
@section('scripts')
    <script src="{{ asset('/js/upload.js') }}"></script>
    <script src="{{ asset('/js/validate.js') }}"></script>
    <script src="{{ asset('/js/tagsinput.min.js') }}"></script>

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
                        $("#preview").attr("src", response.data.common_problem.image);
                        $('#title').val(response.data.common_problem.title);
                        $('#category_id option[value="' + response.data.common_problem
                                .category_id +
                                '"]')
                            .attr("selected", "selected");

                        $('#description').val(response.data.common_problem.description);
                        $('#tags').val(response.data.common_problem.tags);

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
                                    "{{ route('common_problems.store') }}");
                                $('#method').val('post');
                                $("#preview").attr("src", '{{ asset('/images/user.png') }}');
                                $('#title').val('');
                                $('#description').val('');
                                $('#category_id option[value="1"]')
                                    .attr("selected", "selected");
                                $('#tags').val({});

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
