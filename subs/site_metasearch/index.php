<?php
session_start();
include_once("config.php");
require_once "DB.php";
require '../../php_mailer/config.php';
require '../../views/head.php';
require '../../views/menu.php';
$db = new DB();

//popular variaveis
define('NAME', 'Joao Drumond');
define('CAPTCHA_PRIVATE_KEY', '6LeSBHwpAAAAAOisKm_XCLUMIZ5MQalZlXA-IRp-');
define('CAPTCHA_PUBLIC_KEY', '6LeSBHwpAAAAAFLacq0p04X32UBSdagcmjmPvwnm');
require "Emailer.php";
require 'Captcha.php';

$emailer = new Emailer();
$senderEmail = isset($_POST['sender_email'])?$_POST['sender_email']:null;
$phoneNumber = isset($_POST['phone_number'])?$_POST['phone_number']:null;
$emailBody = isset($_POST['email_body'])?$_POST['email_body']:null;
$propertyId = isset($_POST['property_id'])?$_POST['property_id']:null;
$valido = true;
$tst = false;
$captcha = new Captcha();




if($senderEmail && $phoneNumber && $emailBody && $propertyId){
    
    if(!$captcha->verificar()){
        $valido = false;
        $tst = true;
    }
    if(!filter_var($senderEmail, FILTER_VALIDATE_EMAIL)){
        $eerror = "Email inválido";
        $valido = false;
    }
    if(!preg_match("/^\d{9}$/", $phoneNumber)){
        $eerror = "Número de telefone inválido";
        $valido = false;
    }
    if($valido){
        $_SESSION['sender_email'] = $senderEmail;
        $_SESSION['phone_number'] = $phoneNumber;
        //select from db the id of imovel
        $imovel = $db->getImovel($propertyId);
        $subject = "Cliente interessado !";

        $message =
        "<ul>
           <li>Website: ".$imovel[0]['website_link']."</li>
            <br>
            <li>Email: ".$senderEmail."</li>
            <li>Telefone: ".$phoneNumber."</li>
            <li>Mensagem: ".$emailBody."</li>
        </ul>";    
        $emailer->send($subject, $message);
    ?>
            <div class="alert alert-success" role="alert">
            Email enviado com sucesso
            </div>
    <?php
            $_POST = array();
    }else if(!$tst){?>
        <div class="alert alert-danger" role="alert">
        Erro ao enviar email.
        <?php echo $eerror?>
        </div>
    <?php
    }else{
    ?>
    <div class="alert alert-danger" role="alert">
    preencha todos os campos
    </div>
<?php
    }
}
?>
<style>
        .table th,
        .table td {
            text-align: left; /* Left-align text in table cells */
        }
</style>
<main class="flex-grow-1 d-flex flex-column">
    <div class="container">
        <h1>Imóveis</h1>

        <!-- Filter Form -->
       <!-- Filter Form -->
