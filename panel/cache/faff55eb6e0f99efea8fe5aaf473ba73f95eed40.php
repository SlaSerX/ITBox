<?php $__env->startSection('content'); ?>
<div class="">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Ip Block </h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <a class="btn btn-round btn-primary" href="manage_ipblock.php" title="Add">
                            Add ipblock
                        </a>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="">
                    <?php if(count($ipblocks) > 0): ?>

                        <?php if($message): ?>
                            <div class="alert alert-<?php echo e($message['type']); ?>">
                                <?php echo e($message['message']); ?>

                            </div>
                        <?php endif; ?>
                        <table id="example" class="table table-striped responsive-utilities jambo_table bulk_action">
                            <thead>
                            <tr class="headings">
                                <th>#</th>
                                <th>IP</th>
                                <th>Description</th>
                                <th class=" no-link last"><span class="nobr">Action</span></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $ipblocks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $block): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                <tr>
                                    <td class="center"><?php echo e($key+1); ?></td>
                                    <td><?php echo e($block->ip); ?></td>
                                    <td><?php echo e($block->description); ?></td>
                                    <td class="center">
                                        <a class="btn btn-info" href="manage_ipblock.php?id=<?php echo e($block->id); ?>" title="Edit">Edit</a>
                                        <a class="btn btn-danger" href="ipblocks.php?delete=<?php echo e($block->id); ?>" title="Delete" onclick="return confirm('Are you sure?')">Remove</a>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <div class="alert alert-info">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            No ip blocks found
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
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
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>