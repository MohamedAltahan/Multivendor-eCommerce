<div class="form-group">
    <label for="">Select main Category</label>
    <select name="category_id" class="form-control main-category">
        <option value="">Select main category</option>
        @foreach ($categories as $category)
            <option value="{{ $category->id }} "@selected(old('category_id', $childCategory->category_id) == $category->id)>{{ $category->name }}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="">Select sub Category</label>
    <select name="sub_category_id" class="form-control sub-category">
        <option value="">Select sub category</option>
        @if (isset($subCategories))
            @foreach ($subCategories as $subCategory)
                <option value="{{ $subCategory->id }} "@selected(old('sub_category_id', $subCategory->id) == $childCategory->sub_category_id)>
                    {{ $subCategory->name }}</option>
            @endforeach
        @endif

    </select>
</div>

<div class="form-group">
    <x-form.input name="name" label="Name" class="form-control" value="{{ $childCategory->name }}" />
</div>

<div class="form-group">
    <label for="">status</label>
    <select name="status" class="form-control">
        <option value="active" @selected($childCategory->status == 'active')>Active</option>
        <option value="inactive" @selected($childCategory->status == 'inactive')>Inactive</option>
    </select>
</div>

<button type="submit" class="btn btn-primary">{{ $buttonLabel ?? 'Create' }}</button>

{{-- scripts------------------------------------------------------------------------ --}}
@push('scripts')
    <script>
        $(document).ready(function() {

            $('body').on('change', '.main-category', function(e) {
                let id = $(this).val();
                $.ajax({
                    method: 'GET',
                    url: '{{ route('admin.get-sub-categories') }}',
                    data: {
                        id
                    },
                    success: function(data) {
                        $('.sub-category').html(
                            `<option value="">Select sub category</option>`);
                        $.each(data, function(index, item) {
                            $('.sub-category').append(
                                `<option value="${item.id}">${item.name}</option>`);
                        })
                    },
                    error: function() {
                        alert("e");
                    }
                })
            })
        })
    </script>
@endpush
