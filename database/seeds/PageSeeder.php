<?php
/**
 * Class PageSeeder.
 *
 * @category Worketic
 *
 * @package Worketic
 * @author  Amentotech <theamentotech@gmail.com>
 * @license http://www.amentotech.com Amentotech
 * @link    http://www.amentotech.com
 */

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

/**
 * Class PageSeeder
 */
class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pages')->insert(
            [
               
               
            
               
                [
                    'title' => 'Home v1',
                    'slug' => 'home-v1',
                    'body' => 'null',
                    'relation_type' => 1,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'sections' => 'a:4:{i:0;O:8:"stdClass":5:{s:4:"name";s:14:"Slider Section";s:7:"section";s:6:"slider";s:5:"value";s:7:"sliders";s:4:"icon";s:10:"img-01.png";s:2:"id";i:1;}i:1;O:8:"stdClass":5:{s:4:"name";s:16:"Category Section";s:7:"section";s:8:"category";s:5:"value";s:3:"cat";s:4:"icon";s:10:"img-02.png";s:2:"id";i:2;}i:2;O:8:"stdClass":5:{s:4:"name";s:15:"Welcome Section";s:7:"section";s:15:"welcome_section";s:5:"value";s:16:"welcome_sections";s:4:"icon";s:10:"img-03.png";s:2:"id";i:4;}i:3;O:8:"stdClass":5:{s:4:"name";s:11:"APP Section";s:7:"section";s:11:"app_section";s:5:"value";s:11:"app_section";s:4:"icon";s:10:"img-04.png";s:2:"id";i:5;}}',
                ],
                [
                    'title' => 'Home V2',
                    'slug' => 'home-v2',
                    'body' => 'null',
                    'relation_type' => 1,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'sections' => 'a:6:{i:0;O:8:"stdClass":5:{s:4:"name";s:14:"Slider Section";s:7:"section";s:6:"slider";s:5:"value";s:7:"sliders";s:4:"icon";s:10:"img-01.png";s:2:"id";i:1;}i:1;O:8:"stdClass":5:{s:4:"name";s:15:"Service Section";s:7:"section";s:15:"service_section";s:5:"value";s:8:"services";s:4:"icon";s:10:"img-05.png";s:2:"id";i:6;}i:2;O:8:"stdClass":5:{s:4:"name";s:23:"How it work tab section";s:7:"section";s:16:"work_tab_section";s:5:"value";s:9:"work_tabs";s:4:"icon";s:10:"img-07.png";s:2:"id";i:3;}i:3;O:8:"stdClass":5:{s:4:"name";s:18:"Freelancer section";s:7:"section";s:18:"freelancer_section";s:5:"value";s:11:"freelancers";s:4:"icon";s:10:"img-08.png";s:2:"id";i:4;}i:4;O:8:"stdClass":5:{s:4:"name";s:11:"APP Section";s:7:"section";s:11:"app_section";s:5:"value";s:11:"app_section";s:4:"icon";s:10:"img-04.png";s:2:"id";i:5;}i:5;O:8:"stdClass":5:{s:4:"name";s:15:"Article Section";s:7:"section";s:15:"article_section";s:5:"value";s:8:"articles";s:4:"icon";s:10:"img-10.png";s:2:"id";i:10;}}',
                ],
                [
                    'title' => 'Home v3',
                    'slug' => 'home-v3',
                    'body' => 'null',
                    'relation_type' => 1,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'sections' => 'a:6:{i:0;O:8:"stdClass":5:{s:4:"name";s:14:"Slider Section";s:7:"section";s:6:"slider";s:5:"value";s:7:"sliders";s:4:"icon";s:10:"img-01.png";s:2:"id";i:1;}i:1;O:8:"stdClass":5:{s:4:"name";s:15:"Service Section";s:7:"section";s:15:"service_section";s:5:"value";s:8:"services";s:4:"icon";s:10:"img-05.png";s:2:"id";i:5;}i:2;O:8:"stdClass":5:{s:4:"name";s:18:"Freelancer section";s:7:"section";s:18:"freelancer_section";s:5:"value";s:11:"freelancers";s:4:"icon";s:10:"img-08.png";s:2:"id";i:4;}i:3;O:8:"stdClass":5:{s:4:"name";s:25:"How it work video section";s:7:"section";s:18:"work_video_section";s:5:"value";s:11:"work_videos";s:4:"icon";s:10:"img-06.png";s:2:"id";i:3;}i:4;O:8:"stdClass":5:{s:4:"name";s:11:"APP Section";s:7:"section";s:11:"app_section";s:5:"value";s:11:"app_section";s:4:"icon";s:10:"img-04.png";s:2:"id";i:7;}i:5;O:8:"stdClass":5:{s:4:"name";s:15:"Article Section";s:7:"section";s:15:"article_section";s:5:"value";s:8:"articles";s:4:"icon";s:10:"img-09.png";s:2:"id";i:6;}}',
                ],
            ]
        );
    }
}
