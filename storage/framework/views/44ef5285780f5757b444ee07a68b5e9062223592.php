<?php $__env->startPush('stylesheets'); ?>
    <link href="<?php echo e(asset('css/chosen.css')); ?>" rel="stylesheet">
	<link href="<?php echo e(asset('css/dashboard.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/dbresponsive.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/emojionearea.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/basictable.css')); ?>" rel="stylesheet">
<?php $__env->stopPush(); ?>
<?php $__env->startSection('header'); ?>
    <?php if(file_exists(resource_path('views/extend/includes/header.blade.php'))): ?>
        <?php echo $__env->make('extend.includes.header', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php else: ?> 
        <?php echo $__env->make('includes.header', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('main'); ?>

	<main id="wt-main" class="wt-main wt-haslayout">
        <?php if(Auth::user()): ?>
            <?php if(file_exists(resource_path('views/extend/back-end/includes/dashboard-menu.blade.php'))): ?>
                <?php echo $__env->make('extend.back-end.includes.dashboard-menu', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php else: ?> 
                <?php echo $__env->make('back-end.includes.dashboard-menu', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php endif; ?>
		<?php endif; ?>
		<?php echo $__env->yieldContent('content'); ?>
    </main>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
    <script src="<?php echo e(asset('js/chosen.jquery.js')); ?>"></script>
    <script src="<?php echo e(asset('js/jquery.basictable.min.js')); ?>"></script>
    <script>
        jQuery('.chosen-select').chosen();
        jQuery('.wt-tablecategories').basictable({
            breakpoint: 767,
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>