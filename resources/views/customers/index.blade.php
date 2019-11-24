@extends('layouts.layouts')

@section('style')
@endsection

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Danh Sách {{$currentPage}}</h3>
                        <div class="box-tools">
                            <div class="input-group input-group-sm hidden-xs" style="width: 150px;">
                                <div class="input-group-btn">
                                    <a href="{{ route('customers.create') }}">
                                        <button class="btn btn-success btn-sm">Thêm {{$currentPage}}</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Tên quán</th>
                                <th style="width: 75px">Thể loại</th>
                                <th>Địa chỉ quán</th>
                                <th>Thêm</th>
                            </tr>

                            </thead>
                            <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($customers as $customer)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$customer->name }}  </td>
                                    <td>{{$customer->kind }}</td>
                                    <td>
                                        <a href="https://www.google.com/maps/search/?api=1&{{'query='.$customer->kind . '+' . preg_replace('([\s]+)', '+',$customer->name) }}">{{$customer->address }}</a>
                                    </td>
                                    <td>
                                        <a href="{{ route('customers.show', $customer->code) }}"><button class="btn btn-block btn-info btn-xs">Chi Tiết</button></a>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{$customers->links()}}
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>

@endsection
@section('script')
    <script>
    </script>
@endsection