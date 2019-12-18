<?php $__env->startSection('content'); ?>
    <section class="wt-haslayout wt-dbsectionspace">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-9" id="message_center">
                <div class="wt-dashboardbox wt-messages-holder">
                    <div class="wt-dashboardboxtitle">
                        <h2><?php echo e(trans('lang.msgs')); ?></h2>
                    </div>
                    <message-center 
                        :empty_field="'<?php echo e(trans('lang.empty_field')); ?>'" 
                        :host="'<?php echo e($chat_settings['host']); ?>'" 
                        :port="'<?php echo e($chat_settings['port']); ?>'">
                    </message-center>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
    <script src="<?php echo e(asset('js/emojionearea.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/linkify.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/linkify-jquery.min.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make(file_exists(resource_path('views/extend/back-end/master.blade.php')) ? 'extend.back-end.master' : 'back-end.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>