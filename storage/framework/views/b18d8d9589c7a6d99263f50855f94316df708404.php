<?php $__env->startSection('content'); ?>
    <section class="wt-haslayout wt-dbsectionspace">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 float-left" id="packages">
                <?php if(Session::has('success')): ?>
                    <div class="flash_msg">
                        <flash_messages :message_class="'success'" :time ='5' :message="'<?php echo e(Session::get('success')); ?>'" v-cloak></flash_messages>
                    </div>
                    <?php session()->forget('success'); ?>
                <?php endif; ?>
                <div class="wt-dashboardbox">
                    <div class="wt-dashboardboxtitle">
                        <h2><?php echo e(trans('lang.packages')); ?></h2>
                    </div>
                    <div class="wt-dashboardboxcontent wt-packages">
                        <div class="wt-package wt-packagedetails">
                            <div class="wt-packagehead">
                            </div>
                            <div class="wt-packagecontent">
                                <ul class="wt-packageinfo">
                                    <?php $__currentLoopData = $package_options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $options): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li <?php if($options == 'Price'): ?> class="wt-packageprices" <?php endif; ?>><span><?php echo e($options); ?></span></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        </div>
                        <?php if(!empty($packages) && $packages->count() > 0): ?>
                            <?php $__currentLoopData = $packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php  $options = unserialize($package->options); ?>
                                <?php if(!empty($package)): ?>
                                    <div class="wt-package wt-baiscpackage">
                                        <?php if(!empty($package->title || $package->subtitle )): ?>
                                            <div class="wt-packagehead">
                                                <h3><?php echo e($package->title); ?></h3>
                                                <span><?php echo e($package->subtitle); ?></span>
                                            </div>
                                        <?php endif; ?>
                                        <div class="wt-packagecontent">
                                            <ul class="wt-packageinfo">
                                                <li class="wt-packageprice"><span><sup><?php echo e(!empty($symbol['symbol']) ? $symbol['symbol'] : '$'); ?></sup><?php echo e($package->cost); ?><sub>\ <?php echo e(Helper::getPackageDurationList($options['duration'])); ?></sub></span></li>
                                                <?php $__currentLoopData = $options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php
                                                        if ($key == 'banner_option' || $key == 'private_chat') {
                                                            $class = $option == true ? 'ti-check' : 'ti-na';
                                                        }
                                                    ?>
                                                    <?php if($key == 'banner_option' || $key == 'private_chat'): ?>
                                                        <li><span><i class="<?php echo e($class); ?>"></i></span></li>
                                                    <?php elseif($key == 'duration'): ?>
                                                        <li><span> <?php echo e(Helper::getPackageDurationList($options['duration'])); ?></span></li>
                                                    <?php elseif($key == 'badge'): ?>
                                                        <li><span> <?php echo e(Helper::getBadgeTitle($package->badge_id)); ?></span></li>
                                                    <?php else: ?>
                                                        <li><span> <?php echo e($option); ?></span></li>
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </ul>
                                            <?php if(Auth::user()->getRoleNames()[0] != "admin"): ?>
                                                <a class="wt-btn" href="<?php echo e(url('user/package/checkout/'.$package->id)); ?>"><span><?php echo e(trans('lang.buy_now')); ?></span></a>
                                                
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                            <div class="col-12 col-sm-12 col-md-12 col-lg-8 col-xl-8 float-left">
                                <div class="wt-jobalerts">
                                    <div class="alert alert-warning alert-dismissible fade show">
                                        <em><?php echo e(trans('lang.alert')); ?></em> <span> <?php echo e(trans('lang.curr_on_trial')); ?></span>
                                        <a href="javascript:void(0)" class="wt-alertbtn warning"><?php echo e(trans('lang.buy_now')); ?></a>
                                        <a href="javascript:void(0)" class="close" data-dismiss="alert" aria-label="Close"><i class="fa fa-close"></i></a>
                                    </div>
                                </div>
                            </div>
                            <?php if(file_exists(resource_path('views/extend/errors/no-record.blade.php'))): ?> 
								<?php echo $__env->make('extend.errors.no-record', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
							<?php else: ?> 
								<?php echo $__env->make('errors.no-record', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
							<?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(file_exists(resource_path('views/extend/back-end/master.blade.php')) ? 'extend.back-end.master' : 'back-end.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>