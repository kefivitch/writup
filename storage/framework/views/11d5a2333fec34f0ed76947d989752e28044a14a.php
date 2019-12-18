<?php $__env->startSection('content'); ?>
<div class="wt-haslayout wt-manage-account wt-dbsectionspace" id="profile_settings">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-9">
            <?php if(Session::has('message')): ?>
                <div class="flash_msg">
                    <flash_messages :message_class="'success'" :time='5' :message="'<?php echo e(Session::get('message')); ?>'" v-cloak></flash_messages>
                </div>
                <?php elseif(Session::has('error')): ?>
                <div class="flash_msg">
                    <flash_messages :message_class="'danger'" :time='5' :message="'<?php echo e(Session::get('error')); ?>'" v-cloak></flash_messages>
                </div>
            <?php endif; ?>
            <div class="wt-dashboardbox wt-dashboardtabsholder wt-accountsettingholder">
                <?php if(file_exists(resource_path('views/extend/back-end/settings/tabs.blade.php'))): ?>
                    <?php echo $__env->make('extend.back-end.settings.tabs', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <?php else: ?>
                    <?php echo $__env->make('back-end.settings.tabs', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <?php endif; ?>
                <div class="wt-tabscontent tab-content">
                    <div class="wt-securityhold la-langselect" id="wt-security">
                        <?php echo Form::open(['url' => url('profile/settings/save-account-settings'), 'class' =>'wt-formtheme wt-userform']); ?>

                            <div class="wt-securitysettings wt-tabsinfo wt-haslayout">
                                <div class="wt-tabscontenttitle">
                                    <h2><?php echo e(trans('lang.manage_account')); ?></h2>
                                </div>
                                <div class="wt-settingscontent">
                                    <div class="wt-description">
                                        <p><?php echo e(trans('lang.search_note')); ?></p>
                                    </div>
                                    <ul class="wt-accountinfo" id="profile_settings">
                                        
                                        <li>
                                            <switch_button v-model="profile_blocked"><?php echo e(trans('lang.disbable_account_temp')); ?></switch_button>
                                            <input type="hidden" :value="profile_blocked" name="is_disabled">
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="wt-location wt-tabsinfo">
                                <div class="wt-tabscontenttitle">
                                    <h2><?php echo e(trans('lang.select_lang')); ?></h2>
                                </div>
                                <div class="wt-settingscontent">
                                    <div class="wt-description">
                                        <p><?php echo e(trans('lang.lang_note')); ?></p>
                                    </div>
                                    <div class="wt-formtheme wt-userform">
                                        <div class="form-group">
                                            <?php echo Form::select('languages[]', $languages, $user_languages ,array('class' => 'chosen-select', 'multiple', 'data-placeholder' => trans('lang.select_lang'))); ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="wt-location wt-tabsinfo">
                                <div class="wt-tabscontenttitle">
                                    <h2><?php echo e(trans('lang.english_level')); ?></h2>
                                </div>
                                <div class="wt-settingscontent">
                                    <div class="wt-description">
                                        <p><?php echo e(trans('lang.english_level_note')); ?></p>
                                    </div>
                                    <div class="wt-formtheme wt-userform">
                                        <div class="form-group">
                                            <span class="wt-select">
                                                <?php echo Form::select('english_level', $english_levels, $user_level ,array()); ?>

                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group form-group-half wt-btnarea">
                                <?php echo Form::submit(trans('lang.btn_save'), ['class' => 'wt-btn']); ?>

                            </div>
                        <?php echo Form::close(); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(file_exists(resource_path('views/extend/back-end/master.blade.php')) ? 'extend.back-end.master' : 'back-end.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>