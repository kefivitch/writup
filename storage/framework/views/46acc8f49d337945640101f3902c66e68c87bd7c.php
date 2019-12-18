<aside id="wt-sidebar" class="wt-sidebar">

    <div class="wt-proposalsr">
        <div class="wt-proposalsrcontent">
            <span class="wt-proposalsicon"><i class="fa fa-angle-double-down"></i><i class="fa fa-money"></i></span>
            <div class="wt-title">
                <h3><?php echo e($job->price); ?> <i><?php echo e(!empty($symbol['symbol']) ? $symbol['symbol'] : '$'); ?></i></h3>
                <span><?php echo e(trans('lang.client_budget')); ?></span>
            </div>
        </div>
        <?php if(file_exists(resource_path('views/extend/front-end/jobs/sidebar/wt-jobproposals-widget.blade.php'))): ?>
            <?php echo $__env->make('extend.front-end.jobs.sidebar.wt-jobproposals-widget', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php else: ?>
            <?php echo $__env->make('front-end.jobs.sidebar.wt-jobproposals-widget', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php endif; ?>
        <?php if(file_exists(resource_path('views/extend/front-end/jobs/sidebar/wt-qrcode-widget.blade.php'))): ?>
            <?php echo $__env->make('extend.front-end.jobs.sidebar.wt-qrcode-widget', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php else: ?>
            <?php echo $__env->make('front-end.jobs.sidebar.wt-qrcode-widget', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php endif; ?>
        <?php if(file_exists(resource_path('views/extend/front-end/jobs/sidebar/wt-addtofavourite-widget.blade.php'))): ?>
            <?php echo $__env->make('extend.front-end.jobs.sidebar.wt-addtofavourite-widget', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php else: ?>
            <?php echo $__env->make('front-end.jobs.sidebar.wt-addtofavourite-widget', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php endif; ?>

    </div>
    <?php if(file_exists(resource_path('views/extend/front-end/jobs/sidebar/wt-employerinfo-widget.blade.php'))): ?>
        <?php echo $__env->make('extend.front-end.jobs.sidebar.wt-employerinfo-widget', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php else: ?>
        <?php echo $__env->make('front-end.jobs.sidebar.wt-employerinfo-widget', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php endif; ?>
    <?php if(file_exists(resource_path('views/extend/front-end/jobs/sidebar/wt-sharejob-widget.blade.php'))): ?>
        <?php echo $__env->make('extend.front-end.jobs.sidebar.wt-sharejob-widget', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php else: ?>
        <?php echo $__env->make('front-end.jobs.sidebar.wt-sharejob-widget', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php endif; ?>
    <?php if(file_exists(resource_path('views/extend/front-end/jobs/sidebar/wt-reportjob-widget.blade.php'))): ?>
        <?php echo $__env->make('extend.front-end.jobs.sidebar.wt-reportjob-widget', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php else: ?>
        <?php echo $__env->make('front-end.jobs.sidebar.wt-reportjob-widget', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php endif; ?>
</aside>
