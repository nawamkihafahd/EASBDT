<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            {{--<li class="nav-item">--}}
                {{--<a class="nav-link" href="{{ route('admin.index') }}">--}}
                    {{--<i class="nav-icon icon-speedometer"></i> Dashboard--}}
                {{--</a>--}}
            {{--</li>--}}

            <li class="nav-title">Log</li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('logs.index') }}">
                    <i class="nav-icon icon-globe-alt"></i> Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('logs.paymentindex') }}">
                    <i class="nav-icon icon-globe-alt"></i> Log Smart Payment</a>
            </li>
			<li class="nav-item">
                <a class="nav-link" href="{{ route('logs.bpjs') }}">
                    <i class="nav-icon icon-globe-alt"></i> Log Smart BPJS</a>
            </li>
			<li class="nav-item">
                <a class="nav-link" href="{{ route('logs.ticket') }}">
                    <i class="nav-icon icon-globe-alt"></i> Log Smart Ticket</a>
            </li>
			<li class="nav-item">
                <a class="nav-link" href="http://etc.if.its.ac.id/absenKuliah/JT1">
                    <i class="nav-icon icon-globe-alt"></i> Log Smart Presence</a>
            </li>
			<li class="nav-item">
                <a class="nav-link" href="{{ route('logs.parking') }}">
                    <i class="nav-icon icon-globe-alt"></i> Log Smart Parking</a>
            </li>
			<li class="nav-item">
                <a class="nav-link" href="{{ route('logs.search') }}">
                    <i class="nav-icon icon-globe-alt"></i> Tracking Orang</a>
            </li>
        </ul>
    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>
