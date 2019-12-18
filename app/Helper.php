<?php

/**
 * Class Helper
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
use Intervention\Image\Facades\Image;
use File;
use Storage;
use Spatie\Permission\Models\Role;
use DB;
use function GuzzleHttp\json_encode;
use APP\Category;
use APP\Location;
use Auth;
use App\Item;
use App\Payout;
use App\Proposal;
use App\User;
use App\SiteManagement;
use App\Badge;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Schema;

/**
 * Class Helper
 *
 */
class Helper extends Model
{
    /**
     * Set slug before saving in DB
     *
     * @access public
     *
     * @return array
     */
    public static function getGender()
    {
        $gender = ['male' => 'Male', 'female' => 'Female'];
        return $gender;
    }

    /**
     * Generate random code
     *
     * @param integer $limit Limit of numbers
     *
     * @access public
     *
     * @return array
     */
    public static function generateRandomCode($limit)
    {
        if (!empty($limit) && is_numeric($limit)) {
            return substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $limit);
        }
    }

    /**
     * Get employees list
     *
     * @access public
     *
     * @return array
     */
    public static function getEmployeesList()
    {
        $list = array(
            '1' => array(
                'title' => trans('lang.employee_list.just_me'),
                'search_title' => 'Less Than Two',
                'value' => 1,
            ),
            '2' => array(
                'title' => trans('lang.employee_list.2_9'),
                'search_title' => 'Less Than 10',
                'value' => 10,
            ),
            '3' => array(
                'title' => trans('lang.employee_list.10_99'),
                'search_title' => 'Less Than 100',
                'value' => 100,
            ),
            '4' => array(
                'title' => trans('lang.employee_list.100_499'),
                'search_title' => 'Less Than 500',
                'value' => 500,
            ),
            '5' => array(
                'title' => trans('lang.employee_list.500_100'),
                'search_title' => 'Less Than 1000',
                'value' => 1000,
            ),
            '6' => array(
                'title' => trans('lang.employee_list.500_1000'),
                'search_title' => 'More Than 1000',
                'value' => 5000,
            ),
        );
        return $list;
    }

    /**
     * Get location flag
     *
     * @param image $image location flag
     *
     * @access public
     *
     * @return string
     */
    public static function getLocationFlag($image)
    {
        if (!empty($image)) {
            return '/uploads/locations/' . $image;
        } else {
            return 'images/img-09.png';
        }
    }

    /**
     * Get category image
     *
     * @param image $image location flag
     *
     * @access public
     *
     * @return string
     */
    public static function getCategoryImage($image)
    {
        if (!empty($image)) {
            return '/uploads/categories/' . $image;
        } else {
            return 'uploads/categories/img-09.png';
        }
    }

    /**
     * Get badge Image
     *
     * @param image $image badge Image
     *
     * @access public
     *
     * @return string
     */
    public static function getBadgeImage($image)
    {
        if (!empty($image)) {
            return '/uploads/badges/' . $image;
        } else {
            return '';
        }
    }

    /**
     * Get banner image
     *
     * @param image $image location
     *
     * @access public
     *
     * @return string
     */
    public static function getBannerImage($image, $path = '')
    {
        if (empty($image) && isset($_GET['type']) && $_GET['type'] == 'freelancer') {
            $banner =  'images/frbanner-1920x400.jpg';
        } elseif (empty($image) && isset($_GET['type']) && $_GET['type'] == 'employer') {
            $banner =  'images/e-1110x300.jpg';
        } elseif (empty($image) && isset($_GET['type']) && $_GET['type'] == 'job') {
            $banner =  'images/bannerimg/img-02.jpg';
        } else {
            $banner = $path . '/' . $image;
        }
        return $banner;
    }

    /**
     * Get download app image
     *
     * @param image $image download app image
     *
     * @access public
     *
     * @return string
     */
    public static function getDownloadAppImage($image)
    {
        if (!empty($image)) {
            return '/uploads/settings/home/' . $image;
        } else {
            return 'images/mobile-img.png';
        }
    }

    /**
     * Get Header logo image
     *
     * @param image $image header logo
     *
     * @access public
     *
     * @return string
     */
    public static function getHeaderLogo($image)
    {
        if (!empty($image)) {
            return '/uploads/settings/general/' . $image;
        } else {
            return 'images/logo.png';
        }
    }

    /**
     * Get footer logo image
     *
     * @param image $image download app image
     *
     * @access public
     *
     * @return string
     */
    public static function getFooterLogo($image)
    {
        if (!empty($image)) {
            return '/uploads/settings/footer/' . $image;
        } else {
            return 'images/flogo.png';
        }
    }

    /**
     * Store Temporary profile images
     *
     * @param mixed $temp_path Temporary Path.
     * @param mixed $image     Image.
     * @param mixed $file_name file name
     *
     * @return json response
     */
    public static function uploadTempImage($temp_path, $image, $file_name = "")
    {
        $json = array();
        if (!empty($image)) {
            $file_original_name = $image->getClientOriginalName();
            $parts = explode('.', $file_original_name);
            $extension = end($parts);
            $extension = $image->getClientOriginalExtension();
            if ($extension === "jpg" || $extension === "png") {
                $file_original_name = !empty($file_name) ? $file_name : $file_original_name;
                // create directory if not exist.
                if (!file_exists($temp_path)) {
                    File::makeDirectory($temp_path, 0755, true, true);
                }
                // generate small image size
                $small_img = Image::make($image);
                $small_img->fit(
                    36,
                    36,
                    function ($constraint) {
                        $constraint->upsize();
                    }
                );
                $small_img->save($temp_path . '/small-' . $file_original_name);
                // generate medium image size
                $medium_img = Image::make($image);
                $medium_img->fit(
                    100,
                    100,
                    function ($constraint) {
                        $constraint->upsize();
                    }
                );
                $medium_img->save($temp_path . '/medium-' . $file_original_name);
                // save original image size
                $img = Image::make($image);
                $img->save($temp_path . '/' . $file_original_name);
                $json['message'] = trans('lang.img_uploaded');
                $json['type'] = 'success';
                return $json;
            } else {
                $json['message'] = trans('lang.img_jpg_png');
                $json['type'] = 'error';
                return $json;
            }
        } else {
            $json['message'] = trans('lang.image not found');
            $json['type'] = 'error';
            return $json;
        }
    }

    /**
     * Store Temporary images
     *
     * @param mixed $temp_path  Temporary Path.
     * @param mixed $image      Image.
     * @param mixed $file_name  File Name.
     * @param mixed $image_size Image Size.
     *
     * @return json response
     */
    public static function uploadTempImageWithSize($temp_path, $image, $file_name = "", $image_size = array())
    {
        $json = array();
        if (!empty($image)) {
            $file_original_name = $image->getClientOriginalName();
            $parts = explode('.', $file_original_name);
            $extension = end($parts);
            $extension = $image->getClientOriginalExtension();
            if ($extension === "jpg" || $extension === "png") {
                $file_original_name = !empty($file_name) ? $file_name : $file_original_name;
                // create directory if not exist.
                if (!file_exists($temp_path)) {
                    File::makeDirectory($temp_path, 0755, true, true);
                }
                if (!empty($image_size)) {
                    foreach ($image_size as $key => $size) {
                        $small_img = Image::make($image);
                        $small_img->fit(
                            $size['width'],
                            $size['height'],
                            function ($constraint) {
                                $constraint->upsize();
                            }
                        );
                        $small_img->save($temp_path . $key . '-' . $file_original_name);
                    }
                }
                // save original image size
                $img = Image::make($image);
                $img->save($temp_path . '/' . $file_original_name);
                $json['message'] = trans('lang.img_uploaded');
                $json['type'] = 'success';
                return $json;
            } else {
                $json['message'] = trans('lang.img_jpg_png');
                $json['type'] = 'error';
                return $json;
            }
        } else {
            $json['message'] = trans('lang.image not found');
            $json['type'] = 'error';
            return $json;
        }
    }

    /**
     * Upload image to new path
     *
     * @param mixed $image    Image.
     * @param mixed $old_path Old path.
     * @param mixed $new_path New path.
     * @param mixed $counter  Counter.
     *
     * @return $json response
     */
    public static function uploadTempToNewPath($image, $old_path, $new_path, $counter = '')
    {
        if (!empty($image)) {
            $filename = $image;
            if (Storage::disk('local')->exists($old_path . '/' . $image)) {
                if (!file_exists($new_path)) {
                    File::makeDirectory($new_path, 0755, true, true);
                }
                $filename = time() . $counter . '-' . $image;
                Storage::move($old_path . '/' . $image, $new_path . '/' . $filename);
                Storage::move($old_path . '/small-' . $image, $new_path . '/small-' . $filename);
                Storage::move($old_path . '/medium-' . $image, $new_path . '/medium-' . $filename);
            }
            return $filename;
        }
    }

    /**
     * Get English Level List
     *
     * @param string $key key
     *
     * @access public
     *
     * @return array
     */
    public static function getEnglishLevelList($key = "")
    {
        $list = array(
            'basic'             => trans('lang.basic'),
            'conversational'    => trans('lang.conversational'),
            'fluent'            => trans('lang.fluent'),
            'native'            => trans('lang.native'),
            'professional'      => trans('lang.professional'),
        );
        if (!empty($key) && array_key_exists($key, $list)) {
            return $list[$key];
        } else {
            return $list;
        }
    }

    /**
     * Get Project List
     *
     * @param string $key key
     *
     * @access public
     *
     * @return array
     */
    public static function getProjectLevel($key = "")
    {
        $list = array(
            'basic'     => trans('lang.project_level.basic'),
            'medium'    => trans('lang.project_level.medium'),
            'expensive' => trans('lang.project_level.expensive'),
        );
        if (!empty($key) && array_key_exists($key, $list)) {
            return $list[$key];
        } else {
            return $list;
        }
    }

    /**
     * Get Project Type
     *
     * @param string $key key
     *
     * @access public
     *
     * @return array
     */
    public static function getProjectType($key = "")
    {
        $list = array(
            'projects' => trans('lang.projecttype.projects'),
            'hourly'  => trans('lang.projecttype.hourly'),
            'fixed' => trans('lang.projecttype.fixed'),
        );
        if (!empty($key) && array_key_exists($key, $list)) {
            return $list[$key];
        } else {
            return $list;
        }
    }

    /**
     * Get Project Status
     *
     * @param string $key key
     *
     * @access public
     *
     * @return array
     */
    public static function getProjectStatus($key = "")
    {
        $list = array(
            'completed' => trans('lang.project_status.completed'),
            'cancelled' => trans('lang.project_status.cancelled'),
            'hired'     => trans('lang.project_status.hired'),
        );
        if (!empty($key) && array_key_exists($key, $list)) {
            return $list[$key];
        } else {
            return $list;
        }
    }

    /**
     * Get Job Duration List
     *
     * @param string $key key
     *
     * @access public
     *
     * @return array
     */
    public static function getJobDurationList($key = "")
    {
        $list = array(
            'weekly' => trans('lang.job_duration.weekly'),
            'monthly' => trans('lang.job_duration.monthly'),
            'three_month' => trans('lang.job_duration.three_month'),
            'six_month' => trans('lang.job_duration.six_month'),
            'more_than_six' => trans('lang.job_duration.more_than_six'),
        );
        if (!empty($key) && array_key_exists($key, $list)) {
            return $list[$key];
        } else {
            return $list;
        }
    }

    /**
     * Get Job Types List
     *
     * @param string $key key
     *
     * @access public
     *
     * @return array
     */
    public static function getJobTypesList($key = "")
    {
        $list = array(
            'all' => trans('lang.jobtype.all'),
            'featured' => trans('lang.jobtype.featured'),
            'fixed' => trans('lang.jobtype.fixed'),
            'hourly' => trans('lang.jobtype.hourly'),
        );
        if (!empty($key) && array_key_exists($key, $list)) {
            return $list[$key];
        } else {
            return $list;
        }
    }

    /**
     * Get Hourly Rate
     *
     * @param string $key key
     *
     * @access public
     *
     * @return array
     */
    public static function getHourlyRate($key = "")
    {
        $list = array(
            '0-5' => trans('lang.freelancer_hourly_rate.0_5'),
            '5-10' => trans('lang.freelancer_hourly_rate.5_10'),
            '10-20' => trans('lang.freelancer_hourly_rate.10_20'),
            '20-30' => trans('lang.freelancer_hourly_rate.20_30'),
            '30-40' => trans('lang.freelancer_hourly_rate.30_40'),
            '40-50' => trans('lang.freelancer_hourly_rate.40_50'),
            '50-60' => trans('lang.freelancer_hourly_rate.50_60'),
            '60-70' => trans('lang.freelancer_hourly_rate.60_70'),
            '70-80' => trans('lang.freelancer_hourly_rate.70_80'),
            '90-0' => trans('lang.freelancer_hourly_rate.90_0'),
        );
        if (!empty($key) && array_key_exists($key, $list)) {
            return $list[$key];
        } else {
            return $list;
        }
    }

    /**
     * Job Completion Time
     *
     * @param string $key key
     *
     * @access public
     *
     * @return array
     */
    public static function getJobCompletionTimeList($key = "")
    {
        $list = array(
            'one_month' => trans('lang.job_completion.one_month'),
            'two_month' => trans('lang.job_completion.two_month'),
            'three_month' => trans('lang.job_completion.three_month'),
            'four_month' => trans('lang.job_completion.four_month'),
        );
        if (!empty($key) && array_key_exists($key, $list)) {
            return $list[$key];
        } else {
            return $list;
        }
    }

    /**
     * Get Freelancer Level
     *
     * @param string $key key
     *
     * @access public
     *
     * @return array
     */
    public static function getFreelancerLevelList($key = "")
    {
        $list = array(
            'independent'       => trans('lang.freelancer_level.independent'),
            'agency'            => trans('lang.freelancer_level.agency'),
            'rising_talent'     => trans('lang.freelancer_level.rising_talent'),
        );
        if (!empty($key) && array_key_exists($key, $list)) {
            return $list[$key];
        } else {
            return $list;
        }
    }

    /**
     * Get Report Reasons
     *
     * @access public
     *
     * @return array
     */
    public static function getReportReasons()
    {
        $list = array(
            '1' => array(
                'title' => trans('lang.report_reasons.fake'),
                'value' => 'fake',
            ),
            '2' => array(
                'title' => trans('lang.report_reasons.behaviour'),
                'value' => 'behavior',
            ),
            '3' => array(
                'title' => trans('lang.report_reasons.other'),
                'value' => 'Other',
            ),
        );
        return $list;
    }

    /**
     * Get Delete Acc Reasons
     *
     * @access public
     *
     * @return array
     */
    public static function getDeleteAccReason($key = "")
    {
        $list = array(
            'not_satisfied' => trans('lang.del_acc_reason.not_satisfied'),
            'not_good_support' => trans('lang.del_acc_reason.no_good_supp'),
            'Others' => trans('lang.del_acc_reason.others'),
        );
        if (!empty($key) && array_key_exists($key, $list)) {
            return $list[$key];
        } else {
            return $list;
        }
    }

    /**
     * Get Package Duration List
     *
     * @param string $key key
     *
     * @access public
     *
     * @return array
     */
    public static function getPackageDurationList($key = "")
    {
        $list = array(
            '10' => trans('lang.pckge_duration.10'),
            '30' => trans('lang.pckge_duration.30'),
            '360' => trans('lang.pckge_duration.360'),
        );
        if (!empty($key) && array_key_exists($key, $list)) {
            return $list[$key];
        } else {
            return $list;
        }
    }

    /**
     * Get Freelancer Badge
     *
     * @param string $key key
     *
     * @access public
     *
     * @return array
     */
    public static function getFreelancerBadgeList($key = "")
    {
        $list = array(
            'gold'   => trans('lang.badge.gold'),
            'silver' => trans('lang.badge.silver'),
            'brown'  => trans('lang.badge.brown'),
        );
        if (!empty($key) && array_key_exists($key, $list)) {
            return $list[$key];
        } else {
            return $list;
        }
    }

    /**
     * Get project type list
     *
     * @param string $key key
     *
     * @access public
     *
     * @return array
     */
    public static function getProjectTypeList($key = "")
    {
        $list = array(
            'fixed'   => trans('lang.fixed'),
            'hourly' => trans('lang.hourly'),
        );
        if (!empty($key) && array_key_exists($key, $list)) {
            return $list[$key];
        } else {
            return $list;
        }
    }

    /**
     * Upload multiple attachments.
     *
     * @param mixed $uploadedFile uploaded file
     * @param mixed $path         path of file
     *
     * @return relation
     */
    public static function uploadTempMultipleAttachments($uploadedFile, $path)
    {
        if (!file_exists($path)) {
            File::makeDirectory($path, 0755, true, true);
        }
        $filename = $uploadedFile->getClientOriginalName();
        Storage::disk('local')->putFileAs(
            $path,
            $uploadedFile,
            $filename
        );
        return 'success';
    }

    /**
     * Get username
     *
     * @param integer $user_id ID
     *
     * @access public
     *
     * @return array
     */
    public static function getUserName($user_id)
    {
        if (!empty($user_id)) {
            return User::find($user_id)->first_name . ' ' . User::find($user_id)->last_name;
        } else {
            return '';
        }
    }

    /**
     * Get role name by ID
     *
     * @param integer $role_id ID
     *
     * @access public
     *
     * @return array
     */
    public static function getRoleName($role_id)
    {
        return Role::find($role_id)->name;
    }

    /**
     * Get package options
     *
     * @param string $role Role
     *
     * @access public
     *
     * @return array
     */
    public static function getPackageOptions($role)
    {
        if (!empty($role)) {
            if ($role == 'employer') {
                $list = array(
                    '0' => trans('lang.emp_pkg_opt.price'),
                    '1' => trans('lang.emp_pkg_opt.no_of_jobs'),
                    '2' => trans('lang.emp_pkg_opt.no_of_featured_job'),
                    '3' => trans('lang.emp_pkg_opt.pkg_duration'),
                    '4' => trans('lang.emp_pkg_opt.banner'),
                    '5' => trans('lang.emp_pkg_opt.pvt_cht'),
                );
            } elseif ($role == 'freelancer') {
                $list = array(
                    '0' => trans('lang.freelancer_pkg_opt.price'),
                    '1' => trans('lang.freelancer_pkg_opt.no_of_credits'),
                    '2' => trans('lang.freelancer_pkg_opt.no_of_skills'),
                    '3' => trans('lang.freelancer_pkg_opt.no_of_services'),
                    '4' => trans('lang.freelancer_pkg_opt.no_of_featured_services'),
                    '5' => trans('lang.freelancer_pkg_opt.pkg_duration'),
                    '6' => trans('lang.freelancer_pkg_opt.badge'),
                    '7' => trans('lang.freelancer_pkg_opt.banner'),
                    '8' => trans('lang.freelancer_pkg_opt.pvt_cht'),
                );
            }
            return $list;
        }
    }

    /**
     * Get role by userID
     *
     * @param integer $user_id UserID
     *
     * @access public
     *
     * @return array
     */
    public static function getRoleByUserID($user_id)
    {
        $role = DB::table('model_has_roles')->select('role_id')->where('model_id', $user_id)
            ->first();
        return $role->role_id;
    }

    /**
     * Get role by roleID
     *
     * @param integer $role_id RoleID
     *
     * @access public
     *
     * @return array
     */
    public static function getRoleNameByRoleID($role_id)
    {
        $role = \Spatie\Permission\Models\Role::where('id', $role_id)
            ->first();
        if (!empty($role)) {
            return $role->name;
        } else {
            return '-';
        }
    }

    /**
     * Change the .env file Data.
     *
     * @param array $data array
     *
     * @return array
     */
    public static function changeEnv($data = array())
    {
        if (count($data) > 0) {

            // Read .env-file
            $env = file_get_contents(base_path() . '/.env');

            // Split string on every " " and write into array
            $env = preg_split('/\s+/', $env);;

            // Loop through given data
            foreach ((array) $data as $key => $value) {

                // Loop through .env-data
                foreach ($env as $env_key => $env_value) {

                    // Turn the value into an array and stop after the first split
                    // So it's not possible to split e.g. the App-Key by accident
                    $entry = explode("=", $env_value, 2);

                    // Check, if new key fits the actual .env-key
                    if ($entry[0] == $key) {
                        // If yes, overwrite it with the new one
                        $env[$env_key] = $key . "=" . $value;
                    } else {
                        // If not, keep the old one
                        $env[$env_key] = $env_value;
                    }
                }
            }

            // Turn the array back to an String
            $env = implode("\n", $env);

            // And overwrite the .env with the new data
            file_put_contents(base_path() . '/.env', $env);

            return true;
        } else {
            return false;
        }
    }

    /**
     * Get search filters
     *
     * @param string $key key
     *
     * @access public
     *
     * @return array
     */
    public static function getSearchFilterList($key = "")
    {
        $list = array(
            '0' => array(
                'title' => trans('lang.search_filter_list.freelancer'),
                'value' => 'freelancer',
            ),
            '1' => array(
                'title' => trans('lang.search_filter_list.jobs'),
                'value' => 'job',
            ),
            '2' => array(
                'title' => trans('lang.search_filter_list.employers'),
                'value' => 'employer',
            ),
            '3' => array(
                'title' => trans('lang.search_filter_list.services'),
                'value' => 'service',
            ),
        );
        if (Helper::getAccessType() == 'jobs') {
            return Arr::except($list, [3]);
        } else if (Helper::getAccessType() == 'services') {
            return Arr::except($list, [1]);
        }
        if (!empty($key) && array_key_exists($key, $list)) {
            return $list[$key];
        } else {
            return $list;
        }
    }

    /**
     * Get search filters
     *
     * @param string $type type
     *
     * @access public
     *
     * @return array
     */
    public static function getSearchableList($type)
    {
        $json = array();
        if ($type == 'freelancer') {
            $freelancs = User::role('freelancer')->select(
                DB::raw("CONCAT(users.first_name,' ',users.last_name) AS name"),
                "slug"
            )->where('is_disabled', 'false')->get()->toArray();
            $json = $freelancs;
        }
        if ($type == 'employer') {
            $employers = User::role('employer')->select(
                DB::raw("CONCAT(users.first_name,' ',users.last_name) AS name"),
                "slug"
            )->where('is_disabled', 'false')->get()->toArray();
            $json = $employers;
        }
        if ($type == 'job') {
            $jobs = DB::table("jobs")
                ->select(
                    "title AS name",
                    "slug"
                )->get()->toArray();
            $json = $jobs;
        }
        if ($type == 'service') {
            $services = DB::table("services")
                ->select(
                    "title AS name",
                    "slug"
                )->get()->toArray();
            $json = $services;
        }
        return $json;
    }

    /**
     * Get social media data
     *
     * @access public
     *
     * @return array
     */
    public static function getSocialData()
    {
        $social = array(
            'facebook' => array(
                'title' => trans('lang.social_icons.fb'),
                'color' => '#3b5999',
                'icon' => 'fa fa-facebook-f',
            ),
            'twitter' => array(
                'title' => trans('lang.social_icons.twitter'),
                'color' => '#55acee',
                'icon' => 'fab fa-twitter',
            ),
            'youtube' => array(
                'title' => trans('lang.social_icons.youtube'),
                'color' => '#0077B5',
                'icon' => 'fab fa-youtube',
            ),
            'instagram' => array(
                'title' => trans('lang.social_icons.insta'),
                'color' => '#dd4b39',
                'icon' => 'fab fa-instagram',
            ),
            'googleplus' => array(
                'title' => trans('lang.social_icons.gplus'),
                'color' => '#dd4b39',
                'icon' => 'fab fa-google-plus-g',
            )
        );
        return $social;
    }

    /**
     * Language list
     *
     * @param string $lang lang
     *
     * @access public
     *
     * @return array
     */
    public static function getTranslatedLang($lang = "")
    {
        $languages = array(
            'en' => array(
                'code' => 'en',
                'title' => 'English',
            ),
            'de' => array(
                'code' => 'de',
                'title' => 'German',
            ),
            'tr' => array(
                'code' => 'tr',
                'title' => 'Turkish',
            ),
            'es' => array(
                'code' => 'es',
                'title' => 'Spanish',
            ),
            'pt' => array(
                'code' => 'pt',
                'title' => 'Portuguese',
            ),
            'zh' => array(
                'code' => 'zh',
                'title' => 'Chinese',
            ),
            'bn' => array(
                'code' => 'bn',
                'title' => 'Bengali',
            ),
            'fr' => array(
                'code' => 'fr',
                'title' => 'French',
            ),
            'ru' => array(
                'code' => 'ru',
                'title' => 'Russian',
            ),
            'UK' => array(
                'code' => 'UK',
                'title' => 'Ukrainian',
            ),
            'ja' => array(
                'code' => 'ja',
                'title' => 'Japanese',
            ),
            'ur' => array(
                'code' => 'ur',
                'title' => 'Urdu',
            ),
        );

        if (!empty($lang) && array_key_exists($lang, $languages)) {
            return $languages[$lang];
        } else {
            return $languages;
        }
    }

    /**
     * Display socials
     *
     * @access public
     *
     * @return array
     */
    public static function displaySocials()
    {
        $output = "";
        $social_unserialize_array = SiteManagement::getMetaValue('socials');
        $social_list = Helper::getSocialData();
        if (!empty($social_unserialize_array)) {
            $output .= "<ul class='wt-socialiconssimple wt-socialiconfooter'>";
            foreach ($social_unserialize_array as $key => $value) {
                if (array_key_exists($value['title'], $social_list)) {
                    $socialList = $social_list[$value['title']];
                    $output .= "<li class='wt-{$value['title']}'><a href = '{$value["url"]}'><i class='fa {$socialList["icon"]}' ></i></a></li>";
                }
            }
            $output .= "</ul>";
        }
        echo $output;
    }

    /**
     * Get user profile image
     *
     * @param integer $user_id user_id
     *
     * @access public
     *
     * @return array
     */
    public static function getProfileImage($user_id)
    {
        $profile_image = User::find($user_id)->profile->avater;
        if (file_exists('/uploads/users/' . $user_id . '/' . $profile_image)) {
            return !empty($profile_image) ? '/uploads/users/' . $user_id . '/' . $profile_image : '/images/user.jpg';
        } else {
            return '/images/user.jpg';
        }
    }

    /**
     * Get image
     *
     * @param string $path    image path
     * @param string $image   image
     * @param string $size    size
     * @param string $default default image
     *
     * @access public
     *
     * @return string
     */
    public static function getImage($path, $image, $size = '', $default = '')
    {
        if (!empty($path) && !empty($image)) {
            $file = $path . '/' . $size . $image;
            if (file_exists($file)) {
                if (!empty($size)) {
                    return $path . '/' . $size . $image;
                } else {
                    return $path . '/' . $image;
                }
            } else {
                return 'images/' . $default;
            }
        } else {
            return 'images/' . $default;
        }
    }

    /**
     * Get user profile image
     *
     * @param integer $user_id user_id
     * @param integer $size    size
     *
     * @access public
     *
     * @return array
     */
    public static function getUserProfileBanner($user_id, $size = '')
    {
        $user = User::getUserRoleType($user_id);
        $profile_banner = User::find($user_id)->profile->banner;
        if (!empty($profile_banner)) {
            if (!empty($size)) {
                return '/uploads/users/' . $user_id . '/' . $size . '-' . $profile_banner;
            } else {
                return '/uploads/users/' . $user_id . '/' . $profile_banner;
            }
        } elseif ($user->role_type == 'freelancer') {
            if (!empty($size)) {
                if (file_exists('images/' . $size . '-frbanner-1920x400.jpg')) {
                    return 'images/' . $size . '-frbanner-1920x400.jpg';
                } else {
                    return 'images/frbanner-1920x400.jpg';
                }
            } else {
                return 'images/frbanner-1920x400.jpg';
            }
        } elseif ($user->role_type == 'employer') {
            if (!empty($size)) {
                if (file_exists('images/' . $size . '-e-1110x300.jpg')) {
                    return 'images/' . $size . '-e-1110x300.jpg';
                } else {
                    return 'images/e-1110x300.jpg';
                }
            } else {
                return 'images/e-1110x300.jpg';
            }
        }
    }


    /**
     * Get user profile image
     *
     * @param integer $user_id user_id
     *
     * @access public
     *
     * @return array
     */
    public static function getProfileBanner($user_id)
    {
        $banner = User::find($user_id)->profile->banner;
        return !empty($banner) ? '/uploads/users/' . $user_id . '/' . $banner : 'images/embanner-350x172.jpg';
    }

    /**
     * Upload Attachments.
     *
     * @param mixed $path         path     path
     * @param mixed $uploadedFile uploaded uploadedFile
     *
     * @return relation
     */
    public static function uploadSingleTempImage($path, $uploadedFile)
    {
        if (!empty($uploadedFile)) {
            $file_original_name = $uploadedFile->getClientOriginalName();
            $parts = explode('.', $file_original_name);
            $extension = end($parts);
            $extension = $uploadedFile->getClientOriginalExtension();
            if ($extension === "jpg" || $extension === "png") {
                // create directory if not exist.
                if (!file_exists($path)) {
                    File::makeDirectory($path, 0744, true, true);
                }
                // generate small image size
                $image = Image::make($uploadedFile);
                $image->save($path . $file_original_name);

                $json['message'] = trans('lang.img_uploaded');
                $json['type'] = 'success';
                return $json;
            } elseif ($extension === 'gif' || $extension === 'ico') {
                Storage::disk('local_public')->putFileAs(
                    // live path
                    //getcwd().'/uploads/settings/temp/',
                    'settings/temp/',
                    $uploadedFile,
                    $file_original_name
                );
            } else {
                $json['message'] = trans('lang.img_jpg_png');
                $json['type'] = 'error';
                return $json;
            }
        } else {
            $json['message'] = trans('lang.image not found');
            $json['type'] = 'error';
            return $json;
        }
    }

    /**
     * Get project image
     *
     * @param string  $image   Image
     * @param integer $user_id UserID
     *
     * @access public
     *
     * @return array
     */
    public static function getProjectImage($image, $user_id)
    {
        return !empty($image) ? '/uploads/users/' . $user_id . '/' . $image : 'images/projects/img-01.jpg';
    }

    /**
     * List category in tree format
     *
     * @param integer $parent_id  Image
     * @param string  $cat_indent UserID
     *
     * @access public
     *
     * @return array
     */
    public static function listTreeCategories($parent_id = 0, $cat_indent = '')
    {
        $parent_cat = Location::select('title', 'id', 'parent')->where('parent', $parent_id)->get()->toArray();
        foreach ($parent_cat as $key => $value) {
            echo '<option value="' . $value['id'] . '">' . $cat_indent . $value['title'] . '</option>';
            self::listTreeCategories($value['id'], $cat_indent . '—');
        }
    }

    /**
     * Get total jobs
     *
     * @param string $status Status
     *
     * @access public
     *
     * @return array
     */
    public static function getTotalJobs($status = '')
    {
        if (Auth::user()) {
            if (!empty($status)) {
                return Auth::user()->jobs->where('status', $status)->count();
            } else {
                return Auth::user()->jobs->count();
            }
        }
    }

    /**
     * Get proposal Balance
     *
     * @param int $user_id User ID
     * @param int $status  Status
     *
     * @return \Illuminate\Http\Response
     */
    public static function getProposalsBalance($user_id, $status)
    {
        $service_balance = 0;
        $commision = SiteManagement::getMetaValue('commision');
        $admin_commission = !empty($commision) && !empty($commision[0]['commision']) ? $commision[0]['commision'] : 0;
        $job_balance =  Proposal::select('amount')
            ->where('freelancer_id', $user_id)
            ->where('status', $status)->sum('amount');
        $job_total_amount = !empty($job_balance) ? $job_balance - ($job_balance / 100) * $admin_commission : 0;
        if (Schema::hasTable('services') && Schema::hasTable('service_user')) {
            $services = DB::table('service_user')->select('service_id')->where('type', 'employer')
                ->where('seller_id', $user_id)->where('status', $status)->get()->pluck('service_id')->toArray();
            if (!empty($services)) {
                foreach ($services as $id) {
                    $service_balance += Service::select('price')->where('id', $id)->pluck('price')->first();
                }
            }
        }
        $service_total_amount = !empty($service_balance) ? $service_balance - ($service_balance / 100) * $admin_commission : 0;
        return $job_total_amount + $service_total_amount;
    }

    /**
     * Get proposal
     *
     * @param int $user_id User ID
     * @param int $status  Status
     *
     * @return \Illuminate\Http\Response
     */
    public static function getProposals($user_id, $status)
    {
        return Proposal::select('job_id')->latest()->where('freelancer_id', $user_id)->where('status', $status)->get();
    }

    /**
     * Get public path
     *
     * @return \Illuminate\Http\Response
     */
    public static function publicPath()
    {
        $path = public_path();
        if (isset($_SERVER["SERVER_NAME"]) && $_SERVER["SERVER_NAME"] != '127.0.0.1') {
            $path = getcwd();
        }
        return $path;
    }

    /**
     * Get size
     *
     * @param integer $bytes bytes
     *
     * @return \Illuminate\Http\Response
     */
    public static function bytesToHuman($bytes)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB', 'PB'];

        for ($i = 0; $bytes > 1024; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, 2) . ' ' . $units[$i];
    }

    /**
     * Format file name
     *
     * @param string $file_name filename
     *
     * @return \Illuminate\Http\Response
     */
    public static function formateFileName($file_name)
    {
        $file =  strstr($file_name, '-');
        return substr($file, 1);
    }

    /**
     * Currency list
     *
     * @param string $code code
     *
     * @access public
     *
     * @return array
     */
    public static function currencyList($code = "")
    {
        $currency_array = array(
            'TND' => array(
                'numeric_code'  => 788,
                'code'          => 'TND',
                'name'          => 'Dinar Tunisien',
                'symbol'        => 'TND',
                'fraction_name' => 'Cent[D]',
                'decimals'      => 3
            ),
            'USD' => array(
                'numeric_code'  => 840,
                'code'          => 'USD',
                'name'          => 'United States dollar',
                'symbol'        => '$',
                'fraction_name' => 'Cent[D]',
                'decimals'      => 2
            ),
            'AUD' => array(
                'numeric_code'  => 36,
                'code'          => 'AUD',
                'name'          => 'Australian dollar',
                'symbol'        => '$',
                'fraction_name' => 'Cent',
                'decimals'      => 2
            ),
            'BRL' => array(
                'numeric_code'  => 986,
                'code'          => 'BRL',
                'name'          => 'Brazilian real',
                'symbol'        => 'R$',
                'fraction_name' => 'Centavo',
                'decimals'      => 2
            ),
            'CAD' => array(
                'numeric_code'  => 124,
                'code'          => 'CAD',
                'name'          => 'Canadian dollar',
                'symbol'        => '$',
                'fraction_name' => 'Cent',
                'decimals'      => 2
            ),
            'CZK' => array(
                'numeric_code'  => 203,
                'code'          => 'CZK',
                'name'          => 'Czech koruna',
                'symbol'        => 'Kc',
                'fraction_name' => 'Haléř',
                'decimals'      => 2
            ),
            'DKK' => array(
                'numeric_code'  => 208,
                'code'          => 'DKK',
                'name'          => 'Danish krone',
                'symbol'        => 'kr',
                'fraction_name' => 'Øre',
                'decimals'      => 2
            ),
            'EUR' => array(
                'numeric_code'  => 978,
                'code'          => 'EUR',
                'name'          => 'Euro',
                'symbol'        => '€',
                'fraction_name' => 'Cent',
                'decimals'      => 2
            ),
            'HKD' => array(
                'numeric_code'  => 344,
                'code'          => 'HKD',
                'name'          => 'Hong Kong dollar',
                'symbol'        => '$',
                'fraction_name' => 'Cent',
                'decimals'      => 2
            ),
            'HUF' => array(
                'numeric_code'  => 348,
                'code'          => 'HUF',
                'name'          => 'Hungarian forint',
                'symbol'        => 'Ft',
                'fraction_name' => 'Fillér',
                'decimals'      => 2
            ),
            'ILS' => array(
                'numeric_code'  => 376,
                'code'          => 'ILS',
                'name'          => 'Israeli new sheqel',
                'symbol'        => '₪',
                'fraction_name' => 'Agora',
                'decimals'      => 2
            ),
            'INR' => array(
                'numeric_code'  => 356,
                'code'          => 'INR',
                'name'          => 'Indian rupee',
                'symbol'        => 'INR',
                'fraction_name' => 'Paisa',
                'decimals'      => 2
            ),
            'JPY' => array(
                'numeric_code'  => 392,
                'code'          => 'JPY',
                'name'          => 'Japanese yen',
                'symbol'        => '¥',
                'fraction_name' => 'Sen[G]',
                'decimals'      => 2
            ),
            'MYR' => array(
                'numeric_code'  => 458,
                'code'          => 'MYR',
                'name'          => 'Malaysian ringgit',
                'symbol'        => 'RM',
                'fraction_name' => 'Sen',
                'decimals'      => 2
            ),
            'MXN' => array(
                'numeric_code'  => 484,
                'code'          => 'MXN',
                'name'          => 'Mexican peso',
                'symbol'        => '$',
                'fraction_name' => 'Centavo',
                'decimals'      => 2
            ),
            'NOK' => array(
                'numeric_code'  => 578,
                'code'          => 'NOK',
                'name'          => 'Norwegian krone',
                'symbol'        => 'kr',
                'fraction_name' => 'Øre',
                'decimals'      => 2
            ),
            'NZD' => array(
                'numeric_code'  => 554,
                'code'          => 'NZD',
                'name'          => 'New Zealand dollar',
                'symbol'        => '$',
                'fraction_name' => 'Cent',
                'decimals'      => 2
            ),
            'PHP' => array(
                'numeric_code'  => 608,
                'code'          => 'PHP',
                'name'          => 'Philippine peso',
                'symbol'        => 'PHP',
                'fraction_name' => 'Centavo',
                'decimals'      => 2
            ),
            'PLN' => array(
                'numeric_code'  => 985,
                'code'          => 'PLN',
                'name'          => 'Polish złoty',
                'symbol'        => 'zł',
                'fraction_name' => 'Grosz',
                'decimals'      => 2
            ),
            'GBP' => array(
                'numeric_code'  => 826,
                'code'          => 'GBP',
                'name'          => 'British pound[C]',
                'symbol'        => '£',
                'fraction_name' => 'Penny',
                'decimals'      => 2
            ),
            'SGD' => array(
                'numeric_code'  => 702,
                'code'          => 'SGD',
                'name'          => 'Singapore dollar',
                'symbol'        => '$',
                'fraction_name' => 'Cent',
                'decimals'      => 2
            ),
            'SEK' => array(
                'numeric_code'  => 752,
                'code'          => 'SEK',
                'name'          => 'Swedish krona',
                'symbol'        => 'kr',
                'fraction_name' => 'Öre',
                'decimals'      => 2
            ),
            'CHF' => array(
                'numeric_code'  => 756,
                'code'          => 'CHF',
                'name'          => 'Swiss franc',
                'symbol'        => 'Fr',
                'fraction_name' => 'Rappen[I]',
                'decimals'      => 2
            ),
            'TWD' => array(
                'numeric_code'  => 901,
                'code'          => 'TWD',
                'name'          => 'New Taiwan dollar',
                'symbol'        => '$',
                'fraction_name' => 'Cent',
                'decimals'      => 2
            ),
            'THB' => array(
                'numeric_code'  => 764,
                'code'          => 'THB',
                'name'          => 'Thai baht',
                'symbol'        => '฿',
                'fraction_name' => 'Satang',
                'decimals'      => 2
            ),
            'RUB' => array(
                'numeric_code'  => 643,
                'code'          => 'RUB',
                'name'          => 'Russian ruble',
                'symbol'        => 'руб.',
                'fraction_name' => 'Kopek',
                'decimals'      => 2
            ),
        );

        if (!empty($code) && array_key_exists($code, $currency_array)) {
            return $currency_array[$code];
        } else {
            return $currency_array;
        }
    }

    /**
     * Display email warning
     *
     * @access public
     *
     * @return array
     */
    public static function displayEmailWarning()
    {
        $output = "";
        if (
            empty(env('MAIL_USERNAME'))
            && empty(env('MAIL_PASSWORD'))
            && auth()->user()->getRoleNames()->first() === 'admin'
        ) {
            $output .= '<div class="wt-jobalertsholder la-email-warning float-right">';
            $output .= '<ul id="wt-jobalerts">';
            $output .= '<li class="alert alert-danger alert-dismissible fade show">';
            $output .= '<span>';
            $output .= trans('lang.ph_email_warning');
            $output .= '</span>';
            $output .= '<a href="javascript:void(0)" class="close" data-dismiss="alert" aria-label="Close"><i class="fa fa-close"></i></a>';
            $output .= '</li>';
            $output .= '</ul>';
            $output .= '</div>';
        }
        echo $output;
    }

    /**
     * Get badge
     *
     * @param integer $user_id UserID
     *
     * @access public
     *
     * @return array
     */
    public static function getUserBadge($user_id)
    {
        if (!empty($user_id)) {
            $user = User::find($user_id);
            if (!empty($user->badge_id)) {
                return Badge::where('id', $user->badge_id)->first();
            } else {
                return '';
            }
        }
    }

    /**
     * Get payment method list
     *
     * @param string $key key
     *
     * @access public
     *
     * @return array
     */
    public static function getPaymentMethodList($key = "")
    {
        $list = array(
            'paypal' => array(
                'title' => trans('lang.payment_methods.paypal'),
                'value' => 'paypal',
            ),
            'stripe' => array(
                'title' => trans('lang.payment_methods.stripe'),
                'value' => 'stripe',
            ),
        );
        if (!empty($key) && array_key_exists($key, $list)) {
            return $list[$key];
        } else {
            return $list;
        }
    }

    /**
     * Get employer jobs
     *
     * @param string $user_id key
     *
     * @access public
     *
     * @return array
     */
    public static function getEmployerJobs($user_id)
    {
        if (!empty($user_id)) {
            $user = User::find($user_id);
            if ($user->getRoleNames()->first() === 'employer') {
                return Job::select('title', 'id')->where('user_id', $user_id)->get()->pluck('title', 'id');
            } else {
                return array();
            }
        } else {
            return trans('lang.no_jobs_found');
        }
    }

    /**
     * Get google map api key
     *
     * @access public
     *
     * @return array
     */
    public static function getGoogleMapApiKey()
    {
        $settings =  SiteManagement::getMetaValue('settings');
        if (!empty($settings) && !empty($settings[0]['gmap_api_key'])) {
            return $settings[0]['gmap_api_key'];
        } else {
            return '';
        }
    }

    /**
     * Get freelancer earning
     *
     * @param int $user_id User ID
     * @param int $status  Status
     *
     * @return \Illuminate\Http\Response
     */
    public static function getFreelancerJobTotalEarning($user_id, $status)
    {
        $commision = SiteManagement::getMetaValue('commision');
        $admin_commission = !empty($commision) && !empty($commision[0]['commision']) ? $commision[0]['commision'] : 0;
        $job_balance =  Proposal::select('amount')
            ->where('freelancer_id', $user_id)
            ->where('status', $status)->sum('amount');
        return !empty($job_balance) ? $job_balance - ($job_balance / 100) * $admin_commission : 0;
    }

    /**
     * Update payouts
     *
     * @access public
     *
     * @return array
     */
    public static function updatePayouts()
    {
        $payout_settings = SiteManagement::getMetaValue('commision');
        $min_payount = !empty($payout_settings) && !empty($payout_settings[0]['min_payout']) ? $payout_settings[0]['min_payout'] : '';
        $payment_settings = SiteManagement::getMetaValue('commision');
        $currency  = !empty($payment_settings) && !empty($payment_settings[0]['currency']) ? $payment_settings[0]['currency'] : 'USD';
        // update jobs payouts
        $job_payouts = DB::select(
            DB::raw(
                "SELECT id, freelancer_id, 
                SUM(amount) AS total,
                GROUP_CONCAT(id) AS ids
                FROM proposals
                WHERE paid = 'pending' 
                GROUP BY freelancer_id"
            )
        );
        if (!empty($job_payouts)) {
            foreach ($job_payouts as $q) {
                if ($q->total >= $min_payount) {
                    $user = User::find($q->freelancer_id);
                    if ($user->profile->count() > 0) {
                        $payout_id = !empty($user->profile->payout_id) ? $user->profile->payout_id : '';
                        $payout_detail = !empty($user->profile->payout_settings) ? $user->profile->payout_settings : array();
                        if (!empty($payout_id) || !empty($payout_detail)) {
                            $total_earning = Self::getFreelancerJobTotalEarning($q->freelancer_id, 'completed');
                            $payout = new Payout();
                            $payout->user()->associate($q->freelancer_id);
                            $payout->amount = $total_earning;
                            $payout->currency = $currency;
                            if (!empty($payout_detail)) {
                                $payment_details  = Helper::getUnserializeData($user->profile->payout_settings);
                                if ($payment_details['type'] == 'paypal') {
                                    if (Schema::hasColumn('payouts', 'email')) {
                                        $payout->email = $payment_details['paypal_email'];
                                    } elseif (Schema::hasColumn('payouts', 'paypal_id')) {
                                        $payout->paypal_id = $payment_details['paypal_email'];
                                    }
                                } else if ($payment_details['type'] == 'bacs') {
                                    $payout->bank_details = $user->profile->payout_settings;
                                    $payout->paypal_id = 'null';
                                } else {
                                    $payout->paypal_id = '';
                                }
                                $payout->payment_method = $payment_details['type'];
                            } else if (!empty($payout_id)) {
                                $payout->payment_method = 'paypal';
                                if (Schema::hasColumn('payouts', 'email')) {
                                    $payout->email = $payout_id;
                                } elseif (Schema::hasColumn('payouts', 'paypal_id')) {
                                    $payout->paypal_id = $payout_id;
                                }
                            }
                            $payout->status = 'pending';
                            $payout->order_id = null;
                            $payout->type = 'job';
                            $payout->save();
                            $primary_records = explode(',', $q->ids);
                            foreach ($primary_records as $primary) {
                                DB::table('proposals')
                                    ->where('id', $primary)
                                    ->update(['paid' => 'completed']);
                            }
                        }
                    }
                }
            }
        }
        // update services payouts
        $purchased_services = DB::select(
            DB::raw(
                "SELECT SUM(services.price) AS total, service_user.seller_id AS seller, GROUP_CONCAT(service_user.id) AS ids
                FROM service_user 
                INNER JOIN services
                WHERE service_user.service_id = services.id
                AND service_user.type = 'employer'
                AND service_user.status = 'completed'
                AND service_user.paid = 'pending' 
                GROUP BY service_user.seller_id"
            )
        );
        if (!empty($purchased_services)) {
            foreach ($purchased_services as $q) {
                if ($q->total >= $min_payount) {
                    $user = User::find($q->seller);
                    if ($user->profile->count() > 0) {
                        $payout_id = !empty($user->profile->payout_id) ? $user->profile->payout_id : '';
                        $payout_detail = !empty($user->profile->payout_settings) ? $user->profile->payout_settings : array();
                        if (!empty($payout_id) || !empty($payout_detail)) {
                            $payout = new Payout();
                            $payout->user()->associate($q->seller);
                            $payout->amount = $q->total;
                            $payout->currency = $currency;
                            if (!empty($payout_detail)) {
                                $payment_details  = Helper::getUnserializeData($user->profile->payout_settings);
                                if ($payment_details['type'] == 'paypal') {
                                    if (Schema::hasColumn('payouts', 'email')) {
                                        $payout->email = $payment_details['paypal_email'];
                                    } elseif (Schema::hasColumn('payouts', 'paypal_id')) {
                                        $payout->paypal_id = $payment_details['paypal_email'];
                                    }
                                } else if ($payment_details['type'] == 'bacs') {
                                    $payout->bank_details = $user->profile->payout_settings;
                                    $payout->paypal_id = 'null';
                                } else {
                                    $payout->paypal_id = '';
                                }
                                $payout->payment_method = $payment_details['type'];
                            } else if (!empty($payout_id)) {
                                $payout->payment_method = 'paypal';
                                if (Schema::hasColumn('payouts', 'email')) {
                                    $payout->email = $payout_id;
                                } elseif (Schema::hasColumn('payouts', 'paypal_id')) {
                                    $payout->paypal_id = $payout_id;
                                }
                            }
                            $payout->status = 'pending';
                            $payout->order_id = null;
                            $payout->type = 'service';
                            $payout->save();
                            $primary_records = explode(',', $q->ids);
                            foreach ($primary_records as $primary) {
                                DB::table('service_user')
                                    ->where('id', $primary)
                                    ->update(['paid' => 'completed']);

                            }
                        }
                    }
                }
            }
        }
    }

    /**
     * Get images
     *
     * @access public
     *
     * @return string
     */
    public static function getImages($path, $image, $default)
    {
        if (file_exists($path . '/' . $image)) {
            echo '<img src="' . url($path . '/' . $image) . '" alt="' . trans('lang.img') . '">';
        } else {
            echo '<span class="lnr lnr-' . $default . '"></span>';
        }
    }

    /**
     * Get package expiry image
     *
     * @param string $path  path
     * @param string $image image
     *
     * @access public
     *
     * @return string
     */
    public static function getDashExpiryImages($path, $image)
    {
        if (file_exists($path . '/' . $image)) {
            return url($path . '/' . $image);
        } else {
            return '';
        }
    }

    /**
     * Get package expiry image
     *
     * @param int $badge_id badge_id
     *
     * @access public
     *
     * @return string
     */
    public static function getBadgeTitle($badge_id)
    {
        $badge = Badge::find($badge_id);
        if (!empty($badge)) {
            return $badge->title;
        }
    }

    /**
     * Demo site refresh page
     *
     * @param string $message message text
     *
     * @access public
     *
     * @return string
     */
    public static function worketicIsDemoSite($message = '')
    {
        $json = array();
        $message = !empty($message) ? $message : trans('lang.restricted_text');
        if (isset($_SERVER["SERVER_NAME"]) && $_SERVER["SERVER_NAME"] === 'amentotech.com') {
            return $message;
        }
    }

    /**
     * Demo site ajax request
     *
     * @param string $message message text
     *
     * @access public
     *
     * @return string
     */
    public static function worketicIsDemoSiteAjax($message = '')
    {
        $message = !empty($message) ? $message : trans('lang.restricted_text');
        if (isset($_SERVER["SERVER_NAME"]) && $_SERVER["SERVER_NAME"] === 'amentotech.com') {
            return response()->json(['message' => $message]);
        }
    }

    /**
     * Display socials
     *
     * @access public
     *
     * @return array
     */
    public static function getBodyLangClass()
    {
        $settings = SiteManagement::getMetaValue('settings');
        if (!empty($settings) && !empty($settings[0]['body-lang-class'])) {
            return $settings[0]['body-lang-class'];
        } else {
            return '';
        }
    }

    /**
     * Get text direction
     *
     * @access public
     *
     * @return string
     */
    public static function getTextDirection()
    {
        $language = \App::getLocale();
        $lang_array = ['ur'];
        $textdir = 'ltr';
        if (in_array($language, $lang_array)) {
            $textdir = 'rtl';
        }
        return $textdir;
    }

    /**
     * Get home banner
     *
     * @param string $type type
     * @param string $size size
     *
     * @access public
     *
     * @return string
     */
    public static function getHomeBanner($type, $size = '')
    {
        $home_page_settings = !empty(SiteManagement::getMetaValue('home_settings')) ? SiteManagement::getMetaValue('home_settings') : array();
        $banner_settings = !empty($home_page_settings) ? $home_page_settings[0] : array();
        $banner  = !empty($banner_settings) && !empty($banner_settings['home_banner']) ? $banner_settings['home_banner'] : '';
        $banner_inner_image  = !empty($banner_settings) && !empty($banner_settings['home_banner_image']) ? $banner_settings['home_banner_image'] : '';
        $banner_title  = !empty($banner_settings) && !empty($banner_settings['banner_title']) ? $banner_settings['banner_title'] : 'Hire expert freelancers';
        $banner_subtitle  = !empty($banner_settings) && !empty($banner_settings['banner_subtitle']) ? $banner_settings['banner_subtitle'] : 'for any job, Online';
        $banner_description  = !empty($banner_settings) && !empty($banner_settings['banner_description']) ? $banner_settings['banner_description'] : 'Consectetur adipisicing elit sed dotem eiusmod tempor incuntes ut labore etdolore maigna aliqua enim';
        $banner_video_link  = !empty($banner_settings) && !empty($banner_settings['video_link']) ? $banner_settings['video_link'] : 'https://www.youtube.com/watch?v=B-ph2g5o2K4';
        $banner_video_title  = !empty($banner_settings) && !empty($banner_settings['video_title']) ? $banner_settings['video_title'] : 'See For Yourself!';
        $banner_video_desc  = !empty($banner_settings) && !empty($banner_settings['video_desc']) ? $banner_settings['video_desc'] : 'How it works & experience the ultimate joy.';
        if ($type == 'image') {
            if (!empty($banner)) {
                return '/uploads/settings/home/' . $banner;
            } else {
                return 'images/banner-bg.jpg';
            }
        }
        if ($type == 'inner_image') {
            if (!empty($banner_inner_image)) {
                if (!empty($size)) {
                    return '/uploads/settings/home/' . $size . '-' . $banner_inner_image;
                } else {
                    return '/uploads/settings/home/' . $banner_inner_image;
                }
            } else {
                return 'images/banner-img.png';
            }
        }
        if ($type == 'title') {
            return $banner_title;
        }
        if ($type == 'subtitle') {
            return $banner_subtitle;
        }
        if ($type == 'description') {
            return $banner_description;
        }
        if ($type == 'video_url') {
            return $banner_video_link;
        }
        if ($type == 'video_title') {
            return $banner_video_title;
        }
        if ($type == 'video_description') {
            return $banner_video_desc;
        }
    }



    /**
     * Get home banner
     *
     * @param string $type type
     *
     * @access public
     *
     * @return string
     */
    public static function getHomeSection($type)
    {
        $section_settings = !empty(SiteManagement::getMetaValue('section_settings')) ? SiteManagement::getMetaValue('section_settings') : array();
        $show_cat_section = !empty($section_settings) && !empty($section_settings[0]['cat_section_display']) ? $section_settings[0]['cat_section_display'] : true;
        $cat_sec_title = !empty($section_settings[0]['cat_sec_title']) ? $section_settings[0]['cat_sec_title'] : trans('lang.explore_cats');
        $cat_sec_subtitle = !empty($section_settings[0]['cat_sec_subtitle']) ? $section_settings[0]['cat_sec_subtitle'] : trans('lang.professional_by_cats');
        $show_section = !empty($section_settings) && !empty($section_settings[0]['home_section_display']) ? $section_settings[0]['home_section_display'] : true;
        $show_app_section = !empty($section_settings) && !empty($section_settings[0]['app_section_display']) ? $section_settings[0]['app_section_display'] : true;
        $section_bg = !empty($section_settings) && !empty($section_settings[0]['section_bg']) ? $section_settings[0]['section_bg'] : null;
        $company_title = !empty($section_settings) && !empty($section_settings[0]['company_title']) ? $section_settings[0]['company_title'] : null;
        $company_desc = !empty($section_settings) && !empty($section_settings[0]['company_desc']) ? $section_settings[0]['company_desc'] : null;
        $company_url = !empty($section_settings) && !empty($section_settings[0]['company_url']) ? $section_settings[0]['company_url'] : '#';
        $freelancer_title = !empty($section_settings) && !empty($section_settings[0]['freelancer_title']) ? $section_settings[0]['freelancer_title'] : null;
        $freelancer_desc = !empty($section_settings) && !empty($section_settings[0]['freelancer_desc']) ? $section_settings[0]['freelancer_desc'] : null;
        $freelancer_url = !empty($section_settings) && !empty($section_settings[0]['freelancer_url']) ? $section_settings[0]['freelancer_url'] : '#';
        if ($type == 'show_cat_section') {
            return $show_cat_section;
        }
        if ($type == 'cat_sec_title') {
            return $cat_sec_title;
        }
        if ($type == 'cat_sec_subtitle') {
            return $cat_sec_subtitle;
        }
        if ($type == 'show_section') {
            return $show_section;
        }
        if ($type == 'show_app_section') {
            return $show_app_section;
        }
        if ($type == 'background_image') {
            if (!empty($section_bg)) {
                return '/uploads/settings/home/' . $section_bg;
            } else {
                return 'images/banner-bg.jpg';
            }
        }
        if ($type == 'left_title') {
            return $company_title;
        }
        if ($type == 'left_description') {
            return $company_desc;
        }
        if ($type == 'left_url') {
            return $company_url;
        }
        if ($type == 'right_title') {
            return $freelancer_title;
        }
        if ($type == 'right_description') {
            return $freelancer_desc;
        }
        if ($type == 'right_url') {
            return $freelancer_url;
        }
    }

    /**
     * Get App section
     *
     * @param string $type type
     *
     * @access public
     *
     * @return string
     */
    public static function getAppSection($type)
    {
        $section_settings = !empty(SiteManagement::getMetaValue('section_settings')) ? SiteManagement::getMetaValue('section_settings') : array();
        $download_app_img = !empty($section_settings) && !empty($section_settings[0]['download_app_img']) ? $section_settings[0]['download_app_img'] : '';
        $app_title = !empty($section_settings) && !empty($section_settings[0]['app_title']) ? $section_settings[0]['app_title'] : '';
        $app_subtitle = !empty($section_settings) && !empty($section_settings[0]['app_subtitle']) ? $section_settings[0]['app_subtitle'] : '';
        $application_desc = SiteManagement::where('meta_key', 'app_desc')->select('meta_value')->pluck('meta_value')->first();
        $app_desc = !empty($application_desc) ? $application_desc : '';
        $application_android_link = SiteManagement::where('meta_key', 'app_android_link')->select('meta_value')->pluck('meta_value')->first();
        $app_android_link = !empty($application_android_link) ? $application_android_link : '#';
        $application_ios_link = SiteManagement::where('meta_key', 'app_ios_link')->select('meta_value')->pluck('meta_value')->first();
        $app_ios_link = !empty($application_ios_link) ? $application_ios_link : '#';
        if ($type == 'image') {
            if (!empty($download_app_img)) {
                return '/uploads/settings/home/' . $download_app_img;
            } else {
                return 'images/mobile-img.png';
            }
        }
        if ($type == 'title') {
            return $app_title;
        }
        if ($type == 'subtitle') {
            return $app_subtitle;
        }
        if ($type == 'description') {
            return $app_desc;
        }
        if ($type == 'android_url') {
            return $app_android_link;
        }
        if ($type == 'ios_url') {
            return $app_ios_link;
        }
    }

    /**
     * Get dashboard icon list
     *
     * @param string $icon icon
     *
     * @access public
     *
     * @return array
     */
    public static function getIconList($icon = "")
    {
        $icons = array(
            'latest_proposal' => array(
                'value' => 'latest_proposal',
                'title' => trans('lang.latest_proposals'),
            ),
            'package_expiry' => array(
                'value' => 'package_expiry',
                'title' => trans('lang.pkg_expiry'),
            ),
            'new_message' => array(
                'value' => 'new_message',
                'title' => trans('lang.new_msgs'),
            ),
            'saved_item' => array(
                'value' => 'saved_item',
                'title' => trans('lang.save_items'),
            ),
            'cancel_project' => array(
                'value' => 'cancel_project',
                'title' => trans('lang.cancelled_projects'),
            ),
            'ongoing_project' => array(
                'value' => 'ongoing_project',
                'title' => trans('lang.ongoing_projects'),
            ),
            'pending_balance' => array(
                'value' => 'pending_balance',
                'title' => trans('lang.pending_bal'),
            ),
            'current_balance' => array(
                'value' => 'current_balance',
                'title' => trans('lang.current_bal'),
            ),
            'saved_job' => array(
                'value' => 'saved_job',
                'title' => trans('lang.saved_jobs'),
            ),
            'followed_company' => array(
                'value' => 'followed_company',
                'title' => trans('lang.followed_companies'),
            ),
            'liked_freelancer' => array(
                'value' => 'liked_freelancer',
                'title' => trans('lang.liked_freelancers'),
            ),
            'cancel_job' => array(
                'value' => 'cancel_job',
                'title' => trans('lang.cancelled_jobs'),
            ),
            'ongoing_job' => array(
                'value' => 'ongoing_job',
                'title' => trans('lang.ongoing_jobs'),
            ),
            'completed_job' => array(
                'value' => 'completed_job',
                'title' => trans('lang.completed_jobs'),
            ),
            'posted_job' => array(
                'value' => 'posted_job',
                'title' => trans('lang.posted_jobs'),
            ),
            'ongoing_services' => array(
                'value' => 'ongoing_services',
                'title' => trans('lang.ongoing_services'),
            ),
            'completed_services' => array(
                'value' => 'completed_services',
                'title' => trans('lang.completed_services'),
            ),
            'cancelled_services' => array(
                'value' => 'cancelled_services',
                'title' => trans('lang.cancelled_services'),
            ),
            'published_services' => array(
                'value' => 'published_services',
                'title' => trans('lang.published_services'),
            ),
        );
        if (!empty($icon) && array_key_exists($icon, $icons)) {
            return $icons[$icon];
        } else {
            return $icons;
        }
    }

    /**
     * Get project offer message content
     *
     * @access public
     *
     * @return array
     */
    public static function getProjectOfferContent($e_name, $e_link, $p_link, $p_title, $message)
    {
        $content = '';
        $content .= "Hi, The employer " . $e_name . " would like to invite you to consider working on the following project";
        $content .= "<br>";
        $content .= "Employer Link = " . $e_link;
        $content .= "<br>";
        $content .= "Project Title = " . $p_title;
        $content .= "<br>";
        $content .= "Project Link = " . $p_link;
        $content .= "<br>";
        $content .= "Message: " . $message;
        return $content;
    }

    /**
     * Get unserialize data
     *
     * @param array $data data
     *
     * @access public
     *
     * @return array
     */
    public static function getUnserializeData($data)
    {
        if (!empty($data)) {
            $fixed_data = preg_replace_callback(
                '!s:(\d+):"(.*?)";!',
                function ($match) {
                    return ($match[1] == strlen($match[2])) ? $match[0] : 's:' . strlen($match[2]) . ':"' . $match[2] . '";';
                },
                $data
            );
            return unserialize($fixed_data);
        }
    }

    /**
     * Get freelancer status list
     *
     * @param string $status status
     *
     * @access public
     *
     * @return array
     */
    public static function getFreelancerServiceStatus($status = '')
    {
        $status_list = array(
            'published' => array(
                'title' => trans('lang.published'),
                'value' => 'published',
            ),
            'draft' => array(
                'title' => trans('lang.draft'),
                'value' => 'draft',
            ),
        );

        if (!empty($status) && array_key_exists($status, $status_list)) {
            return $status_list[$status];
        } else {
            return $status_list;
        }
    }

    /**
     * Get service orders count
     *
     * @param int    $service_id service_id
     * @param string $status     status
     *
     * @access public
     *
     * @return array
     */
    public static function getServiceCount($service_id, $status)
    {
        return DB::table('service_user')->where('service_id', $service_id)->where('status', $status)->count();
    }

    /**
     * Get freelancer services
     *
     * @param string $status pivot table status
     *
     * @access public
     *
     * @return array
     */
    public static function getFreelancerServices($status, $user_id)
    {
        return DB::table('services')
            ->join('service_user', 'service_user.service_id', '=', 'services.id')
            ->select('services.*', 'service_user.id as pivot_id', 'service_user.user_id as pivot_user', 'service_user.type', 'service_user.status as pivot_status')
            ->where('service_user.status', $status)
            ->where('service_user.seller_id', $user_id)
            ->get();
    }

    /**
     * Get service reviews
     *
     * @param int $receiver_id freelancer id
     * @param int $service_id  user service id
     *
     * @access public
     *
     * @return array
     */
    public static function getServiceReviews($receiver_id, $service_id)
    {
        return DB::table('reviews')
            ->select('reviews.*')
            ->where('reviews.receiver_id', $receiver_id)
            ->where('reviews.service_id', $service_id)->get();
    }

    /**
     * Get service reviews
     *
     * @param int $author_id     employer id
     * @param int $pivot_service service pivot id
     *
     * @access public
     *
     * @return array
     */
    public static function getEmployerServiceReview($user_id, $pivot_service)
    {
        return DB::table('reviews')
            ->select('reviews.*')
            ->where('reviews.user_id', $user_id)
            ->where('reviews.job_id', $pivot_service)->first();
    }

    /**
     * Get service review
     *
     * @param int $project_id project_id
     *
     * @access public
     *
     * @return array
     */
    public static function getReview($project_id)
    {
        return DB::table('reviews')->where('job_id', $project_id)->first();
    }

    /**
     * Get service orders count
     *
     * @param int $service_id service_id
     *
     * @access public
     *
     * @return array
     */
    public static function getServiceSeller($service_id)
    {
        return DB::table('service_user')->where('service_id', $service_id)->where('type', 'seller')->first();
    }

    /**
     * Get employer service status
     *
     * @param int $user_id user_id
     *
     * @access public
     *
     * @return array
     */
    public static function getEmployerServiceStatus($user_id)
    {
        $service =  DB::table('service_user')->select('status')
            ->where('user_id', $user_id)->first();
        return $service->status;
    }

    /**
     * Service new order email content
     *
     * @access public
     *
     * @return array
     */
    public static function getFreelancerNewOrderEmailContent()
    {
        $output = "";
        $output .= "Hello %freelancer_name%";
        $output .= "<a href='%employer_link%'>%employer_name%</a> has purchased your following service <a href='%service_link%'>%service_title%</a>.";
        $output .= "service Information is given below.";
        $output .= "service Amount : %service_amount%";
        $output .= "%signature%";
        return $output;
    }


    /**
     * Service new order email content
     *
     * @access public
     *
     * @return array
     */
    public static function getFreelancerCompletedServiceEmailContent()
    {
        $output = "";
        $output .= "Hello %freelancer_name%";
        $output .= "The <a href='%employer_link%'>%employer_name%</a> has confirmed that the following project (%project_title%) is completed.";
        $output .= "You have received the following ratings %rating% from employer.";
        $output .= "%message%";
        $output .= "%signature%";
        return $output;
    }

    /**
     * Service new order email content
     *
     * @access public
     *
     * @return array
     */
    public static function getFreelancerCancelledServiceEmailContent()
    {
        $output = "";
        $output .= "Hello <a href='%freelancer_link%'>%freelancer_name%</a>,";
        $output .= "Unfortunately <a href=' %employer_link%'>%employer_name%</a> cancelled the <a href='%project_link%'>%project_title%</a> service due to following below reasons.";
        $output .= "%message%";
        $output .= "%signature%";
        return $output;
    }

    /**
     * Service new order email content
     *
     * @access public
     *
     * @return array
     */
    public static function getAdminServicePostedEmailContent()
    {
        $output = "";
        $output .= "Hello";
        $output .= "A new service is posted by <a href='%freelancer_link%'>%freelancer_name%</a>.";
        $output .= "Click to view the service link. <a href='%service_link%' target='_blank' rel='noopener'>%service_title%</a>";
        $output .= "%signature%";
        return $output;
    }

    /**
     * Get the employer service.
     *
     * @return relation
     */
    public static function getPivotService($pivot_id)
    {
        return  DB::table('service_user')->where('id', $pivot_id)->first();
    }

    /**
     * Get the employer service.
     *
     * @param int $pivot_id pivot_id
     *
     * @return relation
     */
    public static function getPivotServiceReport($pivot_id)
    {
        return DB::table('reports')->where('reportable_id', $pivot_id)->where('reportable_type', 'App\Service')->first();
    }

    /**
     * Get the specific review reasons.
     *
     * @param int $id id
     *
     * @return collection
     */
    public static function getReviewReasons($id)
    {
        return DB::table('review_options')->where('id', $id)->first();
    }

    /**
     * Get favicon image
     *
     * @access public
     *
     * @return string
     */
    public static function getSiteFavicon()
    {
        $settings = SiteManagement::getMetaValue('settings');
        $favicon = !empty($settings[0]['favicon']) ? $settings[0]['favicon'] : null;
        if (!empty($favicon)) {
            return '/uploads/settings/general/' . $favicon;
        } else {
            return '';
        }
    }

    /**
     * Get favicon image
     *
     * @access public
     *
     * @return string
     */
    public static function getImageWithSize($path, $image, $size = "")
    {
        if (!empty($path) && !empty($image)) {
            if (!empty($size)) {
                $file = $path . '/' . $size . '-' . $image;
                if (file_exists($file)) {
                    return $path . '/' . $size . '-' . $image;
                } else {
                    return $path . '/' . $image;
                }
            } else {
                return $path . '/' . $image;
            }
        }
    }

    /**
     * Get order's payout
     *
     * @param int $order_id order_id
     *
     * @access public
     *
     * @return string
     */
    public static function getOrderPayout($order_id)
    {
        return  Payout::where('order_id', $order_id)->get();
    }

    /**
     * Get access type.
     *
     * @return accesstype
     */
    public static function getAccessType()
    {
        if (Schema::hasTable('services') && Schema::hasTable('service_user')) {
            $access_type = SiteManagement::where('meta_key', 'access_type')->select('meta_value')->pluck('meta_value')->first();
            if (!empty($access_type)) {
                return $access_type;
            } else {
                return 'jobs';
            }
        } else {
            return 'jobs';
        }
    }

    /**
     * Get home banner
     *
     * @param string $type type
     * @param string $size size
     *
     * @access public
     *
     * @return string
     */
    public static function getServiceSection($type)
    {
        $service_section = !empty(SiteManagement::getMetaValue('service_section_setting')) ? SiteManagement::getMetaValue('service_section_setting') : array();
        $show_services_section  = !empty($service_section) && !empty($service_section['show_services_section']) ? $service_section['show_services_section'] : '';
        $title  = !empty($service_section) && !empty($service_section['title']) ? $service_section['title'] : trans('lang.explore_top_services');
        $subtitle  = !empty($service_section) && !empty($service_section['subtitle']) ? $service_section['subtitle'] : trans('lang.picked_top_services');
        $description  = !empty($service_section) && !empty($service_section['description']) ? $service_section['description'] : '';

        if ($type == 'show_services_section') {
            return $show_services_section;
        }
        if ($type == 'title') {
            return $title;
        }
        if ($type == 'subtitle') {
            return $subtitle;
        }
        if ($type == 'description') {
            return $description;
        }
    }

    /**
     * Get Auth translated role name
     *
     * @access public
     *
     * @return array
     */
    public static function getAuthRoleName()
    {
        if (Auth::user()) {
            if (Auth::user()->getRoleNames()->first() == 'freelancer') {
                return trans('lang.freelancer');
            } elseif (Auth::user()->getRoleNames()->first() == 'employer') {
                return trans('lang.employer');
            } else {
                return trans('lang.admin');
            }
        } else {
            return '';
        }
    }

    /**
     * Get Auth translated role name
     *
     * @access public
     *
     * @return array
     */
    public static function displayProposalStatus($key = '')
    {
        $proposal_status = array(
            'pending'       => trans('lang.pending'),
            'hired'            => trans('lang.hired'),
            'completed'     => trans('lang.completed'),
            'cancelled'     => trans('lang.cancelled'),
        );
        if (!empty($key) && array_key_exists($key, $proposal_status)) {
            return $proposal_status[$key];
        } else {
            return $proposal_status;
        }
    }

    /**
     * Get Payouts list
     *
     * @access public
     *
     * @return array
     */
    public static function getPayoutsList()
    {
        $list = array(
            'paypal' => array(
                'id'        => 'paypal',
                'title'        => trans('lang.paypal'),
                'img_url'    => url('/images/payouts/paypal.png'),
                'status'    => 'enable',
                'fields'    => array(
                    'paypal_email' => array(
                        'type'            => 'text',
                        'classes'        => '',
                        'required'        => true,
                        'placeholder'    => trans('lang.add_paypal_email_address'),
                        'message'        => trans('lang.paypal_email_address_is_required'),
                    )
                )
            ),
            'bacs' => array(
                'id'        => 'bacs',
                'title'        => trans('lang.direct_bank_transfer'),
                'img_url'    => url('/images/payouts/bank.png'),
                'status'    => 'enable',
                'fields'    => array(
                    'bank_account_name' => array(
                        'type'            => 'text',
                        'classes'        => '',
                        'required'        => true,
                        'placeholder'    => trans('lang.bank_account_name'),
                        'message'        => trans('lang.bank_account_name_is_required'),
                    ),
                    'bank_account_number' => array(
                        'type'            => 'text',
                        'classes'        => '',
                        'required'        => true,
                        'placeholder'    => trans('lang.bank_account_number'),
                        'message'        => trans('lang.bank_account_number_is_required'),
                    ),
                    'bank_name' => array(
                        'type'            => 'text',
                        'classes'        => '',
                        'required'        => true,
                        'placeholder'    => trans('lang.bank_name'),
                        'message'        => trans('lang.bank_name_is_required'),
                    ),
                    'bank_routing_number' => array(
                        'type'            => 'text',
                        'classes'        => '',
                        'required'        => false,
                        'placeholder'    => trans('lang.bank_routing_number'),
                        'message'        => trans('lang.bank_routing_number_is_required'),
                    ),
                    'bank_iban' => array(
                        'type'            => 'text',
                        'classes'        => '',
                        'required'        => false,
                        'placeholder'    => trans('lang.bank_iban'),
                        'message'        => trans('lang.bank_iban_is_required'),
                    ),
                    'bank_bic_swift' => array(
                        'type'            => 'text',
                        'classes'        => '',
                        'required'        => false,
                        'placeholder'    => trans('lang.bank_bic_swift'),
                        'message'        => trans('lang.bank_bic_swift_is_required'),
                    )
                )
            ),
        );
        // $list	= apply_filters('workreap_filter_payouts_lists',$list);
        return $list;
    }

    /**
     * Get month list
     *
     * @param string $key key
     *
     * @access public
     *
     * @return array
     */
    public static function getMonthList($key = "")
    {
        $list = array(
            '01'    => "January",
            '02'    => "February",
            '03'     => "March",
            '04'    => "April",
            '05'    => "May",
            '06'    => "June",
            '07'    => "July",
            '08'    => "August",
            '09'    => "September",
            '10'    => "October",
            '11'    => "November",
            '12'    => "December",
        );
        if (!empty($key) && array_key_exists($key, $list)) {
            return $list[$key];
        } else {
            return $list;
        }
    }
}
