<div class="wt-dashboardtabs">
    <ul class="wt-tabstitle nav navbar-nav">
        <li class="nav-item">
            <a class="<?php echo e(\Request::route()->getName()==='FreelancerPayoutsSettings'? 'active': ''); ?>" href="<?php echo e(route('FreelancerPayoutsSettings')); ?>"><?php echo e(trans('lang.payout_settings')); ?></a>
        </li>
        <li class="nav-item">
            <a class="<?php echo e(\Request::route()->getName()==='getFreelancerPayouts'? 'active': ''); ?>" href="<?php echo e(route('getFreelancerPayouts')); ?>"><?php echo e(trans('lang.payouts')); ?></a>
        </li>
    </ul>
</div>