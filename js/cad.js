$(document).ready(function() {
    $("#uploadBtn").change(function(event){
        let fileName = event.target.files[0].name

        $("#lblFile").text(fileName)
    })

    $('#form').submit(function(event) {
        event.preventDefault(); 

        var url = $('#url').val().trim();
        var descricao = $('#descricao').val().trim();
        var categoria = $('#categoria').val().trim();
        var uploadBtn = $('#uploadBtn').val();

        function sanitize(input) {
            return input.replace(/['"<>;(){}]/g, "");
        }

        // Verifica se o campo URL é um link válido
        var urlPattern = /^(https?:\/\/)?([\da-z.-]+)\.([a-z.]{2,6})([\/\w .-]*)*\/?$/;

        if (url === '' || descricao === '' || categoria === '') {
            alert('Por favor, preencha todos os campos.');
        } else if (!urlPattern.test(url)) {
            alert('Por favor, insira um URL válido.');
        } else if (uploadBtn === '') {
            alert('Por favor, selecione um arquivo para upload.');
        } else {
            url = sanitize(url);
            descricao = sanitize(descricao);
            categoria = sanitize(categoria);

            $.ajax({
                url: './js/ajax/verificaBD.php', 
                type: 'POST',
                data: { url: url },
                success: function(response) {
                    if (response === 'exists') {
                        alert('Essa URL já está cadastrada no sistema.');
                    } else {
                        var formData = new FormData($('#form')[0]); 

                        $.ajax({
                            url: './js/ajax/cadastrarBD.php', 
                            type: 'POST',
                            data: formData,
                            contentType: false,
                            processData: false, 
                            success: function(response) {
                                if (response === 'success') {
                                    window.location.href = 'index.php'; 
                                }  else {
                                    alert('Não foi possível cadastrar: ' + response); 
                                }
                            },
                            error: function (xhr, status, error) {
                                console.log("Erro: " + error);
                                alert('Ocorreu um erro no upload.');
                            }
                        });
                    }
                },
                error: function() {
                    alert('Erro ao verificar a URL. Tente novamente mais tarde.');
                }
            });
        }
    });
})