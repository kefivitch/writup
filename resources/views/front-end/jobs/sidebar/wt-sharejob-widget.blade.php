<meta property="og:image" content="https://writup.net/uploads/settings/general/LogoBanner.png" />
<meta property="og:url" content="https://writup.net" />
<meta property="og:type" content="website" />
<meta property="og:title" content="{{ (Request::fullUrl()) }}" />
<meta property="og:description" content="{{ (Request::fullUrl()) }}" />
<meta property="og:site_name" content="@yield('site_name')" />
<div class="wt-widget wt-sharejob">
    <div class="wt-widgettitle">
        <h2>{{ trans('lang.share_job') }}</h2>
    </div>
    <div class="wt-widgetcontent">
        <ul class="wt-socialiconssimple">
            <li>
                <div class="fb-share-button" data-href="{{ (Request::fullUrl()) }}" data-layout="button_count"
                    data-size="large"><a target="_blank"
                        href="https://www.facebook.com/sharer/sharer.php?u={{ (Request::fullUrl()) }}"src="sdkpreparse"
                        class="fb-xfbml-parse-ignore">{{ trans('lang.share_fb') }}</a></div>
            </li>
            <li class="wt-twitter">
                <a href="https://twitter.com/intent/tweet?url={{ urlencode(Request::fullUrl()) }}" class="social-share">
                <i class="fa fab fa-twitter"></i>{{ trans('lang.share_twitter') }}</a>
            </li>
            <li class="wt-pinterest">
                <a href="//pinterest.com/pin/create/button/?url={{ urlencode(Request::fullUrl()) }}"
                onclick="window.open(this.href, \'post-share\',\'left=50,top=50,width=600,height=350,toolbar=0\'); return false;">
                <i class="fa fab fa-pinterest-p"></i>{{ trans('lang.share_pinterest') }}</a>
            </li>
            <li class="wt-googleplus">
                <a href="https://plus.google.com/share?url={{ urlencode(Request::fullUrl()) }}" class="social-share">
                <i class="fa fab fa-google-plus-g"></i>{{ trans('lang.share_google') }}</a>
            </li>
        </ul>
    </div>
</div>
