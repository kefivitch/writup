<?php $__env->startSection('content'); ?>
<div class="wt-haslayout wt-dbsectionspace">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <div class="wt-dashboardbox">
                <div class="wt-dashboardboxtitle">
                    <h2><?php echo e(trans('lang.completed_jobs')); ?></h2>
                </div>
                <div class="wt-dashboardboxcontent wt-jobdetailsholder la-projectc-completed">
                    <div class="wt-freelancerholder">
                        <?php if(!empty($completed_jobs) && $completed_jobs->count() > 0): ?>
                            <div class="wt-managejobcontent wt-verticalscrollbar mCustomScrollbar _mCS_1">
                                <?php $__currentLoopData = $completed_jobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $accepted_proposal = \App\Job::find($job->id)->proposals()->where('status', 'completed')->first();
                                        $profile = \App\User::find($accepted_proposal->freelancer_id)->profile;
                                        $user_image = !empty($profile) ? $profile->avater : '';
                                        $verified_user = \App\User::select('user_verified')->where('id', $job->employer->id)->pluck('user_verified')->first();
                                        $project_type  = Helper::getProjectTypeList($job->project_type);
                                    ?>
                                    <div class="wt-userlistinghold wt-featured wt-userlistingvtwo">
                                        <?php if(!empty($job->is_featured) && $job->is_featured === 'true'): ?>
                                            <span class="wt-featuredtag"><img src="<?php echo e(asset('images/featured.png')); ?>" alt="<?php echo e(trans('lang.is_featured')); ?>" data-tipso="Plus Member" class="template-content tipso_style"></span>
                                        <?php endif; ?>
                                        <div class="wt-userlistingcontent wt-userlistingcontentvtwo">
                                            <div class="wt-contenthead">
                                                <div class="wt-title">
                                                    <a href="<?php echo e(url('profile/'.$job->employer->slug)); ?>">
                                                        <?php if($verified_user === 1): ?>
                                                            <i class="fa fa-check-circle"></i>
                                                        <?php endif; ?>
                                                        &nbsp;<?php echo e(Helper::getUserName($job->employer->id)); ?>

                                                    </a>
                                                    <?php if(!empty($job->title)): ?>
                                                        <h2><?php echo e($job->title); ?></h2>
                                                    <?php endif; ?>
                                                </div>
                                                <ul class="wt-saveitem-breadcrumb wt-userlisting-breadcrumb">
                                                    <?php if(!empty($job->price)): ?>
                                                        <li><span class="wt-dashboraddoller"><i><?php echo e(!empty($symbol) ? $symbol['symbol'] : '$'); ?></i> <?php echo e($job->price); ?></span></li>
                                                    <?php endif; ?>
                                                    <?php if(!empty($job->location->title)): ?>
                                                        <li><span><img src="<?php echo e(asset(Helper::getLocationFlag($job->location->flag))); ?>" alt="<?php echo e(trans('lang.locations')); ?>"> <?php echo e($job->location->title); ?></span></li>
                                                    <?php endif; ?>
                                                    <?php if(!empty($job->project_type)): ?>
                                                        <li><a href="javascript:void(0);" class="wt-clicksavefolder"><i class="far fa-folder"></i> <?php echo e(trans('lang.type')); ?> <?php echo e($project_type); ?></a></li>
                                                    <?php endif; ?>
                                                    <?php if(!empty($job->duration)): ?>
                                                        <li><span class="wt-dashboradclock"><i class="far fa-clock"></i> <?php echo e(trans('lang.duration')); ?> <?php echo e(Helper::getJobDurationList($job->duration)); ?></span></li>
                                                    <?php endif; ?>
                                                </ul>
                                            </div>
                                            <div class="wt-rightarea">
                                                <div class="wt-btnarea">
                                                    <span> <?php echo e(trans('lang.project_completed')); ?></span>
                                                    <a href="<?php echo e(url('proposal/'.$job->slug.'/'.$job->status)); ?>" class="wt-btn"><?php echo e(trans('lang.view_detail')); ?></a>
                                                </div>
                                                <div class="wt-hireduserstatus">
                                                    <h4><?php echo e(trans('lang.hired')); ?></h4><span><?php echo e(Helper::getUserName($accepted_proposal->freelancer_id)); ?></span>
                                                    <ul class="wt-hireduserimgs">
                                                        <li><figure><img src="<?php echo e(asset(Helper::getProjectImage($user_image, $accepted_proposal->freelancer_id))); ?>" alt="<?php echo e(trans('lang.freelancer')); ?>"></figure></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        <?php else: ?>
                            <?php if(file_exists(resource_path('views/extend/errors/no-record.blade.php'))): ?> 
                                <?php echo $__env->make('extend.errors.no-record', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                            <?php else: ?> 
                                <?php echo $__env->make('errors.no-record', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>
                <?php if( method_exists($completed_jobs,'links') ): ?>
                    <?php echo e($completed_jobs->links('pagination.custom')); ?>

                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(file_exists(resource_path('views/extend/back-end/master.blade.php')) ? 'extend.back-end.master' : 'back-end.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>