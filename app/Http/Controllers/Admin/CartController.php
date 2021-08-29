<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Service\CartService;

class CartController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }
    public function index(){
        return view('admin.cart.customer',[
            'title' => 'List Order',
            'customers' => $this->cartService->getCustomer()
        ]);

    }
    public function view(Customer $customer){

            $carts = $this->cartService->getProductForCarts($customer);
        return view('admin.cart.orderDetail',[
            'title' => 'Order Detail: ' .$customer->name,
            'customer' => $customer,
            'carts' => $carts

        ]);
    }
}
