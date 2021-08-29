<?php


namespace App\Http\Service\Product;


use App\Models\Product;

class ProductService
{
    const LIMIT = 16;
    public static function get($page = null)
    {
        return Product::select('id','name','price','price_sale','thumb')
            ->orderByDesc('id')
            ->when($page != null, function ($query) use ($page){
                $query->offset($page * self::LIMIT);
            })
            ->limit(self::LIMIT)
            ->get();
    }

    //Product Detail
    public function showProduct($id)
    {
            return Product::where('id',$id)->where('active',1)->with('menu')->firstOrFail();

    }

    public function more($id)
    {
        return Product::select('id','name','price','price_sale','thumb')
            ->where('active',1)
            ->where('id', '!=', $id)
            ->limit(8)
            ->get();

    }
}
