<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <form action="{{ route('websetting.wamessages') }}" method="POST">
                @csrf
                <div class="card-header">
                    <h5>WA Messages Format (Tagihan)</h5>
                    <p>
                        Format Tersedia:
                        <span class="badge bg-secondary">%customer%</span>
                        <span class="badge bg-secondary">%invoices%</span>
                        <span class="badge bg-secondary">%bulantahun%</span>
                        <span class="badge bg-secondary">%nominaltagihan%</span>
                        <span class="badge bg-secondary">%jatuhtempo%</span>
                        <span class="badge bg-secondary">%bankmandiri%</span>
                        <span class="badge bg-secondary">%bankbca%</span>
                        <span class="badge bg-secondary">%bankbri%</span>
                        <span class="badge bg-secondary">%bankbni%</span>
                        <span class="badge bg-secondary">%linkurlpayment%</span>
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
                        <span class="badge bg-secondary">%customer%</span>
                        <span class="badge bg-secondary">%invoices%</span>
                        <span class="badge bg-secondary">%bulantahun%</span>
                        <span class="badge bg-secondary">%metode_bayar%</span>
                        <span class="badge bg-secondary">%tanggalbayar%</span>
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
                        <span class="badge bg-secondary">%customer%</span>
                        <span class="badge bg-secondary">%tanggaldaftar%</span>
                        <span class="badge bg-secondary">%bulantahun%</span>
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
                        <span class="badge bg-secondary">%customer%</span>
                        <span class="badge bg-secondary">%merchantcode%</span>
                        <span class="badge bg-secondary">%provider%</span>
                        <span class="badge bg-secondary">%virtualnumber%</span>
                        <span class="badge bg-secondary">%harga%</span>
                        <span class="badge bg-secondary">%customerfee%</span>
                        <span class="badge bg-secondary">%nominaltagihan%</span>
                        <span class="badge bg-secondary">%statuspayment%</span>
                        <span class="badge bg-secondary">%paybefore%</span>
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
                    <button class="btn btn-primary" type="submit">Update Pelanggan Messages</button>
                </div>
            </form>
        </div>
    </div>
</div>
