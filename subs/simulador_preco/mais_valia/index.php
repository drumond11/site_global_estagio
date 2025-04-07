<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <?php 
    require '../../../views/head.php';
    require '../../../views/menu.php'; 
    ?>
    <title>Mais-Valia</title>
</head>
<body class="bg-secondary">
    <div class="container">

        <?php
        $jsondata_anoAquisicao = file_get_contents('json_ano_aquisicao.json');
        $json_ano_aquisicao = json_decode($jsondata_anoAquisicao, true);
        ?>
        <div class="row g-3 p-1 m-3 mb-4">
            <form method="post" action="calc.php" id="form" name="form">
                <div class="mb-4">
                  <label for="input_valorAquisicao" class="form-label">Valor da aquisição do imóvel</label>
                  <input type="number" class="form-control" id="input_valorAquisicao" name="input_valorAquisicao" placeholder="digite...">
                </div> 
                <div class="col-6 mb-4">
                        <label for="input_monetario" class="form-label">Ano da aquisição</label>        
                        <?php 
                        echo '<select class="form-select" aria-label="Default select example" id="input_valorMonetarioAnoAquisicao" name="input_valorMonetarioAnoAquisicao">';
                        foreach ($json_ano_aquisicao as $ano_aquisicao => $value) {
                            echo '<option value="' . htmlspecialchars($value) . '">' . htmlspecialchars($ano_aquisicao) . '</option>';
                        }
                        echo '</select>';
                        ?>
                </div>
                <div class="mb-4">
                <label for="input_valorVenda" class="form-label">Valor de venda do imóvel</label>
                <input type="number" class="form-control" id="input_valorVenda" name="input_valorVenda" placeholder="digite...">
                </div>
                <div class="col-6 mb-4">
                    <label for="input_monetario" class="form-label">Ano da Venda</label>                  
                    <select class="form-select" aria-label="" id="input_valorMonetarioAnoVenda" name="input_valorMonetarioAnoVenda">
                        <option value="1.1">2017</option>
                        <option value="1.09">2018</option>
                        <option value="1.09">2019</option>
                        <option value="1.09">2020</option>
                        <option value="1.08">2021</option>
                        <option value="1">2022</option>
                        <option value="1">2023</option>
                        <option selected value="1">2024</option>
                    </select>
                </div> 
                <div class="mb-4">
                  <label for="input_valorDespesa" class="form-label">Despesas</label>
                  <input type="number" class="form-control" id="input_valorDespesa" name="input_valorDespesa" placeholder="digite...">
                </div>
                <div class="mt-4 mb-4 text-center d-grid gap-2">
                    <button type="submit" class="btn btn-primary" id="calcular">CALCULAR MAIS VALIA</button>
                </div>    
            </form>
        </div>
    </div>
    <div class="container" id="resultContainer" style="display:none;">
        <div class="row g-3 p-1 m-3 mb-4">
            <div class="col text-center mb-4">
                <span id="resultMaisValia" class="d-grid gap-2 bg-success btn text-center text-white"></span>
                <p class="mt-4 d-grid gap-2">
                    <button class="btn btn-warning" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTax" aria-expanded="false" aria-controls="collapseTax">
                        Valor de Taxas
                    </button>
                </p>
                    <div class="card card-body fs-5">
                       <p id="resultTaxa"> Valor da Taxa: </p>
                        <br>
                        <p id="resultTaxaAbater"> Valor da Taxa a abater: </p>
                    </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            $('#form').on('submit', function(event){
                event.preventDefault();
                $.ajax({
                    url: 'calcValor.php',
                    method: 'POST',
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(response){
                        if(response.success){
                            $('#resultMaisValia').text('Mais valia: ' + response.valor_mais_valia.toFixed(2).replace('.', ',') + ' €');
                            $('#resultTaxa').text('Valor da Taxa: ' + response.valor_taxa.toFixed(2).replace('.', ',') + ' €');
                            $('#resultTaxaAbater').text('Valor da Taxa a abater: ' + response.valor_taxa_abater.toFixed(2).replace('.', ',') + ' €');
                            $('#resultContainer').show();
                        } else {
                            alert('ERROR, verifique a introdução dos dados!');
                        }
                    }
                });
            });
        });
    </script>
    <footer class="footer mt-auto">
        <?php
            require '../../../views/footer.php';
        ?>
    </footer>
</body>
</html>