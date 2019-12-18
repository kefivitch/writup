<?php
/**
 * Class Page.
 *
 * @category Worketic
 *
 * @package Worketic
 * @author  Amentotech <theamentotech@gmail.com>
 * @license http://www.amentotech.com Amentotech
 * @link    http://www.amentotech.com
 */

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Carbon\Carbon;
use File;

/**
 * Class Page
 *
 */
class Page extends Model
{

     /**
      * Fillables for the database
      *
      * @access protected
      *
      * @var array $fillable
      */
    protected $fillable = array('title', 'slug', 'body');

    /**
     * Set slug attribute
     *
     * @param int $value page ID
     *
     * @return array
     */
    public function setSlugAttribute($value)
    {
        $temp = str_slug($value, '-');
        if (!Page::all()->where('slug', $temp)->isEmpty()) {
            $i = 1;
            $new_slug = $temp . '-' . $i;
            while (!Page::all()->where('slug', $new_slug)->isEmpty()) {
                $i++;
                $new_slug = $temp . '-' . $i;
            }
            $temp = $new_slug;
        }
        $this->attributes['slug'] = $temp;
    }

    /**
     * Get Pages
     *
     * @return array
     */
    public static function getPages()
    {
        $pages = DB::table('pages')->paginate(5);
        return $pages;
    }

    /**
     * Get Parent Pages
     *
     * @param mixed $request $req->attribute
     *
     * @return array
     */
    public function savePage($request)
    {
        if (!empty($request)) {
            $this->title = filter_var($request->title, FILTER_SANITIZE_STRING);
            $this->slug = filter_var($request->title, FILTER_SANITIZE_STRING);
            $this->body = $request->content;
            if ($request->parent_id) {
                $this->relation_type = 1;
            } else {
                $this->relation_type = 0;
            }
            $this->save();
            $page_id =  $this->id;
            $old_path = Helper::PublicPath() . '/uploads/pages/temp';
            if (!file_exists($old_path)) {
                File::makeDirectory($old_path, 0755, true, true);
            }
            $new_path = Helper::PublicPath() . '/uploads/pages';
            if (!empty($request['page_banner'])) {
                if (file_exists($old_path . '/' . $request['page_banner'])) {
                    if (!file_exists($new_path)) {
                        File::makeDirectory($new_path, 0755, true, true);
                    }
                    $filename = time() . '-' . $request['page_banner'];
                    rename($old_path . '/' . $request['page_banner'], $new_path . '/' . $filename);
                    $request['page_banner'] = $filename;
                } else {
                    $request['page_banner'] = $request['page_banner'];
                }
            }
            if (!empty($request['seo_desc'])) {
                DB::table('site_managements')->insert(
                    [
                        'meta_key' => 'seo-desc-'.$page_id, 'meta_value' => $request['seo_desc'],
                        "created_at" => Carbon::now(), "updated_at" => Carbon::now()
                    ]
                );
            }
            if (!empty($request['show_page'])) {
                DB::table('site_managements')->insert(
                    [
                        'meta_key' => 'show-page-'.$page_id, 'meta_value' => $request['show_page'],
                        "created_at" => Carbon::now(), "updated_at" => Carbon::now()
                    ]
                );
            }
            if (!empty($request['show_page_banner'])) {
                DB::table('site_managements')->insert(
                    [
                        'meta_key' => 'show-banner-'.$page_id, 'meta_value' => $request['show_page_banner'],
                        "created_at" => Carbon::now(), "updated_at" => Carbon::now()
                    ]
                );
            }
            if (!empty($request['page_banner'])) {
                DB::table('site_managements')->insert(
                    [
                        'meta_key' => 'page-banner-'.$page_id, 'meta_value' => $request['page_banner'],
                        "created_at" => Carbon::now(), "updated_at" => Carbon::now()
                    ]
                );
            }
            return $page_id;

        }
    }

