<div class="preloader-section" v-if="loading" v-cloak>
    <div class="preloader-holder">
        <div class="loader"></div>
    </div>
</div>
<?php echo Form::open(['url' => '', 'class' =>'wt-formtheme wt-userform la-dashboard-icons', 'id'
=>'upload_dashboard_icon', '@submit.prevent'=>'uploadDashboardIcons']); ?>

<?php $__currentLoopData = $icons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $icon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="wt-selectdesignholder wt-tabsinfo">
        <div class="wt-selectdesign la-selectthemecolor">
            <?php if(!empty($dash_icons['hidden_'.$key])): ?>
                <dashboard-icon
                :title="'<?php echo e($icon['title']); ?>'"
                :icon="'<?php echo e($icon['value']); ?>'"
                :icon_id="'<?php echo e($icon['value']); ?>'"
                :icon_name="'<?php echo e($icon['value']); ?>'"
                :icon_ref="'<?php echo e($icon['value']); ?>'"
                :icon_hidden_name="'icons[hidden_<?php echo e($icon['value']); ?>][hidden_<?php echo e($icon['value']); ?>]'"
                icon_hidden_id="'hidden_<?php echo e($icon['value']); ?>'"
                :existed_icon="'<?php echo e($dash_icons['hidden_'.$key]); ?>'"
                >
                </dashboard-icon>
            <?php else: ?>
                <dashboard-icon
                :title="'<?php echo e($icon['title']); ?>'"
                :icon="'<?php echo e($icon['value']); ?>'"
                :icon_id="'<?php echo e($icon['value']); ?>'"
                :icon_name="'<?php echo e($icon['value']); ?>'"
                :icon_ref="'<?php echo e($icon['value']); ?>'"
                :icon_hidden_name="'icons[hidden_<?php echo e($icon['value']); ?>][hidden_<?php echo e($icon['value']); ?>]'"
                icon_hidden_id="'hidden_<?php echo e($icon['value']); ?>'"
                >
                </dashboard-icon>
            <?php endif; ?>
        </div>
    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<div class="wt-updatall la-updateall-holder">
    <i class="ti-announcement"></i>
    <span><?php echo e(trans('lang.save_changes_note')); ?></span>
    <?php echo Form::submit(trans('lang.btn_save'),['class' => 'wt-btn']); ?>

</div>

<?php echo Form::close(); ?>

