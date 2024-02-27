<th style="padding: 0;">
    <a class="text-decoration-none font-weight-bold d-block text-dark  "
        href="{{ route($path, [
            'sort_by' => $sort_by,
            'sort_order' => request('sort_by') === $sort_by && request('sort_order') === 'asc' ? 'desc' : 'asc',
            $oldSearch => request($oldSearch),
        ]) }}">
        <div class="container py-3">
            {{ $title }}
            @if (request('sort_by') == $sort_by)
                @if (request('sort_order') === 'asc')
                    <span class="mdi mdi-arrow-up-bold"></span>
                @else
                    <span class="mdi mdi-arrow-down-bold"></span>
                @endif
            @else
                <span class="mdi mdi-swap-vertical-bold"></span>

            @endif
        </div>
    </a>

</th>
