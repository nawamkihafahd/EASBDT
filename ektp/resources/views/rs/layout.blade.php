<!DOCTYPE html>
<html lang="en">
<head>
    @include('rs.partials.metadata')
    @include('rs.partials.styles')
	@yield('headscripts')
</head>
<body class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show">
    @include('rs.partials.content')
    @include('rs.partials.scripts')
</body>
</html>
