<?php $__env->startSection('content'); ?>
    <section class="wt-haslayout wt-dbsectionspace wt-insightuser" id="dashboard">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="wt-insightsitemholder">
                    <?php if(session('success')): ?>
                    <div class="row">
                        <div class="alert alert-success" style="width:100%">
                            <?php echo e(session('success')); ?>

                        </div>
                    </div>
                    <?php endif; ?>

                    <?php if(session('error')): ?>
                    <div class="row">
                        <div class="alert alert-error" style="width:100%">
                            <?php echo e(session('error')); ?>

                        </div>
                    </div>
                    <?php endif; ?>
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3">
                            <div class="wt-insightsitem wt-dashboardbox <?php echo e($notify_class); ?>">
                                <figure class="wt-userlistingimg">
                                    <?php echo e(Helper::getImages('uploads/settings/icon',$latest_new_message_icon, 'book')); ?>

                                </figure>
                                <div class="wt-insightdetails">
                                    <div class="wt-title">
                                        <h3><?php echo e(trans('lang.new_msgs')); ?></h3>
                                        <a href="<?php echo e(url('message-center')); ?>"><?php echo e(trans('lang.click_view')); ?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php if($access_type == 'jobs' || $access_type== 'both'): ?>
                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3">
                                <div class="wt-insightsitem wt-dashboardbox wt-insightnoticon">
                                    <figure class="wt-userlistingimg">
                                        <?php echo e(Helper::getImages('uploads/settings/icon',$latest_proposals_icon, 'layers')); ?>

                                    </figure>
                                    <div class="wt-insightdetails ">
                                        <div class="wt-title">
                                            <h3><?php echo e(trans('lang.latest_proposals')); ?></h3>
                                            <a href="<?php echo e(url('employer/dashboard/manage-jobs')); ?>"><?php echo e(trans('lang.click_view')); ?></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if(!empty($enable_package) && $enable_package === 'true'): ?>
                            <?php if(!empty($package)): ?>
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3">
                                    <div class="wt-insightsitem wt-dashboardbox user_current_package">
                                        <countdown
                                        date="<?php echo e($expiry_date); ?>"
                                        :image_url="'<?php echo e(Helper::getDashExpiryImages('uploads/settings/icon',$latest_package_expiry_icon, 'img-21.png')); ?>'"
                                        :title="'<?php echo e(trans('lang.check_pkg_expiry')); ?>'"
                                        :package_url="'<?php echo e(url('dashboard/packages/employer')); ?>'"
                                        :current_package="'<?php echo e($package->title); ?>'"
                                        >
                                        </countdown>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3">
                            <div class="wt-insightsitem wt-dashboardbox">
                                <figure class="wt-userlistingimg">
                                    <?php echo e(Helper::getImages('uploads/settings/icon',$latest_saved_item_icon, 'lnr lnr-heart')); ?>

                                </figure>
                                <div class="wt-insightdetails">
                                    <div class="wt-title">
                                        <h3><?php echo e(trans('lang.view_saved_items')); ?></h3>
                                        <a href="<?php echo e(url('employer/saved-items')); ?>"><?php echo e(trans('lang.click_view')); ?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php if($access_type == 'jobs' || $access_type== 'both'): ?>
                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3">
                                <div class="wt-insightsitem wt-dashboardbox">
                                    <figure class="wt-userlistingimg">
                                        <?php echo e(Helper::getImages('uploads/settings/icon',$latest_cancel_job_icon, 'cross-circle')); ?>

                                    </figure>
                                    <div class="wt-insightdetails">
                                        <div class="wt-title">
                                            <h3><?php echo e(Helper::getTotalJobs('cancelled')); ?></h3>
                                            <span><?php echo e(trans('lang.total_cancelled_jobs')); ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3">
                                <div class="wt-insightsitem wt-dashboardbox">
                                    <figure class="wt-userlistingimg">
                                        <?php echo e(Helper::getImages('uploads/settings/icon',$latest_ongoing_job_icon, 'cloud-sync')); ?>

                                    </figure>
                                    <div class="wt-insightdetails">
                                        <div class="wt-title">
                                            <h3><?php echo e(Helper::getTotalJobs('hired')); ?></h3>
                                            <span><?php echo e(trans('lang.total_ongoing_jobs')); ?></span>
                                            <a href="<?php echo e(url('employer/jobs/hired')); ?>"><?php echo e(trans('lang.click_view')); ?></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3">
                                <div class="wt-insightsitem wt-dashboardbox">
                                    <figure class="wt-userlistingimg">
                                        <?php echo e(Helper::getImages('uploads/settings/icon',$latest_completed_job_icon, 'checkmark-circle')); ?>

                                    </figure>
                                    <div class="wt-insightdetails">
                                        <div class="wt-title">
                                            <h3><?php echo e(Helper::getTotalJobs('completed')); ?></h3>
                                            <span><?php echo e(trans('lang.total_completed_jobs')); ?></span>
                                            <a href="<?php echo e(url('employer/jobs/completed')); ?>"><?php echo e(trans('lang.click_view')); ?></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3">
                                <div class="wt-insightsitem wt-dashboardbox">
                                    <figure class="wt-userlistingimg">
                                        <?php echo e(Helper::getImages('uploads/settings/icon',$latest_posted_job_icon, 'enter')); ?>

                                    </figure>
                                    <div class="wt-insightdetails">
                                        <div class="wt-title">
                                            <h3><?php echo e(Helper::getTotalJobs('posted')); ?></h3>
                                            <span><?php echo e(trans('lang.total_posted_jobs')); ?></span>
                                            <a href="<?php echo e(route('employerManageJobs')); ?>"><?php echo e(trans('lang.click_view')); ?></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if($access_type == 'services' || $access_type== 'both'): ?>
                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3">
                                <div class="wt-insightsitem wt-dashboardbox">
                                    <figure class="wt-userlistingimg">
                                        <?php echo e(Helper::getImages('uploads/settings/icon',$ongoing_services_icon, 'gift')); ?>

                                    </figure>
                                    <div class="wt-insightdetails">
                                        <div class="wt-title">
                                            <h3><?php echo e(Auth::user()->purchasedServices->count()); ?></h3>
                                            <span><?php echo e(trans('lang.total_ongoing_services')); ?></span>
                                            <a href="<?php echo e(url('employer/services/hired')); ?>"><?php echo e(trans('lang.click_view')); ?></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3">
                                <div class="wt-insightsitem wt-dashboardbox">
                                    <figure class="wt-userlistingimg">
                                        <?php echo e(Helper::getImages('uploads/settings/icon',$completed_services_icon, 'gift')); ?>

                                    </figure>
                                    <div class="wt-insightdetails">
                                        <div class="wt-title">
                                            <h3><?php echo e(Auth::user()->completedServices->count()); ?></h3>
                                            <span><?php echo e(trans('lang.total_completed_services')); ?></span>
                                            <a href="<?php echo e(url('employer/services/completed')); ?>"><?php echo e(trans('lang.click_view')); ?></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3">
                                <div class="wt-insightsitem wt-dashboardbox">
                                    <figure class="wt-userlistingimg">
                                        <?php echo e(Helper::getImages('uploads/settings/icon',$cancelled_services_icon, 'gift')); ?>

                                    </figure>
                                    <div class="wt-insightdetails">
                                        <div class="wt-title">
                                            <h3><?php echo e(Auth::user()->cancelledServices->count()); ?></h3>
                                            <span><?php echo e(trans('lang.total_cancelled_services')); ?></span>
                                            <a href="<?php echo e(url('employer/services/cancelled')); ?>"><?php echo e(trans('lang.click_view')); ?></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php if($access_type == 'jobs' || $access_type== 'both'): ?>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="wt-dashboardbox wt-ongoingproject la-ongoing-projects wt-earningsholder">
                        <div class="wt-dashboardboxtitle wt-titlewithsearch">
                            <h2><?php echo e(trans('lang.ongoing_project')); ?></h2>
                        </div>
                        <?php if(!empty($ongoing_jobs) && $ongoing_jobs->count() > 0): ?>
                            <div class="wt-dashboardboxcontent wt-hiredfreelance">
                                <table class="wt-tablecategories wt-freelancer-table">
                                    <thead>
                                        <tr>
                                            <th><?php echo e(trans('lang.project_title')); ?></th>
                                            <th><?php echo e(trans('lang.hired_freelancers')); ?></th>
                                            <th><?php echo e(trans('lang.project_cost')); ?></th>
                                            <th><?php echo e(trans('lang.actions')); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $ongoing_jobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php
                                                $proposal_freelancer = $project->proposals->where('status', 'hired')->pluck('freelancer_id')->first();
                                                $freelancer = !empty($proposal_freelancer) ? \App\User::find($proposal_freelancer) : ''; 
                                                $user_name = Helper::getUsername($proposal_freelancer);
                                            ?>
                                            <tr>
                                                <td data-th="Project title"><span class="bt-content"><a target="_blank" href="<?php echo e(url('job/'.$project->slug)); ?>"><?php echo e($project->title); ?></a></span></td>
                                                <?php if(!empty($freelancer)): ?>
                                                    <td data-th="Hired freelancer">
                                                        <span class="bt-content">
                                                            <a href="<?php echo e(url('profile/'.$freelancer->slug)); ?>">
                                                                <?php if($freelancer->user_verified): ?>
                                                                    <i class="fa fa-check-circle"></i>&nbsp;
                                                                <?php endif; ?>
                                                                <?php echo e($user_name); ?>

                                                            </a>
                                                        </span>
                                                    </td>
                                                <?php endif; ?>
                                                <td data-th="Project cost"><span class="bt-content"><?php echo e(!empty($symbol['symbol']) ? $symbol['symbol'] : '$'); ?><?php echo e($project->price); ?></span></td>
                                                <td data-th="Actions">
                                                    <span class="bt-content">
                                                        <div class="wt-btnarea">
                                                            <a href="<?php echo e(url('employer/dashboard/job/'.$project->slug.'/proposals')); ?>" class="wt-btn"><?php echo e(trans('lang.view_detail')); ?></a>
                                                        </div>
                                                    </span>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
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
            </div>
        <?php endif; ?>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(file_exists(resource_path('views/extend/back-end/master.blade.php')) ? 'extend.back-end.master' : 'back-end.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>