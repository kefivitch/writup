<aside id="wt-sidebar" class="wt-sidebar">

    <div class="wt-proposalsr">
        <div class="wt-proposalsrcontent">
            <span class="wt-proposalsicon"><i class="fa fa-angle-double-down"></i><i class="fa fa-money"></i></span>
            <div class="wt-title">
                <h3>{{{ $job->price }}} <i>{{ !empty($symbol['symbol']) ? $symbol['symbol'] : '$' }}</i></h3>
                <span>{{ trans('lang.client_budget') }}</span>
            </div>
        </div>
        @if (file_exists(resource_path('views/extend/front-end/jobs/sidebar/wt-jobproposals-widget.blade.php')))
            @include('extend.front-end.jobs.sidebar.wt-jobproposals-widget')
        @else
            @include('front-end.jobs.sidebar.wt-jobproposals-widget')
        @endif
        @if (file_exists(resource_path('views/extend/front-end/jobs/sidebar/wt-qrcode-widget.blade.php')))
            @include('extend.front-end.jobs.sidebar.wt-qrcode-widget')
        @else
            @include('front-end.jobs.sidebar.wt-qrcode-widget')
        @endif
        @if (file_exists(resource_path('views/extend/front-end/jobs/sidebar/wt-addtofavourite-widget.blade.php')))
            @include('extend.front-end.jobs.sidebar.wt-addtofavourite-widget')
        @else
            @include('front-end.jobs.sidebar.wt-addtofavourite-widget')
        @endif

    </div>
    @if (file_exists(resource_path('views/extend/front-end/jobs/sidebar/wt-employerinfo-widget.blade.php')))
        @include('extend.front-end.jobs.sidebar.wt-employerinfo-widget')
    @else
        @include('front-end.jobs.sidebar.wt-employerinfo-widget')
    @endif
    @if (file_exists(resource_path('views/extend/front-end/jobs/sidebar/wt-sharejob-widget.blade.php')))
        @include('extend.front-end.jobs.sidebar.wt-sharejob-widget')
    @else
        @include('front-end.jobs.sidebar.wt-sharejob-widget')
    @endif
    @if (file_exists(resource_path('views/extend/front-end/jobs/sidebar/wt-reportjob-widget.blade.php')))
        @include('extend.front-end.jobs.sidebar.wt-reportjob-widget')
    @else
        @include('front-end.jobs.sidebar.wt-reportjob-widget')
    @endif
</aside>
