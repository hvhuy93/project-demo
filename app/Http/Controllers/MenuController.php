<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Service\Menu\MenuService;

class MenuController extends Controller
{
    protected $menuService;

    public function __construct(MenuService $menu){
        $this->menuService = $menu;
    }

    public function index(Request $request, $id, $slug)
    {
        $menu = $this->menuService->getId($id);
        $products = $this->menuService->getProduct($menu,$request);

     return view('menu',[
         'title' => $menu->name,
         'products' => $products,
         'menu' => $menu
     ]);
    }
}
