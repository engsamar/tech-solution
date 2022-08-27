@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="css/tagsinput.css">
@endsection
@section('title', __('dashboard.Problems'))

@section('content')
    <!-- Row start -->
    <div class="row gutters">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="task-section">
                <!-- Row start -->
                <div class="row no-gutters">
                    <div class="col-xl-2 col-lg-2 col-md-3 col-sm-3 col-4">
                        @include('problems.filter')
                    </div>
                    <div class="col-xl-10 col-lg-10 col-md-9 col-sm-9 col-8">
                        <div class="tasks-container">
                            <div class="modal fade" id="itemModal" tabindex="-1" role="dialog"
                                aria-labelledby="itemModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    @include('problems.create_and_edit')
                                </div>
                            </div>
                            <div class="tasks-header">
                                <h3>المشاكل المضافة</h3>
                                <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#itemModal">إضافة
                                    مشكلة</button>
                            </div>
                            <div class="tasksContainerScroll">
                                <!-- Row start -->
                                <div class="row no-gutters justify-content-center">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                        <section class="task-list" id="data">
                                            <!-- Task #1 -->
                                            @if (!empty($items) && count($items) > 0)
                                                @include('problems.items')
                                            @else
                                                <div class="text-center">
                                                    <img src="{{ asset('/images/empty.png') }}" class="empty-box" />
                                                    <hr>
                                                    <h3 class="text-xs-center text-info"> لا يوجد مشكلات مضافة</h3>
                                                </div>
                                            @endif
                                        </section>
                                    </div>
                                </div>
                                <!-- Row end -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Row end -->
            </div>
        </div>
    </div>
    <!-- Row end -->
@endsection
@section('scripts')

    <script src="{{ asset('/js/tagsinput.min.js') }}"></script>
    <script src="{{ asset('/js/upload.js') }}"></script>
    <script src="{{ asset('/js/validate.js') }}"></script>
    <script script>
        $(document).ready(function() {
            $("#important").on('change', function() {
                if ($(this).is(':checked')) {
                    $(this).attr('value', 1);
                } else {
                    $(this).attr('value', 0);
                }
            });

            $('.edit-card').on('click', function(e) {
                e.preventDefault();

                let url = $(this).data('url');
                $.ajax({
                    url: url,
                    method: "GET",
                    success: function(response) {
                        $('.modal-title').html("تعديل بيانات المشكلة");
                        $('.saveForm').attr('action', response.data.url);
                        $('#method').val('PUT');
                        $('#title').val(response.data.problem.title);
                        $('#description').val(response.data.problem.description);
                        $('#tags').val(response.data.problem.tags_array);
                        console.log(response.data.problem.tags_array)
                        $('#category_id option[value="' + response.data.problem.category_id +
                                '"]')
                            .attr("selected", "selected");

                        $('#status option[value="' + response.data.problem.status + '"]')
                            .attr("selected", "selected");
                        if (response.data.problem.important == 1) {
                            $('#important').prop('checked', true);
                            $('#important').attr('value', 1);

                        } else {
                            $('#important').prop('checked', false);
                            $('#important').attr('value', 0);

                        }
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
                                        '</p><br/>');
                                });
                            }
                            if (response.status == 200) {
                                $('#itemModal').modal('hide');
                                $('.modal-title').html("إضافة بيانات المشكلة");
                                $('.saveForm').attr('action',
                                    "{{ route('problems.store') }}");
                                $('#method').val('post');
                                $('#title').val('');
                                $('#description').val('');
                                $('#tags').val({});

                                $('#category_id option[value="1"]')
                                    .attr("selected", "selected");

                                $('#status option[value="0"]')
                                    .attr("selected", "selected");
                                $('#important').prop('checked', false);
                                $('#data').html(response.data.view)

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
