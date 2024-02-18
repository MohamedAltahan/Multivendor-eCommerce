<script>
    $(document).ready(function() {

        //add product to cart
        $('.shopping-cart-form').on('submit', function(e) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            e.preventDefault();
            let formData = $(this).serialize();
            let _token = "{{ csrf_token() }}"
            $.ajax({
                method: 'POST',
                data: formData,
                url: '{{ route('add-to-cart') }}',
                success: function(data) {
                    if (data.status == 'success') {
                        toastr.success(data.message);
                        getSideCartProducts();
                        getCartCount();
                    } else if (data.status == 'error') {
                        toastr.error(data.message);
                    }
                },
                erorr: function(data) {},
            })
        })

        //remove side cart product===============================================================
        $('#side-cart-remove-product').on('click', function(e) {
            let productId = $(this).data('id');
            $.ajax({
                method: 'POST',
                data: {
                    productId,
                    _token: "{{ csrf_token() }}"
                },
                url: '{{ route('remove-side-cart-product') }}',
                success: function() {
                    let product = $('#product_' + productId)
                    $(product).remove();
                    getSideCartProducts();
                    getCartCount();
                },
                erorr: function(data) {

                },
            })
        })

        //getSideCartProducts===============================================================
        function getSideCartProducts() {
            let _token = "{{ csrf_token() }}"
            $.ajax({
                method: 'GET',
                dataType: "html",
                data: {
                    _token
                },
                url: '{{ route('get-cart-products') }}',
                success: function(data) {
                    $('.side_cart_wrapper').html(data);
                },
                erorr: function(data) {},
            })
        }

        //getCartCount===============================================================
        function getCartCount() {
            $.ajax({
                method: 'GET',
                url: "{{ route('get-cart-count') }}",
                success: function(data) {
                    $('.cart-count-icon').text(data);
                },
                erorr: function(data) {

                },
            })
        }

        //add product to wishlist===============================================
        $('.add_to_wishlist').on('click', function(e) {
            e.preventDefault();
            let product_id = $(this).data('id');
            $.ajax({
                url: "{{ route('user.wishlist.store') }}",
                data: {
                    product_id
                },
                success: function(data) {
                    if (data.status == 'success') {
                        toastr.success(data.message);
                    } else if (data.status == 'error') {
                        toastr.error(data.message);
                    }
                },
                error: function(data) {

                }
            })
        })

    })
</script>
