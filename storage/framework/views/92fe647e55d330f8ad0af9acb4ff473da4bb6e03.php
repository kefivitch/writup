<div class="wt-tabscontenttitle la-switch-option">
    <h2><?php echo e(trans('lang.explore_cat_sec')); ?></h2>
    <switch_button v-model="cat_section_display"><?php echo e(trans('lang.show_on_homepage')); ?></switch_button>
    <input type="hidden" :value="cat_section_display" name="section[0][cat_section_display]">
</div>
<?php if(file_exists(resource_path('views/extend/back-end/admin/home-page-settings/sections/explore-categories.blade.php'))): ?> 
    <?php echo $__env->make('extend.back-end.admin.home-page-settings.sections.explore-categories', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php else: ?> 
    <?php echo $__env->make('back-end.admin.home-page-settings.sections.explore-categories', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php endif; ?>
<div class="wt-tabscontenttitle la-switch-option">
    <h2><?php echo e(trans('lang.start_as_sec')); ?></h2>
    <switch_button v-model="home_section_display"><?php echo e(trans('lang.show_on_homepage')); ?></switch_button>
    <input type="hidden" :value="home_section_display" name="section[0][home_section_display]">
</div>
<?php if(file_exists(resource_path('views/extend/back-end/admin/home-page-settings/sections/background-image.blade.php'))): ?> 
    <?php echo $__env->make('extend.back-end.admin.home-page-settings.sections.background-image', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php else: ?> 
    <?php echo $__env->make('back-end.admin.home-page-settings.sections.background-image', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php endif; ?>
<?php if(file_exists(resource_path('views/extend/back-end/admin/home-page-settings/sections/start-as.blade.php'))): ?> 
    <?php echo $__env->make('extend.back-end.admin.home-page-settings.sections.start-as', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php else: ?> 
    <?php echo $__env->make('back-end.admin.home-page-settings.sections.start-as', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php endif; ?>
<div class="wt-tabscontenttitle la-switch-option">
    <h2><?php echo e(trans('lang.download_app_sec_settings')); ?></h2>
    <switch_button v-model="app_section_display"><?php echo e(trans('lang.show_on_homepage')); ?></switch_button>
    <input type="hidden" :value="app_section_display" name="section[0][app_section_display]">
</div>
<?php if(file_exists(resource_path('views/extend/back-end/admin/home-page-settings/sections/download-app.php'))): ?> 
    <?php echo $__env->make('extend.back-end.admin.home-page-settings.sections.download-app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php else: ?> 
    <?php echo $__env->make('back-end.admin.home-page-settings.sections.download-app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php endif; ?>
