@extends('layouts.layouts')
@section('style')

@endsection
@section('content')
    <section class="content">
        <div class="row">
            @if(\Illuminate\Support\Facades\Auth::user()->level > 0)
            <div class="col-md-6">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Khách hàng cần Chăm Sóc</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table class="table table-bordered">
                                <tbody>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Tên quán</th>
                                    <th>Thể loại</th>
                                    <th>Đã nhập</th>
                                    <th>Chăm sóc</th>
                                </tr>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($customers as $customer)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$customer->name }}  </td>
                                        <td>{{$customer->kind }}</td>
                                        <td ><span class="label label-danger">{{ $customer->orders_count }} đơn hàng</span></td>
                                        <td width="100px">
                                            <a href="{{ route('dashboard.show', $customer->code) }}">
                                                <button class="btn btn-block btn-info btn-xs">Chi Tiết</button>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.box-body -->
                    {{ $customers->links() }}
                    </div>
                </div>
            <div class="col-md-6">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Khách Hàng lấy nhiều lần trong tuần</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered">
                            <tbody>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Tên quán</th>
                                <th>Thể loại</th>
                                <th>Đã nhập</th>
                                <th>Chăm sóc</th>
                            </tr>
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($topCustomers as $topCustomer)
                                @if($topCustomer->orders_count > 1)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$topCustomer->name }}  </td>
                                    <td>{{$topCustomer->kind }}</td>
                                    <td ><span class="label label-success">{{ $topCustomer->orders_count }} đơn hàng</span></td>
                                    <td width="100px">
                                        <a href="{{ route('dashboard.show', $topCustomer->code) }}">
                                            <button class="btn btn-block btn-info btn-xs">Chi Tiết</button>
                                        </a>
                                    </td>
                                </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
            <div class="col-md-6">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Top khách hàng</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered">
                            <tbody>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Tên quán</th>
                                <th>Thể loại</th>
                                <th>Đã nhập</th>
                                <th>Chăm sóc</th>
                            </tr>
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($top_customers as $top_customer)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$top_customer->customer->name }}  </td>
                                    <td>{{$top_customer->customer->kind }}</td>
                                    <td ><span class="label label-success">{{ \App\Services\MyHelper::moneyFormating($top_customer->price)}} </span></td>
                                    <td width="100px">
                                        <a href="{{ route('dashboard.show', $top_customer->customer->code) }}">
                                            <button class="btn btn-block btn-info btn-xs">Chi Tiết</button>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>

            @else
            <div class="col-md-12">
                <!-- Widget: user widget style 1 -->
                <div class="box box-widget widget-user-2">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header bg-yellow">
                        <div class="widget-user-image">
                            <img class="img-circle" src="{{ asset('img/avatar5.png') }}" alt="User Avatar">
                        </div>
                        <!-- /.widget-user-image -->
                        <h3 class="widget-user-username">Chào {{ \Illuminate\Support\Facades\Auth::user()->name }}</h3>
                        <h5 class="widget-user-desc">NULL</h5>
                        <h2><p style="text-align: center">Bạn không đủ quyền truy cập vào Admin Tâm Phát</p></h2>
                    </div>
                </div>
                <!-- /.widget-user -->
            </div>
        </div>
        @endif
    </section>
@endsection
@section('script')
    <script>
    </script>
@endsection