<form id="filter" method="GET">
    <div class="row">
        <!-- Price Range -->
        <div class="col-md-3">
            <label for="min_price">Preço Mínimo:</label>
            <input type="text" class="form-control" id="min_price" name="min_price" 
                   value="<?php echo isset($_GET['min_price']) ? $_GET['min_price'] : '5000'; ?>" 
                   placeholder="">
        </div>
        <div class="col-md-3">
            <label for="max_price">Preço Máximo:</label>
            <input type="text" class="form-control" id="max_price" name="max_price" 
                   value="<?php echo isset($_GET['max_price']) ? $_GET['max_price'] : ''; ?>" 
                   placeholder="">
        </div>
        <!-- Area Range -->
        <div class="col-md-3">
            <label for="min_area">Área Mínima(m2):</label>
            <input type="text" class="form-control" id="min_area" name="min_area" 
                   value="<?php echo isset($_GET['min_area']) ? $_GET['min_area'] : '0'; ?>" 
                   placeholder="">
        </div>
        <div class="col-md-3">
            <label for="max_area">Área Máxima(m2):</label>
            <input type="text" class="form-control" id="max_area" name="max_area" 
                   value="<?php echo isset($_GET['max_area']) ? $_GET['max_area'] : ''; ?>" 
                   placeholder="">
        </div>
        <!-- Distrito -->
                      
        <div class="col-md-3">
                    <label for="distrito">Distrito:</label>
                    <select class="form-control" id="distrito" name="distrito">
                        <option value="<?php echo (isset($_SESSION['distrito']) ? $_SESSION['distrito'] : '' );?>">Selecione</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <label for="concelho">Concelho:</label>
                    <select class="form-control" id="concelho" name="cidade">
                        <option value="<?php echo (isset($_SESSION['cidade']) ? $_SESSION['cidade'] : '' );?>">Selecione</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <label for="freguesia">Freguesia:</label>
                    <select class="form-control" id="freguesia" name="freguesia">
                        <option value="<?php echo (isset($_SESSION['freguesia']) ? $_SESSION['freguesia'] : '' );?>">Selecione</option>
                    </select>
                </div>
        <!-- Bedroom Number -->
        <div class="col-md-3">
            <label for="bedroom_number">Número de Quartos:</label>
            <input type="text" class="form-control" id="bedroom_number" name="bedroom_number" 
                   value="<?php echo isset($_GET['bedroom_number']) ? $_GET['bedroom_number'] : ''; ?>">
        </div>
        <!-- Bathroom Number -->
        <div class="col-md-3">
            <label for="bathroom_number">Número de Banheiros:</label>
            <input type="text" class="form-control" id="bathroom_number" name="bathroom_number" 
                   value="<?php echo isset($_GET['bathroom_number']) ? $_GET['bathroom_number'] : ''; ?>">
        </div>
        <!-- Type -->
        <div class="col-md-3">
            <label for="type">Tipo:</label>
            <select class="form-control" id="type" name="type">
                <option value="">Selecione</option>
                <?php
                $tipos = $db->getTypes();
                foreach($tipos as $tipoOption):
                    $selected = (isset($_GET['type']) && $_GET['type'] === $tipoOption['type']) ? 'selected' : '';
                ?>
                <option value="<?php echo $tipoOption['type']; ?>" <?php echo $selected; ?>>
                    <?php echo $tipoOption['type']; ?>
                </option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <br>
    <!-- Submit Button -->
    <button type="submit" class="btn btn-primary">Filtrar</button>
