@section('css-library')
<link rel="stylesheet" href="{{ asset('assets/library/sweetalert2/css/sweetalert2.min.css') }}">
@endsection

<div>
    <section class="section">
        <div class="section-header">
            <h1>Kwitansi</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Keuangan</a></div>
                <div class="breadcrumb-item">Kwitansi</div>
            </div>
        </div>

        <div class="section-body">
            @if (session()->has('success'))
            <div class="alert alert-primary alert-dismissible show fade">
                <div class="alert-body">
                    <button class="close" data-dismiss="alert">
                        <span>×</span>
                    </button>
                    {{session('success')}}
                </div>
            </div>
            @endif
            <div x-data="{ show_content: @entangle('show_modal') }" class="row">
                <div x-show="!show_content" class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Table Kwitansi</h4>
                        </div>
                        <div class="card-body">
                            <div class="w-100 mb-4">
                                <a href="{{ route('keuangan.kwitansi.create') }}" class="btn btn-primary">Buat Kwitansi</a>
                            </div>
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">ID</th>
                                        <th scope="col">Penerima</th>
                                        <th scope="col">Penanggung Jawab</th>
                                        <th style="width: 200px;" scope="col">Total</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($kwitansis as $key => $kwitansi)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$kwitansi->format_code}}</td>
                                        <td>{{$kwitansi->penerima}}</td>
                                        <td>{{$kwitansi->penanggung_jawab}}</td>
                                        <td>
                                            <div class="d-flex justify-content-between">
                                                <span>Rp</span>
                                                <span>{{number_format($kwitansi->total_jumlah, 0, ',', '.')}}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <button wire:click="setKwitansi({{$kwitansi->id}})" wire:target="setKwitansi({{$kwitansi->id}})" wire:loading.class="disabled btn-progress" class="btn btn-sm btn-primary"><i class="fas fa-search"></i></button>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted">Empty</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div x-show="show_content" class="col-12">
                    <div class="row">
                        <div class="col-12 mb-4">
                            <button x-on:click="show_content = false" class="btn btn-warning">Back</button>
                        </div>
                        <div class="col-md-12">
                            <div class="card card-primary border-left border-bottom border-right shadow-none">
                                <div class="card-header">
                                    <h4>Detail Kwitansi</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4 col-sm-6">
                                            <div class="form-group">
                                                <address class="custom-address">
                                                    <strong>Kwitansi ID</strong><br>
                                                    {{$selected_kwitansi->format_code ?? '-'}}
                                                </address>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <div class="form-group">
                                                <address class="custom-address">
                                                    <strong>Penerima</strong><br>
                                                    {{$selected_kwitansi->penerima ?? '-'}}
                                                </address>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <div class="form-group">
                                                <address class="custom-address">
                                                    <strong>Penanggung Jawab</strong><br>
                                                    {{$selected_kwitansi->penanggung_jawab ?? '-'}}
                                                </address>
                                                <h6 class="text-dark"></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card card-primary border-left border-bottom border-right shadow-none">
                        <div class="card-header">
                            <h4>Realisasi Dana</h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-left" style="width: 25px;" scope="col">#</th>
                                        <th class="text-left" scope="col">Realisasi ID</th>
                                        <th class="text-left" scope="col">Paket</th>
                                        <th class="text-left" scope="col">Item</th>
                                        <th class="text-center" style="width: 180px" scope="col">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($realisasi_dana_kwitansi as $key => $realisasi_dana)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$realisasi_dana->format_code}}</td>
                                        <td>{{$realisasi_dana->pengajuan->paket->code}} - {{$realisasi_dana->pengajuan->paket->nama}}</td>
                                        <td>{{$realisasi_dana->pengajuan->item->nama}}</td>
                                        <td>
                                            <div class="d-flex justify-content-between">
                                                <span>Rp</span>
                                                <span>{{number_format($realisasi_dana->jumlah, 0, ',', '.')}}</span>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted">Empty</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                                <tfoot>
                                    <tr class="bg-light">
                                        <th class="text-center" colspan="4">Total</th>
                                        <th>
                                            <div class="d-flex justify-content-between">
                                                <span>Rp</span>
                                                <span>{{number_format($selected_kwitansi->total_jumlah ?? 0, 0, ',', '.')}}</span>
                                            </div>
                                        </th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


@push('script')
<script src="{{ asset('assets/library/sweetalert2/js/sweetalert2.min.js') }}"></script>

@if (session()->has('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Success!',
        text: "{{session('success')}}",
    });
</script>
@endif
<script>

    document.addEventListener('notification:success', function (event) {
        $('.modal').modal('hide');

        setTimeout(function() {
            Swal.fire({
                icon: 'success',
                title: event.detail.title,
                text: event.detail.message,
            });
        }, 600);
    })
</script>
@endpush
