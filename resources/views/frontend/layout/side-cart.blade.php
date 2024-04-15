<ul class="side_cart_wrapper">

    @forelse ($cartProducts as $item)
        <li id="product_{{ $item->rowId }}">
            <div class="wsus__cart_img">
                <a href="{{ route('show-product-details', $item->options->slug) }}"><img
                        src="{{ asset('uploads/' . $item->options->image) }}" alt="product" class="img-fluid w-100"></a>

                <a class="wsis__del_icon" data-id="{{ $item->rowId }}" href="#"><i class="fas fa-minus-circle "
                        id="side-cart-remove-product"></i></a>
            </div>

            <div class="wsus__cart_text">
                <a class="wsus__cart_title"
                    href="{{ route('show-product-details', $item->options->slug) }}">{{ $item->name }}</a>
                <p>{{ $item->price }} * {{ $item->qty }} =
                    {{ $setting->currency . $item->price * $item->qty }}
                </p>

            </div>
        </li>
    @empty
        <h5 class="text-primary " style="justify-content: center">{{ __('Cart is empty') }}</h5>
    @endforelse

</ul>
<h5>{{ __('Sub total') }}<span>{{ $totalCartPrice }}</span></h5>
