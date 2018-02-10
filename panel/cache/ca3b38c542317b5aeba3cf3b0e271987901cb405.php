<?php $__env->startSection('content'); ?>

    <div class="">

        <div class="row">

            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2><?php echo e($title); ?> </h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <a class="btn btn-round btn-primary" href="manage_stream.php" title="Add">
                                Add stream
                            </a>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <form action=""method="post">
                        <input type="submit" name="mass_start" value="Mass start" class="btn btn-small btn-success" onclick="return confirm('Are you sure?')">
                        <input type="submit" name="mass_stop" value="Mass stop" class="btn btn-small btn-danger" onclick="return confirm('Are you sure?')">
                        <input type="submit" name="mass_delete" value="Mass delete" class="btn btn-small btn-danger" onclick="return confirm('Are you sure?')">
                        <?php if(count($streams) > 0): ?>
                            <?php if($message): ?>
                                <div class="alert alert-<?php echo e($message['type']); ?>">
                                    <?php echo e($message['message']); ?>

                                </div>
                            <?php endif; ?>
                    <div class="">


                            <table id="example" class="table table-striped responsive-utilities jambo_table bulk_action">
                                <thead>
                                <tr class="headings">
                                    <th>
                                        <input type="checkbox" id="check-all" class="flat">
                                    </th>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Category</th>
                                    <th>Video</th>
                                    <th>Audio</th>
                                    <th class=" no-link last"><span class="nobr">Action</span>
                                    </th>
                                </tr>
                                </thead>

                                <tbody>


                                <?php $__currentLoopData = $streams; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $stream): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>

                                    <tr>
                                        <td class="center"><input type="checkbox" class="tableflat check"  value="<?php echo e($stream->id); ?>" name="mselect[]"></td>
                                        <td>
                                            <?php echo e($stream->name); ?>


                                            <?php if($stream->checker == 2): ?>
                                                <span class="label label-info">streamurl2</span>
                                            <?php endif; ?>
                                            <?php if($stream->checker == 3): ?>
                                                <span class="label label-info">streamurl3</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="center"><span class="label label-<?php echo e($stream->status_label['label']); ?>"><?php echo e($stream->status_label['text']); ?></span></td>
                                        <td class="center"><?php echo e($stream->category ? $stream->category->name : ''); ?> </td>
                                        <td>
                                            <?php if($stream->video_codec_name): ?>
                                            <?php echo e($stream->video_codec_name); ?>

                                                <?php else: ?>
                                                Empty
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if($stream->audio_codec_name): ?>
                                                <?php echo e($stream->audio_codec_name); ?>

                                            <?php else: ?>
                                                Empty
                                            <?php endif; ?>
                                        </td>
                                        <td class="center">
                                            <?php if($stream->status == 1): ?>
                                                <a class="btn btn-danger" title="STOP STREAM" href="streams.php?stop=<?php echo e($stream->id); ?>">Stop</a>
                                            <?php elseif($stream->status != 1): ?>
                                                <a class="btn btn-success" title="START STREAM" href="streams.php?start=<?php echo e($stream->id); ?>">Start</a>
                                            <?php endif; ?>

                                            <a class="btn btn-info" href="manage_stream.php?id=<?php echo e($stream->id); ?>" title="Edit">
                                                Edit
                                            </a>
                                            <a class="btn btn-danger" href="streams.php?delete=<?php echo e($stream->id); ?>" title="Delete" onclick="return confirm('Are you sure?')">
                                                Remove
                                            </a>

                                        </td>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>

                                </tbody>
                                </table>
                            <?php else: ?>
                                <div class="alert alert-info">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    No streams found
                                </div>
                            <?php endif; ?>
                        </form>
                    </div>
                </div>
            </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
        <!-- Datatables -->
        <script src="js/datatables/js/jquery.dataTables.js"></script>
        <script src="js/datatables/tools/js/dataTables.tableTools.js"></script>
        <script>
            $(document).ready(function () {
                $('input.tableflat').iCheck({
                    checkboxClass: 'icheckbox_flat-green',
                    radioClass: 'iradio_flat-green'
                });
            });

            var asInitVals = new Array();
            $(document).ready(function () {
                var oTable = $('#example').dataTable({
                    "oLanguage": {
                        "sSearch": "Search all columns:"
                    },
                    "aoColumnDefs": [
                        {
                            'bSortable': false,
                            'aTargets': [0]
                        } //disables sorting for column one
                    ],
                    'iDisplayLength': 50,
                    "sPaginationType": "full_numbers"
                });
                $("tfoot input").keyup(function () {
                    /* Filter on the column based on the index of this element's parent <th> */
                    oTable.fnFilter(this.value, $("tfoot th").index($(this).parent()));
                });
                $("tfoot input").each(function (i) {
                    asInitVals[i] = this.value;
                });
                $("tfoot input").focus(function () {
                    if (this.className == "search_init") {
                        this.className = "";
                        this.value = "";
                    }
                });
                $("tfoot input").blur(function (i) {
                    if (this.value == "") {
                        this.className = "search_init";
                        this.value = asInitVals[$("tfoot input").index(this)];
                    }
                });
            });


            $('table input').on('ifChecked', function () {
                check_state = '';
                $(this).parent().parent().parent().addClass('selected');
                countChecked();
            });
            $('table input').on('ifUnchecked', function () {
                check_state = '';
                $(this).parent().parent().parent().removeClass('selected');
                countChecked();
            });

            var check_state = '';
            $('.bulk_action input').on('ifChecked', function () {
                check_state = '';
                $(this).parent().parent().parent().addClass('selected');
                countChecked();
            });
            $('.bulk_action input').on('ifUnchecked', function () {
                check_state = '';
                $(this).parent().parent().parent().removeClass('selected');
                countChecked();
            });
            $('.bulk_action input#check-all').on('ifChecked', function () {
                check_state = 'check_all';
                countChecked();
            });
            $('.bulk_action input#check-all').on('ifUnchecked', function () {
                check_state = 'uncheck_all';
                countChecked();
            });

            function countChecked() {
                if (check_state == 'check_all') {
                    $(".bulk_action input[name='mselect[]']").iCheck('check');
                }
                if (check_state == 'uncheck_all') {
                    $(".bulk_action input[name='mselect[]']").iCheck('uncheck');
                }
                var n = $(".bulk_action input[name='mselect[]']:checked").length;
                if (n > 0) {
                    $('.column-title').hide();
                    $('.bulk-actions').show();
                    $('.action-cnt').html(n + ' Records Selected');
                } else {
                    $('.column-title').show();
                    $('.bulk-actions').hide();
                }
            }
        </script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>