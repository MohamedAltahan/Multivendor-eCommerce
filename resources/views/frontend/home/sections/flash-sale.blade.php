    <!--============================FLASH SELL START==============================-->
    <section id="wsus__flash_sell" class="wsus__flash_sell_2">
        <div class=" container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="offer_time" style="background: url({{ asset('frontend/images/flash_sell_bg.jpg') }}">
                        <div class="wsus__flash_coundown">
                            <span class=" end_text">flash sale</span>
                            <div class="simply-countdown simply-countdown-one"></div>
                            <a class="common_btn" href="{{ route('flash-sale') }}">see more <i
                                    class="fas fa-caret-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row flash_sell_slider">
                @foreach ($flashSaleProducts as $product)
                    <div class="col-xl-4 col-sm-6">
                        @include('frontend.home.big-product-card')
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!--============================ FLASH SELL END ==============================-->
    @push('scripts')
        <script>
            $(document).ready(function() {
                simplyCountdown(".simply-countdown-one", {
                    year: {{ date('Y', strtotime(@$flashSaleDate->end_flash_date)) }}, //2022
                    month: {{ date('m', strtotime(@$flashSaleDate->end_flash_date)) }}, //2
                    day: {{ date('d', strtotime(@$flashSaleDate->end_flash_date)) }}, //5
                });
            });
        </script>
    @endpush
