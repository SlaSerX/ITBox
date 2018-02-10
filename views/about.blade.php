@extends('main')
@section('content')
<div class="">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>ITBox Panel v1.2rc</h2>

                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    @if(count($categories) > 0)

                        @if($message)
                            <div class="alert alert-{{ $message['type'] }}">
                                {{ $message['message'] }}
                            </div>
                        @endif
                        <br>

                        <form id="demo-form2" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="" role="form" action="" method="post">

<?php
$about = shell_exec('cat ./about.txt');
$about1 = shell_exec('cat ./about1.txt');
$license = shell_exec('cat ./license.txt');
echo "ABOUT: <pre>$about1</pre>";
echo "FEATURES: <pre>$about</pre>";
echo "LICENSE: <pre>$license</pre>";
?>

                    @else
                        <div class="alert alert-error">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>Error!</strong> You need to create an category!
                        </div>
                    @endif
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
    <link href="css/select/select2.min.css" rel="stylesheet">
    <script type="text/javascript" src="js/moment.min2.js"></script>
    <script type="text/javascript" src="js/datepicker/daterangepicker.js"></script>
    <script src="js/select/select2.full.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {

            $('#expdate').daterangepicker({
                singleDatePicker: true,
                calender_style: "picker_4"
            }, function (start, end, label) {
            });
            $(".select2_multiple").select2({
                placeholder: "Select categories",
                allowClear: true
            });
        });
    </script>
@endsection
