<?php echo Form::open(['url' => '', 'class' =>'wt-formtheme wt-userform', 'id' =>'submit-chat-form', '@submit.prevent'=>'submitChatSettings']); ?>

    <div class="wt-location wt-tabsinfo">
        <div class="wt-tabscontenttitle">
            <h2><?php echo e(trans('lang.host')); ?></h2>
        </div>
        <div class="wt-settingscontent">
            <div class="wt-description">
                <ol>
                    <li><?php echo e(trans('lang.host_note_1')); ?></li>
                    <li><?php echo e(trans('lang.host_note_2')); ?></li>
                </ol>
            </div>
            <div class="wt-formtheme wt-userform">
                <div class="form-group">
                    <?php echo Form::text('host', e($host), array('class' => 'form-control', 'placeholder'=>trans('lang.host'))); ?>

                </div>
            </div>
        </div>
    </div>
    <div class="wt-location wt-tabsinfo">
        <div class="wt-tabscontenttitle">
            <h2><?php echo e(trans('lang.port')); ?></h2>
        </div>
        <div class="wt-settingscontent">
            <div class="wt-description">
                <?php echo e(trans('lang.port_note_1')); ?>

                <ol>
                    <li><?php echo e(trans('lang.port_note_2')); ?></li>
                    <li><?php echo e(trans('lang.port_note_3')); ?></li>
                    <li>
                        <?php echo e(trans('lang.port_note_4')); ?>

                        <?php echo e(trans('lang.port_note_5')); ?>

                        <?php echo e(trans('lang.port_note_6')); ?>

                    </li>
                </ol>
            </div>
            <div class="wt-formtheme wt-userform">
                <div class="form-group">
                    <?php echo Form::number('port', e($port), array('class' => 'form-control', 'placeholder'=>trans('lang.port'))); ?>

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

