<!DOCTYPE html>
<html>
<head><title>Login</title></head>
<body>
    <h2>Login</h2>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <input type="email" name="email" placeholder="Email" required><br/>
        <input type="password" name="password" placeholder="Password" required><br/>
        <button type="submit">Login</button>
    </form>
    <p>Don't have an account? <a href="{{ route('register') }}">Register</a></p>
    @if($errors->any())<p style="color:red">{{ $errors->first() }}</p>@endif
</body>
</html>
