@extends('layouts.backend.base')

@section('styles')
@endsection

@push('script')
@endpush

@section('isi')
    <div class="col-12">
        <div class="d-flex align-items-center gap-4 mb-4">
            <div class="position-relative">
                <div class="border border-2 border-primary rounded-circle">
                    @if ($user->real_path == null)
                        <img src="{{ asset('back/dist/images/profile/user-1.jpg') }}" class="rounded-circle m-1" width="60"
                            alt="Profile Photo">
                    @else
                        <img src="{{ asset('/' . $user->real_path) }}" class="rounded-circle m-1" width="60"
                            alt="Profile Photo">
                    @endif
                </div>
                @if ($notif != 0)
                    <span
                        class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-primary">{{ $notif }}
                        - Notif<span class="visually-hidden">unread messages</span>
                    </span>
                @else
                @endif
            </div>
            <div>
                <h3 class="fw-semibold">Hi, <span class="text-dark">{{ ucfirst(Auth::user()->name) }}</span>
                </h3>
                <span>{{ ucfirst(Auth::user()->user_type) }} - {{ $date = date('d/M/Y') }}</span>
            </div>
        </div>
    </div>
    <div class="row">
        {{-- Favorit --}}
        <div class="col-lg-12 d-flex align-items-strech">
            <div class="card w-100">
                <div class="card-body p-4">
                    <h5 class="card-title fw-semibold">Produk Favorit</h5>
                    <p class="card-subtitle mb-0">Produk yang Sering Dipesan</p>
                    <div class="owl-carousel collectibles-carousel owl-theme mt-9 owl-rtl owl-loaded owl-drag">

                        <div class="owl-stage-outer">
                            <div class="owl-stage">
                                @foreach ($produkTerlaris as $terlaris)
                                    <div class="owl-item">
                                        <div class="item">
                                            <div class="card overflow-hidden mb-4 mb-md-0 shadow-none border">
                                                <div class="position-relative">
                                                    @if ($terlaris->real_path != null)
                                                        <img src="{{ asset('/' . $terlaris->real_path) }}" alt="user Photo"
                                                            class="img-fluid w-100">
                                                    @else
                                                        <img src="{{ asset('/front/dist/images/produk/no-image-color.png') }}"
                                                            alt="user Photo" class="img-fluid w-100">
                                                    @endif
                                                    {{-- <div class="card-img-overlay">
                                                        <div class="text-end">
                                                            <span class="badge bg-light-dark rounded-pill fs-2">{{ $terlaris->created_at }}</span>
                                                        </div>
                                                    </div> --}}
                                                </div>
                                                <div class="p-9 text-start">
                                                    <h6 class="fw-semibold fs-4">{{ $terlaris->nama_finishing_good }}</h6>
                                                    <div class="d-flex align-items-center mt-3 justify-content-between">
                                                        <h6 class="mb-0">
                                                            <span class="text-dark fw-bold">
                                                                {{ $terlaris->total_quantity }} Krg
                                                            </span>
                                                        </h6>
                                                        <div class="fs-3">Terjual</div>
                                                    </div>
                                                    <a href="{{ route('order.create') }}"
                                                        class="btn btn-primary w-100 mt-3">Order Now</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="owl-nav disabled" id="owl-nav">
                            <button type="button" aria-hidden="true" title="prev" role="presentation" class="owl-prev">
                                <span aria-label="Previous"> ‹ </span>
                            </button>
                            <button type="button" aria-hidden="true" title="next" role="presentation" class="owl-next">
                                <span aria-label="Next"> › </span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Order Status --}}
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div class="d-md-flex align-items-center mb-9">
                        <div>
                            <h5 class="card-title fw-semibold">Order Status</h5>
                            <p class="card-subtitle">Order yang Sedang Diproses dan Dikirim</p>
                        </div>
                        <div class="ms-auto mt-4 mt-md-0">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#home" role="tab">
                                        <span>Proses</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#profile" role="tab">
                                        <span>Dikirim</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Tab panes -->
                    <div class="tab-content mt-3">
                        <div class="tab-pane active" id="home" role="tabpanel">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0 text-nowrap" id="order_view">
                                    <tbody>
                                        @foreach ($orderProses as $proses)
                                            @php
                                                $jumlahItem = \App\Models\OrderItem::where('order_id', $proses->id)
                                                    ->get()
                                                    ->count();
                                            @endphp
                                            <tr>
                                                <td class="ps-0">
                                                    <div class="d-flex align-items-center gap-3">
                                                        {{-- <div class="flex-shrink-0">
                                                            <img src="{{ asset('/front/dist/images/produk/no-image-color.png') }}"
                                                                style="border-radius: 10px; width: 50px;" alt="user Photo">
                                                        </div> --}}
                                                        <div>
                                                            <h6 class="mb-0 fw-semibold">
                                                                Sales Order
                                                            </h6>
                                                            <span class="fs-2">OR-00{{ $proses->id }}</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="ps-0">
                                                    <h6 class="mb-0">{{ $jumlahItem }} produk</h6>
                                                </td>
                                                <td class="ps-0">
                                                    <span
                                                        class="mb-0">{{ \Carbon\Carbon::parse($proses->created_at)->format('d/M/Y') }}</span>
                                                </td>
                                                <td class="ps-0">
                                                    <span class="mb-1 badge rounded-pill bg-primary">
                                                        Proses
                                                    </span>
                                                </td>
                                                <td class="ps-0">
                                                    <a href="{{ route('order.show', $proses->uuid) }}"
                                                        class="btn btn-dark btn-sm"><i class="fa fa-eye"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="tab-pane" id="profile" role="tabpanel">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0 text-nowrap">
                                    <tbody>
                                        @foreach ($orderDikirim as $kirim)
                                            @php
                                                $jumlahItem = \App\Models\OrderItem::where('order_id', $kirim->id)
                                                    ->get()
                                                    ->count();
                                            @endphp
                                            <tr>
                                                {{-- <td class="ps-0">
                                                    <div class="d-flex align-items-center gap-3">
                                                        <div>
                                                            <h6 class="mb-0 fw-semibold">
                                                                {{ $kirim->product->nama_finishing_good }}
                                                            </h6>
                                                            <span class="fs-2">OR-00{{ $kirim->order_id }}</span>
                                                        </div>
                                                    </div>
                                                </td> --}}
                                                <td class="ps-0">
                                                    <div class="d-flex align-items-center gap-3">
                                                        {{-- <div class="flex-shrink-0">
                                                            <img src="{{ asset('/front/dist/images/produk/no-image-color.png') }}"
                                                                style="border-radius: 10px; width: 50px;"
                                                                alt="user Photo">
                                                        </div> --}}
                                                        <div>
                                                            <h6 class="mb-0 fw-semibold">
                                                                Sales Order
                                                            </h6>
                                                            <span class="fs-2">OR-00{{ $kirim->id }}</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="ps-0">
                                                    <h6 class="mb-0">{{ $jumlahItem }} produk</h6>
                                                </td>
                                                <td class="ps-0">
                                                    <span
                                                        class="mb-0">{{ \Carbon\Carbon::parse($kirim->created_at)->format('d/M/Y') }}</span>
                                                </td>
                                                <td class="ps-0">
                                                    @if ($kirim->status == 1)
                                                        <span class="mb-1 badge rounded-pill bg-warning">
                                                            Dikirim
                                                        </span>
                                                    @elseif ($kirim->status == 2)
                                                        <span class="mb-1 badge rounded-pill bg-secondary">
                                                            Dikirim
                                                        </span>
                                                    @else
                                                    @endif
                                                </td>
                                                <td class="ps-0">
                                                    <a href="{{ route('order.show', $kirim->uuid) }}"
                                                        class="btn btn-dark btn-sm"><i class="fa fa-eye"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
