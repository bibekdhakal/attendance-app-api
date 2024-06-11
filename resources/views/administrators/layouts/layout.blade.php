<!DOCTYPE html>
<html lang="en">
<x-head />

<body>
    <div class="container-scroller">
        <x-sidebar />
        <div class="container-fluid page-body-wrapper">
            <x-navbar />
            <div class="main-panel">
                @yield('content')
                <x-footer />
            </div>
        </div>
    </div>
</body>
<x-script />

</html>