<?php $__env->startSection('content'); ?>
<section class="container">
    <div class="container bootstrap snippet">
        <div class="row">
            <div class="col-sm-10"><h1><?php echo e($user->name); ?></h1></div>
        </div>
        <div class="row">
           
            </div><!--/col-3-->
            <div class="col-sm-9">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#home"><?php echo e(__('label.home')); ?></a></li>
                    <li><a data-toggle="tab" href="#myDeal"><?php echo e(__('label.myDeal')); ?></a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="home">
                        <form id="profileForm">
                            <?php echo csrf_field(); ?>
                            <div class="form-group">
                                <label for="Email"><?php echo e(__('label.email')); ?></label>
                                <input type="email" class="form-control" value="<?php echo e($user->email); ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="name"><?php echo e(__('label.fullName')); ?></label>
                                <input type="text" class="form-control" id="name" name="name" value="<?php echo e($user->name); ?>" placeholder="<?php echo e(__('label.plh_fullName')); ?>">
                            </div>
                            <div class="form-group">
                                <label for="address"><?php echo e(__('label.address')); ?></label>
                                <input type="text" class="form-control" id="address" name="address" value="<?php echo e($user->address); ?>" placeholder="<?php echo e(__('label.plh_address')); ?>">
                            </div>
                            <div class="form-group">
                                <label for="mobile"><?php echo e(__('label.mobile')); ?></label>
                                <input type="text" class="form-control" id="mobile" name="mobile" value="<?php echo e($user->mobile); ?>" placeholder="<?php echo e(__('label.plh_mobile')); ?>">
                            </div>
                            <div class="form-group">
                                <?php if(Auth::user()->password == Auth::user()->email): ?>
                                     <button type="button" class="btn btn-success btnCreatePass"><?php echo e(__('label.createPassLogin')); ?></button>
                                <?php else: ?>
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal"><?php echo e(__('label.changePass')); ?></button>
                                <?php endif; ?>
                            </div>
                            <button type="submit" id="saveBtn" class="btn btn-primary"><?php echo e(__('label.save')); ?></button>
                        </form>
                    </div>
                    <!-- The Modal -->
                    <div class="modal" id="myModal">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title"><?php echo e(__('label.changePass')); ?></h4>
                                </div>
                                <div id="error" class="alert alert-danger print-error-msg class-hide">
                                    <ul></ul>
                                </div>
                                <div class="modal-body">
                                    <form id="changePassForm">
                                        <?php echo csrf_field(); ?>
                                        <div class="form-group">
                                            <label for="oldPass"><?php echo e(__('label.pass')); ?></label>
                                            <input type="password" name="oldPass" id="oldPass" class="form-control" placeholder="<?php echo e(__('label.plh_pass')); ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="newPass"><?php echo e(__('label.newPass')); ?></label>
                                            <input type="password" name="newPass" id="newPass" class="form-control" placeholder="<?php echo e(__('label.plh_newPass')); ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="rePass"><?php echo e(__('label.rePass')); ?></label>
                                            <input type="password" name="rePass" id="rePass" class="form-control" placeholder="<?php echo e(__('label.plh_reNewPass')); ?>">
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button id="changePassBtn" class="btn btn-primary"><?php echo e(__('label.save')); ?></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="myDeal">
                        <table>
                            <thead>
                                <th><?php echo e(__('Id')); ?></th>
                                <th><?php echo e(__('label.totalMoney')); ?></th>
                                <th><?php echo e(__('label.bookingDate')); ?></th>
                                <th><?php echo e(__('label.detail')); ?></th>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $bills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $bill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($key + 1); ?></td>
                                        <td><?php echo e($bill->total); ?></td>
                                        <td><?php echo e($bill->created_at); ?></td>
                                        <td><a href="javascript:void(0)" data-toggle="tooltip" data-id="<?php echo e($bill->id); ?>" class="viewDetail"><i class="fa fa-info-circle"></i></a></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- The Modal -->
                    <div class="modal" id="detailModal">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="col-xm-6">
                                    <div class="ticket">
                                        <div class="ticket-position">
                                            <div class="ticket__indecator indecator--pre"><div class="indecator-text pre--text"><?php echo e(__('label.onlineTicket')); ?></div></div>
                                            <div class="ticket__inner">
                                                <div class="ticket-secondary">
                                                    <span class="ticket__item"><?php echo e(__('label.tk_ticketNumber')); ?><strong class="ticket__number"><a class="code"></a></strong></span>
                                                    <span class="ticket__item ticket__date"><a class="date"></a></span>
                                                    <span class="ticket__item ticket__time"><a class="time"></a></span>
                                                    <span class="ticket__item"><?php echo e(__('label.tk_cinema')); ?><span class="ticket__cinema"><a class="cinema"></a></span></span>
                                                    <span class="ticket__item"><?php echo e(__('label.tk_address')); ?><span class="ticket__hall"><a class="address"></a></span></span>
                                                    <span class="ticket__item ticket__price"><?php echo e(__('label.tk_price')); ?><strong class="ticket__cost"><a class="total"></a><?php echo e(__('label.tk_dvt')); ?></strong></span>
                                                </div>
                                                <div class="ticket-primery">
                                                    <span class="ticket__item ticket__item--primery ticket__film"><?php echo e(__('label.tk_film')); ?><br><strong class="ticket__movie"></strong></span>
                                                    <span class="ticket__item ticket__item--primery"><?php echo e(__('label.tk_seat')); ?><span class="ticket__place"></span></span>
                                                </div>
                                            </div>
                                            <div class="ticket__indecator indecator--post"><div class="indecator-text post--text"><?php echo e(__('label.onlineTicket')); ?></div></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<script type="text/javascript">
    $('#saveBtn').click(function (e) {
        e.preventDefault();
        $(this).html('<?php echo e(__('label.sending')); ?>');
        $.ajax({
            data: $('#profileForm').serialize(),
            url: "<?php echo e(route('profile.store')); ?>",
            type: "POST",
            dataType: 'json',
            success: function (data) {
                $('#saveBtn').html('<?php echo e(__('label.save')); ?>');
                alert(data.success);
            },
            error: function(data) {
                console.log(data);
                $('#saveBtn').html('<?php echo e(__('label.save')); ?>');
            }
        });
    });
    $('#changePassBtn').click(function (e) {
        e.preventDefault();
        $(this).html('<?php echo e(__('label.sending')); ?>');
        $.ajax({
            data: $('#changePassForm').serialize(),
            url: "<?php echo e(route('profile.store')); ?>",
            type: "POST",
            dataType: 'json',
            success: function (data) {
                $('#changePassBtn').html('<?php echo e(__('label.save')); ?>');
                if (data.errors){
                    $('.print-error-msg').css('display', 'block');
                    document.getElementById('error').innerHTML = data.errors;
                    setTimeout(function(){
                        $('#error').hide();
                    }, 3000);
                } else 
                {
                    alert(data.success);
                    $('#myModal').modal('hide');                }
                    $('#changePassForm').trigger("reset");
            },
            error: function(data) {
                var x = JSON.parse(data.responseText);
                printErrorMsg(x.errors);
                setTimeout(function(){
                        $('#error').hide();
                    }, 3000);
                $('#changePassBtn').html('<?php echo e(__('label.saveChange')); ?>');
            }
        });
    });
    $('body').on('click', '.viewDetail', function () {
        var bill_id = $(this).data('id');
        $.get("<?php echo e(route('profile.index')); ?>" + '/' + bill_id + '/edit', function (data) {
            $('#detailModal').modal('show');
            $('.code').html(data.tickets[0].code.substring(0, 8));
            $('.cinema').html(data.tickets[0].showtime.room.cinema.name);
            $('.address').html(data.tickets[0].showtime.room.cinema.address);
            $('.total').html(data.total);
            $('.date').html(data.date);
            $('.time').html(data.time);
            $('.ticket__movie').html(data.tickets[0].showtime.movie.name);
            printSeat(data.tickets);
        })
    });
    function printSeat (ticket) {
        var name = '';
        $.each( ticket, function( key, value ) {
            name += value.seat_col.seat_name + ', ';
        });
        $('.ticket__place').html(name.substring(0, name.length - 2));
    }
    function printErrorMsg (msg) {
        $('.print-error-msg').find('ul').html('');
        $('.print-error-msg').css('display', 'block');
        $.each( msg, function( key, value ) {
            $('.print-error-msg').find('ul').append('<li>' + value + '</li>');
        });
    }
    $('.btnCreatePass').click(function () {
        if (confirm('<?php echo e(__('label.confirmCreatePass')); ?>'))
        {
            $.get("<?php echo e(route('profile.create')); ?>", function (data) {
                alert(data.mess);
                location.reload(); 
            });
        }
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('frontend.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wampp\www\vexemphim\resources\views/frontend/user/profile.blade.php ENDPATH**/ ?>