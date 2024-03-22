<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <form action="{{ route('websetting.updatetripay') }}" method="POST">
                @csrf
                <div class="card-header">
                    <h5>Tripay Setting</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <ul class="list-group list-group-flush">
                            @foreach ($settingtripay as $settripay)
                                @php
                                    if ($settripay->name == 'tripay_api_key') {
                                        $name = 'Tripay API Key';
                                    } elseif ($settripay->name == 'tripay_api_secret') {
                                        $name = 'Tripay API Secret';
                                    } elseif ($settripay->name == 'tripay_api_debug') {
                                        $name = 'Tripay API Debug';
                                    } elseif ($settripay->name == 'tripay_merchant_code') {
                                        $name = 'Tripay Merchant Code';
                                    } else {
                                        $name = $settripay->name;
                                    }
                                @endphp

                                <li class="list-group-item">
                                    @if ($settripay->name != 'tripay_api_debug')
                                        <div class="form-group">
                                            <label class="form-label">{{ $name }}</label>
                                            <input type="text" name="settings[{{ $settripay->id }}]"
                                                class="form-control" value="{{ $settripay->value }}">
                                        </div>
                                    @else
                                        <div>
                                            <p class="mb-1">{{ $name }} :</p>
                                        </div>
                                        <div class="form-check form-switch p-0">
                                            <input type="hidden" name="settings[{{ $settripay->id }}]" value="off">
                                            <input class="form-check-input h4 position-relative m-0" type="checkbox"
                                                role="switch" name="settings[{{ $settripay->id }}]" value="on"
                                                {{ $settripay->value == 'on' ? 'checked' : '' }}>
                                        </div>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="card-footer text-end btn-page">
                    <div class="btn btn-outline-secondary">Cancel</div>
                    <button class="btn btn-primary" type="submit">Update Tripay Setting</button>
                </div>
            </form>
        </div>
    </div>
</div>
