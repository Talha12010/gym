<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pending Approvals Muscle Core Gym Admin</title>

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
                <a href="{{ route('admin.subscriptions') }}" class="btn btn-gold btn-sm"><i class="fas fa-chart-line"></i> Records</a>
            </div>
        </div>
    </header>

    <main class="container">
        <div class="ap-hero">
            <h1>Pending <span class="accent">Approvals</span></h1>
            <p>Review new member &amp; trainer registrations before they can log in.</p>
        </div>

        @if(session('success'))
            <div class="alert alert-success ap-flash">{{ session('success') }}</div>
        @endif

        <div class="ap-card">
            @if($pendingUsers->isEmpty())
                <div class="ap-empty">
                    <i class="fas fa-user-check"></i>
                    <h3>All Caught Up</h3>
                    <p>No accounts are waiting for approval right now.</p>
                </div>
            @else
                <div class="ap-table-wrap">
                    <table class="ap-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pendingUsers as $user)
                                <tr>
                                    <td class="id-cell">#{{ $user->id }}</td>
                                    <td><strong>{{ $user->name }}</strong></td>
                                    <td>{{ $user->email }}</td>
                                    <td><span class="chip chip-{{ $user->role }}">{{ $user->role }}</span></td>
                                    <td>
                                        <div class="row-actions">
                                            <form action="{{ route('admin.approveUser', $user->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                <button type="submit" class="btn-approve"><i class="fas fa-check"></i> Approve</button>
                                            </form>

                                            <form action="{{ route('admin.deleteUser', $user->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-reject"><i class="fas fa-trash"></i> Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </main>

</body>
</html>
