<?php $__env->startSection('content'); ?>
    <div class="wt-haslayout wt-manage-account wt-dbsectionspace la-setting-holder" id="settings">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-9">
                <div class="wt-dashboardbox wt-dashboardtabsholder wt-accountsettingholder">
                    <div class="wt-dashboardtabs">
                        <ul class="wt-tabstitle nav navbar-nav">
                            <li class="nav-item">
                                <a class="active" data-toggle="tab" href="#wt-banner"><?php echo e(trans('lang.banner_settings')); ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="" data-toggle="tab" href="#wt-sections"><?php echo e(trans('lang.sections')); ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="" data-toggle="tab" href="#wt-services-sections"><?php echo e(trans('lang.services_section')); ?></a>
                            </li>
                        </ul>
                    </div>
                    <div class="wt-tabscontent tab-content">
                        <div class="wt-securityhold tab-pane active la-banner-settings" id="wt-banner">
                            <?php echo Form::open(['url' => '', 'class' =>'wt-formtheme wt-userform', 'id' =>'home-settings-form', '@submit.prevent'=>'submitHomeSettings']); ?>

                                <?php if(file_exists(resource_path('views/extend/back-end/admin/home-page-settings/banner-settings/index.blade.php'))): ?>
                                    <?php echo $__env->make('extend.back-end.admin.home-page-settings.banner-settings.index', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                <?php else: ?>
                                    <?php echo $__env->make('back-end.admin.home-page-settings.banner-settings.index', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                <?php endif; ?>
                                <div class="wt-updatall la-updateall-holder">
                                    <i class="ti-announcement"></i>
                                    <span><?php echo e(trans('lang.save_changes_note')); ?></span>
                                    <?php echo Form::submit(trans('lang.btn_save'),['class' => 'wt-btn']); ?>

                                </div>
                                
                            <?php echo Form::close(); ?>

                        </div>
                        <div class="wt-securityhold tab-pane la-section-settings" id="wt-sections">
                            <?php echo Form::open(['url' => '', 'class' =>'wt-formtheme wt-userform', 'id' =>'section-settings-form', '@submit.prevent'=>'submitSectionSettings']); ?>

                                <?php if(file_exists(resource_path('views/extend/back-end/admin/home-page-settings/sections/index.blade.php'))): ?>
                                    <?php echo $__env->make('extend.back-end.admin.home-page-settings.sections.index', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                <?php else: ?>
                                    <?php echo $__env->make('back-end.admin.home-page-settings.sections.index', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                <?php endif; ?>
                                <div class="wt-updatall la-updateall-holder">
                                    <i class="ti-announcement"></i>
                                    <span><?php echo e(trans('lang.save_changes_note')); ?></span>
                                    <?php echo Form::submit(trans('lang.btn_save'),['class' => 'wt-btn']); ?>

                                </div>
                            <?php echo Form::close(); ?>

                        </div>
                        <div class="wt-securityhold tab-pane la-section-settings" id="wt-services-sections">
                            <?php if(file_exists(resource_path('views/extend/back-end/admin/home-page-settings/services-section.blade.php'))): ?>
                                <?php echo $__env->make('extend.back-end.admin.home-page-settings.services-section', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                            <?php else: ?>
                                <?php echo $__env->make('back-end.admin.home-page-settings.services-section', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(file_exists(resource_path('views/extend/back-end/master.blade.php')) ? 'extend.back-end.master' : 'back-end.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>