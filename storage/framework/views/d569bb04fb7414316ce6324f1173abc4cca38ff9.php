<div class="wt-location wt-tabsinfo">
    <div class="wt-tabscontenttitle">
            <h2><?php echo e(trans('lang.site_payment_option')); ?></h2>
    </div>
    <div class="wt-settingscontent">
        <div class="wt-settingscontent la-settingsradio">
            <div class="wt-description"><p><?php echo e(trans('lang.site_payment_option_note')); ?></p></div>
            <switch_button v-model="enable_packages"><?php echo e(trans('lang.paid_both')); ?></switch_button>
            <input type="hidden" :value="enable_packages" name="payment[0][enable_packages]">
        </div>
    </div>
</div>
<div class="wt-location wt-tabsinfo" v-if="enable_packages">
    <div class="wt-tabscontenttitle">
        <h2><?php echo e(trans('lang.employer_payment_option')); ?></h2>
    </div>
    <div class="wt-settingscontent la-settingsradio">
        <div class="wt-description"><p><?php echo e(trans('lang.employer_payment_option_note')); ?></p></div>
        <switch_button v-model="employer_package "><?php echo e(trans('lang.paid_employers')); ?></switch_button>
        <input type="hidden" :value="employer_package" name="payment[0][employer_package]">
    </div>
</div>

