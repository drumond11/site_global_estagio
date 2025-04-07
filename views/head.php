<?php 

define('HOME_URI','http://localhost/site_global/');
//define('HOME_URI','https://d31.biz/');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-Control" content="no-store">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <title>D31</title>
    <link rel="icon" type="image/x-icon" href="<?php echo HOME_URI?>assets/images/logo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="<?php echo HOME_URI; ?>assets/css/main.css" rel="stylesheet" />
    <?php if(!empty($cssFolder) && is_dir($cssFolder)): $contents = scandir($cssFolder); ?>
        <?php foreach($contents as $file): ?>
            <?php if(str_ends_with($file, '.css')): ?>
                <link href="<?php echo $cssFolder.'/'.$file; ?>" rel="stylesheet" />
            <?php endif; ?>
        <?php endforeach; ?>
    <?php endif; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="<?php echo HOME_URI; ?>assets/javascript/main.js"></script>
    <?php if(!empty($jsFolder) && is_dir($jsFolder)): $contents = scandir($jsFolder);?>
        <?php foreach($contents as $file): ?>
            <?php if(str_ends_with($file, '.js')): ?>
                <script src="<?php echo $jsFolder.'/'.$file; ?>"></script>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php endif; ?>
</head>
<body class="d-flex flex-column min-vh-100" data-bs-theme="dark">