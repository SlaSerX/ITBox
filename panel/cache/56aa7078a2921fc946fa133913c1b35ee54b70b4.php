<?php $__env->startSection('content'); ?>
    <div class="">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>User Client</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="">
                        <br>
                        <div id="demo-form2"  class="form-horizontal form-label-left" >
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="M3u8">M3u8
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="p1" class="form-control col-md-7 col-xs-12" value="http://<?php echo e($setting->webip); ?>:<?php echo e($setting->webport); ?>/playlist.php?username=<?php echo e($user->username); ?>&password=<?php echo e($user->password); ?>&m3u" disabled>
                                </div>
                                <div class="col-md-1 col-sm-1 col-xs-12">
                                    <a class="btn btn-info" href="javascript:;" onclick="copyToClipboard('#p1')" title="Copy">Copy</a>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">E2
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text"  id="p2" class="form-control col-md-7 col-xs-12"  value="http://<?php echo e($setting->webip); ?>:<?php echo e($setting->webport); ?>/playlist.php?username=<?php echo e($user->username); ?>&password=<?php echo e($user->password); ?>&e2" disabled>
                                </div>
                                <div class="col-md-1 col-sm-1 col-xs-12">
                                    <a class="btn btn-info" href="javascript:;" onclick="copyToClipboard('#p2')" title="Copy">Copy</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php $__env->stopSection(); ?>
        <?php $__env->startSection('js'); ?>
        <script>
            function copyToClipboard(element) {
                var $temp = $("<input>");
                $("body").append($temp);
                console.log($temp);
                $temp.val($(element).val()).select();
                document.execCommand("copy");
                $temp.remove();
                alert('copied to your Clipboard');
            }
        </script>
    <?php $__env->stopSection(); ?>


<?php echo $__env->make('main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>