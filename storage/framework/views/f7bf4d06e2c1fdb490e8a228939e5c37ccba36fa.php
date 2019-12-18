<div class="wt-tabscontenttitle">
    <h2><?php echo e(trans('lang.add_socials')); ?></h2>
</div>
    <?php if(file_exists(resource_path('views/extend/back-end/admin/settings/footer/socials.blade.php'))): ?>
        <?php echo $__env->make('extend.back-end.admin.settings.footer.socials', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php else: ?>
        <?php echo $__env->make('back-end.admin.settings.footer.socials', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php endif; ?>
    <?php echo Form::open(['url' => '', 'class' =>'wt-formtheme wt-userform', 'id'
        =>'footer-setting-form', '@submit.prevent'=>'submitFooterSettings']); ?>

        <?php if(file_exists(resource_path('views/extend/back-end/admin/settings/footer/logo.blade.php'))): ?>
            <?php echo $__env->make('extend.back-end.admin.settings.footer.logo', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php else: ?>
            <?php echo $__env->make('back-end.admin.settings.footer.logo', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php endif; ?>
        <div class="wt-location wt-tabsinfo">
            <div class="wt-tabscontenttitle">
                <h2><?php echo e(trans('lang.about_us_note')); ?></h2>
            </div>
            <div class="wt-settingscontent">
                <div class="wt-formtheme wt-userform">
                    <div class="form-group">
                        <?php echo Form::textarea('footer[description]', e($footer_desc), array('class' => 'form-control')); ?>

                    </div>
                </div>
            </div>
            <div class="wt-tabscontenttitle">
                <h2><?php echo e(trans('lang.copyright_text')); ?></h2>
            </div>
            <div class="wt-settingscontent">
                <div class="wt-formtheme wt-userform">
                    <div class="form-group">
                        <?php echo Form::text('footer[copyright]', e($footer_copyright), array('class' => 'form-control')); ?>

                    </div>
                </div>
            </div>
            <div class="wt-tabscontenttitle">
                <h2><?php echo e(trans('lang.footer_menu_1')); ?></h2>
            </div>
            <div class="wt-settingscontent">
                <div class="wt-formtheme wt-userform">
                    <div class="form-group">
                        <?php echo Form::text('footer[menu_title_1]', $menu_title_1 ,array('class' => 'form-control', 'placeholder' => trans('lang.menu_title'))); ?>

                    </div>
                </div>
            </div>
            <div class="wt-settingscontent la-footer-settings">
                <div class="wt-formtheme wt-userform">
                    <div class="form-group">
                        <span class="wt-select">
                            <?php echo Form::select('footer[menu_pages_1][]', $pages, $menu_pages_1 ,array('class' => 'chosen-select', 'multiple', 'data-placeholder' => trans('lang.select_pages'))); ?>

                        </span>
                    </div>
                </div>
            </div>
            <div class="wt-tabscontenttitle">
                <h2><?php echo e(trans('lang.footer_menu')); ?></h2>
            </div>
            <div class="wt-settingscontent">
                <div class="wt-formtheme wt-userform">
                    <div class="form-group">
                        <span class="wt-select">
                            <?php echo Form::select('footer[pages][]', $pages, $menu_pages ,array('class' => 'chosen-select', 'multiple', 'data-placeholder' => trans('lang.select_pages'))); ?>

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

    <div class="wt-settingscontent">
        <?php if(file_exists(resource_path('views/extend/back-end/admin/settings/footer/search-menu.blade.php'))): ?>
            <?php echo $__env->make('extend.back-end.admin.settings.footer.search-menu', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php else: ?>
            <?php echo $__env->make('back-end.admin.settings.footer.search-menu', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php endif; ?>
    </div>
