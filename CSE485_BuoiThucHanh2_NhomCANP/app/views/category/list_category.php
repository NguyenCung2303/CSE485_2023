/app/views/category/index.php
<!DOCTYPE html>
<html>
<head>
    <title>Danh sách thể loại</title>
</head>
<body>
    <h1>Danh sách Thể Loại</h1>
    <ul>
        <?php foreach ($categories as $category): ?>
            <li><?php echo $category['ten_tloai']; ?></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>