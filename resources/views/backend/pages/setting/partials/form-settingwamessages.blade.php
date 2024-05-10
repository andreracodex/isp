<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <form action="{{ route('websetting.wamessages') }}" method="POST">
                @csrf
                <div class="card-header">
                    <h5>WA Messages Format (Tagihan)</h5>
                    <p>
                        Format Tersedia:
                        <span class="badge bg-secondary">_customer_</span>
                        <span class="badge bg-secondary">_invoices_</span>
                        <span class="badge bg-secondary">_bulantahun_</span>
                        <span class="badge bg-secondary">_nominaltagihan_</span>
                        <span class="badge bg-secondary">_jatuhtempo_</span>
                        <span class="badge bg-secondary">_bankmandiri_</span>
                        <span class="badge bg-secondary">_bankbca_</span>
                        <span class="badge bg-secondary">_bankbri_</span>
                        <span class="badge bg-secondary">_bankbni_</span>
                        <span class="badge bg-secondary">_linkurlpayment_</span>
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
                        <span class="badge bg-secondary">_customer_</span>
                        <span class="badge bg-secondary">_invoices_</span>
                        <span class="badge bg-secondary">_bulantahun_</span>
                        <span class="badge bg-secondary">_metode_bayar_</span>
                        <span class="badge bg-secondary">_tanggalbayar_ </span>
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
</div>
