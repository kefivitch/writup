@extends(file_exists(resource_path('views/extend/front-end/master.blade.php')) ?
'extend.front-end.master':
'front-end.master', ['body_class' => 'wt-innerbgcolor'] )
@push('stylesheets')
<link href="{{ asset('css/owl.carousel.min.css') }}" rel="stylesheet">
@endpush
@section('title'){{ trans('lang.cmdExpress')}} @stop
@section('description', 'description')
@section('content')
@if ($show_service_banner == 'true')

<div class="wt-haslayout wt-innerbannerholder"
    style="background-image:url({{ asset(Helper::getBannerImage('uploads/settings/general/'.$service_inner_banner)) }})">
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-xs-12 col-sm-12 col-md-8 push-md-2 col-lg-6 push-lg-3">
                <div class="wt-innerbannercontent">
                    <div class="wt-title ">
                        <h2>{{ trans('lang.cmdExpress') }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
<div class="wt-haslayout wt-main-section">

    <div class="container">
        <div class="row">
            <div id="wt-twocolumns" class="wt-twocolumns wt-haslayout">

              
                <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5 col-xl-4 float-left">
                    <aside id="wt-sidebar" class="wt-sidebar">
                       
                        @if (!empty($latest_article) && count($latest_article) !== 0)
                        <div class="wt-widget wt-widgetarticlesholder">
                            <div class="wt-widgettitle">
                                <h2>{{ trans('lang.popular_articles') }}</h2>
                            </div>
                            <div class="wt-widgetcontent">
                                @foreach ($latest_article as $key => $article)
                                <div class="wt-particlehold">
                                    <figure>
                                        <img src="{{{asset(Helper::getImage('uploads/articles', $article->banner, 'x-small-', 'xsmall-default-article.png'))}}}"
                                            alt="image description">
                                    </figure>
                                    <div class="wt-particlecontent">
                                        <h3><a href="{{{ url('article/'.$article->slug) }}}">{{$article->title}}</a>
                                        </h3>
                                        <span><i
                                                class="lnr lnr-clock"></i>{{ \Carbon\Carbon::parse($article->updated_at)->format('M d, Y')}}</span>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif
                    </aside>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7 col-xl-8 float-left">
                    @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                    @endif
                    <div class="wt-classicaricle-holder">
                        <div class="wt-classicaricle-header">
                            <div class="wt-title ">
                                <h2 class="text-center">{{ trans('lang.quote_request') }}</h2>
                                <p>{{ trans('lang.quote_request_note')}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="wt-article-holder">
                        <form method="POST" action="{{route('cmdExpress')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="fullName" class="l text-md-left">{{ trans('lang.ph_first_name') }} &
                                    {{ trans('lang.ph_last_name') }}</label>
                                <input id="fullName" type="text"
                                    class="form-control{{ $errors->has('fullName') ? ' is-invalid' : '' }}"
                                    name="fullName" value="{{ old('fullName') }}" required autofocus>
                                @if ($errors->has('fullName'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('fullName') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="row">
                                <div class=" col-md-6">
                                    <div class="form-group">
                                        <label for="email"
                                            class=" text-md-left">{{ trans('lang.email_address') }}</label>
                                        <input type="email"
                                            class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                            name="email" value="{{ old('email') }}" required autofocus>
                                        @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                        @endif
                                    </div>

                                </div>
                                <div class=" col-md-6">
                                    <div class="form-group">
                                        <label for="phone" class=" text-md-left">{{ trans('lang.phone') }}</label>
                                        <input type="phone"
                                            class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}"
                                            name="phone" value="{{ old('phone') }}" required autofocus>
                                        @if ($errors->has('phone'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('phone') }}</strong>
                                        </span>
                                        @endif
                                    </div>

                                </div>
                                <div class=" col-md-6">
                                    <div class="form-group">
                                        <label for="nbr_words"
                                            class=" col-form-label text-md-left">{{ trans('lang.nbr_words') }}</label>
                                        <input type="number" min="0" step="1"
                                            class="form-control{{ $errors->has('nbr_words') ? ' is-invalid' : '' }}"
                                            name="nbr_words" value="{{ old('nbr_words') }}" required autofocus>
                                        @if ($errors->has('nbr_words'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('nbr_words') }}</strong>
                                        </span>
                                        @endif
                                    </div>

                                </div>
                                <div class=" col-md-6">
                                    <div class="form-group">
                                        <label for="file"
                                            class=" col-form-label text-md-left">{{ trans('lang.file_attached') }}</label>
                                        <input type="file"
                                            class="form-control{{ $errors->has('file') ? ' is-invalid' : '' }}"
                                            name="file" value="{{ old('file') }}" required autofocus>
                                        @if ($errors->has('file'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('file') }}</strong>
                                        </span>
                                        @endif
                                    </div>

                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Description"
                                    class=" col-form-label text-md-left">{{ trans('lang.description') }}</label>
                                <textarea type="text"
                                    class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}"
                                    name="description" value="{{ old('description') }}" required autofocus></textarea>
                                @if ($errors->has('description'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group wt-btnarea">
                                <button type="submit" class=" wt-btn" style="background-color: #2b2e3e;">
                                    {{ trans('lang.btn_submit') }}
                                </button>
                            </div>

                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@push('scripts')
<script src="{{ asset('js/owl.carousel.min.js') }}"></script>

@endpush