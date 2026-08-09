<ul class="breadcrumbs">
    @foreach ($breadcrumbs as $name => $url)
        @if ($url)
            <li><a href="{{ $url }}">{{ $name }}</a></li>
        @else
            <li>{{ $name }}</li>
        @endif
    @endforeach
</ul>