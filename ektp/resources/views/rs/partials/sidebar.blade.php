<div class="sidebar" style="color: aec9d6;">
    <nav class="sidebar-nav">
        <ul class="nav">
            {{--<li class="nav-item">--}}
                {{--<a class="nav-link" href="{{ route('admin.index') }}">--}}
                    {{--<i class="nav-icon icon-speedometer"></i> Dashboard--}}
                {{--</a>--}}
            {{--</li>--}}

            <li class="nav-title">Pasien</li>
			<li class="nav-item">
                <a class="nav-link" href="{{ route('pasien.faskes1.index') }}">
                    <i class="nav-icon icon-globe-alt"></i> Pendafataran Pasien</a>
            </li>
			<li class="nav-item">
                <a class="nav-link" href="{{ route('pasien.faskes1.formsetantri') }}">
                    <i class="nav-icon icon-globe-alt"></i> Antrian Pemeriksaan</a>
            </li>
			<li class="nav-item">
                <a class="nav-link" href="{{ route('pasien.faskes1.periksa') }}">
                    <i class="nav-icon icon-globe-alt"></i> Diagnosa Pasien</a>
            </li>
			<!--li class="nav-title">Faskes Lanjutan</li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('pasien.index') }}">
                    <i class="nav-icon icon-globe-alt"></i> Pendaftaran Pasien Bpjs</a>
            </li-->
			
			
			
        </ul>
    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>
