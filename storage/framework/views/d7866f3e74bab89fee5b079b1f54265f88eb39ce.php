<div class="wt-location wt-tabsinfo">
    <div class="wt-settingscontent">
        <?php if(!empty($page_banner)): ?>
            <?php
                $image = '/uploads/pages/'.$page_banner;
                $file_name = Helper::formateFileName($page_banner);
            ?>
            <div class="wt-formtheme wt-userform">
                <div v-if="this.page_banner">
                    <upload-image
                        :id="'page_banner'"
                        :img_ref="'f_banner_ref'"
                        :url="'<?php echo e(url('admin/pages/upload-temp-image/page_banner')); ?>'"
                        :name="'page_banner'">
                    </upload-image>
                </div>
                <div class="wt-uploadingbox" v-else>
                    <figure><img src="<?php echo e(asset($image)); ?>" alt="<?php echo e(trans('lang.banner_photo')); ?>"></figure>
                    <div class="wt-uploadingbar">
                        <div class="dz-filename"><?php echo e($file_name); ?></div>
                        <em><?php echo e(trans('lang.file_size')); ?><a href="javascript:void(0);" class="lnr lnr-cross" v-on:click.prevent="removeImage('hidden_page_banner')"></a></em>
                    </div>
                </div>
                <input type="hidden" name="page_banner" id="hidden_page_banner" value="<?php echo e($page_banner); ?>">
            </div>
        <?php else: ?>
            <div class="wt-formtheme wt-userform">
                <upload-image
                    :id="'page_banner'"
                    :img_ref="'f_banner_ref'"
                    :url="'<?php echo e(url('admin/pages/upload-temp-image/page_banner')); ?>'"
                    :name="'page_banner'">
                </upload-image>
                <input type="hidden" name="page_banner" id="hidden_page_banner">
            </div>
        <?php endif; ?>
    </div>
</div>
