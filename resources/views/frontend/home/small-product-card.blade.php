<div class="col-xl-2  col-sm-6 col-md-4 col-lg-6 category-{{ @$key }}">
    <a class="wsus__hot_deals__single" href="{{ route('show-product-details', $product->slug) }}">
        <div class="wsus__hot_deals__single_img">
            <img src="{{ asset('uploads/' . @$product->firstImage->name) }}" alt="bag" class="img-fluid w-100">
        </div>
        <div class="wsus__hot_deals__single_text">
            <h5>{!! limitText($product->name) !!}</h5>

            <p class="wsus__rating">
                @for ($i = 1; $i <= 5; $i++)
                    @if ($i <= round($product->reviews_avg_rating))
                        <i class="fas fa-star"></i>
                    @else
                        <i class="far fa-star"></i>
                    @endif
                @endfor
                <span>({{ $product->reviews->count() }} review)</span>
            </p>

            @if (checkDiscount($product))
                <p class="wsus__tk">{{ $setting->currency }}{{ $product->offer_price }}
                    <del>{{ $setting->currency }}{{ $product->price }}</del>
                </p>
            @else
                <p class="wsus__tk">{{ $setting->currency }}{{ $product->price }}</p>
            @endif
        </div>
    </a>
</div>
