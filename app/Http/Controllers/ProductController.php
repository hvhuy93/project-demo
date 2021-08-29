<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Service\Product\ProductService;
class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService){
        $this->productService = $productService;
    }
    public function index($id = '', $slug = '')
    {
        $product = $this->productService->showProduct($id);
        $productMore = $this->productService->more($id);

        return view('product.detail',[
            'title' => $product->name,
            'product' => $product,
            'products' => $productMore
        ]);
    }
}
