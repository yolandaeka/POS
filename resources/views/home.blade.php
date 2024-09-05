
<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
</head>
<body>
    <h1>Welcome to Our Website</h1>
    <p>This is the home page.</p>
    <hr>
    <a href="{{ route('products.products') }}"><h2>Products</h2></a>
    <a href="{{ route('user.profile', ['id' => 27, 'name' => 'Yolanda']) }}"><h2>User</h2></a>
    <a href="{{ route('sales.sales') }}"><h2>Sales</h2></a>
</body>
</html>