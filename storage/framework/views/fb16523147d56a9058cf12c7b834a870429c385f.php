<?php $__env->startSection('content'); ?>
    <div class="dpts-listing" id="reviews">
        <?php if(Session::has('message')): ?>
            <div class="flash_msg">
                <flash_messages :message_class="'success'" :time ='5' :message="'<?php echo e(Session::get('message')); ?>'" v-cloak></flash_messages>
            </div>
        <?php elseif(Session::has('error')): ?>
            <div class="flash_msg">
                <flash_messages :message_class="'danger'" :time ='5' :message="'<?php echo e(Session::get('error')); ?>'" v-cloak></flash_messages>
            </div>
        <?php endif; ?>
        <section class="wt-haslayout wt-dbsectionspace">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-6 float-left">
                    <div class="wt-dashboardbox">
                        <div class="wt-dashboardboxtitle">
                            <h2><?php echo e(trans('lang.edit_review_options')); ?></h2>
                        </div>
                        <div class="wt-dashboardboxcontent">
                            <?php echo Form::open([ 'url' => url('admin/review-options/update-review-options/'.$review_options->id.''), 'class' =>'wt-formtheme
                            wt-formprojectinfo wt-formcategory','id' => 'review_options']); ?>

                            <fieldset>
                                <div class="form-group">
                                    <?php echo Form::text( 'review_option_title', e($review_options['title']), ['class' =>'form-control'.($errors->has('review_option_title') ? ' is-invalid' : ''), 'placeholder' => trans('lang.ph_review_option_title')]); ?>

                                    <?php if($errors->has('review_option_title')): ?>
                                        <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($errors->first('review_option_title')); ?></strong>
                                        </span>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group wt-btnarea">
                                    <?php echo Form::submit(trans('lang.update_review_options'), ['class' => 'wt-btn']); ?>

                                </div>
                            </fieldset>
                            <?php echo Form::close();; ?>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(file_exists(resource_path('views/extend/back-end/master.blade.php')) ? 'extend.back-end.master' : 'back-end.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>