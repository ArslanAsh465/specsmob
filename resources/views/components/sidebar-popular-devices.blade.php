<style>
    .sidebar-devices table tbody tr:hover {
        background-color: #f1f5ff;
    }
</style>

<div class="sidebar-devices border rounded overflow-hidden">
    <!-- Header -->
    <div class="text-center fw-bold text-white fs-5 py-2" style="background-color: #f9a13d;">
        Popular Devices
    </div>

    <!-- Table -->
    <div class="table-responsive bg-light">
        <table class="table table-sm table-hover align-middle mb-0">
            <thead class="table-light">
                <tr class="text-center">
                    <th scope="col">#</th>
                    <th scope="col">Device Name</th>
                    <th scope="col">Views</th>
                </tr>
            </thead>
            <tbody>
                @forelse($mobiles as $index => $mobile)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td>
                            <a href="{{ url($mobile->slug) }}" class="text-decoration-none text-dark fw-medium">
                                {{ $mobile->name }}
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
</div>
