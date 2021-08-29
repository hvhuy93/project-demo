<?php


namespace App\Http\Service\Product;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use App\Models\Product;
use  App\Models\Menu;
class ProductAdminService
{

    public static function getMenu()
    {
        return Menu::where('active',1)->get();
    }

    protected function isVailidPrice($request){
    if ($request->input('price') != 0 && $request->input('price_sale') !=0
        && $request->input('price_sale') >= $request->input('price')
    ){
    Session::flash('error','Giá giảm phải nhỏ hơn giá gốc');
    return false;
        }
    if ($request->input('price_sale') !=0 && $request->input('price') == 0){
        Session::flash('error','Vui lòng nhập giá gốc');
        return false;
    }
    return true;
    }

    public function insert($request)
    {
        $isVailidPrice = $this->isVailidPrice($request);
        if ($isVailidPrice === false) return false;

        try {
            $request->except('_token');
            Product::create($request->all());
            Session::flash('success','Thêm sản phẩm thành công');
        }catch (\Exception $err){
        Session::flash('error','Thêm sản phẩm lỗi');
        Log::info($err->getMessage());
        return false;
        }
        return true;

    }

    public function get()
    {
        return Product::with('menu')
            ->orderByDesc('id')
            ->paginate(10);
    }

    public function update($request, $product)
    {
        $isVailidPrice = $this->isVailidPrice($request);
        if ($isVailidPrice === false) return false;

        try {
            $product->fill($request->input());
            $product->save();
            Session::flash('success','Update Successful');
        }catch (\Exception $error){
            Session::flash('error','Update Error');
            Log::info($error->getMessage());
            return false;
        }
        return true;
    }

    public function delete($request)
    {
        $product = Product::where('id',$request->input('id'))->first();
        if ($product){
        $product->delete();
        return true;
        }
        return  false;
    }
}