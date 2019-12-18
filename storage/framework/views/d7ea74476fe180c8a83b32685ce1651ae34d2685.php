<?php echo Form::open(['url' => '', 'class' =>'wt-formtheme wt-userform', 'id' =>'services-sec-settings', '@submit.prevent'=>'submitServicesSectionSettings']); ?>

<div class="wt-tabscontenttitle la-switch-option">
    <h2><?php echo e(trans('lang.show_services_sec')); ?></h2>
    <switch_button v-model="show_services_section"><?php echo e(trans('lang.show_hide_sec')); ?></switch_button>
    <input type="hidden" :value="show_services_section" name="show_services_section">
</div>
<div class="wt-location wt-tabsinfo">
    <h6><?php echo e(trans('lang.title')); ?></h6>
    <div class="wt-settingscontent">
        <div class="wt-formtheme wt-userform">
            <div class="form-group">
                <?php echo Form::text('title', e($service_sec_title), array('class' => 'form-control')); ?>

            </div>
        </div>
    </div>
</div>
<div class="wt-location wt-tabsinfo">
    <h6><?php echo e(trans('lang.subtitle')); ?></h6>
    <div class="wt-settingscontent">
        <div class="wt-formtheme wt-userform">
            <div class="form-group">
                <?php echo Form::text('subtitle', e($service_sec_subtitle), array('class' => 'form-control')); ?>

            </div>
        </div>
    </div>
</div>
<div class="wt-location wt-tabsinfo">
    <h6><?php echo e(trans('lang.description')); ?></h6>
    <div class="wt-settingscontent">
        <div class="wt-formtheme wt-userform">
            <div class="form-group">
                <?php echo Form::textarea('description', e($service_sec_description), array('class' => 'form-control wt-tinymceeditor', 'id' => 'wt-tinymceeditor')); ?>

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

