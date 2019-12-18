<div class="preloader-section" v-if="loading" v-cloak>
    <div class="preloader-holder">
        <div class="loader"></div>
    </div>
</div>
<div class="wt-location wt-tabsinfo">
    <div class="wt-tabscontenttitle">
        <h2><?php echo e(trans('lang.menu_clear_cache')); ?></h2>
    </div>
    <?php echo Form::open(['url' => '', 'class' =>'wt-formtheme wt-userform', 'id'
            =>'form-cache-clear', '@submit.prevent'=>'clearCache']); ?>

        <div class="wt-securitysettings wt-tabsinfo  wt-haslayout">
            <div class="wt-settingscontent">
                <div class="wt-description">
                    <p><?php echo e(trans('lang.selected_cache_note')); ?></p>
                </div>
                <ul class="wt-accountinfo">
                    <li>
                        <switch_button v-model="clear_cache"><?php echo e(trans('lang.clear_cache')); ?></switch_button>
                        <input type="hidden" :value="clear_cache" name="clear_cache">
                    </li>
                    <li>
                        <switch_button v-model="clear_views"><?php echo e(trans('lang.clear_views')); ?></switch_button>
                        <input type="hidden" :value="clear_views" name="clear_views">
                    </li>
                    <li>
                        <switch_button v-model="clear_routes"><?php echo e(trans('lang.clear_routes')); ?></switch_button>
                        <input type="hidden" :value="clear_routes" name="clear_routes">
                    </li>
                </ul>
            </div>
        </div>
    <?php echo Form::submit(trans('lang.btn_clear_selected_cache'), array('class' => 'wt-btn')); ?>

    <?php echo Form::close(); ?>

</div>
<div class="wt-location wt-tabsinfo">
    <div class="wt-tabscontenttitle">
        <h2><?php echo e(trans('lang.clr_all_cache')); ?></h2>
    </div>
    <?php echo Form::open(['url' => '', 'class' =>'wt-formtheme wt-userform', 'id'
        =>'cache-clear', '@submit.prevent'=>'clearAllCache']); ?>

        <div class="wt-securitysettings wt-tabsinfo  wt-haslayout">
            <div class="wt-settingscontent">
                <div class="wt-description">
                    <p><?php echo e(trans('lang.clear_all_cache_note')); ?></p>
                </div>
            </div>
        </div>
    <?php echo Form::submit(trans('lang.btn_clear_all_cache'), array('class' => 'wt-btn')); ?>

    <?php echo Form::close(); ?>

</div>
