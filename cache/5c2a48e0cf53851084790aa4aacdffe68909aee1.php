<?php $__env->startSection('content'); ?>
<div class="">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>ITBox Panel v1.2rc</h2>

                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <?php if(count($categories) > 0): ?>

                        <?php if($message): ?>
                            <div class="alert alert-<?php echo e($message['type']); ?>">
                                <?php echo e($message['message']); ?>

                            </div>
                        <?php endif; ?>
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

                    <?php else: ?>
                        <div class="alert alert-error">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>Error!</strong> You need to create an category!
                        </div>
                    <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>