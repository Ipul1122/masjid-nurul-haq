<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
    <div class="container-fluid">
        <span class="navbar-brand">Dashboard Risnha</span>
        <div class="d-flex">
            <span class="me-3">
                Halo, {{ \App\Models\Risnha::find(session('risnha_id'))->username ?? 'Guest' }}
            </span>
        </div>
    </div>
</nav>
