<?php

use App\Model\Page;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;


class PagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array = array(
            array(
                'title' => 'About Us',
                'slug' => Str::slug('About Us'),
                'summary' => 'About Us',
                'layout' => 'default',
            ),
            array(
                'title' => 'Privacy Policy',
                'slug' => Str::slug('Privacy Policy'),
                'summary' => 'Privacy Policy',
                'layout' => 'default',
            ),

            array(
                'title' => 'Terms And Condition',
                'slug' => Str::slug('Terms And Condition'),
                'summary' => 'Terms And Condition',
                'layout' => 'default',
            ),

            array(
                'title' => 'FAQ',
                'slug' => Str::slug('FAQ'),
                'summary' => 'FAQ',
                'layout' => 'default',
            ),

        );
        foreach($array as $page_item){
            $page = new Page();
            if($page->where('slug',$page_item['slug'])->count() <= 0){
                $page->create($page_item);

                // $page->fill($page_item);
                // $page->save();

            }
        }
    }
}