    /**
     * Get Parent Pages
     *
     * @param int   $id      page ID
     * @param mixed $request request
     *
     * @return array
     */
    public function updatePage($id, $request)
    {
        if (!empty($id) && !empty($request)) {
            $pages = Page::find($id);
            if ($pages->title != $request->title) {
                $pages->slug = filter_var($request->title, FILTER_SANITIZE_STRING);
            }
            $pages->title = filter_var($request->title, FILTER_SANITIZE_STRING);
            $pages->body = $request->content;
            if ($request->parent_id == null) {
                $pages->relation_type = 0;
            } elseif ($request->parent_id) {
                $pages->relation_type = 1;
            }
            $pages->save();
            $old_path = Helper::PublicPath() . '/uploads/pages/temp';
            if (!file_exists($old_path)) {
                File::makeDirectory($old_path, 0755, true, true);
            }
            $new_path = Helper::PublicPath() . '/uploads/pages';
            if (!empty($request['page_banner'])) {
                if (file_exists($old_path . '/' . $request['page_banner'])) {
                    if (!file_exists($new_path)) {
                        File::makeDirectory($new_path, 0755, true, true);
                    }
                    $filename = time() . '-' . $request['page_banner'];
                    rename($old_path . '/' . $request['page_banner'], $new_path . '/' . $filename);
                    $request['page_banner'] = $filename;
                } else {
                    $request['page_banner'] = $request['page_banner'];
                }
            }
            if (!empty($request['seo_desc'])) {
                DB::table('site_managements')->where('meta_key', '=', 'seo-desc-'.$id)->delete();
                DB::table('site_managements')->insert(
                    [
                        'meta_key' => 'seo-desc-'.$id, 'meta_value' => $request['seo_desc'],
                        "created_at" => Carbon::now(), "updated_at" => Carbon::now()
                    ]
                );
            }
            if (!empty($request['show_page'])) {
                DB::table('site_managements')->where('meta_key', '=', 'show-page-'.$id)->delete();
                DB::table('site_managements')->insert(
                    [
                        'meta_key' => 'show-page-'.$id, 'meta_value' => $request['show_page'],
                        "created_at" => Carbon::now(), "updated_at" => Carbon::now()
                    ]
                );
            }
            if (!empty($request['show_page_banner'])) {
                DB::table('site_managements')->where('meta_key', '=', 'show-banner-'.$id)->delete();
                DB::table('site_managements')->insert(
                    [
                        'meta_key' => 'show-banner-'.$id, 'meta_value' => $request['show_page_banner'],
                        "created_at" => Carbon::now(), "updated_at" => Carbon::now()
                    ]
                );
            }
            if (!empty($request['page_banner'])) {
                DB::table('site_managements')->where('meta_key', '=', 'page-banner-'.$id)->delete();
                DB::table('site_managements')->insert(
                    [
                        'meta_key' => 'page-banner-'.$id, 'meta_value' => $request['page_banner'],
                        "created_at" => Carbon::now(), "updated_at" => Carbon::now()
                    ]
                );
            }
        }
    }

    /**
     * Get Page Data
     *
     * @param int $slug Slug
     *
     * @return array
     */
    public static function getPageData($slug)
    {
        if (!empty($slug) && is_string($slug)) {
            return DB::table('pages')->select('*')->where('slug', $slug)->get()->first();
        }
    }

    /**
     * Get Parent Slug
     *
     * @param int $id page ID
     *
     * @return array
     */
    public static function getPageslug($id)
    {
        if (!empty($id) && is_numeric($id)) {
            return DB::table('pages')->select('slug')->where('id', $id)->get()->first();
        }
    }


    /**
     * Get Parent Pages
     *
     * @param int $id pageID
     *
     * @return array
     */
    public function getParentPages($id = '')
    {
        if (!empty($id)) {
            return DB::table('pages')->where('relation_type', 0)->where('id', '!=', $id)->pluck('title', 'id')->prepend('Select parent', '');
        } else {
            return DB::table('pages')->where('relation_type', '=', 0)->pluck('title', 'id')->prepend('Select parent', '');
        }

    }

    /**
     * Get Page List
     *
     * @return array
     */
    public static function getPageList()
    {
        return DB::table('pages')->select('title', 'slug')->pluck('title', 'slug');
    }

    /**
     * Get Child Pages
     *
     * @param int $child_id page child ID
     *
     * @return array
     */
    public static function getChildPages($child_id)
    {
        return DB::table('pages')->select('title', 'slug', 'id')->where('id', $child_id)->get()->first();
    }

    /**
     * Get pages with child
     *
     * @param int $page_id page ID
     *
     * @return array
     */
    public static function pageHasChild($page_id)
    {
        if (!empty($page_id) && is_numeric($page_id)) {
            return DB::table('pages')
                ->join('child_pages', 'pages.id', '=', 'child_pages.parent_id')
                ->select('pages.id', 'pages.title', 'child_pages.child_id')
                ->where('child_pages.parent_id', '=', $page_id)
                ->get()->all();
        }
    }
}
