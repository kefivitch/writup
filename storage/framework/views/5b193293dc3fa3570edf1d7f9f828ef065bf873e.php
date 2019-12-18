<?php $__env->startPush('stylesheets'); ?>
    <link href="<?php echo e(asset('css/prettyPhoto.css')); ?>" rel="stylesheet">
<?php $__env->stopPush(); ?>
<?php $__env->startSection('title'); ?><?php echo e($page->title); ?> <?php $__env->stopSection(); ?>
<?php $__env->startSection('description', "$meta_desc"); ?>
<?php $__env->startSection('content'); ?>
    <?php if($show_banner_image == true): ?>
        <?php $breadcrumbs = Breadcrumbs::generate('showPage',$page, $slug); ?>
        <div class="wt-haslayout wt-innerbannerholder" style="background-image:url(<?php echo e(asset($banner)); ?>)">
            <div class="container">
                <div class="row justify-content-md-center">
                    <div class="col-xs-12 col-sm-12 col-md-8 push-md-2 col-lg-6 push-lg-3">
                        <div class="wt-innerbannercontent">
                            <?php if(!empty($page)): ?>
                                <div class="wt-title">
                                    <h2><?php echo e($page->title); ?></h2>
                                </div>
                            <?php endif; ?>
                            <?php if(!empty($show_breadcrumbs) && $show_breadcrumbs === 'true'): ?>
                                <?php if(count($breadcrumbs)): ?>
                                    <ol class="wt-breadcrumb">
                                        <?php $__currentLoopData = $breadcrumbs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $breadcrumb): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($breadcrumb->url && !$loop->last): ?>
                                                <li><a href="<?php echo e($breadcrumb->url); ?>"><?php echo e($breadcrumb->title); ?></a></li>
                                            <?php else: ?>
                                                <li class="active"><?php echo e($breadcrumb->title); ?></li>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ol>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <?php if(!empty($page)): ?>
        <div class="wt-contentwrappers">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 float-left">
                        <div class="wt-howitwork-hold wt-haslayout">
                            <div class="wt-haslayout wt-main-section">
                                <?php echo htmlspecialchars_decode(stripslashes($page->body)); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php else: ?>
        <?php if(file_exists(resource_path('views/extend/errors/404.blade.php'))): ?> 
            <?php echo $__env->make('extend.errors.404', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php else: ?> 
            <?php echo $__env->make('errors.404', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php endif; ?>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
    <script src="<?php echo e(asset('js/prettyPhoto.js')); ?>"></script>
    <script>
        jQuery("a[data-rel]").each(function () {
            jQuery(this).attr("rel", jQuery(this).data("rel"));
        });
        jQuery("a[data-rel^='prettyPhoto']").prettyPhoto({
            animation_speed: 'normal',
            theme: 'dark_square',
            slideshow: 3000,
            autoplay_slideshow: false,
            social_tools: false
        });
        var popupMeta = {
            width: 400,
            height: 400
        }
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make(file_exists(resource_path('views/extend/front-end/master.blade.php')) ? 
'extend.front-end.master':
 'front-end.master', ['body_class' => 'wt-innerbgcolor'] , \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>