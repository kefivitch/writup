<?php if(file_exists(resource_path('views/extend/back-end/admin/home-page-settings/sections/download-app-image.php'))): ?> 
    <?php echo $__env->make('extend.back-end.admin.home-page-settings.sections.download-app-image', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php else: ?> 
    <?php echo $__env->make('back-end.admin.home-page-settings.sections.download-app-image', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php endif; ?>
<div class="wt-location wt-tabsinfo">
    <h6><?php echo e(trans('lang.app_sec_title')); ?></h6>
    <div class="wt-settingscontent">
        <div class="wt-formtheme wt-userform">
            <div class="form-group">
                <?php echo Form::text('section[0][app_title]', e($app_title), array('class' => 'form-control')); ?>

            </div>
        </div>
    </div>
</div>
<div class="wt-location wt-tabsinfo">
    <h6><?php echo e(trans('lang.app_sec_subtitle')); ?></h6>
    <div class="wt-settingscontent">
        <div class="wt-formtheme wt-userform">
            <div class="form-group">
                <?php echo Form::text('section[0][app_subtitle]', e($app_subtitle), array('class' => 'form-control')); ?>

            </div>
        </div>
    </div>
</div>
<div class="wt-location wt-tabsinfo">
    <h6><?php echo e(trans('lang.description')); ?></h6>
    <div class="wt-settingscontent">
        <div class="wt-formtheme wt-userform">
            <div class="form-group">
                <?php echo Form::textarea('app_desc', e($app_desc), array('class' => 'form-control wt-tinymceeditor', 'id' => 'app_desc_wt_tinymceeditor')); ?>

            </div>
        </div>
    </div>
</div>
<div class="wt-location wt-tabsinfo">
    <h6><?php echo e(trans('lang.android_app_link')); ?></h6>
    <div class="wt-settingscontent">
        <div class="wt-formtheme wt-userform">
            <div class="form-group">
                <?php echo Form::text('app_android_link', e($app_android_link), array('class' => 'form-control')); ?>

            </div>
        </div>
    </div>
</div>
<div class="wt-location wt-tabsinfo">
    <h6><?php echo e(trans('lang.ios_app_link')); ?></h6>
    <div class="wt-settingscontent">
        <div class="wt-formtheme wt-userform">
            <div class="form-group">
                <?php echo Form::text('app_ios_link', e($app_ios_link), array('class' => 'form-control')); ?>

            </div>
        </div>
    </div>
</div>
