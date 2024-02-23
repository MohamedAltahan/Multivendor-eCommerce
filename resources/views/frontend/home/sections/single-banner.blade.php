    <!--============================  SINGLE BANNER START==============================-->
    <section id="wsus__single_banner" class="wsus__single_banner_2">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-6">
                    <div class="wsus__single_banner_content">
                        <div class="wsus__single_banner_img">
                            <a href="{{ @$banner2['banner1']['url1'] }}">
                                <img class="img-fluid w-100"
                                    src="{{ asset('uploads/' . @$banner2['banner1']['banner1']) }}" alt="">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6">
                    <div class="wsus__single_banner_content single_banner_2">
                        <div class="wsus__single_banner_img">
                            <a href="{{ @$banner2['banner2']['url2'] }}">
                                <img class="img-fluid w-100"
                                    src="{{ asset('uploads/' . @$banner2['banner2']['banner2']) }}" alt="">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================ SINGLE BANNER END==============================-->
