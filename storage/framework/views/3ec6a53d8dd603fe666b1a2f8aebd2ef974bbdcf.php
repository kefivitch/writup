<?php echo Form::open(['url' => '', 'class' =>'wt-formtheme wt-userform', 'id' =>'general-setting-form', '@submit.prevent'=>'submitGeneralSettings']); ?>

    <div class="wt-location wt-tabsinfo">
        <div class="wt-tabscontenttitle">
            <h2><?php echo e(trans('lang.site_title')); ?></h2>
        </div>
        <div class="wt-settingscontent">
            <div class="wt-formtheme wt-userform">
                <div class="form-group">
                    <?php echo Form::text('settings[0][title]', e($title), array('class' => 'form-control', 'placeholder'=>trans('lang.site_title'))); ?>

                </div>
            </div>
        </div>
    </div>
    <?php if(file_exists(resource_path('views/extend/back-end/admin/settings/general/logo.blade.php'))): ?>
        <?php echo $__env->make('extend.back-end.admin.settings.general.logo', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php else: ?>
        <?php echo $__env->make('back-end.admin.settings.general.logo', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php endif; ?>
    <?php if(file_exists(resource_path('views/extend/back-end/admin/settings/general/favicon.blade.php'))): ?>
        <?php echo $__env->make('extend.back-end.admin.settings.general.favicon', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php else: ?>
        <?php echo $__env->make('back-end.admin.settings.general.favicon', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php endif; ?>
    <div class="wt-location wt-tabsinfo">
        <div class="wt-tabscontenttitle">
            <h2><?php echo e(trans('lang.no_of_credit')); ?></h2>
        </div>
        <div class="wt-settingscontent">
            <div class="wt-formtheme wt-userform">
                <div class="form-group">
                    <?php echo Form::number('settings[0][connects_per_job]', e($connects_per_job), array('class' => 'form-control', 'min'=>1, 'placeholder'=>trans('lang.connect_per_job'))); ?>

                </div>
            </div>
        </div>
    </div>
    <div class="wt-location wt-tabsinfo">
        <div class="wt-tabscontenttitle">
            <h2><?php echo e(trans('lang.google_map_api_key')); ?></h2>
        </div>
        <div class="wt-settingscontent">
            <div class="wt-formtheme wt-userform">
                <div class="form-group">
                    <?php echo Form::text('settings[0][gmap_api_key]', e($gmap_api_key), array('class' => 'form-control', 'placeholder'=>trans('lang.api_key'))); ?>

                </div>
            </div>
        </div>
    </div>
    <div class="wt-location wt-tabsinfo">
        <div class="wt-tabscontenttitle">
            <h2><?php echo e(trans('lang.language_setting')); ?></h2>
        </div>
        <div class="wt-settingscontent">
            <div class="wt-formtheme wt-userform">
                <div class="form-group">
                    <span class="wt-select">
                        <select class="form-control" name="settings[0][language]">
                            <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php $selected = $key == $selected_language ? 'selected' : '' ?>
                                <option value="<?php echo e($key); ?>" <?php echo e($selected); ?>> <?php echo e($language['title']); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="wt-securitysettings wt-tabsinfo wt-haslayout">
        <div class="wt-tabscontenttitle">
            <h2><?php echo e(trans('lang.chat_setting')); ?></h2>
        </div>
        <div class="wt-settingscontent">
            <div class="wt-description">
                <p><?php echo e(trans('lang.chat_setting_note')); ?></p>
            </div>
            <ul class="wt-accountinfo">
                <li>
                    <switch_button v-model="chat_display"><?php echo e(trans('lang.display_chat')); ?></switch_button>
                    <input type="hidden" :value="chat_display" name="settings[0][chat_display]">
                </li>
            </ul>
        </div>
    </div>
    <div class="wt-securitysettings wt-tabsinfo wt-haslayout">
        <div class="wt-tabscontenttitle">
                <h2><?php echo e(trans('lang.color_setting')); ?></h2>
        </div>
        <div class="wt-settingscontent">
            <div class="wt-description">
                <p><?php echo e(trans('lang.color_setting_note')); ?></p>
            </div>
            <ul class="wt-accountinfo">
                <li>
                    <switch_button v-model="enable_theme_color">
                        <span v-if="enable_theme_color"><?php echo e(trans('lang.primary_color')); ?></span>
                        <span v-else><?php echo e(trans('lang.custom_color')); ?></span>
                    </switch_button>
                    <input type="hidden" :value="enable_theme_color" name="settings[0][enable_theme_color]">
                </li>
            </ul>
            <div class="form-group la-color-picker" v-if="enable_theme_color">
                <verte display="widget" v-model="primary_color" menuPosition="left" model="hex"></verte>
                <input type="hidden" name="settings[0][primary_color]" :value="primary_color">
            </div>
        </div>
    </div>
    <div class="wt-updatall la-updateall-holder">
        <i class="ti-announcement"></i>
        <span><?php echo e(trans('lang.save_changes_note')); ?></span>
        <?php echo Form::submit(trans('lang.btn_save'),['class' => 'wt-btn']); ?>

    </div>
<?php echo Form::close(); ?>

