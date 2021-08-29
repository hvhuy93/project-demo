@extends('admin.main')

@section('contents')
    <div class="custom mt-3">
        <ul>
            <li>CustomerName: <strong>{{$customer->name}}</strong></li>
            <li>Phone: <strong>{{$customer->phone}}</strong></li>
            <li>Address: <strong>{{$customer->add}}</strong></li>
            <li>Email: <strong>{{$customer->email}}</strong></li>
            <li>Note: <strong>{{$customer->content}}</strong></li>
        </ul>
    </div>

    <div>
        <div class="table">
            @php $total = 0; @endphp
            <table class="table">
                <tbody><tr class="table_head">
                    <th class="column-1">Image</th>
                    <th class="column-2">Product</th>
                    <th class="column-3">Price</th>
                    <th class="column-4">Quantity</th>
                    <th class="column-5">Unit Price</th>
                    <th class="column-6">&nbsp;</th>
                </tr>
                @foreach($carts as $cart)

                    @php
                        $price = $cart->price * $cart->qty;
                        $total += $price;
                    @endphp
                    <tr>
                        <td class="column-1">
                            <div class="how-itemcart1">
                                <img src="{{$cart->product->thumb}}" style="width: 80px" alt="IMG">
                            </div>
                        </td>
                        <td class="column-2">{{$cart->product->name}}</td>
                        <td class="column-3">{{number_format($cart->price, 0, '', '.')}}</td>
                        <td class="column-4">{{$cart->qty}}</td>
                        <td class="column-4">{{number_format($price, 0, '', '.')}}</td>

                    </tr>

                @endforeach
                <tr>
                    <td colspan="4" class="text-right text-bold">Total:</td>
                    <td style="color: red" class="text-bold">{{number_format($total, 0, '', '.')}}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection

