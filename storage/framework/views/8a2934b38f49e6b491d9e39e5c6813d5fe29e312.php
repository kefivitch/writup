<?php $__env->startSection('content'); ?>
    <section class="wt-haslayout wt-dbsectionspace">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-9 float-right" id="invoice_list">
                <div class="preloader-section" v-if="loading" v-cloak>
                    <div class="preloader-holder">
                        <div class="loader"></div>
                    </div>
                </div>
                <div class="wt-dashboardbox wt-dashboardinvocies la-payout-holder">
                    <div class="wt-dashboardboxtitle wt-titlewithsearch wt-titlewithbtn">
                        <h2><?php echo e(trans('lang.payouts')); ?></h2>
                        <?php if($selected_year): ?>
                            <a href="javascript:;" v-on:click="generatePdfPayout('<?php echo e($selected_year); ?>', '<?php echo e($selected_month); ?>')" class="wt-btn"> <?php echo e(trans('lang.download')); ?></a>
                        <?php endif; ?>
                        <?php echo Form::open(['url' => url('admin/payouts'), 'method' => 'get', 'class' => 'wt-formtheme wt-formsearch', 'id'=>'payout_year_filter']); ?>

                            <span class="wt-select">
                                <select name="year" @change.prevent='getPayouts' id="payout_year">
                                    <option value="" disabled selected><?php echo e(trans('lang.select_year')); ?></option>
                                    <?php $__currentLoopData = $years; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $year): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php $selected = $selected_year == $year ? 'selected' : '' ?>
                                        <option value="<?php echo e($year); ?>" <?php echo e($selected); ?>> <?php echo e($year); ?> </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </span>
                            <span class="wt-select">
                                <select name="month" @change.prevent='getPayouts' id="payout_month">
                                    <option value="" disabled selected><?php echo e(trans('lang.select_month')); ?></option>
                                    <?php $__currentLoopData = $months; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $month): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php $selected = $selected_month == $key ? 'selected' : '' ?>
                                        <option value="<?php echo e($key); ?>" <?php echo e($selected); ?>> <?php echo e($month); ?> </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </span>
                        <?php echo Form::close(); ?>

                    </div>
                    <div class="wt-dashboardboxcontent wt-categoriescontentholder wt-categoriesholder">
                        <?php if(file_exists(resource_path('views/extend/back-end/admin/payouts-table.blade.php'))): ?> 
                            <?php echo $__env->make('extend.back-end.admin.payouts-table', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        <?php else: ?> 
                            <?php echo $__env->make('back-end.admin.payouts-table', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        <?php endif; ?>
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
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(file_exists(resource_path('views/extend/back-end/master.blade.php')) ? 'extend.back-end.master' : 'back-end.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>