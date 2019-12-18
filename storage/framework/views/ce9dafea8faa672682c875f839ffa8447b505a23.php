<?php $__env->startSection('content'); ?>
    <section class="wt-haslayout wt-dbsectionspace">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-9 float-right" id="invoice_list">
                <div class="wt-dashboardbox wt-dashboardinvocies">
                    <?php if(file_exists(resource_path('views/extend/back-end/freelancer/profile-settings/tabs.blade.php'))): ?>
                        <?php echo $__env->make('extend.back-end.freelancer.payouts.tabs', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php else: ?>
                        <?php echo $__env->make('back-end.freelancer.payouts.tabs', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php endif; ?>
                    <div class="wt-tabscontent tab-content">
                        <div class="wt-tabscontenttitle">
                            <h2><?php echo e(trans('lang.payouts')); ?></h2>
                        </div>
                        <div class="wt-dashboardboxcontent wt-categoriescontentholder wt-categoriesholder">
                            <table class="wt-tablecategories">
                                <thead>
                                    <tr>
                                        <th><?php echo e(trans('lang.date')); ?></th>
                                        <th><?php echo e(trans('lang.amount')); ?></th>
                                        <th><?php echo e(trans('lang.payment_method')); ?></th>
                                    </tr>
                                </thead>
                                <?php if($payouts->count() > 0): ?>
                                    <tbody>
                                        <?php $__currentLoopData = $payouts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $payout): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e(\Carbon\Carbon::parse($payout->created_at)->format('M d, Y')); ?></td>
                                                <td><?php echo e(Helper::currencyList($payout->currency)['symbol']); ?><?php echo e($payout->amount); ?></td>
                                                <td>
                                                    <?php echo e(!empty(Helper::getPayoutsList()[$payout->payment_method]['title']) ? Helper::getPayoutsList()[$payout->payment_method]['title'] : ''); ?>

                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                <?php endif; ?>
                            </table>
                            <?php if($payouts->count() === 0): ?>
                                <?php if(file_exists(resource_path('views/extend/errors/no-record.blade.php'))): ?>
                                    <?php echo $__env->make('extend.errors.no-record', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                <?php else: ?>
                                    <?php echo $__env->make('errors.no-record', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                <?php endif; ?>
                            <?php endif; ?>
                            <?php if( method_exists($payouts,'links') ): ?>
                                <?php echo e($payouts->links('pagination.custom')); ?>

                            <?php endif; ?>
                        </div>
                    </div
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(file_exists(resource_path('views/extend/back-end/master.blade.php')) ? 'extend.back-end.master' : 'back-end.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>