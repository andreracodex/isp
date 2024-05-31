<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <form action="{{ route('websetting.wamessages') }}" method="POST">
                @csrf
                <div class="card-header">
                    <h5>WA Messages Format (Tagihan)</h5>
                    <p>
                        Format Tersedia:
                        <span class="badge bg-dark">%customer%</span>
                        <span class="badge bg-dark">%invoices%</span>
                        <span class="badge bg-dark">%bulantahun%</span>
                        <span class="badge bg-dark">%nominaltagihan%</span>
                        <span class="badge bg-dark">%jatuhtempo%</span>
                        <span class="badge bg-dark">%bankmandiri%</span>
                        <span class="badge bg-dark">%bankbca%</span>
                        <span class="badge bg-dark">%bankbri%</span>
                        <span class="badge bg-dark">%bankbni%</span>
                        <span class="badge bg-dark">%linkurlpayment%</span>
                    </p>
                    <p>
                        Format Utama:
                        <span class="badge bg-danger">%aliasperusahaan%</span>
                        <span class="badge bg-danger">%namaperusahaan%</span>
                        <span class="badge bg-danger">%alamatperusahaan%</span>
                        <span class="badge bg-danger">%phone%</span>
                        <span class="badge bg-danger">%phonealternate%</span>
                        <span class="badge bg-danger">%urlperusahaan%</span>
                    </p>
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
                                    } elseif ($settings->name == 'wa_pelanggan') {
                                        $name = 'Customer Baru Messages';
                                    } elseif ($settings->name == 'wa_payment'){
                                        $name = 'Payment Virtual Account Messages';
                                    } else {
                                        $name = $settings->name;
                                    }
                                @endphp
                                @if ($settings->name == 'wa_tagihan')
                                    <li class="list-group-item">
                                        <div>
                                            <p class="mb-1">{{ $name }} :</p>
                                        </div>
                                        <div class="form-check form-switch p-0">
                                            {{-- <textarea class="form-control" rows="25">{{ $settings->value }}</textarea> --}}
                                            <textarea name="settings[{{ $settings->id }}]" id="editor">{!! $settings->value !!}</textarea>
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
    <div class="col-lg-6">
        <div class="card">
            <form action="{{ route('websetting.wamessages') }}" method="POST">
                @csrf
                <div class="card-header">
                    <h5>WA Messages Format (Terbayar)</h5>
                    <p>
                        Format Tersedia:
                        <span class="badge bg-dark">%customer%</span>
                        <span class="badge bg-dark">%invoices%</span>
                        <span class="badge bg-dark">%bulantahun%</span>
                        <span class="badge bg-dark">%metode_bayar%</span>
                        <span class="badge bg-dark">%tanggalbayar%</span>
                    </p>
                    <p>
                        Format Utama:
                        <span class="badge bg-danger">%aliasperusahaan%</span>
                        <span class="badge bg-danger">%namaperusahaan%</span>
                        <span class="badge bg-danger">%alamatperusahaan%</span>
                        <span class="badge bg-danger">%phone%</span>
                        <span class="badge bg-danger">%phonealternate%</span>
                        <span class="badge bg-danger">%urlperusahaan%</span>
                    </p>
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
                                    } elseif ($settings->name == 'wa_pelanggan') {
                                        $name = 'Customer Baru Messages';
                                    } elseif ($settings->name == 'wa_payment'){
                                        $name = 'Payment Virtual Account Messages';
                                    } else {
                                        $name = $settings->name;
                                    }
                                @endphp
                                @if ($settings->name == 'wa_terbayar')
                                    <li class="list-group-item">
                                        <div>
                                            <p class="mb-1">{{ $name }} :</p>
                                        </div>
                                        <div class="form-check form-switch p-0">
                                            {{-- <textarea class="form-control">{{ $settings->value }}</textarea> --}}
                                            <textarea name="settings[{{ $settings->id }}]" id="editor2">{!! $settings->value !!}</textarea>
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
                    <button class="btn btn-primary" type="submit">Update Terbayar Messages</button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card">
            <form action="{{ route('websetting.wamessages') }}" method="POST">
                @csrf
                <div class="card-header">
                    <h5>WA Messages Format (Pelanggan)</h5>
                    <p>
                        Format Tersedia:
                        <span class="badge bg-dark">%customer%</span>
                        <span class="badge bg-dark">%tanggaldaftar%</span>
                        <span class="badge bg-dark">%bulantahun%</span>
                    </p>
                    <p>
                        Format Utama:
                        <span class="badge bg-danger">%aliasperusahaan%</span>
                        <span class="badge bg-danger">%namaperusahaan%</span>
                        <span class="badge bg-danger">%alamatperusahaan%</span>
                        <span class="badge bg-danger">%phone%</span>
                        <span class="badge bg-danger">%phonealternate%</span>
                        <span class="badge bg-danger">%urlperusahaan%</span>
                    </p>
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
                                    } elseif ($settings->name == 'wa_pelanggan') {
                                        $name = 'Customer Baru Messages';
                                    } elseif ($settings->name == 'wa_payment'){
                                        $name = 'Payment Virtual Account Messages';
                                    } else {
                                        $name = $settings->name;
                                    }
                                @endphp
                                @if ($settings->name == 'wa_pelanggan')
                                    <li class="list-group-item">
                                        <div>
                                            <p class="mb-1">{{ $name }} :</p>
                                        </div>
                                        <div class="form-check form-switch p-0">
                                            {{-- <textarea class="form-control">{{ $settings->value }}</textarea> --}}
                                            <textarea name="settings[{{ $settings->id }}]" id="editor3">{!! $settings->value !!}</textarea>
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
                    <button class="btn btn-primary" type="submit">Update Pelanggan Messages</button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card">
            <form action="{{ route('websetting.wamessages') }}" method="POST">
                @csrf
                <div class="card-header">
                    <h5>WA Messages Pembayaran Tripay (Virtual Account)</h5>
                    <p>
                        Format Tersedia:
                        <span class="badge bg-dark">%customer%</span>
                        <span class="badge bg-dark">%merchantcode%</span>
                        <span class="badge bg-dark">%provider%</span>
                        <span class="badge bg-dark">%virtualnumber%</span>
                        <span class="badge bg-dark">%harga%</span>
                        <span class="badge bg-dark">%customerfee%</span>
                        <span class="badge bg-dark">%merchantfee%</span>
                        <span class="badge bg-dark">%nominaltagihan%</span>
                        <span class="badge bg-dark">%statuspayment%</span>
                        <span class="badge bg-dark">%paybefore%</span>
                        <span class="badge bg-dark">%carabayar%</span>
                        <span class="badge bg-dark">%checkout%</span>
                    </p>
                    <p>
                        Format Utama:
                        <span class="badge bg-danger">%aliasperusahaan%</span>
                        <span class="badge bg-danger">%namaperusahaan%</span>
                        <span class="badge bg-danger">%alamatperusahaan%</span>
                        <span class="badge bg-danger">%phone%</span>
                        <span class="badge bg-danger">%phonealternate%</span>
                        <span class="badge bg-danger">%urlperusahaan%</span>
                    </p>
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
                                    } elseif ($settings->name == 'wa_pelanggan') {
                                        $name = 'Customer Baru Messages';
                                    } elseif ($settings->name == 'wa_payment'){
                                        $name = 'Payment Virtual Account Messages';
                                    } else {
                                        $name = $settings->name;
                                    }
                                @endphp
                                @if ($settings->name == 'wa_payment')
                                    <li class="list-group-item">
                                        <div>
                                            <p class="mb-1">{{ $name }} :</p>
                                        </div>
                                        <div class="form-check form-switch p-0">
                                            {{-- <textarea class="form-control">{{ $settings->value }}</textarea> --}}
                                            <textarea name="settings[{{ $settings->id }}]" id="editor4">{!! $settings->value !!}</textarea>
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
                    <button class="btn btn-primary" type="submit">Update VA Tripay Messages</button>
                </div>
            </form>
        </div>
    </div>
</div>
