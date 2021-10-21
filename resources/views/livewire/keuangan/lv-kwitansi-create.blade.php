@section('css-library')
<link rel="stylesheet" href="{{ asset('assets/library/sweetalert2/css/sweetalert2.min.css') }}">
@endsection

@section('css')
<style>
    .input-group-sm>.input-group-append>.input-group-text {
        height: 31px;
    }
    .custom-address>strong {
        color: #191d21 !important;
    }
</style>
@endsection

<div>
    <section class="section">
        <div class="section-header">
            <h1>Kwitansi</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Keuangan</a></div>
                <div class="breadcrumb-item">Kwitansi</div>
                <div class="breadcrumb-item">Create</div>
            </div>
        </div>

        <div class="section-body">
            <form wire:submit.prevent="addKwitansi">
                <div class="row">
                    <div class="col-md-6 col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Detail Kwitansi</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group mb-3">
                                    <label>Penerima <small class="text-danger">*</small></label>
                                    <input wire:model.defer="penerima_kwitansi" type="text" class="form-control" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label>Penanggung jawab <small class="text-danger">*</small></label>
                                    <input wire:model.defer="penanggung_jawab" type="text" class="form-control" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Material Detail</h4>
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
                                            <th class="text-center" style="width: 80px" scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($list_items as $key => $realisasi_dana)
                                        @php
                                        $total_harga += $realisasi_dana['total_harga'];
                                        @endphp
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$realisasi_dana['format_code']}}</td>
                                            <td>{{$realisasi_dana['paket']}}</td>
                                            <td>{{$realisasi_dana['item']}}</td>
                                            <td>
                                                <div class="d-flex justify-content-between">
                                                    <span>Rp</span>
                                                    <span>{{number_format($realisasi_dana['total_harga'], 0, ',', '.')}}</span>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <div class="custom-control custom-checkbox">
                                                    <input wire:model.defer="realisasi_ids" value="{{$realisasi_dana['id']}}" type="checkbox" class="custom-control-input" name="input_radio[]" id="check_box_{{$realisasi_dana['id']}}">
                                                    <label class="custom-control-label" for="check_box_{{$realisasi_dana['id']}}"></label>
                                                </div>
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
                    <div class="col-12">
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('keuangan.kwitansi.index') }}" type="button" class="btn btn-warning">Cancel</a>
                            <button wire:loading.class="disabled btn-progress" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>


@push('script')
<script src="{{ asset('assets/library/sweetalert2/js/sweetalert2.min.js') }}"></script>
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
