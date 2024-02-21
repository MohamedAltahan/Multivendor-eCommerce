<div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
    <div class="card border">
        <div class="card-body">
            <form action="{{ route('admin.homepage-banner1') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <h6>Status</h6>

                <label class="custom-switch mt-2">
                    <input type="checkbox" name="status" class="custom-switch-input"
                        {{ @$banner1['banner1']['status'] == 'on' ? 'checked' : '' }}>
                    <span class="custom-switch-indicator"></span>
                </label>

                <div class="form-group">
                    <x-form.input class="form-control" name="url" label='Banner Url'
                        value="{{ @$banner1['banner1']['url'] }}" />
                </div>

                <img src="{{ asset('uploads/' . @$banner1['banner1']['banner']) }}" width="200px" alt="banner-image">
                <div class="form-group">
                    <x-form.input type="hidden" name="old_banner1" value="" />
                    <x-form.input type="file" class="form-control" name="banner" label='Banner Image' />
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>
@push('styles')
@endpush
