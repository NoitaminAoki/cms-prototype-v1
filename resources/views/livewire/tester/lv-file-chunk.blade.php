@section('title-page', ' - '. $page_attribute['title'])
@section('css-libraries')
<link rel="stylesheet" href="{{ asset('assets/library/sweetalert2/css/sweetalert2.min.css') }}">
@endsection

@section('css')
@endsection

<div>
    <section class="section">
        <div class="section-header">
            <h1>{{$page_attribute['title']}}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('perencanaan.index') }}">Perencanaan</a></div>
                <div class="breadcrumb-item">{{$page_attribute['title']}}</div>
            </div>
        </div>
        
        <div class="section-body">
            <div class="row">
                <div class="col-12 mb-4">
                    <button data-toggle="modal" data-target="#modalAddItem" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Add</button>
                </div>
            </div>
        </div>
    </section>
    
    <div wire:ignore.self class="modal fade" role="dialog" id="modalAddItem">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{$page_attribute['title']}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form wire:submit.prevent="addItem" x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true" x-on:livewire-upload-finish="isUploading = false" x-on:livewire-upload-error="isUploading = false" x-on:livewire-upload-progress="progress = $event.detail.progress">
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label for="input_date">Tanggal</label>
                            <input wire:model="input_tanggal" type="text" class="form-control form-date" name="input_date" id="input_date" />
                        </div>
                        @error('input_tanggal')
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
                            <button type="button" id="browseFile" class="btn btn-sm btn-primary">Upload</button>
                        </div>
                        <div class="w-100">
                            <div  style="display: none" class="progress mt-3" style="height: 25px">
                                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%; height: 100%">75%</div>
                            </div>
                        </div>
                        <div class="w-100">
                            <img id="imagePreview" src="" class="w-100 border shadow">
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
</div>


@push('script')
<script src="{{ asset('assets/library/sweetalert2/js/sweetalert2.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/resumablejs@1.1.0/resumable.min.js"></script>
<script>
    // let browseFile = $('#browseFile');
    let resumable = new Resumable({
        target: "{{ route('files.upload') }}",
        query:{_token:'{{ csrf_token() }}'} ,// CSRF token
        fileType: ['jpg', 'jpeg', 'png'],
        chunkSize: 5*1024*1024, // default is 1*1024*1024, this should be less than your maximum limit in php.ini
        headers: {
            'Accept' : 'application/json'
        },
        testChunks: false,
        throttleProgressCallbacks: 1,
    });
    
    resumable.assignBrowse(document.getElementById('browseFile'));
    
    resumable.on('fileAdded', function (file) { // trigger when file picked
        console.log("Phase 1");
        showProgress();
        resumable.upload() // to actually start uploading.
    });
    
    resumable.on('fileProgress', function (file) { // trigger when file progress update
        console.log("Phase 2: " + Math.floor(file.progress() * 100));
        updateProgress(Math.floor(file.progress() * 100));
    });
    
    resumable.on('fileSuccess', function (file, response) { // trigger when file upload complete
        console.log("Phase 3");
        response = JSON.parse(response)
        $('#imagePreview').attr('src', response.path);
    });
    
    resumable.on('fileError', function (file, response) { // trigger when there is any error
        console.log("Phase 4");
        alert('file uploading error.')
    });
    
    
    let progress = $('.progress');
    
    function showProgress() {
        progress.find('.progress-bar').css('width', '0%');
        progress.find('.progress-bar').html('0%');
        progress.find('.progress-bar').removeClass('bg-success');
        progress.show();
    }
    
    function updateProgress(value) {
        progress.find('.progress-bar').css('width', `${value}%`)
        progress.find('.progress-bar').html(`${value}%`)
    }
    
    function hideProgress() {
        progress.hide();
    }
</script>
@endpush
