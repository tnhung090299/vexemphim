<?php $__env->startSection('content'); ?>
<div class="container">
    <a class="btn btn-success mb-3" href="javascript:void(0)" id="createNewSlide"><?php echo e(__('label.createSlide')); ?></a><a id="mess"></a>
    <table class="table table-bordered data-table">
        <thead>
            <tr>
                <th><?php echo e(__('label.id')); ?></th>
                <th><?php echo e(__('label.movieName')); ?></th>
                <th><?php echo e(__('label.status')); ?></th>
                <th><?php echo e(__('label.created_at')); ?></th>
                <th><?php echo e(__('label.updated_at')); ?></th>
                <th><?php echo e(__('label.action')); ?></th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
<div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
            </div>
            <div id="error" class="alert alert-danger print-error-msg">
                <ul></ul>
            </div>
            <div class="modal-body">
                <form id="slideForm" name="slideForm" enctype="multipart/form-data" class="form-horizontal">
                    <input type="hidden" name="slide_id" id="slide_id">
                    <div class="form-group">
                        <div class="col-sm-12">
                            <select class="form-control" id="movie_id" name="movie_id">
                                <option value=''><?php echo e(__('label.chooseMovie')); ?></option>
                                <?php $__currentLoopData = $movies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($data->id); ?>"><?php echo e($data->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <select class="form-control" id="status" name="status">
                                <option value=""><?php echo e(__('label.chooseStatus')); ?></option>
                                <option value="0"><?php echo e(__('label.hide')); ?></option>
                                <option value="1"><?php echo e(__('label.show')); ?></option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="image" class="control-label col-sm-5"><?php echo e(__('label.coverImage')); ?></label>
                        <div class="col-sm-12">
                            <input type="file" class="form-control" id="image" name="image">
                        </div>
                    </div>
                    <div class="col-sm-offset-2 col-sm-10">
                     <button type="submit" class="btn btn-primary" id="saveBtn" value="create"><?php echo e(__('label.saveChange')); ?>

                     </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<input type="hidden" name="routeIndex" class="routeIndex" value="<?php echo e(route('slide.index')); ?>">
<input type="hidden" name="routeStore" class="routeStore" value="<?php echo e(route('slide.store')); ?>">
<input type="hidden" name="newSlide" class="newSlide" value="<?php echo e(__('label.createSlide')); ?>">
<input type="hidden" name="editSlide" class="editSlide" value="<?php echo e(__('label.editSlide')); ?>">
<input type="hidden" name="confirmDel" class="confirmDel" value="<?php echo e(__('label.confirmDelete')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<script type="text/javascript" src="<?php echo e(asset('custom-js/adm_slide.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wampp\www\vexemphim\resources\views/admin/cinema/slide.blade.php ENDPATH**/ ?>