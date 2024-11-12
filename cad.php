<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="./css/main.css">
    <link rel="stylesheet" href="./css/cad.css">
</head>
<body>
  <?php
    include_once("./nav.php");
  ?>
  <section class="container">
    <form action="" class="form" id="form" method="POST" enctype="multipart/form-data">
      <div class="input-box">
        <label>URL</label>
        <input type="text" id="url" name="url" placeholder="Informe a url" required />
      </div>

      <div class="input-box">
        <label>Descrição</label>
        <input type="text" id="descricao" name="descricao" placeholder="Informe a descrição da " required />
      </div>

      <div class="input-box">
        <label>Categoria</label>
        <input type="text" id="categoria" name="categoria" placeholder="Informe a Categoria" required />
      </div>

      <div class="input-file">
        <label>Imagem</label>
        <input type="file" id="uploadBtn" name="uploadBtn" required />
        <label id="lblFile" for="uploadBtn"><i class="ri-upload-line"></i>Enviar Arquivo</label>
      </div>
      <button>Submit</button>
    </form>
  </section>
  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
  <script src="./js/cad.js"></script>
</body>
</html>