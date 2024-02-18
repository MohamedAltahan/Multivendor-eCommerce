@extends('frontend.layout.master')
@section('title')
    {{ $setting->site_name }} - wishlist
@endsection
@section('content')
    <!--============================BREADCRUMB START==============================-->
    <section id="wsus__breadcrumb">
        <div class="wsus_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>wishlist</h4>
                        <ul>
                            <li><a href="#">home</a></li>
                            <li><a href="#">peoduct</a></li>
                            <li><a href="#">wishlist</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================BREADCRUMB END==============================-->


    <!--============================ CART VIEW PAGE START==============================-->
    <section id="wsus__cart_view">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="wsus__cart_list wishlist">
                        <div class="table-responsive">
                            <table>
                                <tbody>
                                    <tr class="d-flex">
                                        <th class="wsus__pro_img">
                                            product item
                                        </th>

                                        <th class="wsus__pro_name" style="width:580px">
                                            product details
                                        </th>

                                        <th class="wsus__pro_status">
                                            quantity
                                        </th>

                                        <th class="wsus__pro_tk">
                                            price
                                        </th>

                                        <th class="wsus__pro_icon">
                                            action
                                        </th>
                                    </tr>
                                    @foreach ($wishlistProducts as $item)
                                        <tr class="d-flex">
                                            <td class="wsus__pro_img"><img
                                                    src="{{ asset('uploads/' . $item->product->firstImage->name) }}"
                                                    alt="product" class="img-fluid w-100">
                                                <a href="{{ route('user.wishlist.destroy', $item->id) }}"><i
                                                        class="far fa-times"></i></a>
                                            </td>

                                            <td class="wsus__pro_name" style="width:580px">
                                                <p>{{ $item->product->name }}</p>
                                            </td>

                                            <td class="wsus__pro_status">
                                                <p>{{ $item->product->quantity }}</p>
                                            </td>

                                            <td class="wsus__pro_tk">
                                                <h6>{{ $setting->currency }}{{ $item->product->price }}</h6>
                                            </td>

                                            <td class="wsus__pro_icon">
                                                <a class="common_btn"
                                                    href="{{ route('show-product-details', $item->product->slug) }}">View
                                                    product</a>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--===========================  CART VIEW PAGE END ==============================-->
@endsection
@push('scripts')
@endpush
