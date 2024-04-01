<div class="tab-pane fade" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
    <div class="card border">
        <div class="card-body">
            <form action="{{ route('admin.paypal-setting.update', 1) }}" method="POST">
                @csrf
                @method('PUT')


                <div class="form-group">
                    <label for="">Paypal status</label>
                    <select name="status" id="" class="form-control ">
                        <option @selected(@$paypalSetting->status == 'enable') value="enable">Enable</option>
                        <option @selected(@$paypalSetting->status == 'disable') value="disable">Disable</option>
                    </select>
                    <x-form.error name='layout' message={{ $message }} />
                </div>

                <div class="form-group">
                    <label for="">Account Mode</label>
                    <select name="mode" id="" class="form-control ">
                        <option @selected(@$paypalSetting->mode == 'sandbox') value="sandbox">Sandbox</option>
                        <option @selected(@$paypalSetting->mode == 'live') value="live">live</option>
                    </select>
                    <x-form.error name='layout' message={{ $message }} />
                </div>

                <div class="form-group">
                    <label for="">Chose your Country</label>
                    <select name="country" id="" class="form-control ">
                        <option value="">Select </option>
                        @foreach (config('setting.country') as $country)
                            <option @selected(@$paypalSetting->country == $country) value="{{ $country }}">{{ $country }}
                            </option>
                        @endforeach
                    </select>
                    <x-form.error name='country' message={{ $message }} />
                </div>

                <div class="form-group">
                    <label for="">Paypal Currency</label>
                    <select name="currency" id="" class="form-control ">
                        <option value="">Select Currency</option>
                        @foreach (config('setting.currency_list') as $currency => $symbol)
                            <option @selected(@$paypalSetting->currency == $symbol) value="{{ $symbol }}">{{ $currency }}
                                ({{ $symbol }})
                            </option>
                        @endforeach
                    </select>
                    <x-form.error name='currency' message={{ $message }} />
                </div>

                <div class="form-group">
                    <x-form.input class="form-control" name="exchange_rate"
                        label="Currency exchange rate( per {{ $setting->currency }})"
                        value="{{ $paypalSetting->exchange_rate }}" />
                </div>

                <div class="form-group">
                    <x-form.input class="form-control" name="clint_id" label='Paypal clint id'
                        value="{{ $paypalSetting->clint_id }}" />
                </div>

                <div class="form-group">
                    <x-form.input class="form-control" name="secret_key" label='Paypal secret key'
                        value="{{ $paypalSetting->secret_key }}" />
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>
@push('styles')
@endpush
