@section('css-library')
<link rel="stylesheet" href="{{ asset('assets/library/sweetalert2/css/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/library/select2/css/select2.min.css') }}">
@endsection

<div>   
    <section class="section">
        <div class="section-header">
            <h1>Material Detail</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Perencanaan</a></div>
                <div class="breadcrumb-item">Material Detail</div>
            </div>
        </div>
        
        <div class="section-body">
            <h2 class="section-title">This is Example Page</h2>
            <p class="section-lead">This page is just an example for you to create your own page.</p>
            <div class="card">
                <div class="card-header">
                    <h4>Example Card</h4>
                </div>
                <div class="card-body">
                    <div class="w-100 mb-4">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAddMaterialDetail">Add</button>
                    </div>
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="text-left" style="width: 25px;" scope="col">#</th>
                                <th class="text-left" scope="col">Code</th>
                                <th class="text-left" scope="col">Nama Material</th>
                                <th class="text-left" scope="col">Satuan</th>
                                <th class="text-left" scope="col">Volume</th>
                                <th class="text-left" scope="col">Harga Satuan</th>
                                <th class="text-left" scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($material_details as $key => $material_detail)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$material_detail->ms_item_code->code}} - {{$material_detail->ms_item_code->nama}}</td>
                                <td>{{$material_detail->nama_material}}</td>
                                <td>{{$material_detail->ms_satuan->satuan}}</td>
                                <td>{{$material_detail->volume}}</td>
                                <td>{{number_format($material_detail->harga_satuan, 0, ',', '.')}}</td>
                                <td> - </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted">Empty</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    
    <div wire:ignore.self class="modal fade" role="dialog" id="modalAddMaterialDetail">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Material Detail</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form wire:submit.prevent="addMaterialDetail">
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label for="input_nama_material">Nama Material</label>
                            <input wire:model.defer="nama_material" type="text" class="form-control" id="input_nama_material" required autocomplete="off">
                        </div>
                        @error('nama_material')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                        <div wire:ignore class="form-group mb-3">
                            <label for="select_code">Code</label>
                            <select id="select_code" class="form-control select2" required>
                                <option></option>
                                @foreach ($ms_codes as $ms_code)
                                <option value="{{$ms_code->id}}">CODE {{$ms_code->code}} - {{$ms_code->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('name')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                        <div class="form-group mb-3">
                            <label for="input_volume">Volume</label>
                            <input wire:model.defer="volume" type="text" class="form-control" id="input_volume" required autocomplete="off">
                        </div>
                        @error('volume')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                        <div class="form-row">
                            <div class="form-group col-md-8">
                                <label for="input_harga_satuan">Harga Satuan</label>
                                <input wire:model.defer="harga_satuan" type="text" class="form-control" id="input_harga_satuan">
                            </div>
                            <div wire:ignore class="form-group col-md-4">
                                <label for="select_satuan">Satuan</label>
                                <select id="select_satuan" class="form-control select2" required>
                                    <option></option>
                                    @foreach ($ms_satuans as $ms_satuan)
                                    <option value="{{$ms_satuan->id}}">{{$ms_satuan->satuan}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @error('harga_satuan')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button wire:loading.class="disabled btn-progress" type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</div>

@push('script')
<script src="{{ asset('assets/library/sweetalert2/js/sweetalert2.min.js') }}"></script>
<script src="{{ asset('assets/library/select2/js/select2.full.min.js') }}"></script>

<script>
    $(document).ready(function() {
        $('#select_code').select2({
            placeholder: 'Pilih Code',
            width: '100%'
        })
        $('#select_satuan').select2({
            placeholder: 'Pilih Satuan',
            width: '100%'
        })
    })
    
    $('#select_code').on('change', function() {
        value = $(this).val();
        Livewire.emit('evSetCode', value);
    })
    
    $('#select_satuan').on('change', function() {
        value = $(this).val();
        Livewire.emit('evSetSatuan', value);
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
