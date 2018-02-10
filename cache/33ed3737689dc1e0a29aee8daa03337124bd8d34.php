<?php $__env->startSection('content'); ?>
<div class="">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Playlist importer</h2>

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

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Playlist importer <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                      <textarea name="import"  lass="form-control col-md-7 col-xs-12"id=""  style="width: 100%;"  rows="10"
                                                placeholder="#EXTINF:0,NAMEOFSTREAM1&#10http://url1.com:8000/nameofstream1&#10#EXTINF:0,NAMEOFSTREAM2&#10http://url2.com:8000/nameofstream2&#10#EXTINF:0,NAMEOFSTREAM3&#10http://url3.com:8000/nameofstream3&#10"></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Proxy</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <p style="padding: 5px;"><span><input type="checkbox" class="flat" name="restream" id="" value="1" <?php echo e($stream->restream ? "checked" : ""); ?>></span></p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Bit stream filter:</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <p style="padding: 5px;"><span><input type="checkbox" class="flat" name="bitstreamfilter" id="" value="1" <?php echo e($stream->bitstreamfilter ? "checked" : ""); ?>></span></p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Category</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select name="category" class="form-control">
                                        <option value='<?php echo e($stream->category ? $stream->category->id : ""); ?>'><?php echo e($stream->category ? $stream->category->name : "Select"); ?></option>
                                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                            <option value='<?php echo e($category->id); ?>'><?php echo e($category->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Transcode profile</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select name="transcode" class="form-control">
                                        <option value='0'>No transcode</option>
                                        <?php $__currentLoopData = $transcodes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trans): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                            <option value='<?php echo e($trans->id); ?>' <?php echo e($stream->trans_id  == $trans->id ? "selected" : ""); ?>><?php echo e($trans->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                    </select>
                                </div>
                            </div>

                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                    <button type="submit" name="submit" class="btn btn-success">Submit</button>
                                </div>
                            </div>
                        </form>
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