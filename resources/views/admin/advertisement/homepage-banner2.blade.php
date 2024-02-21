<div class="tab-pane fade" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">
    <div class="card border">
        <div class="card-body">
            <form action="{{ route('admin.homepage-banner2') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <h5 style="color: rgb(114, 114, 255)">left banner</h5>
                @method('PUT')
                <h6>Status</h6>
                <label class="custom-switch mt-2">
                    <input type="checkbox" name="status1" class="custom-switch-input"
                        {{ @$banner2['banner1']['status1'] == 'on' ? 'checked' : '' }}>
                    <span class="custom-switch-indicator"></span>
                </label>

                <div class="form-group">
                    <x-form.input class="form-control" name="url1" label='Banner Url'
                        value="{{ @$banner2['banner1']['url1'] }}" />
                </div>

                <img src="{{ asset('uploads/' . @$banner2['banner1']['banner1']) }}" width="200px" alt="banner-image">
                <div class="form-group">
                    <x-form.input type="hidden" name="old_banner1" value="" />
                    <x-form.input type="file" class="form-control" name="banner1" label='Banner Image' />
                </div>

                {{-- ========================right banner================== --}}
                <hr>
                <h5 style="color: rgb(114, 114, 255)">Right banner</h5>
                @method('PUT')
                <h6>Status</h6>
                <label class="custom-switch mt-2">
                    <input type="checkbox" name="status2" class="custom-switch-input"
                        {{ @$banner2['banner2']['status2'] == 'on' ? 'checked' : '' }}>
                    <span class="custom-switch-indicator"></span>
                </label>

                <div class="form-group">
                    <x-form.input class="form-control" name="url2" label='Banner Url'
                        value="{{ @$banner2['banner2']['url2'] }}" />
                </div>

                <img src="{{ asset('uploads/' . @$banner2['banner2']['banner2']) }}" width="200px" alt="banner-image">
                <div class="form-group">
                    <x-form.input type="hidden" name="old_banner2" value="" />
                    <x-form.input type="file" class="form-control" name="banner2" label='Banner Image' />
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>
