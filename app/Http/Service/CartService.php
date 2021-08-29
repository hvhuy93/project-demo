<?php


namespace App\Http\Service;


use App\Jobs\SendMail;
use App\Models\Cart;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;


class CartService
{
    //Thêm sản phẩm vào gio hàng
    public function create($request)
    {
        $qty = (int)$request->input('num_product');
        $product_id = (int)$request->input('product_id');

        if ($qty <= 0 || $product_id <= 0) {
            Session::flash('error', 'Số lượng hoặc Sản phẩm không chính xác');
            return false;
        }


        $carts = Session::get('carts');
        if (is_null($carts)) {
            Session::put('carts', [
                $product_id => $qty
            ]);
            return true;
        }

        $exists = Arr::exists($carts, $product_id);
        if ($exists) {
            $carts[$product_id] = $carts[$product_id] + $qty;
            Session::put('carts', $carts);
            return true;
        }
        $carts[$product_id] = $qty;
        Session::put('carts', $carts);

        return true;
    }

    //Hiển thị danh sách sản phẩm trong giỏ hàng
    public function getProduct()
    {
        $carts = Session::get('carts');
        if (is_null($carts)) return [];

        $productId = array_keys($carts);
        return Product::select('id', 'name', 'thumb', 'price', 'price_sale')
            ->where('active', 1)
            ->whereIn('id', $productId)
            ->get();

    }

    public function update($request)
    {
        Session::put('carts', $request->input('num_product'));
        return true;
    }

    public function remove($id)
    {
        $carts = Session::get('carts');
        unset($carts[$id]);
        Session::put('carts', $carts);
        return true;
    }

    public function addCart($request)
    {
        try {
            DB::beginTransaction();

            $carts = Session::get('carts');
            if (is_null($carts)) return false;

            $customer = Customer::create([
                'name' => $request->input('name'),
                'add' => $request->input('add'),
                'phone' => $request->input('phone'),
                'email' => $request->input('email'),
                'content' => $request->input('content'),

            ]);


            $this->infoProduct($carts, $customer->id);
            DB::commit();
            Session::flash('success', 'Order confirm');

            #Queue
            SendMail::dispatch($request->input('email'))->delay(now()->addSeconds(2));

            Session::forget('carts');
        } catch (\Exception $err) {
            DB::rollBack();
            Session::flash('error', 'Order rejected');
            return false;
        }
        return true;
    }

    public function infoProduct($carts, $customer_id)
    {

        $productId = array_keys($carts);
        $prodcuts = Product::select('id', 'name', 'thumb', 'price', 'price_sale')
            ->where('active', 1)
            ->whereIn('id', $productId)
            ->get();
        $data = [];
        foreach ($prodcuts as $product) {
            $data[] = [
                'customer_id' => $customer_id,
                'product_id' => $product->id,
                'qty' => $carts[$product->id],
                'price' => $product->price_sale != 0 ? $product->price_sale : $product->price
            ];
        }
        return Cart::insert($data);
    }

    public function getCustomer()
    {
        return Customer::orderByDesc('id')->paginate(10);
    }

    public function getProductForCarts($customer)
    {

        return $customer->carts()->with(['product' => function ($query) {
            $query->select('id', 'name', 'thumb');
            }])->get();

    }
}
