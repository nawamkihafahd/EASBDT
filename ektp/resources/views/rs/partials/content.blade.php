@include('rs.partials.header')
<div class="app-body">
    @include('rs.partials.sidebar')
    <main class="main">
        <ol class="breadcrumb">
            @yield('breadcrumb')
        </ol>
        <div class="container-fluid">
            <div class="animated fadeIn">
                @yield('content')
            </div>
        </div>
    </main>
</div>
@include('rs.partials.footer')
