    <!--============================ BANNER PART 2 START==============================-->
    <section id="wsus__banner">
        <div class="container">
            <div class="wsus__banner_content">
                <div class="row banner_slider">
                    @foreach ($sliders as $slider)
                        <div class="wsus__single_slider"
                            style="background: url({{ asset('uploads/' . $slider->banner_image) }});">
                            <div class="wsus__single_slider_text">
                                <h3>{!! $slider->type !!}</h3>
                                <h1>{!! $slider->title !!}</h1>
                                <h6>Start at {{ $setting->currency }} {{ $slider->starting_price }}
                                </h6>
                                <a class="common_btn" href="{{ $slider->banner_url }}">shop now</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!--============================   BANNER PART 2 END  ==============================-->
