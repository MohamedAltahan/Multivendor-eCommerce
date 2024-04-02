<div class="wsus__product_item">
    <span class="wsus__new">{{ $product->product_type }}</span>
    @if (checkDiscount($product))
        <span class="wsus__minus">-{{ calcDiscountPercentage($product->price, $product->offer_price) }}%
        </span>
    @endif
    <a class="wsus__pro_link" href="{{ route('show-product-details', $product->slug) }}">
        <img src="{{ asset('uploads/' . @$product->firstImage->name) }}" alt="No-image" class="img-fluid w-100 img_1" />

    </a>
    <ul class="wsus__single_pro_icon">
        <li><a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="far fa-eye"></i></a>
        </li>
        <li><a href="#"><i class="far fa-heart"></i></a></li>
        <li><a href="#"><i class="far fa-random"></i></a>
    </ul>
    <div class="wsus__product_details">
        <a class="wsus__category" href="{{ route('products.index', ['category' => $product->category->slug]) }}">
            {{ $product->category->name }}
        </a>

        <p class="wsus__pro_rating">
            @for ($i = 1; $i <= 5; $i++)
                @if ($i <= round($product->reviews_avg_rating))
                    <i class="fas fa-star"></i>
                @else
                    <i class="far fa-star"></i>
                @endif
            @endfor
            <span>({{ $product->reviews->count() }} review)</span>
        </p>

        <a class="wsus__pro_name" href="{{ route('show-product-details', $product->slug) }}">{{ $product->name }}</a>

        @if (checkDiscount($product))
            <p class="wsus__price">
                <span class="currency_color">{{ $setting->currency }}</span>{{ $product->offer_price }}
                <del>{{ $setting->currency }}{{ $product->price }}</del>
            </p>
        @else
            <p class="wsus__price"><span class="currency_color">{{ $setting->currency }}</span>{{ $product->price }}
            </p>
        @endif

        {{-- submit using ajax in scripts file --}}
        <form class="shopping-cart-form" action="">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <input type="hidden" name="submit_source" value="main_card">
            <button type="submit" style="border:none;" class="add_cart" href="#">add to cart</button>
        </form>
    </div>
</div>
