<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
</head>
<body>
    <h2>Reset Your Password</h2>

    @if (session('success'))
        <p style="color: green">{{ session('success') }}</p>
    @endif

    @if (session('error'))
        <p style="color: red">{{ session('error') }}</p>
    @endif

    <form method="POST" action="{{ route('auth.updatepassword') }}">
        @csrf

        <input type="hidden" name="email" value="{{ $email }}">

        <label>New Password:</label>
        <input type="password" name="password" required>
        @error('password') <p style="color: red">{{ $message }}</p> @enderror

        <label>Confirm New Password:</label>
        <input type="password" name="password_confirmation" required>

        <button type="submit">Update Password</button>
    </form>
</body>
</html>
