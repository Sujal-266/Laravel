<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>New Category Created</title>
	<style>
		body { font-family: Arial, sans-serif; background: #f8f9fa; color: #333; }
		.container { max-width: 600px; margin: 40px auto; background: #fff; border-radius: 8px; box-shadow: 0 2px 8px #eee; padding: 32px; }
		h1 { color: #007bff; }
		.category-name { font-size: 1.2em; font-weight: bold; color: #28a745; }
	</style>
</head>
<body>
	<div class="container">
		<h1>Welcome!</h1>
		<p>A new category has been created in our application.</p>
		<p class="category-name">Category Name: <strong>{{ $category->name }}</strong></p>
		<p>Check it out and stay tuned for more updates!</p>
	</div>
</body>
</html>
