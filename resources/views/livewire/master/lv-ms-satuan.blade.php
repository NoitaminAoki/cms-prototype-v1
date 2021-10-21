@section('css-library')
<link rel="stylesheet" href="{{ asset('assets/library/sweetalert2/css/sweetalert2.min.css') }}">
@endsection

<div>   
    <section class="section">
        <div class="section-header">
            <h1>Satuan</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Master</a></div>
                <div class="breadcrumb-item">Satuan</div>
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
                        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAddSatuan">Add</button>
                    </div>
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="text-left" style="width: 25px;" scope="col">#</th>
                                <th class="text-left" scope="col">Satuan</th>
                                <th class="text-left" scope="col">Keterangan</th>
                                <th class="text-left" scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($ms_satuans as $key => $ms_satuan)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td> {{$ms_satuan->satuan}} </td>
                                <td> {{$ms_satuan->keterangan}} </td>
                                <td>-</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted">Empty</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    
    <div wire:ignore.self class="modal fade" tabindex="-1" role="dialog" id="modalAddSatuan">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Satuan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form wire:submit.prevent="addSatuan">
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label for="satuan">Satuan<small class="text-danger">*</small></label>
                            <input wire:model.defer="satuan" type="text" class="form-control" name="satuan" required autocomplete="off">
                        </div>
                        @error('satuan')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                        <div class="form-group mb-3">
                            <label for="keterangan">Keterangan</label>
                            <textarea wire:model.defer="keterangan" class="form-control" name="keterangan"></textarea>
                        </div>
                        @error('name')
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
