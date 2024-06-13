<!DOCTYPE html>
<html lang="en">
<x-head />

<body>
    <div class="container-scroller">
        <x-navbar />
        <div class="container-fluid page-body-wrapper">
            <x-sidebar />
            <div class="main-panel">
                @yield('content')
                <x-footer />
            </div>
        </div>
    </div>
</body>
<x-script />

</html>