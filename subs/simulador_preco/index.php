<?php
use Simulador\Preco\Valor;
require './Classes/index.php';
require __DIR__.'/valores.php';

if ($distrito = get('distrito')) {
    header('Content-Type: application/json');
    $val = [];
    $valor = new Valor([$distrito, get('concelho'), get('freguesia')], $valores);
    $val['estado'] = ($valor->setEstado(get('estado')))->calcularEstado();
    $val['bruto'] = ($valor->setTerreno(get('bruto'), true))->calcularTerreno(Valor::$MODO_TERRENO_BRUTO);
    $val['terreno'] = ($valor->setTerreno(get('terreno')))->calcularTerreno(Valor::$MODO_TERRENO_TERRENO);
    $caracs = get('caracteristicas');
    if (!empty($caracs) && is_array($caracs))
        foreach ($caracs as $carac)
            $valor->setCaracteristica($carac, 1);
    $val['caracteristicas'] = $valor->calcularCaracteristicas();
    $val['total'] = $valor->calcularTotal();
    echo json_encode($val);
    exit();
}

$cssFolder = './assets/css';
$jsFolder = './assets/js';

require '../../views/head.php';
require '../../views/menu.php';
define('CAPTCHA_PRIVATE_KEY', '6LeSBHwpAAAAAOisKm_XCLUMIZ5MQalZlXA-IRp-');
define('CAPTCHA_PUBLIC_KEY', '6LeSBHwpAAAAAFLacq0p04X32UBSdagcmjmPvwnm');
require 'Captcha.php';
?>

<main class="container flex-grow-1 d-flex flex-column">
    <div>
        <form action="" method="GET" id="formpreco">
            <div class="row">
                <div class="col-lg-4">
                    <label for="distrito">Distrito</label>
                    <select class="form-select mt-1" name="distrito" id="distrito">
                        <option value="none"></option>
                    </select>
                </div>
                <div class="col-lg-4">
                    <label for="concelho">Concelho</label>
                    <select class="form-select mt-1" name="concelho" id="concelho">
                        <option value="none"></option>
                    </select>
                </div>
                <div class="col-lg-4">
                    <label for="freguesia">Freguesia</label>
                    <select class="form-select mt-1" name="freguesia" id="freguesia">
                        <option value="none"></option>
                    </select>
                </div>
                <div>
                    <label for="tereno">Terreno m<sup>2</sup></label>
                    <input type="text" class="form-control" name="terreno" id="terreno" required>
                    <label for="tereno">Bruto m<sup>2</sup></label>
                    <input type="text" class="form-control" name="bruto" id="bruto" required>
                </div>
                <p class="mt-2 mb-0">Estado</p>
                <div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="estado" value="novo" id="estadoNovo" checked="checked">
                        <label class="form-check-label" for="estadoNovo">Novo</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="estado" value="usado" id="estadoUsado">
                        <label class="form-check-label" for="estadoUsado">Usado</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="estado" value="ruinas" id="estadoRuinas">
                        <label class="form-check-label" for="estadoRuinas">Ruinas</label>
                    </div>
                </div>
                <p class="mt-2 mb-0">Caracteristicas</p>
                <div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="piscina" name="caracteristicas[]" id="caracteristicaPiscina">
                        <label class="form-check-label" for="caracteristicaPiscina">Piscina</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="varanda" name="caracteristicas[]" id="caracteristicaVaranda">
                        <label class="form-check-label" for="caracteristicaVaranda">Varanda</label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary" id="openModal">Calcular</button>
            </div>
        </form>
    </div>
    <div class="row">
        <div class="col-lg-3 "></div>
        <div class="col-lg-6">
            <table id="table-result" class="table" style="display: none">
                <thead>
                    <tr>
                        <th scope="col">Tipo</th>
                        <th scope="col">Valor</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Terreno</td>
                        <td id="vTerreno" name="vTerreno"></td>
                    </tr>
                    <tr>
                        <td>Bruto</td>
                        <td id="vBruto" name="vBruto"></td>
                    </tr>
                    <tr>
                        <td>Total</td>
                        <td id="vTotal" name="vTotal"></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- MODAL -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Preenche os dados para ver simulação</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-3">
                        <form action="sender.php" method="POST" id="emailForm">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Nome" name="nome" required id="nome">
                            </div>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Morada" name="morada" required id="morada">
                            </div>
                            <div class="input-group mb-3">
                                <input type="number" class="form-control" placeholder="Telemóvel" name="tele" required id="tele">
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">@</span>
                                <input type="email" class="form-control" placeholder="Email" required aria-label="Email" aria-describedby="basic-addon1" name="email" id="email">
                                <div class="input-group mt-3">
                                    <div class="g-recaptcha mt-3" data-sitekey="<?php echo CAPTCHA_PUBLIC_KEY ?>"></div>
                                </div>
                            </div>
                            <input type="hidden" name="terreno" id="hiddenTerreno">
                            <input type="hidden" name="bruto" id="hiddenBruto">
                            <input type="hidden" name="vTerreno" id="hiddenVTerreno">
                            <input type="hidden" name="vBruto" id="hiddenVBruto">
                            <input type="hidden" name="vTotal" id="hiddenVTotal">
                            <div class="d-grid gap-2 col-6 mx-auto p-3">
                                <button class="btn btn-primary" type="submit" name="send">Enviar Email</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- END MODAL -->
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    </div>
</main>

