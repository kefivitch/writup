<?php $__env->startSection('content'); ?>
    <div class="wt-haslayout wt-dbsectionspace" id="jobs">
        <div class="preloader-section" v-if="loading" v-cloak>
            <div class="preloader-holder">
                <div class="loader"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="wt-dashboardbox la-alljob-holder">
                    <div class="wt-dashboardboxtitle wt-titlewithsearch">
                        <h2><?php echo e(trans('lang.all_jobs')); ?></h2>
                        <?php echo Form::open(['url' => url('admin/jobs/search'),
                            'method' => 'get', 'class' => 'wt-formtheme wt-formsearch']); ?>

                        <fieldset>
                            <div class="form-group">
                                <input type="text" name="keyword" value="<?php echo e(!empty($_GET['keyword']) ? $_GET['keyword'] : ''); ?>"
                                    class="form-control" placeholder="<?php echo e(trans('lang.ph_search_jobs')); ?>">
                                <button type="submit" class="wt-searchgbtn"><i class="lnr lnr-magnifier"></i></button>
                            </div>
                        </fieldset>
                        <?php echo Form::close(); ?>

                    </div>
                    <div class="wt-dashboardboxcontent wt-jobdetailsholder">
                        <div class="wt-freelancerholder">
                            <?php if(!empty($jobs) && $jobs->count() > 0): ?>
                                <div class="wt-managejobcontent">
                                    <?php $__currentLoopData = $jobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                            $duration = !empty($job->duration) ? Helper::getJobDurationList($job->duration) : '';
                                            $user_name = !empty($job->employer->id) ? Helper::getUserName($job->employer->id) : '';
                                            $verified_user = !empty($job->employer->id) ? $job->employer->user_verified : '';
                                            $cancel_proposal = $job->proposals->where('status', 'cancelled')->first();
                                            if (!empty($cancel_proposal)) {
                                                $freelancer = Helper::getUserName($cancel_proposal->freelancer_id);
                                            }
                                            $project_type  = Helper::getProjectTypeList($job->project_type);
                                        ?>
                                        <div class="wt-userlistinghold wt-featured wt-userlistingvtwo del-job-<?php echo e($job->id); ?>">
                                            <?php if(!empty($job->is_featured) && $job->is_featured === 'true'): ?>
                                                <span class="wt-featuredtag"><img src="<?php echo e(asset('images/featured.png')); ?>" alt="<?php echo e(trans('lang.is_featured')); ?>" data-tipso="Plus Member" class="template-content tipso_style"></span>
                                            <?php endif; ?>
                                            <div class="wt-userlistingcontent">
                                                <div class="wt-contenthead">
                                                    <?php if(!empty($user_name) || !empty($job->title) ): ?>
                                                        <div class="wt-title">
                                                            <?php if(!empty($user_name)): ?>
                                                                <a href="<?php echo e(url('profile/'.$job->employer->slug)); ?>">
                                                                <?php if($verified_user === 1): ?>
                                                                    <i class="fa fa-check-circle"></i>
                                                                <?php endif; ?>
                                                                &nbsp;<?php echo e($user_name); ?></a>
                                                            <?php endif; ?>
                                                            <?php if(!empty($job->title)): ?>
                                                                <h2><?php echo e($job->title); ?></h2>
                                                            <?php endif; ?>
                                                        </div>
                                                    <?php endif; ?>
                                                    <?php if(!empty($job->price) || !empty($location['title']) || !empty($job->project_type) || !empty($job->duration) ): ?>
                                                        <ul class="wt-saveitem-breadcrumb wt-userlisting-breadcrumb">
                                                            <?php if(!empty($job->price)): ?>
                                                                <li><span class="wt-dashboraddoller"><i><?php echo e(!empty($symbol) ? $symbol['symbol'] : '$'); ?></i> <?php echo e($job->price); ?></span></li>
                                                            <?php endif; ?>
                                                            <?php if(!empty($job->location->title)): ?>
                                                                <li><span><img src="<?php echo e(asset(App\Helper::getLocationFlag($job->location->flag))); ?>" alt="<?php echo e(trans('lang.locations')); ?>"> <?php echo e($job->location->title); ?></span></li>
                                                            <?php endif; ?>
                                                            <?php if(!empty($job->project_type)): ?>
                                                                <li><a href="javascript:void(0);" class="wt-clicksavefolder"><i class="far fa-folder"></i> <?php echo e(trans('lang.type')); ?> <?php echo e($project_type); ?></a></li>
                                                            <?php endif; ?>
                                                            <?php if(!empty($job->duration)): ?>
                                                                <li><span class="wt-dashboradclock"><i class="far fa-clock"></i> <?php echo e(trans('lang.duration')); ?> <?php echo e($duration); ?></span></li>
                                                            <?php endif; ?>
                                                        </ul>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="wt-rightarea la-pending-jobs">
                                                    <div class="wt-btnarea">
                                                        <a href="<?php echo e(url('job/edit-job/'.$job->slug)); ?>" class="wt-btn"><?php echo e(trans('lang.edit_job')); ?></a>
                                                        <a href="javascript:void(0);" v-on:click.prevent="deleteJob(<?php echo e($job->id); ?>)" class="wt-btn"><?php echo e(trans('lang.del_job')); ?></a>
                                                        <?php if(!empty($cancel_proposal) && Helper::getOrderPayout($cancel_proposal->id)->count() == 0): ?>
                                                            <a href="javascript:void(0);"  v-on:click.prevent="showRefoundForm(<?php echo e($job->id); ?>)"  class="wt-btn"><span><?php echo e(trans('lang.refund_now')); ?></span></a>
                                                        <?php endif; ?>
                                                    </div>
                                                    <?php if($job->proposals->count() > 0): ?>
                                                        <div class="wt-hireduserstatus">
                                                            <?php if($job->status == 'hired' || $job->status == 'completed'): ?>
                                                                <h4><?php echo e($job->status); ?></h4>
                                                                <a href="<?php echo e(url('proposal/'.$job->slug . '/'. $job->proposals[0]->status)); ?>" class="wt-btn"><?php echo e(trans('lang.view_detail')); ?></a>
                                                            <?php else: ?>
                                                                <?php $__currentLoopData = $job->proposals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $proposals): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <?php if($proposals->status == 'cancelled'): ?>
                                                                        <h4><?php echo e($proposals->status); ?></h4>
                                                                        <a href="<?php echo e(url('proposal/'.$job->slug . '/cancelled')); ?>" class="wt-btn"><?php echo e(trans('lang.view_detail')); ?></a>
                                                                    <?php elseif($proposals->status == 'pending'): ?>
                                                                        <h4><?php echo e($job->status); ?></h4>
                                                                    <?php endif; ?>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            <?php endif; ?>
                                                        </div>
                                                    <?php else: ?>
                                                        <div class="wt-hireduserstatus">
                                                            <h4><?php echo e($job->status); ?></h4>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <b-modal ref="myModalRef-<?php echo e($job->id); ?>" hide-footer title="Refund" v-cloak>
                                            <div class="d-block text-center">
                                                <?php echo Form::open(['url' => '', 'class' =>'wt-formtheme', 'id' => 'submit_refund_'.$job->id,  
                                                    '@submit.prevent'=>'submitRefund("'.$job->id.'")']); ?>

                                                    <fieldset>
                                                        <div class="form-group">
                                                            <span class="wt-select">
                                                                <select id="refundable_user_id-<?php echo e($job->id); ?>" class="form-control" placeholder="<?php echo e(trans('lang.select_users')); ?>" v-model="refundable_user">
                                                                    <option value=""><?php echo e(trans('lang.select_users')); ?></option>
                                                                    <option value="<?php echo e($job->employer->id); ?>"><?php echo e(trans('lang.search_filter_list.employers_val')); ?></option>
                                                                    <?php if(!empty($cancel_proposal)): ?>
                                                                        <option value="<?php echo e($cancel_proposal->freelancer_id); ?>"><?php echo e(trans('lang.search_filter_list.freelancer_val')); ?></option>
                                                                    <?php endif; ?>
                                                                </select>
                                                            </span>
                                                        </div>
                                                        <?php if(!empty($cancel_proposal)): ?>
                                                            <input type="hidden" value="<?php echo e($cancel_proposal->amount); ?>" id="refundable-amount-<?php echo e($job->id); ?>">
                                                            <input type="hidden" value="<?php echo e($cancel_proposal->id); ?>" id="refundable-order-id-<?php echo e($job->id); ?>">
                                                        <?php endif; ?>
                                                        <input type="hidden" value="<?php echo e($job->id); ?>" id="refundable-job-id-<?php echo e($job->id); ?>">

                                                        <div class="form-group wt-btnarea">
                                                            <?php echo Form::submit(trans('lang.refund'), ['class' => 'wt-btn']); ?>

                                                        </div>
                                                    </fieldset>
                                                <?php echo form::close();; ?>

                                            </div>
                                        </b-modal>
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
                    <?php if( method_exists($jobs,'links') ): ?> <?php echo e($jobs->links('pagination.custom')); ?> <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(file_exists(resource_path('views/extend/back-end/master.blade.php')) ? 'extend.back-end.master' : 'back-end.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>