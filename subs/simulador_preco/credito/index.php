<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Simulador de Crédito com Tabela</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <link rel="stylesheet" href="css/index.css">
</head>
<?php
    require '../../../views/head.php';
    require '../../../views/menu.php';
    define('CAPTCHA_PRIVATE_KEY', '6LeSBHwpAAAAAOisKm_XCLUMIZ5MQalZlXA-IRp-');
    define('CAPTCHA_PUBLIC_KEY', '6LeSBHwpAAAAAFLacq0p04X32UBSdagcmjmPvwnm');
    require '../credito_simples/Captcha.php';
?>
<script>
    function showEmailButton() {
        var valor = document.getElementById('valor').value;
        var taxa = document.getElementById('taxa').value;
        var spread = document.getElementById('spread').value;
        var parcelas = document.getElementById('parcelas').value; 

        if (valor === "" || taxa === "" || spread === "" || parcelas === "") {
           console.log("required parameters not filled !");
        } else {
            document.getElementById("emailButton").style.display = "inline-block";
        }
    }
</script>
<body>
    <div class="container">
        <form id="simuladorForm">
            <div class="form-group">
                <label for="valor">Valor do Empréstimo ($)</label>
                <input type="number" class="form-control" id="valor" name="valor" step="0.01" required>
            </div>
            <div class="form-group">
                <label for="taxa">Taxa de Juros (% ao ano)</label>
                <input type="number" class="form-control" id="taxa" name="taxa" step="0.01" required>
            </div>
            <div class="form-group">
                <label for="spread">Spread Bancário (% ao ano)</label>
                <input type="number" class="form-control" id="spread" name="spread" step="0.01" required>
            </div>
            <div class="form-group">
                <label for="parcelas">Meses</label>
                <input type="number" class="form-control" id="parcelas" name="parcelas" required>
            </div>
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary d-grid gap-2" onclick="showEmailButton()">Simular</button>
            </div>
        </form>

        <div id="resultado" class="mt-4" style="display:none;">
            <h2>Resultado da Simulação</h2>
            <p><strong>Valor do Empréstimo:</strong> $ <span id="valorEmprestimo" name="valorEmprestimo"></span></p>
            <p><strong>Taxa de Juros (% ao ano):</strong> <span id="taxaEfetiva" name="taxaEfetiva"></span></p>
            <p><strong>Número de Parcelas:</strong> <span id="numParcelas" name="numParcelas"></span></p>
            <p><strong>Valor da Parcela:</strong> $ <span id="valorParcela" name="valorParcela"></span></p>

            <h2 class="mt-4">Tabela de Amortização</h2>
            <table class='table table-bordered'>
                <thead class='thead-light'>
                    <tr>
                        <th>Mês</th>
                        <th>Prestação</th>
                        <th>Juros</th>
                        <th>Amortização</th>
                        <th>Saldo Devedor</th>
                    </tr>
                </thead>
                <tbody id="tabelaAmortizacao">
                </tbody>
            </table>

            <p class='mt-4'><strong>Total de Juros Pagos:</strong> $ <span id="jurosTotal"></span></p>
            <p><strong>Total Amortizado:</strong> $ <span id="totalAmortizado"></span></p>
        </div>
        <div class="d-grid mb-3">
            <button type="button" id="emailButton" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" style="display: none;">Email</button>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Digite os seus dados</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-3">
                        <form id="emailForm" action="sender.php" method="POST">
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">@</span>
                                <input type="email" class="form-control" placeholder="Email" aria-label="Username" aria-describedby="basic-addon1" name="email" id="email" required>
                            </div>
                                <input type="hidden" name="valorEmprestimo" id="hiddenValorEmprestimo">
                                <input type="hidden" name="taxaEfetiva" id="hiddenTaxaEfetiva">
                                <input type="hidden" name="numParcelas" id="hiddenNumParcelas">
                                <input type="hidden" name="valorParcela" id="hiddenValorParcela">
                            <div class="input-group mt-3">
                                <div class="g-recaptcha mt-3" data-sitekey="<?php echo CAPTCHA_PUBLIC_KEY?>"></div>
                            </div>
                            <div class="d-grid gap-2 col-6 mx-auto p-3">
                                <button class="btn btn-primary" type="submit" name="send">Enviar Email</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <?php
        require '../../../views/footer.php';
    ?>
    <script>
        $(document).ready(function(){
            $('#simuladorForm').on('submit', function(event){
                event.preventDefault();
                $.ajax({
                    url: 'simulador.php',
                    method: 'POST',
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(response){
                        if(response.success){
                            $('#valorEmprestimo').text(response.valor.toFixed(2).replace('.', ','));
                            $('#taxaEfetiva').text(response.taxaEfetiva.toFixed(2).replace('.', ','));
                            $('#numParcelas').text(response.parcelas);
                            $('#valorParcela').text(response.parcela.toFixed(2).replace('.', ','));

                            $('#tabelaAmortizacao').empty();
                            var currentYear = 1;
                            var yearRow = '<tr class="year-row" data-year="' + currentYear + '"><td colspan="5"><strong>Ano ' + currentYear + '</strong></td></tr>';
                            $('#tabelaAmortizacao').append(yearRow);
                            $.each(response.tabela, function(index, item){
                                var row = '<tr class="month-row year-' + currentYear + '">';
                                row += '<td>' + item.mes + '</td>';
                                row += '<td>$ ' + item.parcela.toFixed(2).replace('.', ',') + '</td>';
                                row += '<td>$ ' + item.juros.toFixed(2).replace('.', ',') + '</td>';
                                row += '<td>$ ' + item.amortizacao.toFixed(2).replace('.', ',') + '</td>';
                                row += '<td>$ ' + item.saldoDevedor.toFixed(2).replace('.', ',') + '</td>';
                                row += '</tr>';
                                $('#tabelaAmortizacao').append(row);

                                if(item.mes % 12 == 0 && item.mes < response.parcelas){
                                    currentYear++;
                                    yearRow = '<tr class="year-row" data-year="' + currentYear + '"><td colspan="5"><strong>Ano ' + currentYear + '</strong></td></tr>';
                                    $('#tabelaAmortizacao').append(yearRow);
                                }
                            });

                            $('#jurosTotal').text(response.jurosTotal.toFixed(2).replace('.', ','));
                            $('#totalAmortizado').text(response.amortizacaoTotal.toFixed(2).replace('.', ','));
                            $('#resultado').show();
                        } else {
                            alert('Erro na simulação. Por favor, tente novamente.');
                        }
                    }
                });
            });

            // Toggle visibility of months in a year
            $(document).on('click', '.year-row', function(){
                var year = $(this).data('year');
                $('.year-' + year).toggle();
            });
        });
       document.addEventListener("DOMContentLoaded", function () {
            const emailButton = document.getElementById("emailButton");
            if (emailButton) {
                emailButton.addEventListener("click", function () {
                    document.getElementById("hiddenValorEmprestimo").value = document.getElementById("valorEmprestimo").innerText;
                    document.getElementById("hiddenTaxaEfetiva").value = document.getElementById("taxaEfetiva").innerText;
                    document.getElementById("hiddenNumParcelas").value = document.getElementById("numParcelas").innerText;
                    document.getElementById("hiddenValorParcela").value = document.getElementById("valorParcela").innerText;
                });
            }
        });
        
        document.getElementById("emailForm").addEventListener("submit", function(event) {
        var recaptchaResponse = grecaptcha.getResponse();
        if (recaptchaResponse.length === 0) {
            event.preventDefault();
            // Seleciona o container do reCAPTCHA e adiciona uma borda vermelha
            let recaptchaContainer = document.querySelector('.g-recaptcha');
            recaptchaContainer.style.border = "3px solid red";
            return;
        } else {
            // Remove a borda vermelha se o reCAPTCHA for validado
            document.querySelector('.g-recaptcha').style.border = "";
        }
    });
    </script>
</body>
</html>