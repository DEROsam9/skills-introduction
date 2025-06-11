<!DOCTYPE html>
<html>
<head><title>Register</title></head>
<body>
    <h2>Register</h2>
    <form method="POST" action="{{ route('register.submit') }}">
        @csrf
        <input type="text" name="name" placeholder="Name" required><br/>
        <input type="email" name="email" placeholder="Email" required><br/>
        <input type="password" name="password" placeholder="Password" required><br/>
        <button type="submit">Register</button>kkkkkkkkkk
    </form>
    <p>Already have an account? <a href="{{ route('login') }}">Login</a></p>
    @if($errors->any())<p style="color:red">{{ $errors->first() }}</p>@endif
</body>
</html>
