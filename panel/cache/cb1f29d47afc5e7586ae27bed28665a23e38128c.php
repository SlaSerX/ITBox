<?php $__env->startSection('content'); ?>

<div class="">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Users </h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <a class="btn btn-round btn-primary" href="manage_user.php" title="Add">
                            Add user
                        </a>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="">
                    <?php if(count($users) > 0): ?>

                        <?php if($message): ?>
                            <div class="alert alert-<?php echo e($message['type']); ?>">
                                <?php echo e($message['message']); ?>

                            </div>
                        <?php endif; ?>
                        <table id="example" class="table table-striped responsive-utilities jambo_table bulk_action">
                            <thead>
                                <tr class="headings">
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Password</th>
                                    <th>Status</th>
                                    <th>Exp date</th>
                                    <th>Category</th>
                                    <th>File</th>
                                    <th>Last viewed channel</th>
                                    <th>Limit</th>
                                    <th>IP</th>
                                    <th>User agent</th>
                                    <th class=" no-link last"><span class="nobr">Action</span></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $user): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                <tr>
                                    <td class="center"><?php echo e($key+1); ?></td>
                                    <td><?php echo e($user->username); ?></td>
                                    <td class="center"><?php echo e($user->password); ?></td>
                                    <td class="center">
                                        <?php if($user->active): ?>
                                            <span class="label label-success">Active</span>
                                        <?php else: ?>
                                            <span class="label label-important">Not Active</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="center">
                                        <?php if($user->exp_date != '0000-00-00'): ?>
                                            <?php if($user->exp_date <=  Carbon\Carbon::today()): ?>
                                                <span class="label label-important"><?php echo e($user->exp_date); ?></span>
                                            <?php else: ?>
                                                <span class="label label-success"><?php echo e($user->exp_date); ?></span>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <span class="label label-success">Unlimited</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="center"><?php echo e($user->category_names); ?></td>
                                    <td class="center">
                                        <a href="getfile.php?m3u=true&id=<?php echo e($user->id); ?>" title="GET M3U"><span class="label label-success">M3U</span></a>
                                        <a href="getfile.php?e2=true&id=<?php echo e($user->id); ?>" title="GET E2"><span class="label label-success">E2</span></a>
                                        <a href="getfile.php?tv=true&id=<?php echo e($user->id); ?>" title="GET TV"><span class="label label-success">TV</span></a>
                                        <a href="clientsgen.php?id=<?php echo e($user->id); ?>" title="Clients"><span class="label label-success">Clients</span></a>
                                        <a href="javascript:;" data-toggle="modal" data-target="#autoenigma2"><span class="label label-success">Auto Enigma2</span></a>
                                    </td>
                                    <td class="center"> <?php if($user->laststream): ?> <?php echo e($user->laststream->name); ?> <?php else: ?> Never connected <?php endif; ?> </td>
                                    <td class="center"><?php echo e($user->max_connections); ?></td>


                                    <td class="center"> <?php if($user->lastconnected_ip): ?> <?php echo e($user->lastconnected_ip); ?> <?php else: ?> Never connected <?php endif; ?> </td>
                                    <td class="center"> <?php if($user->useragent): ?> <?php echo e($user->useragent); ?> <?php else: ?> Never connected <?php endif; ?> </td>
                                    <td class="center">
                                        <a class="btn btn-info" href="manage_user.php?id=<?php echo e($user->id); ?>" title="Edit">Edit</a>
                                        <a class="btn btn-danger" href="users.php?delete=<?php echo e($user->id); ?>" title="Delete" onclick="return confirm('Are you sure?')">Remove</a>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <div class="alert alert-info">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            No users found
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="autoenigma2" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">automatic enigma2 oe2</h4>
                </div>
                <div class="modal-body">
                    <p><textarea name="" id="" class="col-md-12" rows="3">wget -O /etc/enigma2/iptv.sh "http://<?php echo e($setting->webip); ?>:<?php echo e($setting->webport); ?>/retrieve.php?username=<?php echo e($user->username); ?>&password=<?php echo e($user->password); ?>&type=auto_enigma2_oe2&output=mpegts" && chmod 777 /etc/enigma2/iptv.sh && /etc/enigma2/iptv.sh</textarea></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
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