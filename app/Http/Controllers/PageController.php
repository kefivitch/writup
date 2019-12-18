<?php
/**
 * Class PageController
 *
 * @category Worketic
 *
 * @package Worketic
 * @author  Amentotech <theamentotech@gmail.com>
 * @license http://www.amentotech.com Amentotech
 * @link    http://www.amentotech.com
 */
namespace App\Http\Controllers;

use App\Page;
use Illuminate\Http\Request;
use View;
use Illuminate\Support\Facades\Redirect;
use Session;
use DB;
use Auth;
use App\User;
use App\Helper;
use App\SiteManagement;

/**
 * Class PageController
 *
 */
class PageController extends Controller
{
    /**
     * Defining scope of the variable
     *
     * @access public
     * @var    array $page
     */
    protected $page;

    /**
     * Create a new controller instance.
     *
     * @param instance $page instance
     *
     * @return void
     */
    public function __construct(Page $page)
    {
        $this->page = $page;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = $this->page::getPages();
        if (file_exists(resource_path('views/extend/back-end/admin/pages/index.blade.php'))) {
            return View::make('extend.back-end.admin.pages.index', compact('pages'));
        } else {
            return View::make(
                'back-end.admin.pages.index',
                compact('pages')
            );
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parent_page = $this->page->getParentPages();
        $page_created = trans('lang.page_created');
        if (file_exists(resource_path('views/extend/back-end/admin/pages/create.blade.php'))) {
            return View::make('extend.back-end.admin.pages.create', compact('parent_page', 'page_created'));
        } else {
            return View::make('back-end.admin.pages.create', compact('parent_page', 'page_created'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param mixed $request $req->attr
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $server = Helper::worketicIsDemoSiteAjax();
        if (!empty($server)) {
            $response['type'] = 'error';
            $response['message'] = $server->getData()->message;
            return $response;
        }
        $json = array();
        if (!empty($request)) {
            $this->validate(
                $request, [
                    'title' => 'required|string',
                    'content' => 'required',
                ]
            );
            $save_page = $this->page->savePage($request);
            if ($request['parent_id']) {
                DB::table('child_pages')->insert(
                    ['parent_id' => $request['parent_id'], 'child_id' => $save_page]
                );
            }
            $json['type'] = 'success';
            return $json;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param string $slug page slug
     *
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        if (!empty($slug)) {
            $page = $this->page->getPageData($slug);
            $page_meta = SiteManagement::where('meta_key', 'seo-desc-'.$page->id)->select('meta_value')->pluck('meta_value')->first();
            $page_banner = SiteManagement::where('meta_key', 'page-banner-'.$page->id)->select('meta_value')->pluck('meta_value')->first();
            $show_banner = SiteManagement::where('meta_key', 'show-banner-'.$page->id)->select('meta_value')->pluck('meta_value')->first();
            $breadcrumbs_settings = SiteManagement::getMetaValue('show_breadcrumb');
            $show_breadcrumbs = !empty($breadcrumbs_settings) ? $breadcrumbs_settings : 'true';
            $show_banner_image = false;
            if (empty($show_banner)) {
                $show_banner_image = true;
            } else {
                $show_banner_image = $show_banner == 'true' ? true : false;
            }
            $banner = !empty($page_banner) ? Helper::getBannerImage('uploads/pages/'.$page_banner) : 'images/bannerimg/img-02.jpg';
            $meta_desc = !empty($page_meta) ? $page_meta : '';
            if (file_exists(resource_path('views/extend/front-end/pages/show.blade.php'))) {
                return View::make('extend.front-end.pages.show', compact('page', 'slug', 'meta_desc', 'banner', 'show_banner', 'show_banner_image','show_breadcrumbs'));
            } else {
                return View::make('front-end.pages.show', compact('page', 'slug', 'meta_desc', 'banner', 'show_banner', 'show_banner_image','show_breadcrumbs'));
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param integer $id page Id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!empty($id)) {
            $page = $this->page::find($id);
            $parent_selected_id = '';
            $parent_page = $this->page->getParentPages($id);
            $has_child = $this->page->pageHasChild($id);
            $child_parent_id = DB::table('child_pages')->select('parent_id')->where('child_id', $id)->get()->first();
            $desc = SiteManagement::where('meta_key', 'seo-desc-'.$id)->select('meta_value')->pluck('meta_value')->first();
            $seo_desc = !empty($desc) ? $desc : '';
            $page_banner = SiteManagement::where('meta_key', 'page-banner-'.$id)->select('meta_value')->pluck('meta_value')->first();
            if (!empty($child_parent_id->parent_id)) {
                $parent_selected_id = $child_parent_id->parent_id;
            } else {
                $parent_selected_id = '';
            }
            if (file_exists(resource_path('views/extend/back-end/admin/pages/edit.blade.php'))) {
                return View::make('extend.back-end.admin.pages.edit', compact('page', 'parent_page', 'parent_selected_id', 'id', 'has_child', 'seo_desc', 'page_banner'));
            } else {
                return View::make('back-end.admin.pages.edit', compact('page', 'parent_page', 'parent_selected_id', 'id', 'has_child', 'seo_desc', 'page_banner'));
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param mixed   $request $req->attr
     * @param integer $id      page ID
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $server_verification = Helper::worketicIsDemoSite();
        if (!empty($server_verification)) {
            Session::flash('error', $server_verification);
            return Redirect::to('admin/pages');
        }
        if (!empty($request)) {
            $this->validate(
                $request, [
                'title' => 'required|string',
                'content' => 'required',
                ]
            );
            $parent_id = filter_var($request['parent_id'], FILTER_SANITIZE_NUMBER_INT);
            $child_id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
            $this->page->updatePage($id, $request);
            if ($parent_id == null) {
                DB::table('child_pages')->where('child_id', '=', $child_id)->delete();
            } elseif ($parent_id) {
                DB::table('child_pages')->where('child_id', '=', $child_id)->delete();
                DB::table('child_pages')->insert(
                    ['parent_id' => $parent_id, 'child_id' => $child_id]
                );
            }
            Session::flash('message', trans('lang.page_updated'));
            return Redirect::to('admin/pages');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param mixed $request $req->attr
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $server = Helper::worketicIsDemoSiteAjax();
        if (!empty($server)) {
            $json['type'] = 'error';
            $json['message'] = $server->getData()->message;
            return $json;
        }
        $json = array();
        $id = $request['id'];
        if (!empty($id)) {
            $child_pages = $this->page::pageHasChild($id);
            if (!empty($child_pages)) {
                foreach ($child_pages as $page) {
                    DB::table('pages')->where('id', $page->child_id)->update(['relation_type' => 0]);
                }
            } else {
                $relation = DB::table('pages')->select('relation_type')->where('id', $id)->get()->first();
                if ($relation->relation_type == 1) {
                    DB::table('pages')->where('id', $id)->update(['relation_type' => 0]);
                }
            }
            DB::table('child_pages')->where('child_id', '=', $id)->orWhere('parent_id', '=', $id)->delete();
            DB::table('pages')->where('id', '=', $id)->delete();
            $json['type'] = 'success';
            $json['message'] = trans('lang.page_deleted');
            return $json;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param mixed $request request attributes
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteSelected(Request $request)
    {
        $server = Helper::worketicIsDemoSiteAjax();
        if (!empty($server)) {
            $json['type'] = 'error';
            $json['message'] = $server->getData()->message;
            return $json;
        }
        $json = array();
        $checked = $request['ids'];
        foreach ($checked as $id) {
            $this->page::where("id", $id)->delete();
        }
        if (!empty($checked)) {
            $json['type'] = 'success';
            return $json;
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.something_wrong');
            return $json;
        }
    }

    /**
     * Upload Image to temporary folder.
     *
     * @param mixed  $request   request attributes
     * @param string $file_name getfilename
     *
     * @return \Illuminate\Http\Response
     */
    public function uploadTempImage(Request $request, $file_name = '')
    {
        $path = Helper::PublicPath() . '/uploads/pages/temp/';
        if (!empty($request[$file_name])) {
            Helper::uploadSingleTempImage($path, $request[$file_name]);
        }
    }
}
