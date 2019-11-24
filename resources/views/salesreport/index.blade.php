@extends('layouts.layouts')
@section('style')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>
@endsection
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Báo cáo từ</label>
                    <form action="{{ route('salesreport.store') }}" method="POST" class="form-horizontal">
                        @csrf
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control pull-right" id="daterangepicker" name="daterange"
                                   value=""/>
                            <span class="input-group-btn">
                            <button value="{{ __('salesreport.submit') }}" type="submit" class="btn btn-info btn-flat">Báo cáo</button>
                            </span>
                        </div>

                        <input type="text" id="date_min" name="date_min" value="" hidden/>
                        <input type="text" id="date_max" name="date_max" value="" hidden/>

                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection
@section('script')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

    <script type="text/javascript">
        $(function () {
            $('input[name="daterange"]').daterangepicker({
                opens: 'left',
            }, function (start, end) {
                var a = start.format('YYYY-MM-DD');
                var b = end.format('YYYY-MM-DD');
                $("#date_min").attr('value', a);
                $("#date_max").attr('value', b);
            });
        });
    </script>
@endsection