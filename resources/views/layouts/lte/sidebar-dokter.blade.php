<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
        <!--begin::Sidebar Brand-->
        <div class="sidebar-brand">
          <!--begin::Brand Link-->
          <a href="./index.html" class="brand-link">
            <!--begin::Brand Image-->
            <img
              src="{{ asset('assets/img/logo.png') }}"
              alt="rshp-logo"
              class="brand-image opacity-75 shadow"
            />
            <!--end::Brand Image-->
            <!--begin::Brand Text-->
            <span class="brand-text fw-light">RSHP</span>
            <!--end::Brand Text-->
          </a>
          <!--end::Brand Link-->
        </div>
        <!--end::Sidebar Brand-->
        <!--begin::Sidebar Wrapper-->
        <div class="sidebar-wrapper">
          <nav class="mt-2">
            <!--begin::Sidebar Menu-->
            <ul
              class="nav sidebar-menu flex-column"
              data-lte-toggle="treeview"
              role="navigation"
              aria-label="Main navigation"
              data-accordion="false"
              id="navigation"
            >
              <li class="nav-item">
                <a href="{{ route('dokter.dashboard-dokter') }}" class="nav-link">
                  <i class="nav-icon bi bi-house-fill"></i>
                  <p>Dashboard</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ route('dokter.temu-dokter.index') }}" class="nav-link">
                  <i class="nav-icon bi bi-receipt"></i>
                  <p>Temu Dokter</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ route('dokter.rekam-medis.index') }}" class="nav-link">
                  <i class="nav-icon bi bi-clipboard2-pulse-fill"></i>
                  <p>Rekam Medis</p>
                </a>
              </li>
            <!--end::Sidebar Menu-->
          </nav>
        </div>
        <!--end::Sidebar Wrapper-->
      </aside>