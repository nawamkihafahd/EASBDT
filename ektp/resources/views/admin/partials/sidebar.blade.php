<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            {{--<li class="nav-item">--}}
                {{--<a class="nav-link" href="{{ route('admin.index') }}">--}}
                    {{--<i class="nav-icon icon-speedometer"></i> Dashboard--}}
                {{--</a>--}}
            {{--</li>--}}

            <li class="nav-title">Pendaftaran</li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.index') }}">
                    <i class="nav-icon icon-globe-alt"></i> Pendaftaran</a>
            </li>
			<li class="nav-title">Alat</li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.alat.index') }}">
                    <i class="nav-icon icon-globe-alt"></i> Alat</a>
            </li>
			<li class="nav-title">History</li>
			<li class="nav-item">
                <a class="nav-link" href="{{ route('admin.logs.all') }}">
                    <i class="nav-icon icon-globe-alt"></i> History Tapping</a>
            </li>
			
        </ul>
    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>
