<div class="col">
    <div class="card">
        <h5 class="card-header">{{ $title ?? 'geen titel' }}</h5>
        <div class="card-body">
            <line-chart :chartdata="{{ $data ?? '{}' }}" :chartoptions="{{ $options ?? '{}' }}" />
        </div>
    </div>
</div>
