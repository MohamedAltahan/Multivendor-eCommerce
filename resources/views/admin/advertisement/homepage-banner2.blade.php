<div class="tab-pane fade" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">
    <div class="card border">
        <div class="card-body">

            <div class="row">
                <div class="col-md-6">
                    <label for="status1" style="color: red">show this(Advertise banner) on Home
                        page:</label>
                </div>
                <div class="col-md-1 ">
                    <label class="custom-switch ">
                        <input type="checkbox" name="status" id='status1' data-sectionname="doubleBanner"
                            class="custom-switch-input change-status"
                            {{ @$sectionStatus == 'active' ? 'checked' : '' }}>
                        <span class="custom-switch-indicator"></span>
                    </label>
                </div>
            </div>

            <form action="{{ route('admin.homepage-banner2') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <br>
                <div class="row">
                    <div class="col-md-6">
                        {{-- ========================left banner================== --}}
                        <h5 style="color: rgb(114, 114, 255)">left banner</h5>
                        @method('PUT')

                        <div class="form-group">
                            <x-form.input class="form-control" name="url1" label='Banner Url'
                                value="{{ @$banner2['banner1']['url1'] }}" />
                        </div>

                        <img src="{{ asset('uploads/' . @$banner2['banner1']['banner1']) }}" width="200px"
                            alt="banner-image">

                        <div class="form-group">
                            <x-form.input type="hidden" name="old_banner1" value="" />
                            <x-form.input type="file" class="form-control" name="banner1" label='Banner Image' />
                        </div>
                    </div>

                    <div class="col-md-6">
                        {{-- ========================right banner================== --}}
                        <h5 style="color: rgb(114, 114, 255)">Right banner</h5>
                        @method('PUT')

                        <div class="form-group">
                            <x-form.input class="form-control" name="url2" label='Banner Url'
                                value="{{ @$banner2['banner2']['url2'] }}" />
                        </div>

                        <img src="{{ asset('uploads/' . @$banner2['banner2']['banner2']) }}" width="200px"
                            alt="banner-image">
                        <div class="form-group">
                            <x-form.input type="hidden" name="old_banner2" value="" />
                            <x-form.input type="file" class="form-control" name="banner2" label='Banner Image' />
                        </div>

                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Save settings</button>
            </form>
        </div>
    </div>
</div>
