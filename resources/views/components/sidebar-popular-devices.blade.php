<div class="overflow-hidden">
    <!-- Header -->
    <div class="text-center fw-bold text-white fs-4 py-2" style="background-color: #045CB4;">
        POPULAR DEVICES
    </div>

    <!-- Table -->
    <table class="table table-sm table-striped mb-0">
        <thead>
            <tr>
                <th scope="col"></th>
                <th scope="col">Device Name</th>
                <th scope="col">Views</th>
            </tr>
        </thead>
        <tbody>
            @forelse($mobiles as $index => $mobile)
                <tr>
                    <td class="text-center">{{ $index + 1 }}.</td>
                    <td>
                        <a href="{{ url($mobile->slug) }}" class="text-decoration-none text-dark fw-medium">
                            <span onmouseover="this.style.color='#f9a13d';" onmouseout="this.style.color='#000';">
                                {{ $mobile->name }}
                            </span>
                        </a>
                    </td>
                    <td class="text-center">{{ number_format($mobile->views) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center text-muted py-2">No devices available</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
