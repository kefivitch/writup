<?php $__env->startSection('content'); ?>
    <div class="pages-listing" id="pages-list">
        <?php if(Session::has('message')): ?>
            <div class="flash_msg">
                <flash_messages :message_class="'success'" :time='5' :message="'<?php echo e(Session::get('message')); ?>'" v-cloak></flash_messages>
            </div>
        <?php elseif(Session::has('error')): ?>
            <div class="flash_msg">
                <flash_messages :message_class="'danger'" :time ='5' :message="'<?php echo e(Session::get('error')); ?>'" v-cloak></flash_messages>
            </div>
        <?php endif; ?>
        <?php if($errors->any()): ?>
            <ul class="wt-jobalerts">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="flash_msg">
                        <flash_messages :message_class="'danger'" :time='10' :message="'<?php echo e($error); ?>'" v-cloak></flash_messages>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        <?php endif; ?>
        <section class="wt-haslayout wt-dbsectionspace">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-12 float-left">
                    <div class="wt-dashboardbox">
                        <div class="wt-dashboardboxtitle">
                            <h2><?php echo e(trans('lang.edit_page')); ?></h2>
                        </div>
                        <div class="wt-dashboardboxcontent">
                            <?php echo Form::open([ 'url' => url('admin/pages/update-page/'.$page->id.''), 'class' =>'wt-formtheme wt-formprojectinfo wt-formcategory','id' => 'pages']); ?>

                                <fieldset>
                                    <div class="form-group">
                                        <?php echo Form::text( 'title', e($page->title), ['class' =>'form-control', 'placeholder' => trans('lang.ph_page_title')] ); ?>

                                    </div>
                                    <div class="form-group">
                                        <?php echo Form::textarea( 'content', e($page->body), ['class' =>'form-control wt-tinymceeditor', 'placeholder' => trans('lang.ph_desc')]); ?>

                                    </div>
                                    <?php if(empty($has_child)): ?>
                                        <?php if($parent_page->count() >= 1): ?>
                                            <div class="form-group">
                                                <span class="wt-select">
                                                    <?php echo Form::select('parent_id', $parent_page, $parent_selected_id , array('class' => 'form-control wt-select2')); ?>

                                                </span>
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <div class="wt-securitysettings wt-tabsinfo wt-haslayout">
                                        <div class="wt-tabscontenttitle">
                                            <h2><?php echo e(trans('lang.seo_meta_desc')); ?></h2>
                                        </div>
                                        <div class="wt-settingscontent">
                                            <div class="form-group">
                                                <?php echo Form::textarea('seo_desc', $seo_desc, array('class' => 'form-group seo-meta', 'placeholder' => trans('lang.description'))); ?>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="wt-tabscontenttitle la-switch-option">
                                        <h2><?php echo e(trans('lang.add_menu_to_navbar')); ?></h2>
                                        <switch_button v-model="show_page"><?php echo e(trans('lang.add_menu_to_navbar')); ?></switch_button>
                                        <input type="hidden" :value="show_page" name="show_page">
                                    </div>
                                    <div class="wt-tabscontenttitle la-switch-option">
                                        <h2><?php echo e(trans('lang.show_page_banner')); ?></h2>
                                        <switch_button v-model="show_page_banner"><?php echo e(trans('lang.show_hide_banner')); ?></switch_button>
                                        <input type="hidden" :value="show_page_banner" name="show_page_banner">
                                    </div>
                                    <?php if(file_exists(resource_path('views/extend/back-end/admin/pages/page_inner_banner.blade.php'))): ?> 
                                        <?php echo $__env->make('extend.back-end.admin.pages.page_inner_banner', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                    <?php else: ?> 
                                        <?php echo $__env->make('back-end.admin.pages.page_inner_banner', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                    <?php endif; ?>
                                    <div class="form-group wt-btnarea">
                                        <?php echo Form::submit(trans('lang.update_page'), ['class' => 'wt-btn']); ?>

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