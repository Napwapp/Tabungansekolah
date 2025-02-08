@extends ('halaman_dashboard.index')
@section('navitem')
<li class="sidebar-item active">
        <a href="{{route('user')}}" class='sidebar-link'>
            <i class="bi bi-grid-fill"></i>
            <span>Dashboard</span>
        </a>
</li>

<li class="sidebar-item">
    <a href="{{route('profile')}}" class='sidebar-link'>
        <i class="bi bi-person-badge-fill"></i>
        <span>Profil</span>
    </a>
</li>
                        
<li class="sidebar-item  has-sub">
    <a href="#" class='sidebar-link'>
        <i class="bi bi-basket-fill"></i>
        <span>Tabungan</span>
    </a>
    <ul class="submenu ">
        <li class="submenu-item ">
            <a href="{{route('kelas')}}">Tabungan Kelas</a>
        </li>
        <li class="submenu-item ">
            <a href="{{route('tabungan')}}">Tabunganku</a>
        </li>
    </ul>
</li>

<li class="sidebar-item  ">
    <a href="{{route('riwayat')}}" class='sidebar-link'>
        <i class="bi bi-chat-dots-fill"></i>
        <span>Riwayat Transaksi</span>
        </a>
</li>

                                    
<li class="sidebar-item  ">
    <a href="{{route('contact')}}" class='sidebar-link'>
        <i class="bi bi-envelope-fill"></i>
        <span>Kontak Kami</span>
    </a>
</li>

                        <!-- saya nonaktifkan (sementara) karna siapa tau penting suatu saat -->
                        <!-- <li
                            class="sidebar-item  has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-grid-1x2-fill"></i>
                                <span>Layouts</span>
                            </a>
                            <ul class="submenu ">
                                <li class="submenu-item ">
                                    <a href="layout-default.html">Default Layout</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="layout-vertical-1-column.html">1 Column</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="layout-vertical-navbar.html">Vertical Navbar</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="layout-rtl.html">RTL Layout</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="layout-horizontal.html">Horizontal Menu</a>
                                </li>
                            </ul>
                        </li>
                        -->
                        
                        <!-- <li class="sidebar-title">Forms &amp; Tables</li>
                        
                        <li
                            class="sidebar-item  has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-hexagon-fill"></i>
                                <span>Form Elements</span>
                            </a>
                            <ul class="submenu active">
                                <li class="submenu-item ">
                                    <a href="form-element-input.html">Input</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="form-element-input-group.html">Input Group</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="form-element-select.html">Select</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="form-element-radio.html">Radio</a>
                                </li>
                                <li class="submenu-item active">
                                    <a href="form-element-checkbox.html">Checkbox</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="form-element-textarea.html">Textarea</a>
                                </li>
                                </li>
                            </ul>
                        </li> -->
                        
    <form action="{{route('logout')}}" method="post" class="sidebar-item" style="margin-left: 15px; color:rgb(124, 141, 181)">
    @csrf
    <i class="bi bi-x-octagon-fill"></i>
    <button type="submit" style="border: none; padding: 10px; background-color: white;">Log Out</button>
@endsection