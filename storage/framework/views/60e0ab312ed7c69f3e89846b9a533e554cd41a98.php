<div class="preloader-section" v-if="loading" v-cloak>
    <div class="preloader-holder">
        <div class="loader"></div>
    </div>
</div>
<div class="wt-location wt-tabsinfo">
    <div class="wt-tabscontenttitle">
        <h2><?php echo e(trans('lang.site_access_type_settings')); ?></h2>
    </div>
    <?php if(Schema::hasTable('services') && Schema::hasTable('service_user')): ?>
        <?php echo Form::open(['url' => '', 'class' =>'wt-formtheme wt-userform', 'id'
            =>'acces_types_form', '@submit.prevent'=>'submitAccessType']); ?>

            <div class="wt-securitysettings wt-tabsinfo  wt-haslayout">
                <div class="wt-settingscontent">
                    <div class="wt-description">
                        <p><?php echo e(trans('lang.access_type_note')); ?></p>
                    </div>
                    <div class="wt-formregisterstart">
                        <div class="wt-radioboxholder">
                            <span class="wt-radio">
                                <input id="access_both" type="radio" name="access_type" value="both" <?php echo e($access_type == 'both' ? 'checked' : ''); ?>>
                                <label for="access_both"><?php echo e(trans('lang.access_both')); ?></label>
                            </span>
                            <span class="wt-radio">
                                <input id="access_services" type="radio" name="access_type" value="services" <?php echo e($access_type == 'services' ? 'checked' : ''); ?>>
                                <label for="access_services"><?php echo e(trans('lang.access_services')); ?></label>
                            </span>
                            <span class="wt-radio">
                                <input id="access_jobs" type="radio" name="access_type" value="jobs" <?php echo e($access_type == 'jobs' ? 'checked' : ''); ?>>
                                <label for="access_jobs"><?php echo e(trans('lang.access_jobs')); ?></label>
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

    <?php else: ?>
        <div class="wt-securitysettings wt-tabsinfo  wt-haslayout">
            <div class="wt-settingscontent">
                <div class="wt-description">
                    <p><?php echo e(trans('lang.access_type_warning')); ?></p>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>
