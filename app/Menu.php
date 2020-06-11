<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    public function pages(){
        return $this->hasMany('App\Page','menu_id','id');
    }

    public static function getMenus($onlyActives = false)
    {
        $data = [];
        $menus = Menu::where('parent_id',null);
        if($onlyActives){
            $menus = $menus->where('status',true);
        }
        $menus = $menus->orderBy('order','asc')->get();

        foreach ($menus as $menu){
            if(!Menu::hasSubMenus($menu->id)){
                $data[] = $menu;
            }else{
                $subMenus = Menu::getSubMenus($menu->id);
                $menu->subMenus = $subMenus;
                $data[] = $menu;
            }

        }
        return $data;
    }

    public static function hasSubMenus($menu_id){
        return Menu::where('parent_id',$menu_id)->count();
    }

    public static function getSubMenus($menu_id)
    {
        $data = [];
        $subMenus = Menu::where('parent_id',$menu_id)->orderBy('order','asc')->get();
        foreach ($subMenus as $subMenu){
            if(!Menu::hasSubMenus($subMenu->id)){
                $data[] = $subMenu;
            }else{
                $subMenus = Menu::getSubMenus($subMenu->id);
                $subMenu->subMenus = $subMenus;
                $data[] = $subMenu;
            }

        }
        return $data;
    }

    public static function getTargetMenus($target){
        $menus = Menu::where('status',true)->where('target','LIKE',"%$target%")->get();
        return $menus;
    }
}
