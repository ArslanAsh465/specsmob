<div class="sidebar-devices border rounded overflow-hidden">
    <!-- Header -->
    <div class="text-center fw-bold text-white fs-5 py-2" style="background-color: #f9a13d;">
        Top 10 Devices Rated by Users
    </div>

    <!-- Body -->
    <div class="table-responsive bg-light">
        <table class="table table-sm table-hover align-middle mb-0">
            <thead class="table-light">
                <tr class="text-center">
                    <th scope="col" class="text-start">Device</th>
                    <th scope="col">
                        <span class="text-warning">
                            @for ($i = 1; $i <= 5; $i++)
                                <i class="bi bi-star-fill"></i>
                            @endfor
                        </span>
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse($mobiles as $mobile)
                    <tr>
                        <!-- Device Name -->
                        <td>
                            <a href="{{ url($mobile->slug) }}" class="text-decoration-none text-dark fw-medium">
                                {{ $mobile->name }}
                            </a>
                        </td>

                        <!-- 5-Star Count -->
                        <td class="text-center fw-bold">
                            {{ $mobile->five_stars_count }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" class="text-center text-muted py-2">
                            No top-rated mobiles available
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<style>
    .sidebar-devices table tbody tr:hover {
        background-color: #f8f9fa;
    }

    .sidebar-devices a:hover {
        color: #0d6efd;
        text-decoration: none;
    }

    .sidebar-devices .bi-star-fill {
        color: #ffc107; /* Gold */
    }
</style>
