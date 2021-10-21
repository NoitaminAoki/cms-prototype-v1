@section('css-library')
<link rel="stylesheet" href="{{ asset('assets/library/sweetalert2/css/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/library/select2/css/select2.min.css') }}">
@endsection

@section('css')
<style>
    .custom-checkbox label.custom-control-label {
        cursor: pointer;
    }
</style>
@endsection

<div>
    <section class="section">
        <div class="section-header">
            <h1>Pengajuan Dana</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Keuangan</a></div>
                <div class="breadcrumb-item">Pengajuan Dana</div>
            </div>
        </div>

        <div class="section-body">
            <form wire:submit.prevent="addPengajuanDana">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h4>Konstruksi Proyek</h4>
                            </div>
                            <div class="card-body">
                                <div wire:ignore class="form-group mb-3">
                                    <label for="code">Paket  <small class="text-danger">*</small></label>
                                    <select id="select_paket" class="form-control select2" required>
                                        <option></option>
                                        @foreach ($pakets as $paket)
                                        <option value='{"id": {{$paket->id}}, "sub_divisi_id": {{$paket->sub_divisi_id}}}'>{{$paket->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div wire:ignore class="form-group mb-3">
                                    <label for="code">Item  <small class="text-danger">*</small> <small class="ml-1" wire:loading wire:target="changePaket" style="display: none"><i class="fas fa-circle-notch fa-spin text-primary"></i></small></label>
                                    <select id="select_item" class="form-control select2" required>
                                        <option disabled>Pilih Paket Terlebih Dahulu</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h4>Detail Pengajuan</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group mb-3">
                                    <label>Keterangan</label>
                                    <textarea wire:model.lazy="keterangan_pengajuan" class="form-control" style="height: 64px;"></textarea>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="inputPembuatPengajuan">Pembuat Pengajuan <small class="text-danger">*</small></label>
                                    <input wire:model.lazy="pembuat_pengajuan" class="form-control" id="inputPembuatPengajuan" name="input_pembuat_pengajuan" type="text" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Material Detail</h4>
                                <div class="card-header-action">
                                    <button type="button" data-toggle="modal" data-target="#modalListMaterial" class="btn btn-primary">Add Material</button>
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th class="text-left" style="width: 25px;" scope="col">#</th>
                                            <th class="text-left" scope="col">Nama Material</th>
                                            <th class="text-left" style="width: 150px" scope="col">Jumlah</th>
                                            <th class="text-center" style="width: 150px" scope="col">Sub Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($item_list as $key => $material_detail)
                                        @php
                                        $total_harga_material += $material_detail['harga_satuan']*$material_detail['jumlah'];
                                        @endphp
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$material_detail['nama_material']}}</td>
                                            <td>
                                                <input wire:model.lazy="item_list.{{$key}}.jumlah" class="form-control form-control-sm" type="text">
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-between">
                                                    <span>Rp</span>
                                                    <span>{{number_format($material_detail['harga_satuan']*$material_detail['jumlah'], 0, ',', '.')}}</span>
                                                </div>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="4" class="text-center text-muted">Empty</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                    <tfoot>
                                        <tr class="bg-light">
                                            <th class="text-center" colspan="3">Total</th>
                                            <th>
                                                <div class="d-flex justify-content-between">
                                                    <span>Rp</span>
                                                    <span>{{number_format($total_harga_material, 0, ',', '.')}}</span>
                                                </div>
                                            </th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('keuangan.pengajuan_dana.index') }}" class="btn btn-warning">Back</a>
                            <button wire:loading.class="disabled btn-progress" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>


    <div wire:ignore.self class="modal fade" tabindex="-1" role="dialog" id="modalListMaterial">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">List Material Detail</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-6 mb-3">
                            <label for="">Search</label>
                            <div class="input-group">
                                <input type="text" class="form-control" wire:model.debounce.600ms="material_search" name="material_search" required autocomplete="off">
                                <button wire:click="$set('material_search', '')" class="btn btn-link btn-sm ml-3">Reset</button>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th class="text-left" style="width: 25px;" scope="col">#</th>
                                    <th class="text-left" scope="col">Nama Material</th>
                                    <th class="text-ceneter" style="width:50px;" scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($material_details as $key => $material_detail)
                                <tr>
                                    <td>{{$offset_material+($key+1)}}</td>
                                    <td>{{$material_detail->nama_material}}</td>
                                    <td class="text-center">
                                        <div class="custom-control custom-checkbox">
                                            <input wire:model.defer="material_ids" value="{{$material_detail->id}}" type="checkbox" class="custom-control-input" name="input_radio[]" id="check_box_{{$material_detail->id}}">
                                            <label class="custom-control-label" for="check_box_{{$material_detail->id}}"></label>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted">Empty</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="w-100 mt-4">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-end">
                                @if ($material_page == 1)
                                <li class="page-item disabled">
                                    <button class="page-link" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </button>
                                </li>
                                @else
                                <li class="page-item">
                                    <button id="btn-prev-page" wire:click="goToPage({{$material_page-1}})" onclick="console.log('clicked')" class="page-link" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </button>
                                </li>
                                @endif
                                @for ($i = 1; $i <= $total_material_page; $i++)
                                <li class="page-item {{($i == $material_page)? 'active' : ''}}"><button id="btn_{{$i}}" class="page-link" wire:click="goToPage({{$i}})">{{$i}}</button></li>
                                @endfor
                                @if ($material_page == $total_material_page)
                                <li class="page-item disabled">
                                    <button class="page-link" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                    </button>
                                </li>
                                @else
                                <li class="page-item">
                                    <button id="btn-next-page" wire:click="goToPage({{$material_page+1}})" onclick="console.log('clicked')"  class="page-link" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                    </button>
                                </li>
                                @endif
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button wire:click="addMaterialToList" wire:loading.class="disabled btn-progress" type="button" class="btn btn-primary">Add Material(s)</button>
                </div>
            </div>
        </div>
    </div>
</div>


@push('script')
<script src="{{ asset('assets/library/sweetalert2/js/sweetalert2.min.js') }}"></script>
<script src="{{ asset('assets/library/select2/js/select2.full.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#select_paket').select2({
            placeholder: 'Pilih Paket',
            width: '100%'
        })
        $('#select_item').select2({
            placeholder: 'Pilih Item',
            width: '100%'
        })
    })
    $('#select_paket').on('change', function (e) {
        var data = $(this).select2("val");
        @this.changePaket(data);
    });
    $('#select_item').on('change', function() {
        value = $(this).val();
        Livewire.emit('evSetItem', value);
    })
    document.addEventListener('select2:change', function (event) {
        if(event.detail.data.length > 0) {
            $(event.detail.id).select2().empty();
            $(event.detail.id).select2({
                placeholder: event.detail.placeholder,
                width: '100%',
                data: [
                {
                    "id": "",
                    "text": "",
                    "selected": true
                },
                ...(event.detail.data)
                ]
            });
        } else {
            $(event.detail.id).select2().empty();
            $(event.detail.id).select2({
                placeholder: event.detail.placeholder,
                width: '100%',
                data: [
                {
                    "id": "",
                    "text": "",
                    "selected": true
                },
                {
                    "id": 1,
                    "text": event.detail.text_empty,
                    "disabled": true
                }
                ]
            });
        }
    })

    document.addEventListener('modal:close', function (event) {
        $('.modal').modal('hide');
    })

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
