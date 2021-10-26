@section('css-libraries')
@endsection

@section('css')
@endsection

<div>
  <section class="section">
    <div class="section-header">
      <h1>Pelaksanaan</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
        <div class="breadcrumb-item">Pelaksanaan</div>
      </div>
    </div>
    
    <div class="section-body">
      <div class="row">
        <div class="col-12 col-sm-6 col-md-6 col-lg-3">
          <a class="text-decoration-none custom-color-inherit" href="{{ route('pelaksanaan.keuangan.index') }}">
            <div class="card custom-card-folder">
              <div class="card-body">
                <div class="text-center">
                  <i class="fas fa-folder custom-fa-10x custom-bg-folder"></i>
                </div>
                <div class="w-100 mt-2">
                  <h6 class="text-uppercase mb-0">I. Divisi Keuangan</h6>
                </div>
              </div>
            </div>
          </a>
        </div>
        <div class="col-12 col-sm-6 col-md-6 col-lg-3">
          <a class="text-decoration-none custom-color-inherit" href="{{ route('pelaksanaan.konstruksi.index') }}">
            <div class="card custom-card-folder">
              <div class="card-body">
                <div class="text-center">
                  <i class="fas fa-folder custom-fa-10x custom-bg-folder"></i>
                </div>
                <div class="w-100 mt-2">
                  <h6 class="text-uppercase mb-0">II. Divisi Kontruksi</h6>
                </div>
              </div>
            </div>
          </a>
        </div>
        <div class="col-12 col-sm-6 col-md-6 col-lg-3">
          <a class="text-decoration-none custom-color-inherit" href="{{ route('pelaksanaan.marketing.index') }}">
            <div class="card custom-card-folder">
              <div class="card-body">
                <div class="text-center">
                  <i class="fas fa-folder custom-fa-10x custom-bg-folder"></i>
                </div>
                <div class="w-100 mt-2">
                  <h6 class="text-uppercase mb-0">II. Divisi Marketing</h6>
                </div>
              </div>
            </div>
          </a>
        </div>
        <div class="col-12 col-sm-6 col-md-6 col-lg-3">
          <a class="text-decoration-none custom-color-inherit" href="{{ route('pelaksanaan.umum.index') }}">
            <div class="card custom-card-folder">
              <div class="card-body">
                <div class="text-center">
                  <i class="fas fa-folder custom-fa-10x custom-bg-folder"></i>
                </div>
                <div class="w-100 mt-2">
                  <h6 class="text-uppercase mb-0">II. Divisi Umum</h6>
                </div>
              </div>
            </div>
          </a>
        </div>
      </div>
    </div>
  </section>
</div>


@push('script')
@endpush
