<table class="wt-tablecategories" style="font-family:'Poppins', Arial, Helvetica, sans-serif; background-size:2px;background-size: 100% 2px; background-repeat: no-repeat;border: 1px solid #eee;">
    <thead>
        <tr style="background: #fcfcfc;">
            <th style="font-weight: 500;color: #323232;font-size: 15px;line-height: 20px;text-align: left;padding: 15px 20px;"><?php echo e(trans('lang.user_name')); ?></th>
            <th style="font-weight: 500;color: #323232;font-size: 15px;line-height: 20px;text-align: left;padding: 15px 20px;"><?php echo e(trans('lang.amount')); ?></th>
            <th style="font-weight: 500;color: #323232;font-size: 15px;line-height: 20px;text-align: left;padding: 15px 20px;"><?php echo e(trans('lang.payment_method')); ?></th>
            <th style="font-weight: 500;color: #323232;font-size: 15px;line-height: 20px;text-align: left;padding: 15px 20px;"><?php echo e(trans('lang.processing_date')); ?></th>
            <th style="font-weight: 500;color: #323232;font-size: 15px;line-height: 20px;text-align: left;padding: 15px 20px;"><?php echo e(trans('lang.status')); ?></th>
        </tr>
    </thead>
    <?php if($payouts->count() > 0): ?>
        <tbody id="payout-table">
            <?php $__currentLoopData = $payouts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $payout): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr id="<?php echo e($payout->id); ?>">
                    <td style="border-top: 1px solid #eff2f5;color: #767676;font-size: 13px;line-height: 20px;padding: 10px 20px;text-align: left;"><?php echo e(Helper::getUserName($payout->user_id)); ?></td>
                    <td style="border-top: 1px solid #eff2f5;color: #767676;font-size: 13px;line-height: 20px;padding: 10px 20px;text-align: left;">
                        <?php echo e(Helper::currencyList($payout->currency)['symbol']); ?><?php echo e($payout->amount); ?>

                    </td>
                    <td style="border-top: 1px solid #eff2f5;color: #767676;font-size: 13px;line-height: 20px;padding: 10px 20px;text-align: left;">
                        <?php echo e(!empty(Helper::getPayoutsList()[$payout->payment_method]['title']) ? Helper::getPayoutsList()[$payout->payment_method]['title'] : ''); ?>

                    </td>
                    <td style="border-top: 1px solid #eff2f5;color: #767676;font-size: 13px;line-height: 20px;padding: 10px 20px;text-align: left;"><?php echo e(\Carbon\Carbon::parse($payout->created_at)->format('M d, Y')); ?></td>
                    
                    <td style="border-top: 1px solid #eff2f5;color: #767676;font-size: 13px;line-height: 20px;padding: 10px 20px;text-align: left;">
                        <span class="bt-content">
                            <form class="wt-formtheme wt-formsearch change-payout-status" id="change_job_status">
                                <fieldset>
                                    <div class="form-group">
                                        <span class="wt-select">
                                            <select id="<?php echo e($payout->id); ?>-payout_status">
                                                <option value="pending" <?php echo e($payout->status == 'pending' ? 'selected' : ''); ?>><?php echo e(trans('lang.pending')); ?></option>
                                                <option value="completed" <?php echo e($payout->status == 'completed' ? 'selected' : ''); ?>><?php echo e(trans('lang.completed')); ?></option>
                                            </select>
                                        </span>
                                        <a href="javascrip:void(0);" class="wt-searchgbtn" @click.prevent='changePayoutStatus(<?php echo e($payout->id); ?>)'><i class="fa fa-check"></i></a>
                                    </div>
                                </fieldset>
                            </form>
                        </span>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    <?php endif; ?>
</table>