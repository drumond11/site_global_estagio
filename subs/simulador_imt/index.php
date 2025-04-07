<?php
$jsFolder = './assets/js';
if (($preco = get('preco')) && ($tipo = get('tipo')) && ($regiao = get('regiao'))) {
    header('Content-Type: application/json');
    $imt = json_decode(file_get_contents('./imt.json'));
    if(is_numeric($preco) || isset($imt->{$tipo}) || isset($imt->{$tipo}->{$regiao})){
        $objsArr = $imt->{$tipo}->{$regiao};
        usort($objsArr, function($a, $b){return $a->ate==$b->ate?0:($a->ate<$b->ate || $b->ate == null?-1:1);});
        $lastObj = $objsArr[0];
        for($i = 0; $i < count($objsArr); $i++)
            if($objsArr[$i]->ate != null && $preco > $objsArr[$i]->ate)
                $lastObj = $objsArr[$i+1];
        $arr = [
            'selo' => round($preco*0.008, 2),
            'imt' => round($preco*$lastObj->taxa/100 - $lastObj->parcela, 2)
        ];
        $arr['total'] = round($arr['selo'] + $arr['imt'], 2);
        echo json_encode($arr);
    } else {
        echo json_encode(['total' => 0, 'selo' => 0, 'imt' => 0]);
    }
    exit();
}
require '../../views/head.php';
require '../../views/menu.php';
define('CAPTCHA_PRIVATE_KEY', '6LeSBHwpAAAAAOisKm_XCLUMIZ5MQalZlXA-IRp-');
define('CAPTCHA_PUBLIC_KEY', '6LeSBHwpAAAAAFLacq0p04X32UBSdagcmjmPvwnm');
require 'Captcha.php';
?>

<script>
    function showEmailButton() {
        var preco = document.getElementById('preco').value;
        if (preco === ""){
           console.log("required parameters not filled !");
        } else {
            document.getElementById("emailButton").style.display = "inline-block";
        }
    }
</script>

<main class="container flex-grow-1 d-flex flex-column">
    <form action="" method="GET" id="formIMT" class="my-4">
        <div class="row">
            <div class="col-lg-6 mb-2">
                <label for="regiao" class="form-label">Localidade</label>
                <select name="regiao" id="regiao" class="form-select">
                    <option selected="selected" value="continente">Portugal Continental</option>
                    <option value="ilhas">Regiões Autónomas</option>
                </select>
            </div>
            <div class="col-lg-6 mb-2">
                <label for="tipo" class="form-label">Tipo</label>
                <select name="tipo" id="tipo" class="form-select">
                    <option selected="selected" value="habitacaoPropria">Habitação própria</option>
                    <option value="habitacaoSecundaria">Habitação secundária</option>
                    <option value="predioRustico">Prédios rústicos</option>
                    <option value="prediosUrbanosAquisicoesOnerosas">Prédios urbanos e outras aquisições onerosas</option>
                    <option value="territorioFavoravelNaoParticular">Adquirente (exceto particulares) residente em paraíso fiscal ou em território em que o regime fiscal é mais favorável</option>
                    <option value="territorioFavoravelNaoParticularControlado">Entidade dominada ou controlada, direta ou indiretamente, por entidade com domicílio em paraíso fiscal ou em território em que o regime fiscal é mais favorável.</option>
                </select>
            </div>
            <div class="col-lg-12 mb-2">
                <label for="preco" class="form-label">Preço</label>
                <input type="number" name="preco" id="preco" class="form-control" required/>
            </div>
        </div>
        <button type="submit" onclick="showEmailButton();" class="btn btn-primary">Calcular</button>
    </form>

    <table class="table" style="display: none" id="resultTable">
        <thead>
            <tr>
                <th scope="col">Tipo</th>
                <th scope="col">Valor</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>IMT</td>
                <td id="imt" name="imt"></td>
            </tr>
            <tr>
                <td>Selo (0.8%)</td>
                <td id="selo" name="selo"></td>
            </tr>
            <tr>
                <td>Total</td>
                <td id="total" name="total"></td>
            </tr>
        </tbody>
    </table>

    <div class="d-grid">
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
                        <input type="hidden" name="preco" id="hiddenPreco">
                        <input type="hidden" name="imt" id="hiddenImt">
                        <input type="hidden" name="selo" id="hiddenSelo">
                        <input type="hidden" name="total" id="hiddenTotal">
                        <div class="input-group mt-3">
                            <div class="g-recaptcha mt-3" data-sitekey="<?php echo CAPTCHA_PUBLIC_KEY ?>"></div>
                        </div>
                        <div class="d-grid gap-2 col-6 mx-auto p-3">
                            <button class="btn btn-primary" type="submit" name="send">Enviar Email</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script>
    function calcularIMT() {
        // Obtém os valores do formulário
        const regiao = document.getElementById("regiao").value;
        const tipo = document.getElementById("tipo").value;
        const preco = document.getElementById("preco").value;

        if (!preco) {
            alert("Por favor, insira o preço.");
            return;
        }

        // Cria a requisição AJAX
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "calcular_imt.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        // Trata a resposta
        xhr.onload = function () {
            if (xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);

                if (response.success) {
                    // Atualiza a tabela com os valores
                    document.getElementById("imt").innerText = `${response.imt} €`;
                    document.getElementById("selo").innerText = `${response.selo} €`;
                    document.getElementById("total").innerText = `${response.total} €`;

                    // Exibe a tabela e o botão de email
                    document.getElementById("resultTable").style.display = "table";
                    document.getElementById("emailButton").style.display = "block";
                } else {
                    alert(response.message || "Erro ao calcular IMT.");
                }
            } else {
                alert("Erro na requisição. Tente novamente.");
            }
        };

        // Envia a requisição com os dados do formulário
        const data = `regiao=${encodeURIComponent(regiao)}&tipo=${encodeURIComponent(tipo)}&preco=${encodeURIComponent(preco)}`;
        xhr.send(data);
    }

    document.addEventListener("DOMContentLoaded", function () {
        const emailButton = document.getElementById("emailButton");
        if (emailButton) {
            emailButton.addEventListener("click", function () {
                document.getElementById("hiddenPreco").value = document.getElementById("preco").value;
                document.getElementById("hiddenImt").value = document.getElementById("imt").innerText;
                document.getElementById("hiddenSelo").value = document.getElementById("selo").innerText;
                document.getElementById("hiddenTotal").value = document.getElementById("total").innerText;
            });
        }
    });

    // Validação do reCAPTCHA antes de enviar o formulário de email
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
<?php
require '../../views/footer.php';

function get($name) {
    return isset($_GET[$name]) ? $_GET[$name] : false;
}
?>
