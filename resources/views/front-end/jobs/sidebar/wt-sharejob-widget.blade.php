<div class="wt-widget wt-sharejob">
    <div class="wt-widgettitle">
        <h2>{{ trans('lang.share_job') }}</h2>
    </div>
    <div class="wt-widgetcontent">
      
    {!!Share::currentPage()->facebook()->twitter()->pinterest()!!}
        <div id="social-links">
            <ul>
                <div class="wt-widgetcontent">
                    <ul class="wt-socialiconssimple">
                    <a href="https://plus.google.com/share?url={{ urlencode(Request::fullUrl()) }}" class="social-share">
                        <i class="fa fab fa-google-plus-g"></i></a>
                    </ul>
                </div>
            </ul>
        </div>
    </div>
</div>