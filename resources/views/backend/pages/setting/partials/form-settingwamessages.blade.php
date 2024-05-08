<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <form action="{{ route('websetting.wamessages') }}" method="POST">
                @csrf
                <div class="card-header">
                    <h5>WA Messages Format (Tagihan)</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <ul class="list-group list-group-flush">
                            @foreach ($wamessages as $settings)
                                @php
                                    if ($settings->name == 'wa_tagihan') {
                                        $name = 'Tagihan Belum Bayar Messages (Tagihan)';
                                    } elseif ($settings->name == 'wa_terbayar') {
                                        $name = 'Tagihan Terbayar Messages (Lunas)';
                                    }
                                    else {
                                        $name = $settings->name;
                                    }
                                @endphp
                                @if($settings->name == 'wa_tagihan')
                                <li class="list-group-item">
                                    <div>
                                        <p class="mb-1">{{ $name }} :</p>
                                    </div>
                                    <div class="form-check form-switch p-0">
                                        <input type="hidden" name="settings[{{ $settings->id }}]">
                                        <textarea class="form-control" rows="25">{{ $settings->value }}</textarea>
                                    </div>
                                </li>
                                @elseif ($settings->name == 'wa_header_terbayar')
                                <li class="list-group-item">
                                    <div>
                                        <p class="mb-1">{{ $name }} :</p>
                                    </div>
                                    <div class="form-check form-switch p-0">
                                        <input type="hidden" name="settings[{{ $settings->id }}]">
                                        <textarea class="form-control">{{ $settings->value }}</textarea>
                                    </div>
                                </li>
                                @else
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="card-footer text-end btn-page">
                    <div class="btn btn-outline-secondary">Cancel</div>
                    <button class="btn btn-primary" type="submit">Update Tagihan Messages</button>
                </div>
            </form>
        </div>
    </div>
</div>
