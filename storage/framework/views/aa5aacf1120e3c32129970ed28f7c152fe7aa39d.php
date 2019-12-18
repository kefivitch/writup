<div class="wt-location wt-tabsinfo">
    <div class="wt-tabscontenttitle">
        <h2><?php echo e(trans('lang.upload_favicon')); ?></h2>
    </div>
    <div class="wt-settingscontent">
        <?php if(!empty($favicon)): ?>
            <?php $image = '/uploads/settings/general/'.$favicon; ?>
            <div class="wt-formtheme wt-userform">
                <div v-if="this.favicon">
                    <upload-image
                        :id="'favicon'"
                        :img_ref="'favicon_ref'"
                        :url="'<?php echo e(url('admin/upload-temp-image/favicon')); ?>'"
                        :name="'favicon'">
                    </upload-image>
                </div>
                <div class="wt-uploadingbox" v-else>
                    <figure><img src="<?php echo e(asset($image)); ?>" alt="<?php echo e(trans('lang.favicon')); ?>"></figure>
                    <div class="wt-uploadingbar">
                        <div class="dz-filename"><?php echo e($favicon); ?></div>
                        <em><?php echo e(trans('lang.file_size')); ?><a href="javascript:void(0);" class="lnr lnr-cross" v-on:click.prevent="removeImage('hidden_site_favicon')"></a></em>
                    </div>
                </div>
                <input type="hidden" name="settings[0][favicon]" id="hidden_site_favicon" value="<?php echo e($favicon); ?>">
            </div>
        <?php else: ?>
            <div class="wt-formtheme wt-userform">
                <upload-image
                    :id="'favicon'"
                    :img_ref="'favicon_ref'"
                    :url="'<?php echo e(url('admin/upload-temp-image/favicon')); ?>'"
                    :name="'favicon'">
                </upload-image>
                <input type="hidden" name="settings[0][favicon]" id="hidden_site_favicon">
            </div>
        <?php endif; ?>
    </div>
</div>
