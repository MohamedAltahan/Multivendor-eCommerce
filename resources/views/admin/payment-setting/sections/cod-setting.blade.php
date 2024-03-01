<div class="tab-pane fade  show active" id="list-messages" role="tabpanel" aria-labelledby="list-messages-list">
    <div class="card border">
        <div class="card-body">
            <form action="{{ route('admin.cod-setting.update', 1) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="">COD status</label>
                    <select name="status" id="" class="form-control ">
                        <option @selected(@$codSetting->status == 'enable') value="enable">Enable</option>
                        <option @selected(@$codSetting->status == 'disable') value="disable">Disable</option>
                    </select>
                    <x-form.error name='layout' message={{ $message }} />
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>