</form>


        <hr>
        
        <hr>
        <!-- Property Table -->
        <div class="table">
        <table class="table">
            <thead>
                <tr>
                    <th>Tipo - Imóvel</th>
                    <th>Área</th>
                    <th>Preço</th>  
                    <th>Distrito</th>
                    <th>Concelho</th>
                    <th>Freguesia</th>
                    <th>Quartos</th>
                    <th>Banheiros</th>
                </tr>
            </thead>
            <tbody id="imoveis">
            <?php
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $_GET['min_area']        = isset($_POST['min_area']) ? $_POST['min_area'] : 5;
        $_GET['max_area']        = isset($_POST['max_area']) ? $_POST['max_area'] : null;
        $_GET['type']            = isset($_POST['type']) ? $_POST['type'] : null;
        $_GET['min_price']       = isset($_POST['min_price']) ? $_POST['min_price'] : 5000;
        $_GET['max_price']       = isset($_POST['max_price']) ? $_POST['max_price'] : null;
        $_GET['bedroom_number']  = isset($_POST['bedroom_number']) ? $_POST['bedroom_number'] : null;
        $_GET['bathroom_number'] = isset($_POST['bathroom_number']) ? $_POST['bathroom_number'] : null;
        $_GET['freguesia']       = isset($_POST['freguesia']) ? $_POST['freguesia'] : null;
        $_GET['distrito']        = isset($_POST['distrito']) ? $_POST['distrito'] : null;
        $_GET['cidade']          = isset($_POST['cidade']) ? $_POST['cidade'] : null;
    }
        $min_area        = isset($_GET['min_area']) ? trim($_GET['min_area']) : 5;
        $max_area        = isset($_GET['max_area']) ? trim($_GET['max_area']) : null;
        $type            = isset($_GET['type']) ? trim($_GET['type']) : null;
        $min_price       = isset($_GET['min_price']) ? trim($_GET['min_price']) : 5000;
        $max_price       = isset($_GET['max_price']) ? trim($_GET['max_price']) : null;
        $bedroom_number  = isset($_GET['bedroom_number']) ? trim($_GET['bedroom_number']) : null;
        $bathroom_number = isset($_GET['bathroom_number']) ? trim($_GET['bathroom_number']) : null;
        $freguesia       = isset($_GET['freguesia']) ? trim($_GET['freguesia']) : null;
        $distrito        = isset($_GET['distrito']) ? trim($_GET['distrito']) : null;
        $cidade          = isset($_GET['cidade']) ? trim($_GET['cidade']) : null;    

                $limit = 10;  // Number of items per page
                $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                $offset = ($page - 1) * $limit;
                $imoveis = $db->getImoveis($min_area, $max_area, $type, $min_price, $max_price, $bedroom_number, $bathroom_number, $freguesia, $distrito, $cidade,$limit, $offset);
                $totalProperties = $db->getTotalImoveis($min_area, $max_area, $type, $min_price, $max_price, $bedroom_number, $bathroom_number, $freguesia, $distrito, $cidade,$limit, $offset);
                $totalPages = ceil($totalProperties / $limit);  
                $maxPagesToShow = 3;
                $pagesToShow = min($totalPages, $maxPagesToShow);
                $middle    = floor($pagesToShow / 2);
                $startPage = max(1, $page - $middle);
                $endPage   = $startPage + $pagesToShow - 1;
                
                if ($endPage > $totalPages) {
                    $endPage   = $totalPages;
                    $startPage = max(1, $endPage - $pagesToShow + 1);
                }

                foreach($imoveis as $imovel):
                    $price = round($imovel['price'] );
                    $priceMin = $price-5000;
                    $priceMax = $price+5000;
                    $area = round($imovel['gross_area']);
                    $areaMin = $area-5;
                    $areaMax = $area+5;


                    $query_params = array(
                        'min_area'        => $min_area,
                        'max_area'        => $max_area,
                        'type'            => $type,
                        'min_price'       => $min_price,
                        'max_price'       => $max_price,
                        'bedroom_number'  => $bedroom_number,
                        'bathroom_number' => $bathroom_number,
                        'freguesia'       => $freguesia,
                        'distrito'        => $distrito,
                        'cidade'          => $cidade
                    );
                    $query_string = http_build_query($query_params);
            ?>  
                <tr>
                    <td><?php echo $imovel['type'] ?></td>
                    <td><?php if($areaMin=$area-5)
                                echo "$area - $areaMax";
                            else
                                echo "$areaMin - $areaMax"; 
                    ?> m2</td>
                    <td><?php   if($priceMin==$price-5000)
                                    echo "$price - $priceMax €";
                                else
                                    echo "$priceMin - $priceMax €";
                    ?> </td>
                    <td><?php echo $imovel['distrito'] ?></td>
                    <td><?php echo $imovel['cidade'] ?></td>
                    <td><?php echo $imovel['freguesia'] ?></td>
                    <td><?php echo $imovel['bedroom_number'] ?></td>
                    <td><?php echo $imovel['bathroom_number'] ?></td>   
                    <td><button class="btn btn-primary" onclick="openModal(<?php echo $imovel['id'] ?>)"><img src="mail.png" alt="mail"></button></td> 
                </tr>
            <?php
                endforeach;
            ?>
            </tbody>
        </table>

<!-- Pagination  -->

<nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center">
    <!-- Previous button -->
    <?php if($page > 1): ?>
      <li class="page-item">
        <a class="page-link" href="?page=<?php echo $page - 1; ?>&<?php echo $query_string; ?>" aria-label="Previous">
          <span aria-hidden="true">&laquo;</span>
        </a>
      </li>
    <?php endif; ?>

    <!-- Always show the first page if not in the current sliding window -->
    <?php if ($startPage > 1): ?>
      <li class="page-item <?php echo ($page == 1) ? 'active' : ''; ?>">
        <a class="page-link" href="?page=1&<?php echo $query_string; ?>">1</a>
      </li>
      <?php if ($startPage > 2): ?>
        <li class="page-item disabled"><span class="page-link">...</span></li>
      <?php endif; ?>
    <?php endif; ?>

    <!-- Sliding window of page numbers -->
    <?php for ($i = $startPage; $i <= $endPage; $i++): ?>
      <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
        <a class="page-link" href="?page=<?php echo $i; ?>&<?php echo $query_string; ?>"><?php echo $i; ?></a>
      </li>
    <?php endfor; ?>

    <!-- Always show the last page if not in the current sliding window -->
    <?php if ($endPage < $totalPages): ?>
      <?php if ($endPage < $totalPages - 1): ?>
        <li class="page-item disabled"><span class="page-link">...</span></li>
      <?php endif; ?>
      <li class="page-item <?php echo ($page == $totalPages) ? 'active' : ''; ?>">
        <a class="page-link" href="?page=<?php echo $totalPages; ?>&<?php echo $query_string; ?>"><?php echo $totalPages; ?></a>
      </li>
    <?php endif; ?>

    <!-- Next button -->
    <?php if($page < $totalPages): ?>
      <li class="page-item">
        <a class="page-link" href="?page=<?php echo $page + 1; ?>&<?php echo $query_string; ?>" aria-label="Next">
          <span aria-hidden="true">&raquo;</span>
        </a>
      </li>
    <?php endif; ?>
  </ul>
</nav>



<!-- End Pagination -->

        </div>
    </div>
    <div class="modal fade" id="emailModal" tabindex="-1" role="dialog" aria-labelledby="emailModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="emailModalLabel">Enviar Email</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="closeModal()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="emailForm" action="" method="POST">
                    <input type="hidden" class="form-control" id="propertyIdInput" name="property_id" required>
                    <div class="form-group">
                        <label for="senderEmail">Email</label>
                        <input type="email" class="form-control" id="senderEmail" name="sender_email" required value="<?php isset($_SESSION['sender_email'])?$_SESSION['sender_email']:"" ?>">
                    </div>
                    <div class="form-group">
                        <label for="phoneNumber">Número de Telefone</label>
                        <input type="tel" class="form-control" id="phoneNumber" name="phone_number" required value="<?php isset($_SESSION['phone_number'])?$_SESSION['phone_number']:"" 
                        ?>">
                    </div>
                    <div class="form-group">
                        <label for="emailBody">Mensagem:</label>
                        <textarea class="form-control" id="emailBody" name="email_body" required></textarea>
                    </div>
                    <div class="form-group">
                        <div class="g-recaptcha mt-3 mb-3" data-sitekey="<?php echo CAPTCHA_PUBLIC_KEY?>"></div>
                    </div>
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
    
<?php
$inputConcelho = isset($_GET['cidade']) ? $_GET['cidade'] : 'none';
$inputDistrito = isset($_GET['distrito']) ? $_GET['distrito'] : 'none';
$inputFreguesia = isset($_GET['freguesia']) ? $_GET['freguesia'] : 'none';
?>

<input type="hidden" id="selectedDistrito" value="<?php echo $inputDistrito; ?>" >
<input type="hidden" id="selectedConcelho" value="<?php echo $inputConcelho; ?>" >
<input type="hidden" id="selectedFreguesia" value="<?php echo $inputFreguesia; ?>" >

<script src="./indexJavaScript.js"></script>
<script src="geolocation.js"></script>

</main>
<?php
require '../../views/footer.php';
?>  