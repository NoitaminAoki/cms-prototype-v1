
<div class="main-sidebar">
  <aside id="sidebar-wrapper">
    <div class="sidebar-brand sidebar-gone-show"><a href="index.html">Stisla</a></div>
    <ul class="sidebar-menu">
      <li class="menu-header">Dashboard</li>
      @role('Super Admin')
      <li class="nav-item dropdown {{ \Request::routeIs('perencanaan*') ? 'active' : '' }}">
        <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Perencanaan</span></a>
        <ul class="dropdown-menu">
          <li class="{{ \Request::routeIs('perencanaan.divisi*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('perencanaan.divisi.index') }}">Divisi</a></li>
          <li class="{{ \Request::routeIs('perencanaan.material_detail*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('perencanaan.material_detail.index') }}">Material Detail</a></li>
        </ul>
      </li>
      @endrole
      <li class="nav-item dropdown {{ \Request::routeIs('keuangan*') ? 'active' : '' }}">
        <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Keuangan</span></a>
        <ul class="dropdown-menu">
          @can('kas-besar view')
          <li class="{{ \Request::routeIs('keuangan.kas_besar*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('keuangan.kas_besar.index') }}">Kas Besar</a></li>
          @endcan
          @can('pengajuan-dana view')
          <li class="{{ \Request::routeIs('keuangan.pengajuan_dana*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('keuangan.pengajuan_dana.index') }}">Pengajuan Dana</a></li>
          @endcan
          @can('realisasi-dana view')
          <li class="{{ \Request::routeIs('keuangan.realisasi_dana*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('keuangan.realisasi_dana.index') }}">Realisasi Dana</a></li>
          @endcan
          @can('kwitansi view')
          <li class="{{ \Request::routeIs('keuangan.kwitansi*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('keuangan.kwitansi.index') }}">Kwitansi</a></li>
          @endcan
          @can('jurnal-harian view')
          <li class="{{ \Request::routeIs('keuangan.jurnal_harian*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('keuangan.jurnal_harian.index') }}">Jurnal Harian</a></li>
          @endcan
          @can('jurnal-keuangan view')
          <li class="{{ \Request::routeIs('keuangan.jurnal_keuangan*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('keuangan.jurnal_keuangan.index') }}">Jurnal Keuangan</a></li>
          @endcan
        </ul>
      </li>
      <li class="menu-header">Master</li>
      <li class="{{ \Request::routeIs('master.code*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('master.code.index') }}"><i class="far fa-square"></i> <span>Code</span></a></li>
      <li class="{{ \Request::routeIs('master.satuan*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('master.satuan.index') }}"><i class="far fa-square"></i> <span>Satuan</span></a></li>
      @auth('admin')
      <li class="menu-header">Manage (Admin)</li>
      <li class="{{ \Request::routeIs('admin.manage.roles*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.manage.roles.index') }}"><i class="far fa-square"></i> <span>Roles & Permission</span></a></li>
      <li class="{{ \Request::routeIs('admin.manage.user_roles*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.manage.user_roles.index') }}"><i class="far fa-square"></i> <span>User Roles</span></a></li>
      @endauth
    </ul>
  </aside>
</div>