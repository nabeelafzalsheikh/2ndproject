<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tenant Dashboard</title>
</head>
<body>
    <h1>Welcome, {{ $user->name }}</h1>
    <p>Tenant: {{ request()->route('tenant') }}</p>
</body>
</html>
