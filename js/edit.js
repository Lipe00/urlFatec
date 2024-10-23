// Função para pegar o parâmetro da URL
$.urlParam = function(name) {
    const url = window.location.href;
    const regex = new RegExp('[?&]' + name + '=([^&#]*)');
    const results = regex.exec(url);
    return results ? decodeURIComponent(results[1]) : null;
};

$(document).ready(function() {
    const idParam = $.urlParam('param');

    if(idParam){
        $.ajax({
            url: './js/ajax/editView.php', 
            type: 'POST',
            data: { id: idParam }, 
            dataType: 'json',
            success: function (response) {
                $.each(response, function (index, data) {
                    $('#id').val(data.idURL)
                    $('#oldImg').val(data.capaURL)
                    $('#url').val(data.urlURL)
                    $('#descricao').val(data.descricaoURL)
                    $('#categoria').val(data.categoriaURL)
                });
            },
            error: function () {
                alert('Erro ao buscar os dados!');
            }
        });
    }
    $("#uploadBtn").change(function(event){
        let fileName = event.target.files[0].name

        $("#lblFile").text(fileName)
    })

    $('#form').submit(function(event) {
        event.preventDefault(); 

        var id = $('#id').val().trim();
        var oldImg = $('#oldImg').val().trim();
        var url = $('#url').val().trim();
        var descricao = $('#descricao').val().trim();
        var categoria = $('#categoria').val().trim();
        var uploadBtn = $('#uploadBtn').val();

        function sanitize(input) {
            return input.replace(/['"<>;(){}]/g, "");
        }

        // Verifica se o campo URL é um link válido
        var urlPattern = /^(https?:\/\/)?([\da-z.-]+)\.([a-z.]{2,6})([\/\w .-]*)*\/?$/;

        if (url === '' && descricao === '' && categoria === '') {
            alert('Não insira registros vazios');
        } else if (!urlPattern.test(url)) {
            alert('Por favor, insira um URL válido.');
        }  else {
            url = sanitize(url);
            descricao = sanitize(descricao);
            categoria = sanitize(categoria);

            var formData = new FormData();
            formData.append('id', id);
            formData.append('oldImg', oldImg);
            formData.append('url', url);
            formData.append('descricao', descricao);
            formData.append('categoria', categoria);

            if ($('#uploadBtn')[0].files.length > 0) {
                formData.append('uploadBtn', $('#uploadBtn')[0].files[0]);
            }

            console.log("Enviando dados:", formData);

            $.ajax({
                url: './js/ajax/editBD.php', 
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false, 
                success: function(response) {
                    if (response === 'success') {
                        window.location.href = 'rel.php'; 
                    }  else {
                        alert('Não foi possível cadastrar: ' + response); 
                    }
                },
                error: function (xhr, status, error) {
                    alert("erro")
                    console.log("Erro: " + error);
                    alert('Ocorreu um erro no upload.');
                }
            });
        }
    })
});