<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <title>Simulador de Taxa de Esforço</title>
</head>
<?php 
    require '../../../views/head.php';
    require '../../../views/menu.php'; 
?>
<body>
    <div class="container">
        <div class="row g-3 p-1 m-3 mb-1">
            <form method="post" action="calcular.php" id="form" name="form">
                <div class="row mb-4">
                    <div class="col mb-4">
                        <h3>Rendimentos Mensais</h3>
                        <label for="input_RendimentoMensal" class="form-label">Rendimento Mensal Liquido</label>
                        <input type="number" class="form-control" min="1" id="input_RendimentoMensal" name="input_RendimentoMensal" placeholder="digite...">
                    </div>
                </div>
                <div class="row mb-2">
                    <h3>Despesas mensais</h3>
                    <div class="col mb-4">
                        <label for="input_creditoHabitacao" class="form-label">Crédito Habitação</label>
                        <input type="number" class="form-control" min="1" id="input_creditoHabitacao" name="input_creditoHabitacao" placeholder="digite...">
                    </div>
                    <div class="col mb-4">
                        <label for="input_creditoAutomovel" class="form-label">Crédito Automóvel</label>
                        <input type="number" class="form-control" min="0" id="input_creditoAutomovel" name="input_creditoAutomovel" placeholder="digite...">
                    </div>
                    <div class="col mb-4">
                        <label for="input_creditoPessoal" class="form-label">Crédito Pessoal</label>
                        <input type="number" class="form-control" min="0" id="input_creditoPessoal" name="input_creditoPessoal" placeholder="digite...">
                    </div>
                </div>
                <div class="row mb-4">    
                    <div class="col mb-4">
                        <label for="input_dividas_cartaoCredito" class="form-label">Dívida do Cartão de Crédito</label>
                        <input type="number" class="form-control" min="0" id="input_dividas_cartaoCredito" name="input_dividas_cartaoCredito" placeholder="digite...">
                    </div>
                    <div class="col mb-4">
                        <label for="input_outrosCreditos" class="form-label">Outros Créditos</label>
                        <input type="number" class="form-control" min="0" id="input_outrosCreditos" name="input_outrosCreditos" placeholder="digite...">
                    </div>
                    <div class="col mb-4">
                        <label for="input_encargosDomesticos" class="form-label">Total de Encargos Domésticos</label>
                        <input type="number" class="form-control" min="0" id="input_encargosDomesticos" name="input_encargosDomesticos" placeholder="digite...">
                    </div>
                </div>    
                <div class="row">
                    <div class="mt-4 mb-4 text-center d-grid gap-2">
                        <button type="submit" class="btn btn-primary">Simular Taxa de Esforço</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="container" id="resultContainer" style="display:none;">
        <div class="row g-3 p-1 m-3">
            <div class="col mb-2">
                <span id="percentagem_taxa" class="card p-2 text-center"></span>
                <span id="text_resultado" class="card p-2 mt-2"></span>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            $('#form').on('submit', function(event){
                event.preventDefault();
                $.ajax({
                    url: 'calcular.php',
                    method: 'POST',
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(response){
                        if(response.success){
                            var percentagem = response.percentagem_taxa.toFixed(0).replace('.', ',');
                            $('#percentagem_taxa').removeClass('bg-success bg-warning bg-danger text-white text-dark');
                            $('#text_resultado').removeClass('bg-success bg-warning bg-danger text-white text-dark');
                            if(response.percentagem_taxa <= 30){ 
                                $('#percentagem_taxa').addClass('bg-success text-white');
                                $('#percentagem_taxa').text('Taxa de Esforço ' + percentagem + ' %');
                                $("#text_resultado").addClass('bg-success');
                                $('#text_resultado').text('A sua taxa de esforço está em estado saudável. A relação entre os seus rendimentos e os seus encargos mensais está equilibrada e permite-lhe novos investimentos. Contudo, pondere sempre novos gastos com cuidado, resguarde a sua poupança e mantenha o seu orçamento sustentável.');
                            }else if(response.percentagem_taxa <= 60){ 
                                $('#percentagem_taxa').addClass('bg-warning text-dark');
                                $('#percentagem_taxa').text('Taxa de Esforço ' + percentagem + ' %');
                                $("#text_resultado").addClass('bg-warning text-dark');
                                $('#text_resultado').text('A sua Taxa de Esforço está em estado preocupante. A relação entre os seus rendimentos e as suas despesas pode ser comprometida com alguma facilidade ao subscrever novos créditos. Pondere rever todos os seus encargos e mensalidades, de forma a reduzir as suas obrigações e ganhar folga no seu orçamento mensal.');
                            }else if (response.percentagem_taxa <=100){
                                $('#percentagem_taxa').addClass('bg-danger text-white');
                                $('#percentagem_taxa').text('Taxa de Esforço ' + percentagem + ' %');
                                $("#text_resultado").addClass('bg-danger');
                                $('#text_resultado').text('A sua Taxa de Esforço está em estado crítico. É urgente que reveja o seu orçamento em detalhe e reduza os seus encargos financeiros. Considere renegociar o seu crédito habitação, rever as coberturas dos seguros, consolidar créditos ao consumo, bem como despesas com telecomunicações, ginásios e outras mensalidades. Desta forma conseguirá um maior equilíbrio entre o que recebe e as suas despesas, ganhando um orçamento mais saudável e uma vida também mais descansada.');
                            }else{
                                $('#percentagem_taxa').addClass('bg-danger text-white');
                                $('#percentagem_taxa').text('Taxa de Esforço >' + 100 + ' %');
                                $("#text_resultado").addClass('bg-danger');
                                $('#text_resultado').text('O valor das despesas supera o valor dos rendimentos. A sua Taxa de Esforço está em estado crítico. É urgente que reveja o seu orçamento em detalhe e reduza os seus encargos financeiros. Considere renegociar o seu crédito habitação, rever as coberturas dos seguros, consolidar créditos ao consumo, bem como despesas com telecomunicações, ginásios e outras mensalidades. Desta forma conseguirá um maior equilíbrio entre o que recebe e as suas despesas, ganhando um orçamento mais saudável e uma vida também mais descansada.');
                                response.percentagem_taxa = 100;
                            }
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