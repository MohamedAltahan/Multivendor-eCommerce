<div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
    <div class="card border">
        <div class="card-body">
            <form action="{{ route('admin.homepage-banner1') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <h6>Status</h6>

                <div class="div form-group">
                    <select name="status" class="form-control">
                        <option @selected(@$banner1['banner1']['status'] == 'on' ? 'selected' : '') value="on">ON</option>
                        <option @selected(@$banner1['banner1']['status'] == 'off' ? 'selected' : '') value="off">OFF</option>
                    </select>
                </div>

                <div class="form-group">
                    <x-form.input class="form-control" name="url" label='Banner Url'
                        value="{{ @$banner1['banner1']['url'] }}" />
                </div>

                <img src="{{ asset('uploads/' . @$banner1['banner1']['banner']) }}" width="200px" alt="banner-image">
                <div class="form-group">
                    <x-form.input type="hidden" name="old_banner1" value="" />
                    <x-form.input type="file" class="form-control" name="banner" label='Banner Image' />
                </div>

                <button type="submit" class="btn btn-primary">Save settings</button>
            </form>
        </div>
    </div>
</div>
@push('styles')
@endpush
