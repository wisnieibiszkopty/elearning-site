<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
</head>
<body>
    <h1>Registration</h1>
    <form method="POST" action="/auth/register">
    @csrf
        <input type="text" name="name">
        <input type="text" name="company">
        <input type="text" name="password">
        <input type="text" name="password_confirmation">
        <input type="text" name="avatar">
        <input type="text" name="role">
        <button type="submit">Register</button>
    </form>
</body>
</html>