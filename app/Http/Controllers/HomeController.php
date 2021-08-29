<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Http\Service\Menu\MenuService;
use App\Http\Service\Slide\SlideService;
use App\Http\Service\Product\ProductService;

class HomeController extends Controller
{
    protected $menuService;
    protected $slideService;
    protected $productService;


    public function __construct(MenuService $menu, SlideService $slide, ProductService $product)
    {
        $this->menuService = $menu;
        $this->slideService = $slide;
        $this->productService = $product;
    }

    public function index()
    {
        return view('home', [
            'title' => 'Shop Clothes',
            'menus' => $this->menuService->show(),
            'sliders' => $this->slideService->show(),
            'products' => $this->productService->get()
        ]);
    }

    public function loadProduct(Request $request)
    {
        $page = $request->input('page', 0);
        $result = $this->productService->get($page);
        if ( count($result) != 0) {
            $html = view('product.list', ['products' => $result])->render();

            return response()->json([
                'html' => $html
            ]);
        }
        return response()->json([
            'html' => ''
        ]);
    }

    public function about(){
        return view('about',[
            'title' => 'About'
        ]);
    } public function contact(){
        return view('contact',[
            'title' => 'Contact'
        ]);
    }
}
