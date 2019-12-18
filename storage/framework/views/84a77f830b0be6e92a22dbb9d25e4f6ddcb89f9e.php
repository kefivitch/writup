<?php $__env->startSection('content'); ?>
    <section class="wt-haslayout wt-dbsectionspace wt-insightuser" id="dashboard">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="wt-insightsitemholder">
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3">
                            <div class="wt-insightsitem wt-dashboardbox">
                                <figure class="wt-userlistingimg">
                                    <?php echo e(Helper::getImages('uploads/settings/icon',$latest_proposals_icon, 'layers')); ?>

                                </figure>
                                <div class="wt-insightdetails">
                                    <div class="wt-title">
                                        <h3><?php echo e(trans('lang.latest_proposals')); ?></h3>
                                        <a href="<?php echo e(route('showFreelancerProposals')); ?>"><?php echo e(trans('lang.click_view')); ?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php if(!empty($enable_package) && $enable_package === 'true'): ?>
                            <?php if(!empty($package)): ?>
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3">
                                    <div class="wt-insightsitem wt-dashboardbox user_current_package">
                                        <countdown
                                        date="<?php echo e($expiry_date); ?>"
                                        :image_url="'<?php echo e(Helper::getDashExpiryImages('uploads/settings/icon',$latest_package_expiry_icon, 'img-21.png')); ?>'"
                                        :title="'<?php echo e(trans('lang.check_pkg_expiry')); ?>'"
                                        :package_url="'<?php echo e(url('dashboard/packages/freelancer')); ?>'"
                                        :trail="'<?php echo e($trail); ?>'"
                                        :current_package="'<?php echo e($package->title); ?>'"
                                        >
                                        </countdown>
                                    </div>
                                </div>  
                            <?php endif; ?>          
                        <?php endif; ?>
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3">
                            <div class="wt-insightsitem wt-dashboardbox <?php echo e($notify_class); ?>">
                                <figure class="wt-userlistingimg">
                                    <?php echo e(Helper::getImages('uploads/settings/icon',$latest_new_message_icon, 'book')); ?>

                                </figure>
                                <div class="wt-insightdetails">
                                    <div class="wt-title">
                                        <h3><?php echo e(trans('lang.new_msgs')); ?></h3>
                                        <a href="<?php echo e(route('message')); ?>"><?php echo e(trans('lang.click_view')); ?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3">
                            <div class="wt-insightsitem wt-dashboardbox">
                                <figure class="wt-userlistingimg">
                                    <?php echo e(Helper::getImages('uploads/settings/icon',$latest_saved_item_icon, 'lnr lnr-heart')); ?>

                                </figure>
                                <div class="wt-insightdetails">
                                    <div class="wt-title">
                                        <h3><?php echo e(trans('lang.view_saved_items')); ?></h3>
                                        <a href="<?php echo e(url('freelancer/saved-items')); ?>"><?php echo e(trans('lang.click_view')); ?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php if($access_type == 'jobs' || $access_type== 'both'): ?>
                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3">
                                <div class="wt-insightsitem wt-dashboardbox">
                                    <figure class="wt-userlistingimg">
                                        <?php echo e(Helper::getImages('uploads/settings/icon',$latest_cancel_project_icon, 'cross-circle')); ?>

                                    </figure>
                                    <div class="wt-insightdetails">
                                        <div class="wt-title">
                                            <h3><?php echo e($cancelled_projects->count()); ?></h3>
                                            <h3><?php echo e(trans('lang.total_cancelled_projects')); ?></h3>
                                            <a href="<?php echo e(url('freelancer/jobs/cancelled')); ?>"><?php echo e(trans('lang.click_view')); ?></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3">
                                <div class="wt-insightsitem wt-dashboardbox">
                                    <figure class="wt-userlistingimg">
                                        <?php echo e(Helper::getImages('uploads/settings/icon',$latest_ongoing_project_icon, 'cloud-sync')); ?>

                                    </figure>
                                    <div class="wt-insightdetails">
                                        <div class="wt-title">
                                            <h3><?php echo e($ongoing_projects->count()); ?></h3>
                                            <h3><?php echo e(trans('lang.total_ongoing_projects')); ?></h3>
                                            <a href="<?php echo e(url('freelancer/jobs/hired')); ?>"><?php echo e(trans('lang.click_view')); ?></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3">
                            <div class="wt-insightsitem wt-dashboardbox">
                                <figure class="wt-userlistingimg">
                                    <?php echo e(Helper::getImages('uploads/settings/icon',$latest_pending_balance_icon, 'cart')); ?>

                                </figure>
                                <div class="wt-insightdetails">
                                    <div class="wt-title">
                                        <h3><?php echo e(!empty($symbol['symbol']) ? $symbol['symbol'] : '$'); ?><?php echo e(Helper::getProposalsBalance(Auth::user()->id, 'hired')); ?></h3>
                                        <h3><?php echo e(trans('lang.pending_bal')); ?></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3">
                            <div class="wt-insightsitem wt-dashboardbox">
                                <figure class="wt-userlistingimg">
                                    <?php echo e(Helper::getImages('uploads/settings/icon',$latest_current_balance_icon, 'gift')); ?>

                                </figure>
                                <div class="wt-insightdetails">
                                    <div class="wt-title">
                                    <h3><?php echo e(!empty($symbol['symbol']) ? $symbol['symbol'] : '$'); ?><?php echo e(Helper::getProposalsBalance(Auth::user()->id, 'completed')); ?></h3>
                                        <h3><?php echo e(trans('lang.curr_bal')); ?></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php if($access_type == 'services' || $access_type== 'both'): ?>
                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3">
                                <div class="wt-insightsitem wt-dashboardbox">
                                    <figure class="wt-userlistingimg">
                                        <?php echo e(Helper::getImages('uploads/settings/icon',$ongoing_services_icon, 'gift')); ?>

                                    </figure>
                                    <div class="wt-insightdetails">
                                        <div class="wt-title">
                                            <h3><?php echo e(Helper::getFreelancerServices('hired', Auth::user()->id)->count()); ?></h3>
                                            <h3><?php echo e(trans('lang.total_ongoing_services')); ?></h3>
                                            <a href="<?php echo e(url('freelancer/services/hired')); ?>"><?php echo e(trans('lang.click_view')); ?></a>
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
                                            <h3><?php echo e(Helper::getFreelancerServices('completed', Auth::user()->id)->count()); ?></h3>
                                            <h3><?php echo e(trans('lang.total_completed_services')); ?></h3>
                                            <a href="<?php echo e(url('freelancer/services/completed')); ?>"><?php echo e(trans('lang.click_view')); ?></a>
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
                                            <h3><?php echo e(Helper::getFreelancerServices('cancelled', Auth::user()->id)->count()); ?></h3>
                                            <h3><?php echo e(trans('lang.total_cancelled_services')); ?></h3>
                                            <a href="<?php echo e(url('freelancer/services/cancelled')); ?>"><?php echo e(trans('lang.click_view')); ?></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3">
                                <div class="wt-insightsitem wt-dashboardbox">
                                    <figure class="wt-userlistingimg">
                                        <?php echo e(Helper::getImages('uploads/settings/icon',$published_services_icon, 'gift')); ?>

                                    </figure>
                                    <div class="wt-insightdetails">
                                        <div class="wt-title">
                                            <h3><?php echo e(Helper::getFreelancerServices('published', Auth::user()->id)->count()); ?></h3>
                                            <h3><?php echo e(trans('lang.total_published_services')); ?></h3>
                                            <a href="<?php echo e(url('freelancer/services/posted')); ?>"><?php echo e(trans('lang.click_view')); ?></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <?php if($access_type == 'jobs' || $access_type== 'both'): ?>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 float-left">
                    <div class="wt-dashboardbox wt-ongoingproject la-ongoing-projects">
                        <div class="wt-dashboardboxtitle wt-titlewithsearch">
                            <h2><?php echo e(trans('lang.ongoing_project')); ?></h2>
                        </div>
                        <?php if(!empty($ongoing_projects) && $ongoing_projects->count() > 0): ?>
                            <div class="wt-dashboardboxcontent wt-hiredfreelance">
                                <table class="wt-tablecategories wt-freelancer-table">
                                    <thead>
                                        <tr>
                                            <th><?php echo e(trans('lang.project_title')); ?></th>
                                            <th><?php echo e(trans('lang.employer_name')); ?></th>
                                            <th><?php echo e(trans('lang.project_cost')); ?></th>
                                            <th><?php echo e(trans('lang.actions')); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $ongoing_projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $projects): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php
                                                $project = \App\Proposal::find($projects->id);
                                                $user = \App\User::find($project->job->user_id);
                                                $user_name = Helper::getUsername($project->job->user_id);
                                            ?>
                                            <tr>
                                                <td data-th="Project title"><span class="bt-content"><a target="_blank" href="<?php echo e(url('freelancer/job/'.$project->job->slug)); ?>"><?php echo e($project->job->title); ?></a></span></td>
                                                <td data-th="Hired freelancer">
                                                    <span class="bt-content">
                                                        <a href="<?php echo e(url('profile/'.$user->slug)); ?>">
                                                            <?php if($user->user_verified): ?>
                                                                <i class="fa fa-check-circle"></i>&nbsp;
                                                            <?php endif; ?>
                                                            <?php echo e($user_name); ?>

                                                        </a>
                                                    </span>
                                                </td>
                                                <td data-th="Project cost"><span class="bt-content"><?php echo e(!empty($symbol['symbol']) ? $symbol['symbol'] : '$'); ?><?php echo e($projects->amount); ?></span></td>
                                                <td data-th="Actions">
                                                    <span class="bt-content">
                                                        <div class="wt-btnarea">
                                                            <a href="<?php echo e(url('freelancer/job/'.$project->job->slug)); ?>" class="wt-btn"><?php echo e(trans('lang.view_detail')); ?></a>
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
            <?php endif; ?>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 float-left">
                <div class="wt-dashboardbox  wt-ongoingproject la-ongoing-projects">
                    <div class="wt-dashboardboxtitle wt-titlewithsearch">
                        <h2><?php echo e(trans('lang.past_earnings')); ?></h2>
                    </div>
                    <?php
                        $pastearing_check = '';
                        if (Schema::hasTable('services') && Schema::hasTable('service_user')) {
                            $pastearing_check = Helper::getFreelancerServices('completed', Auth::user()->id)->count() > 0;
                        }
                    ?>
                    <?php if((!empty($completed_projects) && $completed_projects->count() > 0) || $pastearing_check): ?>
                        <?php
                            $commision = \App\SiteManagement::getMetaValue('commision');
                            $admin_commission = !empty($commision[0]['commision']) ? $commision[0]['commision'] : 0;
                        ?>
                        <div class="wt-dashboardboxcontent wt-hiredfreelance">
                            <table class="wt-tablecategories">
                                <thead>
                                    <tr>
                                        <th><?php echo e(trans('lang.project_title')); ?></th>
                                        <th><?php echo e(trans('lang.date')); ?></th>
                                        <th><?php echo e(trans('lang.earnings')); ?></th>
                                    </tr>
                                </thead>
                                <?php if($access_type == 'jobs' || $access_type== 'both'): ?>
                                    <?php if(!empty($completed_projects) && $completed_projects->count() > 0): ?>
                                        <tbody>
                                            <?php $__currentLoopData = $completed_projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $projects): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php
                                                    $project = \App\Proposal::find($projects->id);
                                                    $user_name = Helper::getUsername($project->job->user_id);
                                                    $amount = !empty($project->amount) ? $project->amount - ($project->amount / 100) * $admin_commission : 0;
                                                ?>
                                                <tr class="wt-earning-contents">
                                                    <td class="wt-earnig-single" data-th="Project Title"><span class="bt-content"><?php echo e($project->job->title); ?></span></td>
                                                    <td data-th="Date"><span class="bt-content"><?php echo e($project->updated_at); ?></span></td>
                                                    <td data-th="Earnings"><span class="bt-content"><?php echo e(!empty($symbol['symbol']) ? $symbol['symbol'] : '$'); ?><?php echo e($amount); ?></span></td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    <?php endif; ?>
                                <?php endif; ?>
                                <?php if($access_type == 'services' || $access_type == 'both'): ?>
                                    <?php if(Helper::getFreelancerServices('completed', Auth::user()->id)->count() > 0): ?>
                                        <tbody>
                                            <?php $__currentLoopData = Helper::getFreelancerServices('completed', Auth::user()->id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php
                                                    $freelancer = Helper::getServiceSeller($service->id);
                                                    $user_name = !empty($freelancer) ? Helper::getUsername($freelancer->seller_id) : '';
                                                    $amount = !empty($service->price) ? $service->price - ($service->price / 100) * $admin_commission : 0;
                                                ?>
                                                <tr class="wt-earning-contents">
                                                    <td class="wt-earnig-single" data-th="Project Title"><span class="bt-content"><?php echo e($service->title); ?></span></td>
                                                    <td data-th="Date"><span class="bt-content"><?php echo e($service->updated_at); ?></span></td>
                                                    <td data-th="Earnings"><span class="bt-content"><?php echo e(!empty($symbol['symbol']) ? $symbol['symbol'] : '$'); ?><?php echo e($amount); ?></span></td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    <?php endif; ?>
                                <?php endif; ?>
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
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(file_exists(resource_path('views/extend/back-end/master.blade.php')) ? 'extend.back-end.master' : 'back-end.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>