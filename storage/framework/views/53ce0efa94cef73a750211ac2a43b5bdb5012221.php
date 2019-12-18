<?php echo Form::open(['url' => '', 'class' =>'wt-formtheme wt-userform', 'id' =>'comission-form', '@submit.prevent'=>'submitCommisionSettings']); ?>

    <?php if(file_exists(resource_path('views/extend/back-end/admin/settings/payment/site-payment-options.blade.php'))): ?>
        <?php echo $__env->make('extend.back-end.admin.settings.payment.site-payment-options', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php else: ?>
        <?php echo $__env->make('back-end.admin.settings.payment.site-payment-options', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php endif; ?>
    <div class="wt-location wt-tabsinfo">
        <div class="wt-tabscontenttitle">
            <h2><?php echo e(trans('lang.ph_currency_setting')); ?></h2>
        </div>
        <div class="wt-settingscontent">
            <div class="wt-formtheme wt-userform">
                <div class="form-group">
                    <span class="wt-select">
                    <?php echo e(Form::select('payment[0][currency]', $currency,e($existing_currency), ['class'=>'form-control','placeholder'=>trans('lang.ph_select_currency')])); ?>

                </span>
                </div>
            </div>
        </div>
    </div>
    <div class="wt-location wt-tabsinfo">
        <div class="wt-tabscontenttitle">
            <h2><?php echo e(trans('lang.commission_settings')); ?></h2>
        </div>
        <div class="wt-settingscontent">
            <div class="wt-description">
                <p><?php echo e(trans('lang.set_comm_project')); ?></p>
            </div>
            <div class="wt-formtheme wt-userform">
                <div class="form-group">
                    <?php echo Form::number('payment[0][commision]', $commision, array('class' => 'form-control', 'placeholder' => '0')); ?>

                </div>
            </div>
        </div>
    </div>
    <div class="wt-location wt-tabsinfo">
        <div class="wt-tabscontenttitle">
            <h2><?php echo e(trans('lang.min_payout')); ?></h2>
        </div>
        <div class="wt-settingscontent">
            <div class="wt-description">
                <p><?php echo e(trans('lang.set_min_payout')); ?></p>
            </div>
            <div class="wt-formtheme wt-userform">
                <div class="form-group">
                    <?php echo Form::number('payment[0][min_payout]', e($min_payout), ['class' => 'form-control', 'placeholder' => trans('lang.ph_min_payout')]); ?>

                </div>
            </div>
        </div>
    </div>
    <div class="wt-location wt-tabsinfo">
        <div class="wt-tabscontenttitle">
            <h2><?php echo e(trans('lang.select_payment_method')); ?></h2>
        </div>
        <div class="wt-settingscontent">
            <div class="wt-formtheme wt-userform">
                <div class="form-group">
                    <span class="wt-select">
                        <select name="payment[0][payment_method][]" class="chosen-select" multiple data-placeholder = "<?php echo e(trans('lang.select_pay_method')); ?>">
                            <?php $__currentLoopData = $payment_methods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $payment_method): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php $selected = in_array($payment_method['value'], $payment_gateway) ? 'selected': ''; ?>
                                <option value="<?php echo e($payment_method['value']); ?>" <?php echo e($selected); ?>><?php echo e($payment_method['title']); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="wt-updatall la-updateall-holder">
        <i class="ti-announcement"></i>
        <span><?php echo e(trans('lang.save_changes_note')); ?></span>
        <?php echo Form::submit(trans('lang.btn_save'),['class' => 'wt-btn']); ?>

    </div>
<?php echo Form::close(); ?>

