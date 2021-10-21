@section('css-library')
<link rel="stylesheet" href="{{ asset('assets/library/sweetalert2/css/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/library/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/library/bootstrap-daterangepicker/daterangepicker.css') }}">
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
            <h1>Jurnal Harian</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Keuangan</a></div>
                <div class="breadcrumb-item">Jurnal Harian</div>
                <div class="breadcrumb-item">Create</div>
            </div>
        </div>
    </section>
</div>


@push('script')
<script src="{{ asset('assets/library/sweetalert2/js/sweetalert2.min.js') }}"></script>
<script src="{{ asset('assets/library/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/library/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#select_paket').select2({
            placeholder: 'Pilih Paket',
            width: '100%'
        })
    })
    $('#select_paket').on('change', function() {
        value = $(this).val();
        Livewire.emit('evSetPaket', value);
    })
    $('#inputDate').on('change', function (event) {
        Livewire.emit('evSetTanggal', event.target.value);
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
