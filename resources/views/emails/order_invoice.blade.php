@component('mail::message')

Dear <p>{{ $order->first_name }},</p>

@php
  $getSetting = App\Models\Backend\SystemSetting::getSingle();
@endphp

<p>
 <!-- Thank you for your recent purchase with <strong>E-Commerce</strong>. we are pleased to confirm your order. -->
 Thank you for your recent purchase with <strong>{{ $getSetting->website_name }}</strong>. we are pleased to confirm your order.
  </p>


<h3>Order Details:</h3>

<ul>
    <li> Order Number: {{ $order->order_number }} </li>
    <li> Date purchase: {{ date('d-m-Y', strtotime($order->created_at)) }} </li>
</ul>


<table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
    <thead>
        <tr>
            <th style="border-bottom: 1px solid #ddd; padding: 8px; text-align: left;">Item</th>
            <th style="border-bottom: 1px solid #ddd; padding: 8px; text-align: left;">Quantiy</th>
            <th style="border-bottom: 1px solid #ddd; padding: 8px; text-align: left;">Price</th>
        </tr>
    </thead>
    <tbody>
        @foreach($order->getItem as $item)
        <tr>
            <td style="padding: 8px; border-bottom: 1px solid #ddd;">
                {{ $item->getProduct->title }}
                <br>
                 Color: {{ $item->color_name }}
                 @if(!empty($item->size_name))
                <br>
                 Size: {{ $item->size_name }}
                 <br>
                 Size Amount: ${{ number_format($item->size_amount, 2) }}
                 @endif
            </td>
            <td style="padding: 8px; border-bottom: 1px solid #ddd;">{{ $item->quantity }}</td>
            <td style="padding: 8px; border-bottom: 1px solid #ddd;">${{ number_format($item->total_price, 2) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<p> Shipping Name: <b>{{ $order->getShipping->name }} </b></p>
<p> Shipping Amount: <b>${{ number_format($order->shipping_amount, 2) }} </b></p>

@if(!empty($order->discount_code))
<p> Discount Code : <b>{{ $order->discount_code }} </b></p>
<p> Discount Amount : <b>{{ number_format($order->discount_amount, 2) }} </b></p>
@endif

<p> Total Amount: <b>${{ number_format($order->total_amount, 2) }} </b></p>

<p style="text-transform: capitalize;"> Payment Method Amount: <b>{{ $order->payment_method }} </b></p>


<p>Thank you for choosing <strong>{{ $getSetting->website_name }} </strong>. we are appreciate your bussiness. </p>


Thanks,<br>
<!-- {{config('app.name')}} -->
{{ $getSetting->website_name }}


@endcomponent