$(document).ready(function() {
    
    function converterData(data) {
        var partes = data.split('-');

        if (partes.length === 3) {
            var ano = partes[0];
            var mes = partes[1];
            var dia = partes[2];
            
            return dia + '/' + mes + '/' + ano;
        } else {
            return 'Formato de data inválido';
        }
    }

    $('#search').on('input', function () {
        let searchQuery = $(this).val(); 

        if (searchQuery.length > 0) {
            $.ajax({
                url: './js/ajax/relBD.php', 
                type: 'POST',
                data: { pesq: searchQuery }, 
                dataType: 'json',
                success: function (response) {
                    $('#content').empty();
                    $('<div>', { id: 'cRow', class: 'content-row' }).appendTo('#content');
                    
                    let row = "cRow";
                    let i = 0;
                    let j = 0;

                    $.each(response, function (index, data) {
                        if (i === 4) {
                            i = 0;
                            j++;
                            $('<div>', { id: 'cRow' + j, class: 'content-row' }).appendTo('#content');
                            row = 'cRow' + j;
                        }

                        let splt = ((data.urlURL).replace('https://', '')).split('.');
                        let urlName;
                        if (splt[0] === 'www') {
                            urlName = splt[1];
                        } else {
                            urlName = splt[0];
                        }

                        let cardHTML = `
                            <div class="card-container">
                                <div class="card">
                                    <div class="card-image">
                                        <img src="img/bd/${data.capaURL}" alt="">
                                    </div>
                                    <div class="card-content">
                                        <h3 style="text-transform: capitalize;">${urlName}</h3>
                                        <p>${data.descricaoURL}</p>
                                        <div class="data-row-ext">
                                            <div class="data-row-int">
                                                <a href="${data.urlURL}" 
                                                class="btn"
                                                target="_blank">
                                                <i class="ri-external-link-line"></i>
                                                Acessar o Site</a>
                                                <p>${converterData(data.dataCadastroURL)}</p>
                                            </div>
                                        </div>
                                        <div class="data-row-ext">
                                            <div class="data-row-int">
                                                <button 
                                                class="btn-editar" 
                                                id="btn-editar" 
                                                data-id="${data.idURL}"
                                                data-image="../../img/bd/${data.capaURL}">
                                                <i class="ri-edit-2-line"></i>
                                                </button>

                                                <button 
                                                class="btn-excluir" 
                                                id="btn-excluir" 
                                                data-id="${data.idURL}" 
                                                data-image="../../img/bd/${data.capaURL}">
                                                <i class="ri-delete-bin-6-line"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;

                        $('#' + row).append(cardHTML);
                        i++; 
                    });
                },
                error: function () {
                    alert('Erro ao buscar os dados.');
                }
            });
        } else {
            carregarDados();
        }
    });

    
    function carregarDados() {
        $.ajax({
            url: './js/ajax/relBD.php', 
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.length > 0) {
                    
                    $('#content').empty();
                    $('<div>', { id: 'cRow', class: 'content-row' }).appendTo('#content');

                    let row = "cRow";
                    let i = 0; // Contador para verificar se chegou a 4 cards
                    let j = 0; // Contador para adicionar o sufixo da nova linha
                    
                    $.each(response, function(index, data) {
                        if(i === 4){
                            i = 0;
                            j++;
                            $('<div>', { id: 'cRow'+j, class: 'content-row'  }).appendTo('#content');
                            row = 'cRow'+j
                        }
                        
                        let splt = ((data.urlURL).replace('https://', '')).split('.')
                        let urlName;
                        if (splt[0] === 'www') {
                            urlName = splt[1];
                        } else {
                            urlName = splt[0];
                        }

                        let cardHTML = `
                            <div class="card-container">
                                <div class="card">
                                    <div class="card-image">
                                        <img src="img/bd/${data.capaURL}" alt="">
                                    </div>
                                    <div class="card-content">
                                        <h3 style="text-transform: capitalize;">${urlName}</h3>
                                        <p>${data.descricaoURL}</p>
                                        <div class="data-row-ext">
                                            <div class="data-row-int">
                                                <a href="${data.urlURL}" class="btn"
                                                target="_blank">
                                                <i class="ri-external-link-line"></i>
                                                Acessar o Site</a>
                                                <p>${converterData(data.dataCadastroURL)}</p>
                                            </div>
                                        </div>
                                        <div class="data-row-ext">
                                            <div class="data-row-int">
                                                <button 
                                                class="btn-editar" 
                                                id="btn-editar" 
                                                data-id="${data.idURL}"
                                                data-image="../../img/bd/${data.capaURL}">
                                                <i class="ri-edit-2-line"></i>
                                                </button>

                                                <button 
                                                class="btn-excluir" 
                                                id="btn-excluir" 
                                                data-id="${data.idURL}" 
                                                data-image="../../img/bd/${data.capaURL}">
                                                <i class="ri-delete-bin-6-line"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;
                        
                        $('#' + row).append(cardHTML);
                        i++;
                    });
                } else {
                    $('#content').html('<p>Nenhum dado encontrado.</p>');
                }
            },
            error: function() {
                $('#content').html('<p>Erro ao carregar os dados.</p>');
            }
        });
    }

    $(document).on('click', '.btn-excluir', function () {
        let idURL = $(this).data('id');
        let imagePath = $(this).data('image')

        let confirmar = confirm("Você realmente quer excluir este item?");
        if (confirmar) {
            $.ajax({
                url: './js/ajax/excluirBD.php',
                type: 'POST',
                data: { id: idURL, image: imagePath }, 
                success: function (response) {
                    if (response === 'success') {
                        alert('Item excluído com sucesso!');
                        carregarDados();
                    } else {
                        alert(response)
                        alert('Erro ao excluir o item. Tente novamente.');
                    }
                },
                error: function () {
                    alert('Erro na requisição. Tente novamente.');
                }
            });
        }
    });

    $(document).on('click', '.btn-editar', function () {
        window.location.assign("./edit.php?param="+$(this).data('id'))
    });

    
    carregarDados();
});