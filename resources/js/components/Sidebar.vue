<template>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a href="#" class="brand-link">
            <img
             src="https://adminlte.io/themes/v3/dist/img/AdminLTELogo.png"
              alt="Logo" class="brand-image elevation-3"
              style="opacity: .8"
              >
            <span class="brand-text font-weight-light">HKR</span>
        </a>
        <div class="sidebar">
            <nav class="mt-2">
                <ul
                  class="nav nav-pills nav-sidebar flex-column"
                  data-widget="treeview" role="menu"
                  data-accordion="false"
                  >
                    <li class="nav-item">
                        <router-link  class="nav-link" exact :to="{name:'home'}" >
                            <i class="nav-icon fas fa-home"></i>
                            <p>Home</p>
                        </router-link>
                    </li>
                    <li class=nav-header>Master</li>
                    <li class="nav-item">
                        <router-link  class="nav-link" exact :to="{name:'karyawan'}" >
                            <i class="nav-icon fas fa-users"></i>
                            <p>Karyawan</p>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link  class="nav-link" exact :to="{name:'tim'}" >
                            <i class="nav-icon fas fa-users-cog"></i>
                            <p>Tim</p>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link  class="nav-link" exact :to="{name:'unit'}" >
                            <i class="nav-icon fas fa-building"></i>
                            <p>Unit</p>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link  class="nav-link" exact :to="{name:'kriteria'}" >
                            <i class="nav-icon fas fa-book"></i>
                            <p>Kriteria</p>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link  class="nav-link" exact :to="{name:'kategori_hasil'}" >
                            <i class="nav-icon fas fa-stream"></i>
                            <p>Kategori Hasil</p>
                        </router-link>
                    </li>
                    <li class=nav-header>Relasi</li>
                    <li class="nav-item">
                        <router-link  class="nav-link" exact :to="{name:'nilai'}" >
                            <i class="nav-icon fas fa-copy"></i>
                            <p>Nilai</p>
                        </router-link>
                    </li>
                  <!--   <li class="nav-item">
                        <router-link  class="nav-link" exact :to="{name:'tim_detail'}" >
                            <i class="nav-icon fas fa-copy"></i>
                            <p>Tim Detail</p>
                        </router-link>
                    </li> -->
                    <li class="nav-item">
                        <router-link  class="nav-link" exact :to="{name:'unit_detail'}" >
                            <i class="nav-icon fas fa-copy"></i>
                            <p>Unit Detail</p>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link  class="nav-link" exact :to="{name:'penilaian'}" >
                            <i class="nav-icon fas fa-copy"></i>
                            <p>Penilaian</p>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link  class="nav-link" exact :to="{name:'penilaian_detail'}" >
                            <i class="nav-icon fas fa-copy"></i>
                            <p>Penilaian Detail</p>
                        </router-link>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>
</template>