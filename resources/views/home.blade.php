@extends('layouts.app')
@section('title', __('dashboard.Dashboard'))

@section('content')
    <!-- Row starts -->
    <div class="row gutters">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">حالة المشكلات</div>
                </div>
                <div class="card-body">

                    <!-- Row starts -->
                    <div class="row gutters">
                        <div class="col-xl-2 col-lg-4 col-md-4 col-sm-4 col-12">
                            <div class="ticket-status-card">
                                <h6>الكل</h6>
                                <h3>{{ \App\Models\Problem::count() }}</h3>
                            </div>
                        </div>

                        <div class="col-xl-2 col-lg-4 col-md-4 col-sm-4 col-12">
                            <div class="ticket-status-card">
                                <h6>قيد الإنتظار</h6>
                                <h3>{{ \App\Models\Problem::where('status', 0)->count() }}</h3>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-4 col-md-4 col-sm-4 col-12">
                            <div class="ticket-status-card">
                                <h6>مغلقة</h6>
                                <h3>{{ \App\Models\Problem::where('status', 1)->count() }}</h3>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-4 col-md-4 col-sm-4 col-12">
                            <div class="ticket-status-card">
                                <h6>مرفوضة</h6>
                                <h3>{{ \App\Models\Problem::where('status', 2)->count() }}</h3>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-4 col-md-4 col-sm-4 col-12">
                            <div class="ticket-status-card">
                                <h6>مهمة</h6>
                                <h3>{{ \App\Models\Problem::where('important', 1)->count() }}</h3>
                            </div>
                        </div>

                    </div>
                    <!-- Row ends -->

                </div>
            </div>
        </div>
    </div>
    <!-- Row end -->

@endsection
