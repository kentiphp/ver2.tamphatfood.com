@extends('layouts.layouts')
@section('style')

@endsection
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">{{$currentPage}} - {{ $customer->content }} </h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">

                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Mã</th>
                                <th>Tên quán</th>
                                <th>Tên khách hàng</th>
                                <th>Thể loại</th>
                                <th>Số điện thoại</th>
                                <th>Địa chỉ quán</th>
                                <th>Ghi chú</th>
                                <th>Edit/Delete</th>
                            </tr>

                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{$customer->code }}</td>
                                    <td>{{$customer->name }}  </td>
                                    <td>{{$customer->namecustomer }}</td>
                                    <td>{{$customer->kind }}</td>
                                    <td>{{$customer->phone_number }}</td>
                                    <td><a href="https://www.google.com/maps/search/?api=1&{{'query='.$customer->kind . '+' . preg_replace('([\s]+)', '+',$customer->name) }}" >{{$customer->address }}</a></td>
                                    <td>{{$customer->note }}  </td>
                                    <td>
                                        <a href="{{ route('customers.edit', $customer->code) }}"><button type="submit" value="delete" class="btn btn-block btn-success btn-xs">Edit</button></a>

                                        <form action="{{ route('customers.destroy', $customer) }}" method="POST">
                                            @csrf
                                            {!! method_field('DELETE') !!}
                                            <button type="submit" value="delete" class="btn btn-block btn-danger btn-xs">Delete</button>
                                        </form></td>
                                    </td>
                                </tr>
                            </tbody>

                        </table>
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