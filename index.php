<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <title>URL::Fatec</title>
</head>
<body>
    <?php
        include_once("./nav.php");
    ?>
    
    <div class="search-bar">
        <input type="text" name="search" id="search" placeholder="Digite o termo que deseja procurar">
    </div>

    <div class="content" id="content">
        <div class="content-row" id="cRow">
        </div>
    </div>
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script src="./js/index.js"></script>
</body>
</html>