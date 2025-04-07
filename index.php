<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <?php require './views/head.php'; ?>
    <link rel="stylesheet" href="index.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src='./number_index.js'></script>
</head>
<body>
    <?php require './views/menu.php'; ?>
    <div class="bg_wrapper_teste"></div>
    <br>
    <div class="container">
        <h1 class="title">Quem Somos</h1>
        <p class="cont">Na D31, unimos expertise em crédito hipotecário, mediação mobiliária, assessoria jurídica e financeira para construir o seu futuro imobiliário com solidez e confiança.</p>
        <div style="height: 35px;"></div>
    </div>
    <div class="cont-mp">
        <table>
            <tr>
                <td style="width: 25%;">
                    <i class="fa-solid fa-hotel bigger-icons"></i><br>
                    <a>Crédito hipotecário</a> 
                </td>
                <td style="width: 25%;"><a href="https://www.d31imo.biz/" target="_blank" class="nav-link">
                    <i class="fa-solid fa-house-chimney-window bigger-icons"></i><br>
                    <a>Mediação Mobiliária</a>
                    </a>
                </td>
                <td style="width: 25%;">
                    <i class="fa-solid fa-gavel bigger-icons"></i><br>
                    <a>Jurídico</a>
                </td>
                <td style="width: 25%;">
                    <i class="fa-solid fa-credit-card bigger-icons"></i><br>
                    <a>Financeiro</a>
                </td>
            </tr>
        </table>
    </div>

    <!-- Responsive Colaboradores / Imoveis / Vendas -->
    <div class="container text-center">
        <div class="row text-center">
            <h4 class="text-center">A empresa em números</h4>
        </div>
        <div class="stats-container">
            <div class="stat-circle">
                <div class="number-o"><span class="number-o" id="timer_vendas">0</span>+</div>
                <span class="label">Vendas</span>
            </div>
            <div class="stat-circle">
                <div class="number-b"><span class="number-b" id="timer_colab">0</span>+</div>
                <span class="label">Colaboradores</span>
            </div>
            <div class="stat-circle">
            <div class="number-g"><span class="number-g" id="timer_imoveis">0</span>+</div>
                <span class="label">Imóveis</span>
            </div>
        </div>
    </div>
    
    <!--fim dos numeros com animação -->


    <!-- Script para invocar a execução do reCAPTCHA -->
    <script>
        // Função para executar o reCAPTCHA programaticamente
        function executeRecaptcha() {
            grecaptcha.execute('6LfBbA4qAAAAAJow1OnuuH_4AGQz3VeSbTlvD59k', { action: 'submit' })
            .then(function(token) {
                console.log('reCAPTCHA token:', token);
                onSubmit(token);
            });
        }

        // Função callback a ser chamada após o usuário ser verificado
        function onSubmit(token) {
            console.log('Token recebido:', token);
        }

        // Chama a função para executar o reCAPTCHA assim que a página for carregada
        window.onload = function() {
            executeRecaptcha();
        };
    </script>
    <script src='./number_index.js'></script>
    <?php require './views/footer.php'; ?>
</body>
</html>
