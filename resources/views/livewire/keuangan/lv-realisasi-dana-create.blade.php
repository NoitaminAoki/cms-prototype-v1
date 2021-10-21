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
            <h1>Realisasi Dana</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Keuangan</a></div>
                <div class="breadcrumb-item">Realisasi Dana</div>
                <div class="breadcrumb-item">Detail Pengajuan</div>
            </div>
        </div>

        <div class="section-body">
            <form wire:submit.prevent="addRealisasiDana">
                <div class="row">
                    <div class="col-md-6 col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Detail Pengajuan</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <address class="custom-address">
                                                <strong>Divisi</strong><br>
                                                {{$pengajuan_dana->paket->divisi->nama}}
                                            </address>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <address class="custom-address">
                                                <strong>Paket</strong><br>
                                                {{$pengajuan_dana->paket->nama}}
                                            </address>
                                            <h6 class="text-dark"></h6>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <address class="custom-address">
                                                <strong>Item</strong><br>
                                                {{$pengajuan_dana->item->nama}}
                                            </address>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <address class="custom-address">
                                                <strong>Pembuat Pengajuan</strong><br>
                                                {{$pengajuan_dana->pembuat_pengajuan}}
                                            </address>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <address class="custom-address">
                                                <strong>Keterangan</strong><br>
                                                {{$pengajuan_dana->keterangan ?? '-'}}
                                            </address>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Detail Realisasi Dana</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group mb-3">
                                    <label>Keterangan</label>
                                    <textarea wire:model.defer="keterangan_realisasi" class="form-control" style="height: 64px;"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Asal <small class="text-danger">*</small></label>
                                    <input wire:model.defer="asal_realisasi" type="text" class="form-control" required>
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
                                            <th class="text-left" scope="col">Nama Material</th>
                                            <th class="text-left" style="width: 150px" scope="col">Satuan</th>
                                            <th class="text-left" scope="col">Jumlah</th>
                                            <th class="text-center" style="width: 150px" scope="col">Sub Total</th>
                                            <th class="text-center" style="width: 220px" scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    {{-- <tbody x-data="{ materials: @entangle('list_items').defer }">
                                        <template x-for="(material, index) in materials">
                                            <tr>
                                                <td x-text="index+1"></td>
                                                <td x-text="material.nama_material"></td>
                                                <td x-text="material.satuan"></td>
                                                <td x-text="material.jumlah_akhir+'/'+material.jumlah_awal"></td>
                                                <td x-text="material.jumlah_akhir*material.harga_satuan"></td>
                                                <td>

                                                    <div class="input-group input-group-sm">
                                                        <div class="input-group-prepend">
                                                            <button x-on:click="material.jumlah_akhir--" class="btn btn-sm btn-light"><i class="fas fa-minus"></i></button>
                                                        </div>
                                                        <input x-model="material.jumlah_akhir" type="text" class="form-control form-control-sm">
                                                        <div class="input-group-append">
                                                            <button x-on:click="material.jumlah_akhir++" class="btn btn-sm btn-light"><i class="fas fa-plus"></i></button>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </template>
                                    </tbody> --}}
                                    <tbody>
                                        @forelse ($list_items as $key => $material_detail)
                                        @php
                                        $total_harga_material += $material_detail['jumlah_akhir']*$material_detail['harga_satuan'];
                                        @endphp
                                        @if ($material_detail['is_deleted'])
                                        <tr style="background-color: rgb(223, 223, 223);">
                                            <td>{{$key+1}}</td>
                                            <td colspan="4">{{$material_detail['nama_material']}} <span class="text-danger">[deleted]</span></td>
                                            <td class="text-right"><button type="button" wire:click="toggleDeleteMaterial({{$key}})" class="btn btn-sm btn-info"><i class="fas fa-undo-alt"></i></button></td>
                                        </tr>
                                        @else
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$material_detail['nama_material']}}</td>
                                            <td>{{$material_detail['satuan']}}</td>
                                            <td>
                                                @if ($material_detail['jumlah_akhir'] > $material_detail['stock'])
                                                <p class="mb-0">{{$material_detail['jumlah_akhir']}}/{{$material_detail['jumlah_awal']}} <small class="text-danger">[Out of Stock]</small></p>
                                                <span>Available Stock: {{$material_detail['stock']}}</span>
                                                @else
                                                <p class="mb-0">{{$material_detail['jumlah_akhir']}}/{{$material_detail['jumlah_awal']}}</p>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-between">
                                                    <span>Rp</span>
                                                    <span>{{number_format($material_detail['jumlah_akhir']*$material_detail['harga_satuan'], 0, ',', '.')}}</span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex">
                                                    <input wire:model.lazy="list_items.{{$key}}.jumlah_akhir" class="form-control form-control-sm" type="number">
                                                    <button type="button" wire:click="toggleDeleteMaterial({{$key}})" class="btn btn-sm btn-danger ml-4"><i class="fas fa-trash"></i></button>
                                                </div>
                                            </td>
                                        </tr>
                                        @endif
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
                                                    <span>{{number_format($total_harga_material, 0, ',', '.')}}</span>
                                                </div>
                                            </th>
                                            <th></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('keuangan.realisasi_dana.index') }}" type="button" class="btn btn-warning">Cancel</a>
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
