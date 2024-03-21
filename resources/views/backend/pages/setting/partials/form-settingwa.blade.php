<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <form action="{{ route('websetting.wasettings') }}" method="POST">
                @csrf
                <div class="card-header">
                    <h5>WA Setting</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <ul class="list-group list-group-flush">
                            @foreach ($webwa as $waweb)
                                @php
                                    if ($waweb->id == 1) {
                                        $name = 'Notifikasi Tanggal Jatuh Tempo';
                                    } elseif ($waweb->id == 2) {
                                        $name = 'Notifikasi Tagihan 1 Hari Sebelum Jatuh Tempo';
                                    } elseif ($waweb->id == 3) {
                                        $name = 'Notifikasi Tagihan 3 Hari Sebelum Jatuh Tempo';
                                    } elseif ($waweb->id == 4) {
                                        $name = 'Notifikasi Tagihan 7 Hari Sebelum Jatuh Tempo';
                                    } elseif ($waweb->id == 5) {
                                        $name = 'Notifikasi Saat Pelanggan Isolir';
                                    } elseif ($waweb->id == 6) {
                                        $name = 'Notifikasi Saat Pelanggan Baru';
                                    } elseif ($waweb->id == 7) {
                                        $name = 'Notifikasi Saat Pembayaran';
                                    } else {
                                        $name = $waweb->id;
                                    }
                                @endphp


                                <li class="list-group-item">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <p class="mb-1">{{ $name }} :</p>
                                            <p class="text-muted text-sm mb-0">Value Content : {{ $waweb->value }} </p>
                                        </div>
                                        <div class="form-check form-switch p-0">
                                            <input class="form-check-input h4 position-relative m-0" type="checkbox"
                                                role="switch"  name="is_active[{{ $waweb->id }}]" @if ($waweb->is_active == 1) @checked(true) @else @checked(false) @endif">
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="card-footer text-end btn-page">
                    <div class="btn btn-outline-secondary">Cancel</div>
                    <button class="btn btn-primary" type="submit">Update WA Settings</button>
                </div>
            </form>
        </div>
    </div>
</div>
