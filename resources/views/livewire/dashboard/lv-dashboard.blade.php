@section('css-library')
<link rel="stylesheet" href="{{ asset('assets/library/sweetalert2/css/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/library/select2/css/select2.min.css') }}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css" rel="stylesheet">
@endsection

@section('css')
<style>
    .custom-max-w-180 {
        max-width: 180px;
    }
</style>
@endsection

<div>
    <section class="section">
        <div class="section-header">
            <h1>Dashboard</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                  <i class="fas fa-money-bill-wave-alt"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Kas Besar</h4>
                  </div>
                  <div class="card-body">
                    Rp. {{ $kasbesar }}
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                  <i class="fas fa-money-bill-wave-alt"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Kas Kecil</h4>
                  </div>
                  <div class="card-body">
                    12.000.000
                  </div>
                </div>
              </div>
            </div>

    </section>


</div>


@push('script')
@endpush
