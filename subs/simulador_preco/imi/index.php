<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora de IMI</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        // Função para carregar os concelhos a partir do JSON
        function loadConcelhos() {
            fetch('concelhos.json')
                .then(response => response.json())
                .then(data => {
                    const concelhoSelect = document.getElementById('concelho');
                    data.concelhos.forEach(concelho => {
                        const option = document.createElement('option');
                        option.value = concelho;
                        option.text = concelho;
                        concelhoSelect.appendChild(option);
                    });
                })
                .catch(error => console.error('Erro ao carregar concelhos:', error));
        }

        $(document).ready(function(){
            $('#imiForm').on('submit', function(event){
                event.preventDefault();
                $.ajax({
                    url: 'calculate.php',
                    method: 'POST',
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(data){
                        if(data.error){
                            $('#resultado').html('<div class="alert alert-danger">' + data.error + '</div>');
                        } else {
                            const montante_imi = parseFloat(data.montante_imi); // Converter montante_imi para número

                            let resultHtml = `
                                <table class="table mt-4">
                                    <thead>
                                        <tr>
                                            <th scope="col">Mês</th>
                                            <th scope="col">Valor a Pagar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                            `;

                            // Gerar as linhas da tabela para os meses retornados
                            Object.keys(data.meses).forEach(mes => {
                                resultHtml += `
                                    <tr>
                                        <td>${mes}</td>
                                        <td>${parseFloat(data.meses[mes].replace(',', '.')).toLocaleString('pt-PT', { style: 'currency', currency: 'EUR' })}</td>
                                    </tr>
                                `;
                            });

                            resultHtml += `
                                    </tbody>
                                </table>
                                <p class="mt-3">Total do IMI a pagar: ${montante_imi.toFixed(2).replace('.', ',')} €</p>
                            `;

                            $('#resultado').html(resultHtml);
                        }
                    },
                    error: function(){
                        $('#resultado').html('<div class="alert alert-danger">Erro ao calcular IMI. Por favor, tente novamente.</div>');
                    }
                });
            });

            // Carregar concelhos quando a página é carregada
            loadConcelhos();
        });
    </script>
</head>
<?php
    require '../../../views/head.php';
    require '../../../views/menu.php';
?>
<body>
    <div class="container mt-5">
        <form id="imiForm">
            <div class="form-group">
                <label for="vpt">Valor Patrimonial Tributário (VPT):</label>
                <input type="number" class="form-control" id="vpt" name="vpt" step="0.01" required>
            </div>

            <div class="form-group">
                <label for="distrito">Distrito:</label>
                <select class="form-control" id="distrito" name="distrito" required>
                    <option value="Funchal">Funchal</option>
                </select>
            </div>

            <div class="form-group">
                <label for="concelho">Concelho:</label>
                <select class="form-control" id="concelho" name="concelho" required>
                    <!-- Concelhos serão carregados aqui -->
                </select>
            </div>

            <div class="form-group">
                <label for="tipo_imovel">Tipo de Imóvel:</label>
                <select class="form-control" id="tipo_imovel" name="tipo_imovel" required>
                    <option value="Urbano">Prédio Urbano</option>
                    <option value="Rustico">Prédio Rústico</option>
                </select>
            </div>

            <div class="form-group">
                <label for="num_filhos">Número de Filhos:</label>
                <select class="form-control" id="num_filhos" name="num_filhos" required>
                    <option value="0">0</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3 ou mais</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary btn-full-width">Calcular IMI</button>
        </form>
        <div id="resultado" class="mt-4"></div>
    </div>
    <footer class="footer mt-auto">
        <?php
            require '../../../views/footer.php';
        ?>
    </footer>
</body>
</html>
