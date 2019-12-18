<?php $__env->startPush('stylesheets'); ?>
    <link href="<?php echo e(asset('css/prettyPhoto-min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/owl.carousel.min.css')); ?>" rel="stylesheet">
<?php $__env->stopPush(); ?>
<?php 
    $app_description =  env('APP_DESCRIPTION'); 
    $currency   = App\SiteManagement::getMetaValue('commision');
    $symbol = !empty($currency) && !empty($currency[0]['currency']) ? Helper::currencyList($currency[0]['currency']) : array();
?>
<?php $__env->startSection('title'); ?><?php echo e(config('app.name')); ?> <?php $__env->stopSection(); ?>
<?php $__env->startSection('description', "$app_description"); ?>
<?php $__env->startSection('content'); ?>
    <?php
        $categories = App\Category::latest()->get()->take(8);
        $skills = App\Skill::latest()->get()->take(8);
        $locations = App\Location::latest()->get()->take(8);
        $languages = App\Language::latest()->get()->take(8);
        $type = Helper::getAccessType() == 'services' ? 'service' : 'job';
        if (Schema::hasTable('services') && Schema::hasTable('service_user')) {
            $services = App\Service::latest()->paginate(6);
        }
    ?>
    <div id="home" class="la-home-page">
        <?php if(Session::has('error')): ?>
            <div class="flash_msg">
                <flash_messages :message_class="'danger'" :time ='5' :message="'<?php echo e(Session::get('error')); ?>'" v-cloak></flash_messages>
            </div>
            <?php session()->forget('error'); ?>
        <?php endif; ?>
        <div class="wt-haslayout wt-bannerholder" style="background-image:url(<?php echo e(asset(Helper::getHomeBanner('image'))); ?>)">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-5">
                        <div class="wt-bannerimages">
                            <figure class="wt-bannermanimg" data-tilt>
                                <img src="<?php echo e(asset(Helper::getHomeBanner('inner_image'))); ?>" alt="<?php echo e(trans('lang.img')); ?>">
                            </figure>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-7">
                        <div class="wt-bannercontent">
                            <div class="wt-bannerhead">
                                <div class="wt-title">
                                    <h1>
                                        <span><?php echo e(Helper::getHomeBanner('title')); ?></span>
                                        <?php echo e(Helper::getHomeBanner('subtitle')); ?>

                                    </h1>
                                </div>
                                <div class="wt-description">
                                    <p><?php echo e(Helper::getHomeBanner('description')); ?></p>
                                </div>
                            </div>
                            <search-form
                            :widget_type="'home'"
                            :placeholder="'<?php echo e(trans('lang.looking_for')); ?>'"
                            :freelancer_placeholder="'<?php echo e(trans('lang.search_filter_list.freelancer')); ?>'"
                            :employer_placeholder="'<?php echo e(trans('lang.search_filter_list.employers')); ?>'"
                            :job_placeholder="'<?php echo e(trans('lang.search_filter_list.jobs')); ?>'"
                            :service_placeholder="'<?php echo e(trans('lang.search_filter_list.services')); ?>'"
                            :no_record_message="'<?php echo e(trans('lang.no_record')); ?>'"
                            >
                            </search-form>
                            <div class="wt-videoholder">
                                <div class="wt-videoshow">
                                    <a data-rel="prettyPhoto[video]" href="<?php echo e(Helper::getHomeBanner('video_url')); ?>"><i class="fa fa-play"></i></a>
                                </div>
                                <div class="wt-videocontent">
                                    <span><?php echo e(Helper::getHomeBanner('video_title')); ?><em><?php echo e(Helper::getHomeBanner('video_description')); ?></em></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Top Services Start-->
        <?php if(Helper::getServiceSection('show_services_section') === 'true'): ?>
            <section class="wt-haslayout wt-main-section wt-bglight">
                <div class="container">
                    <div class="row justify-content-md-center">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 push-lg-2">
                            <div class="wt-sectionhead wt-textcenter wt-topservices-title">
                                <div class="wt-sectiontitle">
                                    <h2><?php echo e(Helper::getServiceSection('title')); ?></h2>
                                    <span><?php echo e(Helper::getServiceSection('subtitle')); ?></span>
                                </div>
                                <div class="wt-description">
                                    <?php echo htmlspecialchars_decode(stripslashes(Helper::getServiceSection('description'))); ?>
                                </div>
                            </div>
                        </div>
                        <div class="wt-freelancers-holder wt-freelancers-home row">
                            <?php if(!empty($services) && $services->count() > 0): ?>
                                <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php 
                                        $service_reviews = $service->seller->count() > 0 ? Helper::getServiceReviews($service->seller[0]->id, $service->id) : ''; 
                                        $service_rating  = !empty($service_reviews) && $service_reviews->sum('avg_rating') != 0 ? round($service_reviews->sum('avg_rating') / $service_reviews->count()) : 0;
                                        $attachments = Helper::getUnserializeData($service->attachments);
                                        $no_attachments = empty($attachments) ? 'la-service-info' : '';
                                        $enable_slider = !empty($attachments) ? 'wt-servicesslider' : '';
                                        $total_orders = Helper::getServiceCount($service->id, 'hired');
                                    ?>
                                    <div class="col-12 col-sm-12 col-md-6 col-lg-4 float-left">
                                        <div class="wt-freelancers-info <?php echo e($no_attachments); ?>">
                                            <?php if($service->seller->count() > 0): ?>
                                                <?php if(!empty($attachments)): ?>
                                                    <?php $enable_slider = count($attachments) > 1 ? 'wt-freelancerslider owl-carousel' : ''; ?>
                                                    <div class="wt-freelancers <?php echo e($enable_slider); ?>">
                                                        <?php $__currentLoopData = $attachments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attachment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <figure class="item">
                                                                <a href="<?php echo e(url('profile/'.$service->seller[0]->slug)); ?>"><img src="<?php echo e(asset(Helper::getImageWithSize('uploads/services/'.$service->seller[0]->id, $attachment, 'medium'))); ?>" alt="img description" class="item"></a>
                                                            </figure>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </div>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                            <?php if($service->is_featured == 'true'): ?>
                                                <span class="wt-featuredtagvtwo"><?php echo e(trans('lang.featured')); ?></span>
                                            <?php endif; ?>
                                            <div class="wt-freelancers-details">
                                                <?php if($service->seller->count() > 0): ?>
                                                    <figure class="wt-freelancers-img">
                                                        <img src="<?php echo e(asset(Helper::getProfileImage($service->seller[0]->id))); ?>" alt="img description">
                                                    </figure>
                                                <?php endif; ?>
                                                <div class="wt-freelancers-content">
                                                    <div class="dc-title">
                                                        <?php if($service->seller->count() > 0): ?>
                                                            <a href="<?php echo e(url('profile/'.$service->seller[0]->slug)); ?>"><i class="fa fa-check-circle"></i> <?php echo e(Helper::getUserName($service->seller[0]->id)); ?></a>
                                                        <?php endif; ?>
                                                        <a href="<?php echo e(url('service/'.$service->slug)); ?>"><h3><?php echo e($service->title); ?></h3></a>
                                                        <span><strong><?php echo e((!empty($symbol['symbol'])) ? $symbol['symbol'] : '$'); ?><?php echo e($service->price); ?></strong> <?php echo e(trans('lang.starting_from')); ?></span>
                                                    </div>
                                                </div>
                                                <div class="wt-freelancers-rating">
                                                    <ul>
                                                        <li><span><i class="fa fa-star"></i><?php echo e($service_rating); ?>/<i>5</i> (<?php echo e(!empty($service_reviews) ? $service_reviews->count() : ''); ?>)</span></li>
                                                        <li>
                                                            <?php if($total_orders > 0): ?>
                                                                <i class="fa fa-spinner fa-spin"></i>
                                                            <?php endif; ?>
                                                            <?php echo e($total_orders); ?> <?php echo e(trans('lang.in_queue')); ?>

                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?>
        <?php if(!empty($categories)
            && $categories->count() > 0
            && Helper::getHomeSection('show_cat_section') == 'true'): ?>
            <section class="wt-haslayout wt-main-section">
                <div class="container">
                    <div class="row justify-content-md-center">
                        <div class="col-xs-12 col-sm-12 col-md-8 push-md-2 col-lg-6 push-lg-3">
                            <div class="wt-sectionhead wt-textcenter">
                                <div class="wt-sectiontitle">
                                    <h2><?php echo e(Helper::getHomeSection('cat_sec_title')); ?></h2>
                                    <span><?php echo e(Helper::getHomeSection('cat_sec_subtitle')); ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="wt-categoryexpl">
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-3 float-left">
                                    <div class="wt-categorycontent">
                                        <figure><img src="<?php echo e(asset(Helper::getCategoryImage($category->image))); ?>" alt="<?php echo e($category->title); ?>"></figure>
                                        <div class="wt-cattitle">
                                            <h3><a href="<?php echo e(url('search-results?type='.$type.'&category%5B%5D='.$category->slug)); ?>"><?php echo e($category->title); ?></a></h3>
                                        </div>
                                        <div class="wt-categoryslidup">
                                            <?php if(!empty($category->abstract)): ?>
                                                <p><?php echo e($category->abstract); ?></p>
                                            <?php endif; ?>
                                            <a href="<?php echo e(url('search-results?type='.$type.'&category%5B%5D='.$category->slug)); ?>"><?php echo e(trans('lang.explore')); ?> <i class="fa fa-arrow-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?>
        <?php if(Helper::getHomeSection('show_section') == 'true'): ?>
            <section class="wt-haslayout wt-main-section wt-paddingnull wt-bannerholdervtwo" style="background-image:url(<?php echo e(asset(Helper::getHomeSection('background_image'))); ?>)">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="wt-companydetails">
                                <div class="wt-companycontent">
                                    <div class="wt-companyinfotitle">
                                        <h2><?php echo e(Helper::getHomeSection('left_title')); ?></h2>
                                    </div>
                                    <div class="wt-description">
                                        <p><?php echo e(Helper::getHomeSection('left_description')); ?></p>
                                    </div>
                                    <div class="wt-btnarea">
                                        <a href="<?php echo e(Helper::getHomeSection('left_url')); ?>" class="wt-btn"><?php echo e(trans('lang.join_now')); ?></a>
                                    </div>
                                </div>
                                <div class="wt-companycontent">
                                    <div class="wt-companyinfotitle">
                                        <h2><?php echo e(Helper::getHomeSection('right_title')); ?></h2>
                                    </div>
                                    <div class="wt-description">
                                        <p><?php echo e(Helper::getHomeSection('right_description')); ?></p>
                                    </div>
                                    <div class="wt-btnarea">
                                        <a href="<?php echo e(Helper::getHomeSection('right_url')); ?>" class="wt-btn"><?php echo e(trans('lang.join_now')); ?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?>
        <?php if(Helper::getHomeSection('show_app_section') == 'true'): ?>
            <section class="wt-haslayout wt-main-section">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 float-left">
                            <figure class="wt-mobileimg">
                                <img src="<?php echo e(asset(Helper::getAppSection('image'))); ?>" alt="<?php echo e(trans('lang.img')); ?>">
                            </figure>
                        </div>
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 float-left">
                            <div class="wt-experienceholder">
                                <div class="wt-sectionhead">
                                    <div class="wt-sectiontitle">
                                        <h2><?php echo e(Helper::getAppSection('title')); ?></h2>
                                        <span><?php echo e(Helper::getAppSection('subtitle')); ?></span>
                                    </div>
                                    <div class="wt-description">
                                        <?php echo htmlspecialchars_decode(stripslashes(Helper::getAppSection('description'))); ?>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?>
        <?php if($skills->count() > 0
            || $categories->count() > 0
            || $locations->count() > 0
            || $languages->count() > 0): ?>
            <section class="wt-haslayaout wt-main-section wt-footeraboutus">
                <div class="container">
                    <div class="row">
                        <?php if(Helper::getAccessType() != 'services'): ?>
                            <?php if($skills->count() > 0): ?>
                                <div class="col-12 col-sm-6 col-md-3 col-lg-3">
                                    <div class="wt-widgetskills">
                                        <div class="wt-fwidgettitle">
                                            <h3><?php echo e(trans('lang.by_skills')); ?></h3>
                                        </div>
                                        <?php if(!empty($skills)): ?>
                                            <ul class="wt-fwidgetcontent">
                                                <?php $__currentLoopData = $skills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <li><a href="<?php echo e(url('search-results?type=job&skills%5B%5D='.$skill->slug)); ?>"><?php echo e($skill->title); ?></a></li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </ul>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>
                        <?php if($categories->count() > 0): ?>
                            <div class="col-12 col-sm-6 col-md-3 col-lg-3">
                                <div class="wt-footercol wt-widgetcategories">
                                    <div class="wt-fwidgettitle">
                                        <h3><?php echo e(trans('lang.by_cats')); ?></h3>
                                    </div>
                                    <?php if(!empty($categories)): ?>
                                        <ul class="wt-fwidgetcontent">
                                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li><a href="<?php echo e(url('search-results?type='.$type.'&category%5B%5D='.$category->slug)); ?>"><?php echo e($category->title); ?></a></li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if($locations->count() > 0): ?>
                            <div class="col-12 col-sm-6 col-md-3 col-lg-3">
                                <div class="wt-widgetbylocation">
                                    <div class="wt-fwidgettitle">
                                        <h3><?php echo e(trans('lang.by_locs')); ?></h3>
                                    </div>
                                    <?php if(!empty($locations)): ?>
                                        <ul class="wt-fwidgetcontent">
                                            <?php $__currentLoopData = $locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li><a href="<?php echo e(url('search-results?type='.$type.'&locations%5B%5D='.$location->slug)); ?>"><?php echo e($location->title); ?></a></li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if($languages->count() > 0): ?>
                            <div class="col-12 col-sm-6 col-md-3 col-lg-3">
                                <div class="wt-widgetbylocation">
                                    <div class="wt-fwidgettitle">
                                        <h3><?php echo e(trans('lang.by_lang')); ?></h3>
                                    </div>
                                    <?php if(!empty($languages)): ?>
                                        <ul class="wt-fwidgetcontent">
                                            <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li><a href="<?php echo e(url('search-results?type='.$type.'&languages%5B%5D='.$language->slug)); ?>"><?php echo e($language->title); ?></a></li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </section>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
    <script src="<?php echo e(asset('js/tilt.jquery.js')); ?>"></script>
    <script src="<?php echo e(asset('js/prettyPhoto-min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/owl.carousel.min.js')); ?>"></script>
    <script>
        jQuery("a[data-rel]").each(function () {
		jQuery(this).attr("rel", jQuery(this).data("rel"));
	});
	jQuery("a[data-rel^='prettyPhoto']").prettyPhoto({
		animation_speed: 'normal',
		theme: 'dark_square',
		slideshow: 3000,
		default_width: 800,
        default_height: 500,
        allowfullscreen: true,
		autoplay_slideshow: false,
		social_tools: false,
		iframe_markup: "<iframe src='{path}' width='{width}' height='{height}' frameborder='no' allowfullscreen='true'></iframe>",
		deeplinking: false
    });
    var _wt_freelancerslider = jQuery('.wt-freelancerslider')
        _wt_freelancerslider.owlCarousel({
            items: 1,
            loop:true,
            nav:true,
            margin: 0,
            autoplay:false,
            navClass: ['wt-prev', 'wt-next'],
            navContainerClass: 'wt-search-slider-nav',
            navText: ['<span class="lnr lnr-chevron-left"></span>', '<span class="lnr lnr-chevron-right"></span>'],
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make(file_exists(resource_path('views/extend/front-end/master.blade.php')) ? 'extend.front-end.master' : 'front-end.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>