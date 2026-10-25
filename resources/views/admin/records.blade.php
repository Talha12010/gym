<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monthly Records Muscle Core Gym Admin</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/site.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin-pages.css') }}">
</head>
<body>

    <header class="ap-header">
        <div class="container ap-header-inner">
            <a href="{{ route('admin.dashboard') }}" class="ap-brand">
                <img src="{{ asset('images/mcg.jpg') }}" alt="Muscle Core Gym logo">
                <span>Muscle Core <em>Admin</em></span>
            </a>
            <div class="ap-actions">
                <a href="{{ route('admin.dashboard') }}" class="btn btn-ghost btn-sm"><i class="fas fa-arrow-left"></i> Dashboard</a>
                <a href="{{ route('admin.pendingUsers') }}" class="btn btn-gold btn-sm"><i class="fas fa-user-clock"></i> Pending</a>
            </div>
        </div>
    </header>

    <main class="container">
        <div class="ap-hero">
            <h1>Monthly <span class="accent">Records</span></h1>
            <p>All subscription records, grouped by the month they were created.</p>
        </div>

        @if(session('success'))
            <div class="alert alert-success ap-flash">{{ session('success') }}</div>
        @endif

        @forelse ($groupedSubscriptions as $month => $subs)
            <div class="ap-card">
                <div class="month-heading"><i class="fas fa-calendar-days"></i> {{ $month }}</div>
                <div class="ap-table-wrap">
                    <table class="ap-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Contact</th>
                                <th>Payment</th>
                                <th>Plan</th>
                                <th>Duration</th>
                                <th>Price</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($subs as $sub)
                                <tr>
                                    <td class="id-cell">#{{ $sub->id }}</td>
                                    <td><strong>{{ $sub->name }}</strong></td>
                                    <td>{{ $sub->email }}</td>
                                    <td>{{ $sub->contact }}</td>
                                    <td><span class="chip">{{ $sub->payment }}</span></td>
                                    <td><span class="chip chip-trainer">{{ $sub->plan_name }}</span></td>
                                    <td>{{ $sub->duration }} month(s)</td>
                                    <td><strong style="color:var(--gold-bright)">RS {{ number_format($sub->price, 2) }}</strong></td>
                                    <td>{{ \Carbon\Carbon::parse($sub->created_at)->format('d M Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @empty
            <div class="ap-card">
                <div class="ap-empty">
                    <i class="fas fa-inbox"></i>
                    <h3>No Records Yet</h3>
                    <p>Subscription records will appear here once members start joining.</p>
                </div>
            </div>
        @endforelse
    </main>

</body>
</html>
