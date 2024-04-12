    <!--============================ BANNER PART 2 START==============================-->
    <section id="wsus__banner">
        <div class="container">
            <div class="wsus__banner_content">
                <div class="row banner_slider">
                    @foreach ($sliders as $slider)
                        <a class="" href="{{ $slider->banner_url }}">
                            <div class="wsus__single_slider "
                                style="background-image: url({{ asset('uploads/' . $slider->banner_image) }}) ">
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!--============================   BANNER PART 2 END  ==============================-->
