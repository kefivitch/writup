<?php $__env->startSection('content'); ?>
    <div class="wt-haslayout wt-manage-account wt-dbsectionspace la-admin-setting" id="settings">
        <?php if(Session::has('message')): ?>
            <div class="flash_msg">
                <flash_messages :message_class="'success'" :time ='5' :message="'<?php echo e(Session::get('message')); ?>'" v-cloak></flash_messages>
            </div>
        <?php elseif(Session::has('error')): ?>
            <div class="flash_msg">
                <flash_messages :message_class="'danger'" :time ='5' :message="'<?php echo e(Session::get('error')); ?>'" v-cloak></flash_messages>
            </div>
        <?php endif; ?>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-9 float-left">
                <div class="wt-dashboardbox wt-dashboardtabsholder wt-accountsettingholder">
                    <div class="wt-dashboardtabs">
                        <ul class="wt-tabstitle nav navbar-nav">
                            <li class="nav-item">
                                <a class="<?php echo e(\Request::route()->getName()==='settings/#wt-general'? 'active': ''); ?>" data-toggle="tab" href="#wt-general"><?php echo e(trans('lang.general_settings')); ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="<?php echo e(\Request::route()->getName()==='settings/#wt-email'? 'active': ''); ?>" data-toggle="tab" href="#wt-email"><?php echo e(trans('lang.email_settings')); ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="<?php echo e(\Request::route()->getName()==='settings/#wt-payment'? 'active': ''); ?>" data-toggle="tab" href="#wt-payment"><?php echo e(trans('lang.payment_settings')); ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="<?php echo e(\Request::route()->getName()==='settings/#wt-footer'? 'active': ''); ?>" data-toggle="tab" href="#wt-footer"><?php echo e(trans('lang.footer_settings')); ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="<?php echo e(\Request::route()->getName()==='settings/#wt-register'? 'active': ''); ?>" data-toggle="tab" href="#wt-register"><?php echo e(trans('lang.register_form_settings')); ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="<?php echo e(\Request::route()->getName()==='settings/#wt-icons'? 'active': ''); ?>" data-toggle="tab" href="#wt-icons"><?php echo e(trans('lang.dashboard_icons')); ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="<?php echo e(\Request::route()->getName()==='settings/#wt-demo'? 'active': ''); ?>" data-toggle="tab" href="#wt-demo"><?php echo e(trans('lang.demo_content')); ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="<?php echo e(\Request::route()->getName()==='settings/#wt-clear-cache'? 'active': ''); ?>" data-toggle="tab" href="#wt-clear-cache"><?php echo e(trans('lang.menu_clear_cache')); ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="<?php echo e(\Request::route()->getName()==='settings/#wt-inner-pages'? 'active': ''); ?>" data-toggle="tab" href="#wt-inner-pages"><?php echo e(trans('lang.inner_page_settings')); ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="<?php echo e(\Request::route()->getName()==='settings/#wt-import-updates'? 'active': ''); ?>" data-toggle="tab" href="#wt-import-updates"><?php echo e(trans('lang.import_updates')); ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="<?php echo e(\Request::route()->getName()==='settings/#wt-access-type'? 'active': ''); ?>" data-toggle="tab" href="#wt-access-types"><?php echo e(trans('lang.site_access_type')); ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="<?php echo e(\Request::route()->getName()==='settings/#wt-chat-settings'? 'active': ''); ?>" data-toggle="tab" href="#wt-chat-settings"><?php echo e(trans('lang.chat_settings')); ?></a>
                            </li>
                        </ul>
                    </div>
                    <div class="wt-tabscontent tab-content">
                        <div class="wt-securityhold tab-pane active la-general-setting" id="wt-general">
                            <?php if(file_exists(resource_path('views/extend/back-end/admin/settings/general/index.blade.php'))): ?>
                                <?php echo $__env->make('extend.back-end.admin.settings.general.index', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                            <?php else: ?>
                                <?php echo $__env->make('back-end.admin.settings.general.index', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                            <?php endif; ?>
                        </div>
                        <div class="wt-securityhold tab-pane la-email-setting" id="wt-email">
                            <?php if(file_exists(resource_path('views/extend/back-end/admin/settings/email/index.blade.php'))): ?>
                                <?php echo $__env->make('extend.back-end.admin.settings.email.index', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                            <?php else: ?>
                                <?php echo $__env->make('back-end.admin.settings.email.index', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                            <?php endif; ?>
                        </div>
                        <div class="wt-securityhold tab-pane la-payment-setting" id="wt-payment">
                            <?php if(file_exists(resource_path('views/extend/back-end/admin/settings/payment/commision-settings.blade.php'))): ?>
                                <?php echo $__env->make('extend.back-end.admin.settings.payment.commision-settings', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                            <?php else: ?>
                                <?php echo $__env->make('back-end.admin.settings.payment.commision-settings', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                            <?php endif; ?>
                            <?php if(file_exists(resource_path('views/extend/back-end/admin/settings/payment/paypal-settings.blade.php'))): ?>
                                <?php echo $__env->make('extend.back-end.admin.settings.payment.paypal-settings', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                            <?php else: ?>
                                <?php echo $__env->make('back-end.admin.settings.payment.paypal-settings', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                            <?php endif; ?>
                            <?php if(file_exists(resource_path('views/extend/back-end/admin/settings/payment/stripe-settings.blade.php'))): ?>
                                <?php echo $__env->make('extend.back-end.admin.settings.payment.stripe-settings', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                            <?php else: ?>
                                <?php echo $__env->make('back-end.admin.settings.payment.stripe-settings', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                            <?php endif; ?>
                        </div>
                        <div class="wt-securityhold tab-pane la-footer-setting" id="wt-footer">
                            <?php if(file_exists(resource_path('views/extend/back-end/admin/settings/footer/index.blade.php'))): ?>
                                <?php echo $__env->make('extend.back-end.admin.settings.footer.index', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                            <?php else: ?>
                                <?php echo $__env->make('back-end.admin.settings.footer.index', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                            <?php endif; ?>
                        </div>
                        <div class="wt-securityhold tab-pane la-footer-setting" id="wt-register">
                            <?php if(file_exists(resource_path('views/extend/back-end/admin/settings/register/index.blade.php'))): ?>
                                <?php echo $__env->make('extend.back-end.admin.settings.register.index', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                            <?php else: ?>
                                <?php echo $__env->make('back-end.admin.settings.register.index', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                            <?php endif; ?>
                        </div>
                        <div class="wt-securityhold tab-pane la-footer-setting" id="wt-icons">
                            <?php if(file_exists(resource_path('views/extend/back-end/admin/settings/icon/index.blade.php'))): ?>
                                <?php echo $__env->make('extend.back-end.admin.settings.icon.index', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                            <?php else: ?>
                                <?php echo $__env->make('back-end.admin.settings.icon.index', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                            <?php endif; ?>
                        </div>
                        <div class="wt-securityhold tab-pane la-footer-setting" id="wt-demo">
                            <?php if(file_exists(resource_path('views/extend/back-end/admin/settings/demo-content/index.blade.php'))): ?>
                                <?php echo $__env->make('extend.back-end.admin.settings.demo-content.index', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                            <?php else: ?>
                                <?php echo $__env->make('back-end.admin.settings.demo-content.index', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                            <?php endif; ?>
                        </div>
                        <div class="wt-securityhold tab-pane la-footer-setting" id="wt-clear-cache">
                            <?php if(file_exists(resource_path('views/extend/back-end/admin/settings/clear-cache/index.blade.php'))): ?>
                                <?php echo $__env->make('extend.back-end.admin.settings.clear-cache.index', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                            <?php else: ?>
                                <?php echo $__env->make('back-end.admin.settings.clear-cache.index', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                            <?php endif; ?>
                        </div>
                        <div class="wt-securityhold tab-pane la-footer-setting" id="wt-inner-pages">
                            <?php if(file_exists(resource_path('views/extend/back-end/admin/settings/inner-pages/index.blade.php'))): ?>
                                <?php echo $__env->make('extend.back-end.admin.settings.inner-pages.index', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                            <?php else: ?>
                                <?php echo $__env->make('back-end.admin.settings.inner-pages.index', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                            <?php endif; ?>
                        </div>
                        <div class="wt-securityhold tab-pane la-footer-setting" id="wt-import-updates">
                            <?php if(file_exists(resource_path('views/extend/back-end/admin/settings/updates/index.blade.php'))): ?>
                                <?php echo $__env->make('extend.back-end.admin.settings.updates.index', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                            <?php else: ?>
                                <?php echo $__env->make('back-end.admin.settings.updates.index', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                            <?php endif; ?>
                        </div>
                        <div class="wt-securityhold tab-pane la-footer-setting" id="wt-access-types">
                            <?php if(file_exists(resource_path('views/extend/back-end/admin/settings/site-access-type/index.blade.php'))): ?>
                                <?php echo $__env->make('extend.back-end.admin.settings.site-access-type.index', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                            <?php else: ?>
                                <?php echo $__env->make('back-end.admin.settings.site-access-type.index', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                            <?php endif; ?>
                        </div>
                        <div class="wt-securityhold tab-pane la-footer-setting" id="wt-chat-settings">
                            <?php if(file_exists(resource_path('views/extend/back-end/admin/settings/chat-settings/index.blade.php'))): ?>
                                <?php echo $__env->make('extend.back-end.admin.settings.chat-settings.index', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                            <?php else: ?>
                                <?php echo $__env->make('back-end.admin.settings.chat-settings.index', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(file_exists(resource_path('views/extend/back-end/master.blade.php')) ? 'extend.back-end.master' : 'back-end.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>