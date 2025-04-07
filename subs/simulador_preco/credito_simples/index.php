<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Crédito simples</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>
<body>
    <?php
        require '../../../views/head.php';
        require '../../../views/menu.php';
        define('CAPTCHA_PRIVATE_KEY', '6LeSBHwpAAAAAOisKm_XCLUMIZ5MQalZlXA-IRp-');
        define('CAPTCHA_PUBLIC_KEY', '6LeSBHwpAAAAAFLacq0p04X32UBSdagcmjmPvwnm');
        require 'Captcha.php';
    ?>
    <script>
    function showEmailButton() {
      const emailButton = document.getElementById("emailButton");
      emailButton.style.display = "inline-block";
    }
    </script>
    <div class="container flex-grow-1">
        <form id="simuladorForm">
            <div class="form-group">
                <label for="valor">Valor do Empréstimo ($)</label>
                <input type="range" class="form-control-range" id="valor" name="valor" min="50000" max="500000" step="2000" value="50000">
                <div class="slider-value" id="valorDisplay">$ 50000</div>
            </div>
            <div class="form-group">
                <label for="prazo">Prazo (Anos)</label>
                <input type="range" class="form-control-range" id="prazo" name="prazo" min="10" max="40" step="1" value="10">
                <div class="slider-value" id="prazoDisplay">10 anos</div>
            </div>
            <div class="d-flex align-items-center mb-3">
                <button type="button" class="btn btn-secondary" id="editarSpread">Editar Spread</button>
                <div id="spreadContainer" style="display:none; margin-left: 10px;">
                    <div class="form-group">
                        <label for="spread">Spread Bancário (% ao ano)</label>
                        <input type="number" class="form-control" id="spread" name="spread" step="0.01" value="1.2">
                    </div>
                </div>
            </div>
            <p class="spread-note">Nota: O spread está predefinido como 1,2%.</p>
            <div class="d-grid gap-2 mt-3">
                <button type="submit" class="btn btn-primary d-grid gap-2" onclick="showEmailButton()">Simular</button>
            </div>
        </form>

        <div id="resultado" class="mt-4" style="display:none;">
            <p><strong>Valor da Parcela Mensal:</strong> $ <span id="valorParcela" name="valorParcela"></span></p>
        </div>
        <br>

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
                                <input type="email" required class="form-control" placeholder="Email" aria-label="Username" aria-describedby="basic-addon1" name="email" id="email">
                            </div>
                                <input type="hidden" name="valor" id="hiddenValor">
                                <input type="hidden" name="prazo" id="hiddenPrazo">
                                <input type="hidden" name="spread" id="hiddenSpread">
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
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    </div>
    <footer class="footer mt-auto">
        <?php
            require '../../../views/footer.php';
        ?>
    </footer>
    <script>
        $(document).ready(function(){
            $('#valor').on('input', function(){
                $('#valorDisplay').text('$ ' + parseFloat(this.value).toLocaleString());
            });

            $('#prazo').on('input', function(){
                $('#prazoDisplay').text(this.value + ' anos');
            });

            $('#editarSpread').on('click', function(){
                $('#spreadContainer').toggle();
                if ($('#spreadContainer').is(':visible')) {
                    $(this).css('margin-right', '10px');
                } else {
                    $(this).css('margin-right', '0');
                }
            });

            $('#simuladorForm').on('submit', function(event){
                event.preventDefault();

                const valor = parseFloat($('#valor').val());
                const taxa = 0; // Taxa de juros é fixada em 0
                const spread = parseFloat($('#spread').val()) / 100;
                const prazoAnos = parseInt($('#prazo').val());
                const parcelas = prazoAnos * 12;

                const taxaEfetiva = (taxa / 100 + spread) / 12;
                const parcela = valor * taxaEfetiva / (1 - Math.pow(1 + taxaEfetiva, -parcelas));

                $('#valorParcela').text(parcela.toFixed(2).replace('.', ','));
                $('#resultado').show();
            });
        });

        document.addEventListener("DOMContentLoaded", function () {
            const emailButton = document.getElementById("emailButton");
            if (emailButton) {
                emailButton.addEventListener("click", function () {
                    document.getElementById("hiddenValor").value = document.getElementById("valor").value;
                    document.getElementById("hiddenPrazo").value = document.getElementById("prazo").value;
                    document.getElementById("hiddenSpread").value = document.getElementById("spread").value;
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