<script>
document.addEventListener("DOMContentLoaded", function () {
    // Elementos dos formulários
    const calcForm = document.getElementById("formpreco");
    const calcularButton = document.getElementById("openModal");
    const modal = new bootstrap.Modal(document.getElementById('exampleModal'));
    const resultTable = document.querySelector(".table");
    
    // Elementos de exibição dos valores
    const vTerreno = document.getElementById("vTerreno");
    const vBruto = document.getElementById("vBruto");
    const vTotal = document.getElementById("vTotal");
    
    // Campos ocultos no formulário do modal
    const hiddenTerreno = document.getElementById("hiddenTerreno");
    const hiddenBruto = document.getElementById("hiddenBruto");
    const hiddenVTerreno = document.getElementById("hiddenVTerreno");
    const hiddenVBruto = document.getElementById("hiddenVBruto");
    const hiddenVTotal = document.getElementById("hiddenVTotal");
    
    // Formulário do modal
    const emailForm = document.getElementById("emailForm");
    
    // Criação do loader (usando classes Bootstrap)
    const loaderHtml = `
        <div id="page-loader" class="position-fixed top-0 start-0 w-100 h-100 d-none bg-dark bg-opacity-75 align-items-center justify-content-center" 
             style="z-index: 9999;">
            <div class="d-flex justify-content-center align-items-center h-100">
                <div class="spinner-border text-light" style="width: 3rem; height: 3rem;" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        </div>
    `;
    document.body.insertAdjacentHTML('beforeend', loaderHtml);
    const loader = document.getElementById("page-loader");
    
    // Funções para exibir/ocultar o loader
    function showLoader() {
        loader.classList.remove("d-none");
        loader.classList.add("d-flex");
    }
    
    function hideLoader() {
        loader.classList.remove("d-flex");
        loader.classList.add("d-none");
    }
    
    // Ao clicar no botão "Calcular"
    calcularButton.addEventListener("click", function (e) {
        e.preventDefault();
        showLoader();
        
        const formData = new FormData(calcForm);
        const params = new URLSearchParams(formData);
        
        fetch(`index.php?${params.toString()}`)
            .then(response => response.json())
            .then(data => {
                // Exibe os valores na tabela
                vTerreno.innerText = data.terreno.toFixed(2) + " €";
                vBruto.innerText = data.bruto.toFixed(2) + " €";
                vTotal.innerText = data.total.toFixed(2) + " €";
                
                // Preenche os campos ocultos do modal
                hiddenTerreno.value = document.getElementById("terreno").value;
                hiddenBruto.value = document.getElementById("bruto").value;
                hiddenVTerreno.value = data.terreno.toFixed(2) + " €";
                hiddenVBruto.value = data.bruto.toFixed(2) + " €";
                hiddenVTotal.value = data.total.toFixed(2) + " €";
                
                hideLoader();
                modal.show();
            })
            .catch(error => {
                console.error("Error:", error);
                hideLoader();
                alert("Ocorreu um erro ao calcular. Por favor, tente novamente.");
            });
    });
    
    // Envio do formulário do modal com verificação do reCAPTCHA
    emailForm.addEventListener("submit", function (e) {
        var recaptchaResponse = grecaptcha.getResponse();
        if (recaptchaResponse.length === 0) {
            e.preventDefault();
            // Seleciona o container do reCAPTCHA e adiciona uma borda vermelha
            let recaptchaContainer = document.querySelector('.g-recaptcha');
            recaptchaContainer.style.border = "3px solid red";
            return;
        } else {
            // Caso o reCAPTCHA seja validado, remove qualquer destaque anterior
            document.querySelector('.g-recaptcha').style.border = "";
        }
        
        e.preventDefault();
        showLoader();
        const modalFormData = new FormData(emailForm);
        
        fetch("sender.php", {
            method: "POST",
            body: modalFormData
        })
        .then(response => response.text())
        .then(data => {
            hideLoader();
            modal.hide();
            resultTable.style.display = "table";
            // Opcional: exibir mensagem de sucesso
        })
        .catch(error => {
            console.error("Error:", error);
            hideLoader();
            alert("Erro ao enviar email. Por favor, tente novamente.");
        });
    });
});
</script>

<?php
require '../../views/footer.php';
function get($name) {
    return isset($_GET[$name]) ? $_GET[$name] : false;
}
?>
