<div class="sidebar-devices overflow-hidden">
    <!-- Header -->
    <div class="text-center fw-bold text-white fs-6 py-2" style="background-color: #045CB4;">
        Top 10 Devices Rated by Users
    </div>

    <!-- Table -->
    <table class="table table-sm table-striped mb-0">
        <thead>
            <tr>
                <th scope="col">Device</th>
                <th scope="col">Five Stars</th>
            </tr>
        </thead>
        <tbody>
            @forelse($mobiles as $index => $mobile)
                <tr>
                    <td>
                        <a href="{{ url($mobile->slug) }}" class="text-decoration-none text-dark fw-medium">
                            <span onmouseover="this.style.color='#f9a13d';" onmouseout="this.style.color='#000';">
                                {{ $mobile->name }}
                            </span>
                        </a>
                    </td>
                    <td class="text-center">{{ $mobile->five_stars_count }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center text-muted py-2">No top-rated mobiles available</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
