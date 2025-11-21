<div class="breadcrumb-area mb-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mt">
            @foreach ($breadcrumbs as $label => $url)
                @if ($url)
                    <li class="breadcrumb-item">
                        <a href="{{ $url }}">{{ $label }}</a>
                    </li>
                @else
                    <li class="breadcrumb-item active" aria-current="page">
                        {{ $label }}
                    </li>
                @endif
            @endforeach
        </ol>
    </nav>
</div>
