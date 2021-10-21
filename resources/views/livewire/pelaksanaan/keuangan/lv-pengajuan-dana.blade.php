@section('css-libraries')
<link type="text/css" rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css">
<link rel="stylesheet" href="{{ asset('assets/library/sweetalert2/css/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/library/select2/css/select2.min.css') }}">
@endsection

@section('css')
@endsection

<div>
    <section class="section">
        <div class="section-header">
            <h1>Pengajuan Anggaran Proyek</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('pelaksanaan.index') }}">Pelaksanaan</a></div>
                <div class="breadcrumb-item"><a href="{{ route('pelaksanaan.keuangan.index') }}">Divisi Keuangan</a></div>
            </div>
        </div>
        
        <div class="section-body">
            <div class="row">
                @can('pengajuan-dana add')
                <div class="col-12 mb-4">
                    <button data-toggle="modal" data-target="#modalAddPengajuanDana" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Add</button>
                </div>
                @endcan
                @forelse ($pengajuan_danas as $pengajuan_dana)
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <a href="#" wire:click="setPengajuanDana({{$pengajuan_dana->id}})" data-toggle="modal" data-target="#modalViewPengajuanDana">
                        <div class="card shadow-sm custom-card-folder">
                            <article class="article article-style-b mb-0">
                                <div class="article-header">
                                    <div class="article-image" style="background-image: url({{ route('image.keuangan.pengajuan_dana', ['id'=>$pengajuan_dana->id]) }});">
                                    </div>
                                    <div class="article-badge custom-article-badge w-100">
                                        <div class="article-badge-item text-black custom-bg-transparent-white">{{$pengajuan_dana->image_name}}</div>
                                    </div>
                                </div>
                            </article>
                        </div>
                    </a>
                </div>
                @empty
                <div class="col-12">
                    <div class="card">
                        <div class="card-body text-center">
                            <span>Empty</span>
                        </div>
                    </div>
                </div>
                @endforelse
            </div>
        </div>
    </section>
    
    <div wire:ignore.self class="modal fade" role="dialog" id="modalAddPengajuanDana">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Pengajuan Dana</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form wire:submit.prevent="addPengajuanDana" x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true" x-on:livewire-upload-finish="isUploading = false" x-on:livewire-upload-error="isUploading = false" x-on:livewire-upload-progress="progress = $event.detail.progress">
                    <div class="modal-body">
                        <div wire:ignore class="form-group">
                            <label for="code">Paket</label>
                            <select id="select_paket" class="form-control select2" required>
                                <option></option>
                                @foreach ($pakets as $paket)
                                <option value="{{$paket->id}}">{{$paket->code}} - {{$paket->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="input_date">Tanggal</label>
                            <input wire:model="input_tanggal" type="text" class="form-control form-date" name="input_date" id="input_date" />
                        </div>
                        <div class="form-group">
                            <label>File Excel</label>
                            <input type="file" wire:model="file_excel" class="form-control" id="upload_excel_{{$iteration}}" required>
                        </div>
                        @error('file_excel')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                        <div class="form-group">
                            <label>Image</label>
                            <input type="file" wire:model="file_image" accept="image/*" class="form-control" id="upload_image_{{$iteration}}" required>
                        </div>
                        @error('file_image')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                        <div x-show="isUploading">
                            <progress max="100" class="w-100" x-bind:value="progress"></progress>
                        </div>
                        <div class="w-100">
                            @if ($file_image)
                            Image Preview:
                            <img src="{{ $file_image->temporaryUrl() }}" class="w-100 border shadow">
                            @endif
                        </div>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button wire:loading.class="disabled btn-progress" type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div wire:ignore.self class="modal fade" role="dialog" id="modalViewPengajuanDana">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Pengajuan Dana</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                    <div class="modal-body">
                        <div class="w-100">
                            @if ($selected_pengajuan)
                            <img id="img_id_{{$selected_pengajuan['id']}}" src="{{$selected_url}}" class="w-100 border shadow">
                            @endif
                        </div>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button wire:click="downloadImage" wire:loading.class="disabled btn-progress" type="button" class="btn btn-primary">Download</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@push('script')
<script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src="{{ asset('assets/library/sweetalert2/js/sweetalert2.min.js') }}"></script>
<script src="{{ asset('assets/library/select2/js/select2.full.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#select_paket').select2({
            placeholder: 'Pilih Paket',
            width: '100%'
        })
        $('.form-date').daterangepicker({
            singleDatePicker: true,
            autoApply: true,
        });
    })
    
    $('#select_paket').on('change', function() {
        value = $(this).val();
        Livewire.emit('evSetPaket', value);
    })
    $('.form-date').on('change', function(event) {
        Livewire.emit('evSetInputTanggal', event.target.value);
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
