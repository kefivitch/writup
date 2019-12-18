<?php $__env->startSection('content'); ?>
    <div class="cats-listing" id="emails">
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
                            <h2><?php echo e(trans('lang.edit_email_template')); ?></h2>
                            <div>
                                <strong><?php echo e(trans('lang.variables')); ?></strong>
                                <ul>
                                    <?php $__currentLoopData = $variables_array; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><?php echo e($key); ?> => <?php echo e($value); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                                <span><?php echo e(trans('lang.variable_note')); ?></span>
                            </div>
                        </div>
                        <div class="wt-dashboardboxcontent">
                            <?php echo Form::open(['url' => url('admin/email-templates/update-templates/'.$template->id.''),
                                'class' =>'wt-formtheme wt-formprojectinfo wt-formcategory', 'id' => 'update_email_templates'] ); ?>

                            <fieldset>
                                <div class="form-group">
                                    <?php echo Form::text( 'title', e($template->title), ['class' =>'form-control', 'placeholder' => trans('lang.title')] ); ?>

                                </div>
                                <div class="form-group">
                                        <?php echo Form::text( 'subject', e($template->subject), ['class' =>'form-control', 'placeholder' => trans('lang.subject')] ); ?>

                                    </div>
                                <div class="form-group">
                                        <?php echo Form::textarea('email_content', $template->content, array('class' => 'wt-tinymceeditor', 'id' => 'wt-tinymceeditor', 'placeholder' => trans('lang.add_template_content')) ); ?>

                                </div>
                                <div class="form-group wt-btnarea">
                                    <?php echo Form::submit(trans('lang.update_email_template'), ['class' => 'wt-btn']); ?>

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