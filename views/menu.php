<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="<?php echo HOME_URI; ?>views/flags.css">
    <!-- Chamda do javaScript mudança de linguagem ( Chamar aqui uma vez que carrega primeiro o script antes de aparecer as opções ) -->
    <script src="<?php echo HOME_URI;?>translate.js" type="text/javascript"></script>
    <title>Navbar Example</title>
</head>
    <header>
        <nav class="navbar navbar-expand-lg bg-body-secondary">
            <div class="container">
                <a href="<?php echo HOME_URI; ?>" class="navbar-brand">
                    <img src="<?php echo HOME_URI; ?>/assets/images/logold31.png" style="max-height: 130px;" alt="logo">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#conteudoNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="conteudoNavbar">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item ms-2">
                            <a href="https://www.d31imo.biz/" target="_blank" class="nav-link">Imóveis</a>
                        </li>
                        <!-- 
                        <li class="nav-item ms-2">
                            <a href="<?php //echo HOME_URI; ?>subs/quinta_arrifes" class="nav-link">Empreendimento</a>
                        </li>
-->
                        <li class="nav-item ms-2">
                            <a href="<?php echo HOME_URI; ?>subs/site_metasearch" class="nav-link">Pesquisa Global</a>
                        </li>
                        <li class="nav-item ms-2 dropdown">
                            <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" href="#">Simulador</a>
                            <ul class="dropdown-menu" id="simuladores">
                                <li>
                                    <a href="<?php echo HOME_URI; ?>subs/simulador_imt/" class="dropdown-item">IMT</a>
                                </li>
                                <li>
                                    <a href="<?php echo HOME_URI; ?>subs/simulador_preco/" class="dropdown-item">Quanto custa a sua casa?</a>
                                </li>
                                <li>
                                    <a href="<?php echo HOME_URI; ?>subs/simulador_preco/credito/" class="dropdown-item">Crédito</a>
                                </li>
                                <li>
                                    <a href="<?php echo HOME_URI; ?>subs/simulador_preco/credito_simples/" class="dropdown-item">Crédito Simples</a>
                                </li>
                                <li>
                                    <a href="<?php echo HOME_URI; ?>subs/simulador_preco/mais_valia/" class="dropdown-item">Mais Valias</a>
                                </li>
                                <li>
                                    <a href="<?php echo HOME_URI; ?>subs/simulador_preco/taxa_esforco/" class="dropdown-item">Taxa de Esforço</a>
                                </li>
                                <li>
                                    <a href="<?php echo HOME_URI; ?>subs/simulador_preco/imi/" class="dropdown-item">IMI</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item ms-2">
                            <a href="<?php echo HOME_URI; ?>carreira" class="nav-link">Escolha o seu plano</a>
                        </li>
                        <li class="nav-item ms-2">
                            <a href="<?php echo HOME_URI; ?>contactos" class="nav-link">Contactos</a>
                        </li>
                        <li class="nav-item ms-2 dropdown">
                            <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" href="#">Informações</a>
                            <ul class="dropdown-menu" id="simuladores">
                                <li>
                                    <a href="<?php echo HOME_URI; ?>info" class="dropdown-item">Canal de Denúncias</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <div class="d-flex align-items-center">
                        <div class="form-check form-switch" id="themeToggle">
                            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                            <label class="form-check-label" for="flexSwitchCheckDefault">
                                <svg width="25px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M3.32031 11.6835C3.32031 16.6541 7.34975 20.6835 12.3203 20.6835C16.1075 20.6835 19.3483 18.3443 20.6768 15.032C19.6402 15.4486 18.5059 15.6834 17.3203 15.6834C12.3497 15.6834 8.32031 11.654 8.32031 6.68342C8.32031 5.50338 8.55165 4.36259 8.96453 3.32996C5.65605 4.66028 3.32031 7.89912 3.32031 11.6835Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </label>
                        </div>
                    </div>    
                    <!--  Start of language selector  -->
                    <div id="language_selector" class="dropdown">
                        <button class="btn" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            <div id="current_flag" class="flag-icon flag-icon-pt"></div>
                            <i class="fa-solid fa-chevron-down"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton" style="">
                        <a class="dropdown-item" href="#" onclick="mudarLingua('pt')">
                                <div class="flag-icon flag-icon-pt"></div> 
                                <span translate="no" class="notranslate">Português</span>
                            </a>
                            <a class="dropdown-item" href="#" onclick="mudarLingua('en')">
                                <div class="flag-icon flag-icon-uk"></div> 
                                <span translate="no" class="notranslate">Inglês</span>
                            </a>
                            <a class="dropdown-item" href="#" onclick="mudarLingua('fr')">
                                <div class="flag-icon flag-icon-fr"></div> 
                                <span translate="no" class="notranslate">Francês</span>
                            </a>
                            <a class="dropdown-item" href="#" onclick="mudarLingua('de')">
                                <div class="flag-icon flag-icon-de"></div> 
                                <span translate="no" class="notranslate">Alemão</span>
                            </a>   
                            <a class="dropdown-item" href="#" onclick="mudarLingua('ru')">
                                <div class="flag-icon flag-icon-ru"></div> 
                                <span translate="no" class="notranslate">Russo</span>
                            </a>   
                            <a class="dropdown-item" href="#" onclick="mudarLingua('zh-CN')">
                                <div class="flag-icon flag-icon-zh-CN"></div> 
                                <span translate="no" class="notranslate">Chinês</span>
                            </a>   
                        </div>
                        <a class="invisible d-none" id="google_translate_element" href="#"></a>
                    </div>
                    
                    <!--  end of language selector  -->
                </div>
            </div>
        </nav>
    </header>
    
    <!-- Scripts do Google Translate  -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
    <!-- Chamada do back end está no footer -->