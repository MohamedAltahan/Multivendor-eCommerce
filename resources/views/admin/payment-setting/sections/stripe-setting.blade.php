<div class="tab-pane fade " id="list-stripe" role="tabpanel" aria-labelledby="list-stripe-list">
    <div class="card border">
        <div class="card-body">
            <form action="{{ route('admin.stripe-setting.update', 1) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="">Stripe status</label>
                    <select name="status" id="" class="form-control ">
                        <option @selected(@$stripeSetting->status == 'enable') value="enable">Enable</option>
                        <option @selected(@$stripeSetting->status == 'disable') value="disable">Disable</option>
                    </select>
                    <x-form.error name='layout' message={{ $message }} />
                </div>

                <div class="form-group">
                    <label for="">Account Mode</label>
                    <select name="mode" id="" class="form-control ">
                        <option @selected(@$stripeSetting->mode == 'sandbox') value="sandbox">Sandbox</option>
                        <option @selected(@$stripeSetting->mode == 'live') value="live">live</option>
                    </select>
                    <x-form.error name='layout' message={{ $message }} />
                </div>

                <div class="form-group">
                    <label for="">Chose your Country</label>
                    <select name="country" id="" class="form-control ">
                        <option value="">Select </option>
                        @foreach (config('setting.country') as $country)
                            <option @selected(@$stripeSetting->country == $country) value="{{ $country }}">{{ $country }}
                            </option>
                        @endforeach
                    </select>
                    <x-form.error name='country' message={{ $message }} />
                </div>

                <div class="form-group">
                    <label for="">Stripe Currency</label>
                    <select name="currency" id="" class="form-control select2">
                        <option value="">Select Currency</option>
                        @foreach (config('setting.currency_list') as $currency => $symbol)
                            <option @selected(@$stripeSetting->currency == $symbol) value="{{ $symbol }}">{{ $currency }}
                                ({{ $symbol }})
                            </option>
                        @endforeach
                    </select>
                    <x-form.error name='currency' message={{ $message }} />
                </div>

                <div class="form-group">
                    <x-form.input class="form-control" name="exchange_rate"
                        label="Currency exchange rate( per {{ $setting->currency }})"
                        value="{{ $stripeSetting->exchange_rate }}" />
                </div>

                <div class="form-group">
                    <x-form.input class="form-control" name="clint_id" label='Stripe clint id'
                        value="{{ $stripeSetting->clint_id }}" />
                </div>

                <div class="form-group">
                    <x-form.input class="form-control" name="secret_key" label='Stripe secret key'
                        value="{{ $stripeSetting->secret_key }}" />
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>
@push('styles')
@endpush
