@extends('frontend.layout.master')
@section('title')
    {{ $setting->site_name }} - About
@endsection
@section('content')
    <!--============================  BREADCRUMB START==============================-->
    <section id="wsus__breadcrumb">
        <div class="wsus_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>contact us</h4>
                        <ul>
                            <li><a href="#">home</a></li>
                            <li><a href="#">contact us</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================   BREADCRUMB END ==============================-->

    <!--============================   CONTACT PAGE START ==============================-->
    <section id="wsus__contact">
        <div class="container">
            <div class="wsus__contact_area">
                <div class="row">
                    <div class="col-xl-4">
                        <div class="row">

                            @if ($setting->contact_email)
                                <div class="col-xl-12">
                                    <div class="wsus__contact_single">
                                        <i class="fal fa-envelope"></i>
                                        <h5>mail address</h5>
                                        <a href="mailto:{{ $setting->contact_email }}">{{ $setting->contact_email }}</a>
                                        <span><i class="fal fa-envelope"></i></span>
                                    </div>
                                </div>
                            @endif

                            @if ($setting->contact_phone)
                                <div class="col-xl-12">
                                    <div class="wsus__contact_single">
                                        <i class="far fa-phone-alt"></i>
                                        <h5>phone number</h5>
                                        <a href="macallto:{{ $setting->contact_phone }}">{{ $setting->contact_phone }}</a>
                                        <span><i class="far fa-phone-alt"></i></span>
                                    </div>
                                </div>
                            @endif

                            @if ($setting->contact_address)
                                <div class="col-xl-12">
                                    <div class="wsus__contact_single">
                                        <i class="fal fa-map-marker-alt"></i>
                                        <h5>contact address</h5>
                                        <a href="">{{ $setting->contact_address }}</a>
                                        <span><i class="fal fa-map-marker-alt"></i></span>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="col-xl-8">
                        <div class="wsus__contact_question">
                            <h5>Send Us a Message</h5>
                            <form id="contact-form">
                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="wsus__con_form_single">
                                            <input type="text" placeholder="Your Name" name="name">
                                        </div>
                                    </div>
                                    <div class="col-xl-12">
                                        <div class="wsus__con_form_single">
                                            <input type="email" placeholder="Email" name="email">
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="wsus__con_form_single">
                                            <input type="text" placeholder="Phone" name="phone">
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="wsus__con_form_single">
                                            <input type="text" placeholder="Subject" name="subject">
                                        </div>
                                    </div>
                                    <div class="col-xl-12">
                                        <div class="wsus__con_form_single">
                                            <textarea cols="3" rows="5" placeholder="Message" name="message"></textarea>
                                        </div>
                                        <button type="submit" id="submit" class="common_btn">send now</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-xl-12">
                        <div class="wsus__con_map">
                            <iframe src="{{ $setting->map }}" width="1600" height="450" style="border:0;"
                                allowfullscreen="100" loading="lazy"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================    CONTACT PAGE END ==============================-->
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#contact-form').on('submit', function(e) {
                e.preventDefault();
                let data = $(this).serialize();
                $.ajax({
                    data: data,
                    method: 'POST',
                    url: "{{ route('handle-contact-form') }}",
                    beforeSend: function() {
                        $('#submit').text('sending...')
                        $('#submit').attr('disabled', true);
                    },
                    success: function(data) {
                        if (data.status == 'success') {
                            toastr.success(data.message)
                        }
                        $('#contact-form')[0].reset();
                        $('#submit').text('Send now')
                        $('#submit').attr('disabled', false);

                    },
                    error: function(data) {
                        let errors = data.responseJSON.errors;
                        $.each(errors, function(key, value) {
                            toastr.error(value);
                        })
                        $('#submit').text('Send now')
                        $('#submit').attr('disabled', false);


                    }
                })
            })
        })
    </script>
@endpush
