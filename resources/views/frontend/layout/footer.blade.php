@php
    $footerInfo = App\Models\Footer::first();
    $footerSocialButtons = App\Models\FooterSocial::where('status', 'active')->get();
    $footerSectionTwolinks = App\Models\FooterGridTwoLink::where('status', 'active')->get();
    $footerSectionTwoTitle = App\Models\FooterTitle::first();
    $footerSectionThreelinks = App\Models\footerGridThreeLink::where('status', 'active')->get();
    $footerSectionThreeTitle = App\Models\footerTitle::first();
@endphp
<!--============================ FOOTER PART START ==============================-->
<footer class="footer_2">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-xl-3 col-sm-7 col-md-6 col-lg-3">
                <div class="wsus__footer_content">
                    <a class="wsus__footer_2_logo" href="{{ url('/') }}">
                        <img src="{{ asset('uploads/' . @$footerInfo->logo) }}" alt="logo">
                    </a>
                    <a class="action" href="callto:{{ @$footerInfo->phone }}"><i class="fas fa-phone-alt"></i>
                        {{ @$footerInfo->phone }}</a>
                    <a class="action" href="mailto:{{ @$footerInfo->email }}"><i class="far fa-envelope"></i>
                        {{ @$footerInfo->email }}</a>
                    <p><i class="fal fa-map-marker-alt"></i> {{ @$footerInfo->address }}</p>
                    <ul class="wsus__footer_social">
                        @foreach ($footerSocialButtons as $button)
                            <li><a title="{{ $button->name }}" class="facebook" href="{{ $button->link }}"><i
                                        class="{{ $button->icon }}"></i></a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-xl-2 col-sm-5 col-md-4 col-lg-2">
                <div class="wsus__footer_content">
                    <h5>{{ $footerSectionTwoTitle->footer_section_two_title }}</h5>
                    <ul class="wsus__footer_menu">
                        @foreach ($footerSectionTwolinks as $link)
                            <li><a href="{{ $link->link }}"><i class="fas fa-caret-right"></i>
                                    {{ $link->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-xl-2 col-sm-5 col-md-4 col-lg-2">
                <div class="wsus__footer_content">
                    <h5>{{ $footerSectionThreeTitle->footer_section_three_title }}</h5>
                    <ul class="wsus__footer_menu">
                        @foreach ($footerSectionThreelinks as $link)
                            <li><a href="{{ $link->link }}"><i class="fas fa-caret-right"></i>
                                    {{ $link->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-xl-4 col-sm-7 col-md-8 col-lg-5">
                <div class="wsus__footer_content wsus__footer_content_2">
                    <h3>Subscribe To Our Newsletter</h3>
                    <p>Get all the latest information on Events, Sales and Offers.
                        Get all the latest information on Events.</p>
                    <form action="{{ route('newsletter-subscribe') }}" method="POST" id="newsLetterForm">
                        @csrf
                        <input type="text" class="newsletter" placeholder="Email" name="subscriber_email">
                        <button type="submit" class="common_btn subscribe_btn">subscribe</button>
                    </form>
                    <div class="footer_payment">
                        <p>We're using safe payment for :</p>
                        <img src="images/credit2.png" alt="card" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="wsus__footer_bottom">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="wsus__copyright d-flex justify-content-center">
                        <p>{{ @$footerInfo->copyright }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!--============================ FOOTER PART END ==============================-->
