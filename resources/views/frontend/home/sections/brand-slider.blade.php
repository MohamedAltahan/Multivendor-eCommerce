    <!--============================BRAND SLIDER START ==============================-->
    <section id="wsus__brand_sleder" class="brand_slider_2">
        <div class="container">
            <div class="brand_border">
                <div class="row brand_slider">
                    @foreach ($brands as $brand)
                        <div class="col-xl-2">
                            <div class="wsus__brand_logo">
                                <a href="{{ $brand->url }}"><img src="{{ asset('uploads/' . $brand->logo) }}"
                                        alt="{{ $brand->name }}" class="img-fluid w-100"></a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!--============================BRAND SLIDER END==============================-->
