<form action="{{ route('users') }}" method="get">
    <div class="row">
        <div class="col-md-6">
            <div class="form-inline form-search">
                <div class="input-group">
                    <input type="search" name="search" value="{{ request('search') }}" class="form-control form-control-sm" placeholder="Buscar...">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-secondary btn-sm"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>