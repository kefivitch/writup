<?php $__env->startSection('content'); ?>
    <div class="wt-dbsectionspace wt-haslayout la-ps-freelancer">
        <div class="freelancer-profile" id="invoice_list">
            <div class="preloader-section" v-if="loading" v-cloak>
                <div class="preloader-holder">
                    <div class="loader"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-9">
                    <div class="wt-dashboardbox wt-dashboardtabsholder">
                        <?php if(file_exists(resource_path('views/extend/back-end/freelancer/payouts/tabs.blade.php'))): ?>
                            <?php echo $__env->make('extend.back-end.freelancer.payouts.tabs', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        <?php else: ?>
                            <?php echo $__env->make('back-end.freelancer.payouts.tabs', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        <?php endif; ?>
                        <div class="wt-tabscontent tab-content">
                            <div class="wt-tabscontenttitle">
                                <h2><?php echo e(trans('lang.payout_settings')); ?></h2>
                            </div>
                            <div class="wt-settingscontent">
                                <div class="wt-description">
                                    <p><?php echo e(trans('lang.payout_settings_note')); ?></p>
                                </div>
                                <form class="wt-formtheme wt-payout-settings la-payout-settings" @submit.prevent="submitPayoutsDetail(<?php echo e(Auth::user()->id); ?>)" id="profile_payout_detail">
                                        <?php if( !empty($payrols) ): ?>
                                            <?php $__currentLoopData = $payrols; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pay_key	=> $payrol): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php
                                                    $vue_display = $payrol['id'] == 'bacs' ? 'show_bank_fields' : 'show_paypal_fields';
                                                    $checked =  $payout_settings['type'] == $payrol['id'] ? 'checked' : '';
                                                ?>
                                                <?php if( !empty($payrol['status']) && $payrol['status'] === 'enable' ): ?>
                                                    <fieldset>
                                                        <div class="wt-checkboxholder">
                                                            <span class="wt-radio">
                                                                <input id="payrols-<?php echo e($payrol['id']); ?>" type="radio" name="payout_settings[type]" value="<?php echo e($payrol['id']); ?>" v-on:change="changePayout('<?php echo e($payrol['id']); ?>')" <?php echo e($checked); ?>>
                                                                <label for="payrols-<?php echo e($payrol['id']); ?>">
                                                                    <figure class="wt-userlistingimg">
                                                                        <img src="<?php echo e($payrol['img_url']); ?>" alt="<?php echo e($payrol['title']); ?>">
                                                                    </figure>
                                                                </label>
                                                            </span>
                                                        </div>
                                                        <div class="fields-wrapper wt-haslayout" v-if="<?php echo e($vue_display); ?>">
                                                            <div class="wt-description">
                                                                <?php if($payrol['id'] == 'paypal'): ?>
                                                                    <p><?php echo e(trans('lang.paypal_payout_id_text')); ?> <a target="_blank" href="https://www.paypal.com/"> <?php echo e(trans('lang.paypal')); ?> </a> | <a target="_blank" href="https://www.paypal.com/signup/"><?php echo e(trans('lang.payout_id_create_acc')); ?></a></p>
                                                                <?php elseif($payrol['id'] == 'bacs'): ?>
                                                                    <p><?php echo e(trans('lang.bank_payout_id_text')); ?></p>
                                                                <?php endif; ?>
                                                            </div>
                                                            <?php if( !empty($payrol['fields'])): ?>
                                                                <?php $__currentLoopData = $payrol['fields']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <?php $db_value	= !empty($payout_settings[$key]) ? $payout_settings[$key] : ""; ?>
                                                                <div class="form-group form-group-half toolip-wrapo">
                                                                    <input type="<?php echo e($field['type']); ?>" name="payout_settings[<?php echo e($key); ?>]" id="<?php echo e($key); ?>-payrols" class="form-control" placeholder="<?php echo e($field['placeholder']); ?>" value="<?php echo e($db_value); ?>">
                                                                </div>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            <?php endif; ?>
                                                        </div>
                                                    </fieldset>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                        <fieldset>
                                            <div class="form-group wt-btnarea">
                                                <button type="submit" class="wt-btn wt-payrols-settings" data-id="<?php echo $payrol['id']; ?>">submit</button>
                                            </div>
                                        </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(file_exists(resource_path('views/extend/back-end/master.blade.php')) ? 'extend.back-end.master' : 'back-end.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>