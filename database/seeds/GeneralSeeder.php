<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class GeneralSeeder extends Seeder
{

    public function run()
    {
       /****************Language******************/
       \App\Language::create([
           'key' => 'az',
           'name' => 'Azərbaycan',
           'description' => 'Azərbaycan dili',
           'order' => 1
       ]);

        /****************Menu translation group and translations******************/
        \App\TranslationGroup::create([
            'name' => 'navigation',
            'description' => 'Menu Group - created by Pashayev panel',
        ]);

        \App\TranslationGroup::create([
            'name' => 'menuLabels',
            'description' => 'Menu Labels Group - created by Pashayev panel',
        ]);

        $menuList = [
            'dashboard' => 'Panel',
            'modules' => 'Modullar',
            'menus' => 'Menyular',
            'portfolio' => 'Portfel',
            'products' => 'Məhsullar',
            'categories' => 'Kateqoriyalar',
            'users' => 'İstifadəçilər',
            'roles' => 'Vəzifələr',
            'permissions' => 'İcazələr',
            'localization' => 'Lokalizasiya',
            'languages' => 'Dillər',
            'translation_groups' => 'Tərcümə qrupları',
            'translations' => 'Tərcümələr',
            'settings' => 'Tənzimləmələr',
            'config' => 'Konfiqurasiya',
            'site' => 'Sayt',
        ];

        foreach ($menuList as $key => $value) {
            \App\Translation::create([
                'group_id' => 1,
                'key' => $key,
                'value' => json_encode([
                    "az" => $value
                ],JSON_UNESCAPED_UNICODE),
            ]);
        }

        $menuList = [
            'main' => 'Əsas',
            'other' => 'Digər'
        ];

        foreach ($menuList as $key => $value) {
            \App\Translation::create([
                'group_id' => 2,
                'key' => $key,
                'value' => json_encode([
                    "az" => $value
                ],JSON_UNESCAPED_UNICODE),
            ]);
        }
    }

}
