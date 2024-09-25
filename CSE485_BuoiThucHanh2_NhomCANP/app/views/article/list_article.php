<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <li><a href="./index.php?controller=article&action=list">Bài viết</a></li>
</head>
<body>
    <table>
        <tr>
            <td>Content Of Cell</td>
            <td>Content Of Cell</td>
            <td>Content Of Cell</td>
            <td>Content Of Cell</td>
        </tr>
        <?php
            foreach($articles as $article){
               echo "<p>{$article->getTitle()}</p>";
           }?>
    </table>
</body>
</html>