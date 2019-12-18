<div class="preloader-section" v-if="loading" v-cloak>
    <div class="preloader-holder">
        <div class="loader"></div>
    </div>
</div>
<div class="wt-location wt-tabsinfo">
    <div class="wt-tabscontenttitle">
        <h2><?php echo e(trans('lang.import_updates')); ?></h2>
    </div>
    <?php echo Form::open(['url' => '', 'class' =>'wt-formtheme wt-userform', 'id'
        =>'import-updates', '@submit.prevent'=>'importUpdate("'.trans('lang.imprted').'", "'.trans('lang.imprt_success').'")']); ?>

        <div class="wt-securitysettings wt-tabsinfo  wt-haslayout">
            <div class="wt-settingscontent">
                <div class="wt-description">
                    <p><?php echo e(trans('lang.import_updates_note')); ?></p>
                </div>
            </div>
        </div>
        <div class="wt-updatall la-updateall-holder">
            <i class="ti-announcement"></i>
            <span><?php echo e(trans('lang.save_update_note')); ?></span>
            <?php echo Form::submit(trans('lang.btn_import_updates'),['class' => 'wt-btn']); ?>

        </div>
    <?php echo Form::close(); ?>

    
</div>
