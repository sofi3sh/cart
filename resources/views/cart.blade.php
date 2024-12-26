<!DOCTYPE html>
<html>
<head>
    <title>Cart</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
<h1>{{__('cart.title')}}</h1>
<div class="cart-page">
<div class="cart-container">
@foreach ($cartItems as $cartItem)
    <div class="cart-item" data-cart-id="{{ $cartItem->id }}">
                <h2>{{ $cartItem->product->name }}</h2>
        <p>Price: $<span class="product-price">{{ number_format($cartItem->product_price, 2, '.', '') }}</span></p>
        <input type="number" class="quantity-input" name="quantity" value="{{ $cartItem->quantity }}" data-cart-id="{{ $cartItem->id }}">
        <button class="delete-button" data-cart-id="{{ $cartItem->id }}">{{__('cart.button_remove')}}</button>
    </div>
@endforeach
</div>
    <button id="back-to-shopping" class="btn btn-primary">{{__('cart.button_back')}}</button>
</div>

<script src="{{ asset('js/cart.js') }}"></script>

</body>
</html>