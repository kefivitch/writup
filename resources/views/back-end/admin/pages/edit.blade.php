@extends(file_exists(resource_path('views/extend/back-end/master.blade.php')) ? 'extend.back-end.master' : 'back-end.master')
@section('content')
    <div class="pages-listing" id="pages-list">
        @if (Session::has('message'))
            <div class="flash_msg">
                <flash_messages :message_class="'success'" :time='5' :message="'{{{ Session::get('message') }}}'" v-cloak></flash_messages>
            </div>
        @elseif (Session::has('error'))
            <div class="flash_msg">
                <flash_messages :message_class="'danger'" :time ='5' :message="'{{{ Session::get('error') }}}'" v-cloak></flash_messages>
            </div>
        @endif
        @if ($errors->any())
            <ul class="wt-jobalerts">
                @foreach ($errors->all() as $error)
                    <div class="flash_msg">
                        <flash_messages :message_class="'danger'" :time='10' :message="'{{{ $error }}}'" v-cloak></flash_messages>
                    </div>
                @endforeach
            </ul>
        @endif
        <section class="wt-haslayout wt-dbsectionspace">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-12 float-left">
                    <div class="wt-dashboardbox">
                        <div class="wt-dashboardboxtitle">
                            <h2>{{{ trans('lang.edit_page') }}}</h2>
                        </div>
                        <div class="wt-dashboardboxcontent">
                            {!! Form::open([ 'url' => url('admin/pages/update-page/'.$page->id.''), 'class' =>'wt-formtheme wt-formprojectinfo wt-formcategory','id' => 'pages']) !!}
                                <fieldset>
                                    <div class="form-group">
                                        {!! Form::text( 'title', e($page->title), ['class' =>'form-control', 'placeholder' => trans('lang.ph_page_title')] ) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::textarea( 'content', e($page->body), ['class' =>'form-control wt-tinymceeditor', 'placeholder' => trans('lang.ph_desc')]) !!}
                                    </div>
                                    @if (empty($has_child))
                                        @if ($parent_page->count() >= 1)
                                            <div class="form-group">
                                                <span class="wt-select">
                                                    {!! Form::select('parent_id', $parent_page, $parent_selected_id , array('class' => 'form-control wt-select2')) !!}
                                                </span>
                                            </div>
                                        @endif
                                    @endif
                                    <div class="wt-securitysettings wt-tabsinfo wt-haslayout">
                                        <div class="wt-tabscontenttitle">
                                            <h2>{{{ trans('lang.seo_meta_desc') }}}</h2>
                                        </div>
                                        <div class="wt-settingscontent">
                                            <div class="form-group">
                                                {!! Form::textarea('seo_desc', $seo_desc, array('class' => 'form-group seo-meta', 'placeholder' => trans('lang.description'))) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="wt-tabscontenttitle la-switch-option">
                                        <h2>{{ trans('lang.add_menu_to_navbar') }}</h2>
                                        <switch_button v-model="show_page">{{{ trans('lang.add_menu_to_navbar') }}}</switch_button>
                                        <input type="hidden" :value="show_page" name="show_page">
                                    </div>
                                    <div class="wt-tabscontenttitle la-switch-option">
                                        <h2>{{ trans('lang.show_page_banner') }}</h2>
                                        <switch_button v-model="show_page_banner">{{{ trans('lang.show_hide_banner') }}}</switch_button>
                                        <input type="hidden" :value="show_page_banner" name="show_page_banner">
                                    </div>
                                    @if (file_exists(resource_path('views/extend/back-end/admin/pages/page_inner_banner.blade.php'))) 
                                        @include('extend.back-end.admin.pages.page_inner_banner')
                                    @else 
                                        @include('back-end.admin.pages.page_inner_banner')
                                    @endif
                                    <div class="form-group wt-btnarea">
                                        {!! Form::submit(trans('lang.update_page'), ['class' => 'wt-btn']) !!}
                                    </div>
                                </fieldset>
                            {!! Form::close(); !!}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
