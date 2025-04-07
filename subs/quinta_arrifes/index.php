<?php
$cssFolder = './assets/css';
$jsFolder = './assets/javascript';
require '../../views/head.php';
require '../../views/menu.php';
?>

<main class="container py-0 flex-grow-1 d-flex flex-column">
    <div class="row flex-grow-1 text-center">
        <div id="mainBackground" class="col-lg-6 vh-100 d-flex flex-column px-0 bg-edificio align-items-center justify-content-center">
            <img src="./assets/images/foto_frente_v2.png" class="img-fluid" />
            <iframe class="py-4" width="100%" height="100%" src="https://www.youtube.com/embed/dDBd3bApBKQ?si=d9Ks0D2Zr7SdTxbO" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
        </div>
        <div id="mainContent" class="col-lg-6 p-4 text-start">
            <div class="row">
                <h2>Edifício Quinta dos Arrifes</h2>
                <p>A Quinta dos Arrifes, localizada na pitoresca Rua dos Arrifes, na encantadora Ilha da Madeira, é um
                    refúgio de
                    conforto e tranquilidade. Seu edifício oferece uma atmosfera acolhedora, com vistas deslumbrantes
                    para a
                    paisagem circundante. Rodeada por belezas naturais, a quinta proporciona uma experiência única,
                    unindo elegância
                    e serenidade.</p>
            </div>
            <div class="row">
                <ul class="list-group list-group-flush text-uppercase fw-semibold">
                    <li class="list-group-item">Data: 2024</li>
                    <li class="list-group-item">Local: Rua dos Arrifes - Funchal</li>
                    <li class="list-group-item">Tipo: T1, T3 e Loja</li>
                    <li class="list-group-item">Estado: em planeamento</li>
                </ul>
            </div>
            <div class="row py-1">
                <div class="btn-group">
                    <input type="radio" class="btn-check " data-bs-toggle="collapse" aria-expanded="true"
                        data-bs-target="#blocoA" name="bloco" id="blocoABtn" checked="checked">
                    <label class="btn btn-outline-secondary" for="blocoABtn">Bloco A</label>

                    <input type="radio" class="btn-check " data-bs-toggle="collapse" data-bs-target="#blocoB"
                        name="bloco" id="blocoBBtn">
                    <label class="btn btn-outline-secondary" for="blocoBBtn">Bloco B</label>
                </div>
            </div>
            <div class="row py-1" id="blocoGroup">
                <div class="collapse show btn-group" id="blocoA" data-bs-parent="#blocoGroup">
                    <input type="radio" class="btn-check " data-bs-toggle="collapse" data-bs-target="#piso0A"
                        name="blocoA" aria-expanded="true" id="blocoAPiso0" checked="checked">
                    <label class="btn btn-outline-secondary" for="blocoAPiso0">Piso 0</label>
                    <input type="radio" class="btn-check " data-bs-toggle="collapse" data-bs-target="#piso1A"
                        name="blocoA" id="blocoAPiso1">
                    <label class="btn btn-outline-secondary" for="blocoAPiso1">Piso 1</label>
                    <input type="radio" class="btn-check " data-bs-toggle="collapse" data-bs-target="#piso2A"
                        name="blocoA" id="blocoAPiso2">
                    <label class="btn btn-outline-secondary" for="blocoAPiso2">Piso 2</label>
                </div>
                <div class="collapse btn-group" id="blocoB" data-bs-parent="#blocoGroup">
                    <input type="radio" class="btn-check " data-bs-toggle="collapse" data-bs-target="#piso-1B"
                        name="blocoB" aria-expanded="true" id="blocoBPiso-1" checked="checked" />
                    <label class="btn btn-outline-secondary" for="blocoBPiso-1">Piso -1</label>
                    <input type="radio" class="btn-check " data-bs-toggle="collapse" data-bs-target="#piso0B"
                        name="blocoB" id="blocoBPiso0" />
                    <label class="btn btn-outline-secondary" for="blocoBPiso0">Piso 0</label>
                </div>
            </div>
            <div class="row py-1" id="apGroup">
                <div class="collapse show btn-group" id="piso0A" data-bs-parent="#apGroup">
                    <input type="radio" class="btn-check " data-bs-toggle="collapse" data-bs-target="#apT1A"
                        name="piso0A" aria-expanded="true" id="T1A" checked="checked">
                    <label class="btn btn-outline-secondary" for="T1A">T1A</label>
                    <input type="radio" class="btn-check " data-bs-toggle="collapse" data-bs-target="#apT1B"
                        name="piso0A" aria-expanded="true" id="T1B">
                    <label class="btn btn-outline-secondary" for="T1B">T1B</label>
                    <input type="radio" class="btn-check " data-bs-toggle="collapse" data-bs-target="#apT1C"
                        name="piso0A" aria-expanded="true" id="T1C">
                    <label class="btn btn-outline-secondary" for="T1C">T1C</label>
                </div>
                <div class="collapse btn-group" id="piso1A" data-bs-parent="#apGroup">
                    <input type="radio" class="btn-check " data-bs-toggle="collapse" data-bs-target="#apT1D"
                        name="piso1A" aria-expanded="true" id="T1D" checked="checked">
                    <label class="btn btn-outline-secondary" for="T1D">T1D</label>
                    <input type="radio" class="btn-check " data-bs-toggle="collapse" data-bs-target="#apT1E"
                        name="piso1A" aria-expanded="true" id="T1E">
                    <label class="btn btn-outline-secondary" for="T1E">T1E</label>
                    <input type="radio" class="btn-check " data-bs-toggle="collapse" data-bs-target="#apT1F"
                        name="piso1A" aria-expanded="true" id="T1F">
                    <label class="btn btn-outline-secondary" for="T1F">T1F</label>
                </div>
                <div class="collapse btn-group" id="piso2A" data-bs-parent="#apGroup">
                    <input type="radio" class="btn-check " data-bs-toggle="collapse" data-bs-target="#apT3G"
                        name="piso2A" aria-expanded="true" id="T3G" checked="checked">
                    <label class="btn btn-outline-secondary" for="T3G">T3G</label>
                </div>
                <div class="collapse btn-group" id="piso0B" data-bs-parent="#apGroup">
                    <input type="radio" class="btn-check " data-bs-toggle="collapse" data-bs-target="#apT1H"
                        name="piso0B" aria-expanded="true" id="T1H" checked="checked">
                    <label class="btn btn-outline-secondary" for="T1H">T1H</label>
                    <input type="radio" class="btn-check " data-bs-toggle="collapse" data-bs-target="#apT1I"
                        name="piso0B" aria-expanded="true" id="T1I">
                    <label class="btn btn-outline-secondary" for="T1I">T1I</label>
                </div>
                <div class="collapse btn-group" id="piso-1B" data-bs-parent="#apGroup">
                    <input type="radio" class="btn-check" data-bs-toggle="collapse" data-bs-target="#lojaB"
                        name="piso-1B" aria-expanded="true" id="Loja" checked="checked">
                    <label class="btn btn-outline-secondary" for="Loja">Loja</label>
                </div>
            </div>
            <div class="row py-5" id="apartamento">
                <div class="collapse show col-12" id="apT1A" data-bs-parent="#apartamento">
                    <div class="row">
                        <img src="./assets/images/plantas/T1A.JPG" alt="T1A" class="col-lg-6 img-fluid planta h-auto p-5">
                        <div class="col-lg-6 shadow-lg bg-warning bg-opacity-25 p-4">
                            <h1 class="fs-3">Apartamento:</h1>
                            <h2>T1 A - Bloco A</h2>
                            <h2 class="fs-5">Área Total: 187.15 m<sup>2</sup></h2>
                            <h2 class="fs-5">Área Bruta: 64.70 m<sup>2</sup></h2>
                            <ul>
                                <li>Terraço: 46.95 m<sup>2</sup></li>
                                <li>Alpendre/Varanda: 17.80 m<sup>2</sup></li>
                                <li>Jardim: 57.70 m<sup>2</sup></li>
                                <li>Estacionamento: 0 m<sup>2</sup></li>
                                <li>Garagem: 0 m<sup>2</sup></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="collapse col-12" id="apT1B" data-bs-parent="#apartamento">
                    <div class="row">
                        <img src="./assets/images/plantas/T1B.JPG" alt="T1B" class="col-lg-6 img-fluid planta h-auto p-5">
                        <div class="col-lg-6 shadow-lg bg-warning bg-opacity-25 p-4">
                            <h1 class="fs-3">Apartamento:</h1>
                            <h2>T1 B - Bloco A</h2>
                            <h2 class="fs-5">Área Total: 84.55 m<sup>2</sup></h2>
                            <h2 class="fs-5">Área Bruta: 60.35 m<sup>2</sup></h2>
                            <ul>
                                <li>Terraço: 24.20 m<sup>2</sup></li>
                                <li>Alpendre/Varanda: 0 m<sup>2</sup></li>
                                <li>Jardim: 0 m<sup>2</sup></li>
                                <li>Estacionamento: 0 m<sup>2</sup></li>
                                <li>Garagem: 0 m<sup>2</sup></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="collapse col-12" id="apT1C" data-bs-parent="#apartamento">
                    <div class="row">
                        <img src="./assets/images/plantas/T1C.JPG" alt="T1C" class="col-lg-6 img-fluid planta h-auto p-5">
                        <div class="col-lg-6 shadow-lg bg-warning bg-opacity-25 p-4">
                            <h1 class="fs-3">Apartamento:</h1>
                            <h2>T1 C - Bloco A</h2>
                            <h2 class="fs-5">Área Total: 111.60 m<sup>2</sup></h2>
                            <h2 class="fs-5">Área Bruta: 73.40 m<sup>2</sup></h2>
                            <ul>
                                <li>Terraço: 38.20 m<sup>2</sup></li>
                                <li>Alpendre/Varanda: 0 m<sup>2</sup></li>
                                <li>Jardim: 0 m<sup>2</sup></li>
                                <li>Estacionamento: 0 m<sup>2</sup></li>
                                <li>Garagem: 0 m<sup>2</sup></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="collapse col-12" id="apT1D" data-bs-parent="#apartamento">
                    <div class="row">
                        <img src="./assets/images/plantas/T1D.JPG" alt="T1D" class="col-lg-6 img-fluid planta h-auto p-5">
                        <div class="col-lg-6 shadow-lg bg-warning bg-opacity-25 p-4">
                            <h1 class="fs-3">Apartamento:</h1>
                            <h2>T1 D - Bloco A</h2>
                            <h2 class="fs-5">Área Total: 118.70 m<sup>2</sup></h2>
                            <h2 class="fs-5">Área Bruta: 64.70 m<sup>2</sup></h2>
                            <ul>
                                <li>Terraço: 17.80 m<sup>2</sup></li>
                                <li>Alpendre/Varanda: 13.30 m<sup>2</sup></li>
                                <li>Jardim: 22.90 m<sup>2</sup></li>
                                <li>Estacionamento: 0 m<sup>2</sup></li>
                                <li>Garagem: 0 m<sup>2</sup></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="collapse col-12" id="apT1E" data-bs-parent="#apartamento">
                    <div class="row">
                        <img src="./assets/images/plantas/T1E.JPG" alt="T1E" class="col-lg-6 img-fluid planta h-auto p-5">
                        <div class="col-lg-6 shadow-lg bg-warning bg-opacity-25 p-4">
                            <h1 class="fs-3">Apartamento:</h1>
                            <h2>T1 E - Bloco A</h2>
                            <h2 class="fs-5">Área Total: 73.75 m<sup>2</sup></h2>
                            <h2 class="fs-5">Área Bruta: 60.35 m<sup>2</sup></h2>
                            <ul>
                                <li>Terraço: 0 m<sup>2</sup></li>
                                <li>Alpendre/Varanda: 13.40 m<sup>2</sup></li>
                                <li>Jardim: 0 m<sup>2</sup></li>
                                <li>Estacionamento: 0 m<sup>2</sup></li>
                                <li>Garagem: 0 m<sup>2</sup></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="collapse col-12" id="apT1F" data-bs-parent="#apartamento">
                    <div class="row">
                        <img src="./assets/images/plantas/T1F.JPG" alt="T1F" class="col-lg-6 img-fluid planta h-auto p-5">
                        <div class="col-lg-6 shadow-lg bg-warning bg-opacity-25 p-4">
                            <h1 class="fs-3">Apartamento:</h1>
                            <h2>T1 F - Bloco A</h2>
                            <h2 class="fs-5">Área Total: 85.20 m<sup>2</sup></h2>
                            <h2 class="fs-5">Área Bruta: 73.40 m<sup>2</sup></h2>
                            <ul>
                                <li>Terraço: 0 m<sup>2</sup></li>
                                <li>Alpendre/Varanda: 11.80 m<sup>2</sup></li>
                                <li>Jardim: 0 m<sup>2</sup></li>
                                <li>Estacionamento: 0 m<sup>2</sup></li>
                                <li>Garagem: 0 m<sup>2</sup></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="collapse col-12" id="apT1G" data-bs-parent="#apartamento">
                    <div class="row">
                        <img src="./assets/images/plantas/T1G.JPG" alt="T1G" class="col-lg-6 img-fluid planta h-auto p-5">
                        <div class="col-lg-6 shadow-lg bg-warning bg-opacity-25 p-4">
                            <h1 class="fs-3">Apartamento:</h1>
                            <h2>T1 G - Bloco A</h2>
                            <h2 class="fs-5">Área Total: 187.15 m<sup>2</sup></h2>
                            <h2 class="fs-5">Área Bruta: 64.70 m<sup>2</sup></h2>
                            <ul>
                                <li>Terraço: 46.95 m<sup>2</sup></li>
                                <li>Alpendre/Varanda: 17.80 m<sup>2</sup></li>
                                <li>Jardim: 57.70 m<sup>2</sup></li>
                                <li>Estacionamento: 0 m<sup>2</sup></li>
                                <li>Garagem: 0 m<sup>2</sup></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="collapse col-12" id="apT1H" data-bs-parent="#apartamento">
                    <div class="row">
                        <img src="./assets/images/plantas/T1H.png" alt="T1H" class="col-lg-6 img-fluid planta h-auto p-5">
                        <div class="col-lg-6 shadow-lg bg-warning bg-opacity-25 p-4">
                            <h1 class="fs-3">Apartamento:</h1>
                            <h2>T1 H - Bloco B</h2>
                            <h2 class="fs-5">Área Total: 182.80 m<sup>2</sup></h2>
                            <h2 class="fs-5">Área Bruta: 63.50 m<sup>2</sup></h2>
                            <ul>
                                <li>Terraço: 79.80 m<sup>2</sup></li>
                                <li>Alpendre/Varanda: 13.60 m<sup>2</sup></li>
                                <li>Jardim: 0 m<sup>2</sup></li>
                                <li>Estacionamento: 0 m<sup>2</sup></li>
                                <li>Garagem: 25.90 m<sup>2</sup></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="collapse col-12" id="apT1I" data-bs-parent="#apartamento">
                    <div class="row">
                        <img src="./assets/images/plantas/T1I.png" alt="T1I" class="col-lg-6 img-fluid planta h-auto p-5">
                        <div class="col-lg-6 shadow-lg bg-warning bg-opacity-25 p-4">
                            <h1 class="fs-3">Apartamento:</h1>
                            <h2>T1 I - Bloco B</h2>
                            <h2 class="fs-5">Área Total: 194.45 m<sup>2</sup></h2>
                            <h2 class="fs-5">Área Bruta: 68.55 m<sup>2</sup></h2>
                            <ul>
                                <li>Terraço: 85.00 m<sup>2</sup></li>
                                <li>Alpendre/Varanda: 15.00 m<sup>2</sup></li>
                                <li>Jardim: 0 m<sup>2</sup></li>
                                <li>Estacionamento: 0 m<sup>2</sup></li>
                                <li>Garagem: 25.90 m<sup>2</sup></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="collapse col-12" id="apT3G" data-bs-parent="#apartamento">
                    <div class="row">
                        <img src="./assets/images/plantas/T3G.JPG" alt="T3G" class="col-lg-6 img-fluid planta h-auto p-5">
                        <div class="col-lg-6 shadow-lg bg-warning bg-opacity-25 p-4">
                            <h1 class="fs-3">Apartamento:</h1>
                            <h2>T3 G - Bloco A</h2>
                            <h2 class="fs-5">Área Total: 256.35 m<sup>2</sup></h2>
                            <h2 class="fs-5">Área Bruta: 169.85 m<sup>2</sup></h2>
                            <ul>
                                <li>Terraço: 60.10 m<sup>2</sup></li>
                                <li>Alpendre/Varanda: 26.40 m<sup>2</sup></li>
                                <li>Jardim: 0 m<sup>2</sup></li>
                                <li>Estacionamento: 0 m<sup>2</sup></li>
                                <li>Garagem: 0 m<sup>2</sup></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="collapse col-12" id="lojaB" data-bs-parent="#apartamento">
                    <div class="row">
                        <img src="./assets/images/plantas/lojaB.JPeG" alt="LojaB"
                            class="col-lg-6 img-fluid planta h-auto p-5">
                        <div class="col-lg-6 shadow-lg bg-warning bg-opacity-25 p-4">
                            <h1 class="fs-3">Loja:</h1>
                            <h2>Piso -1</h2>
                            <h2 class="fs-5">Área Total: 42.20 m<sup>2</sup></h2>
                            <h2 class="fs-5">Área Útil: 42.20 m<sup>2</sup></h2>
                            <ul>
                                <li>Terraço: 0 m<sup>2</sup></li>
                                <li>Alpendre/Varanda: 0 m<sup>2</sup></li>
                                <li>Jardim: 0 m<sup>2</sup></li>
                                <li>Estacionamento: 0 m<sup>2</sup></li>
                                <li>Garagem: 0 m<sup>2</sup></li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-lg-6 p-2">
                    <img src="./assets/images/preview/frente.jpeg" alt="frente" class="img-fluid preview-edf">
                </div>
                <div class="col-lg-6 p-2">
                    <img src="./assets/images/preview/frenteclean.jpeg" alt="frente" class="img-fluid preview-edf">
                </div>
                <div class="col-lg-6 p-2">
                    <img src="./assets/images/preview/topofrente.jpeg" alt="frente" class="img-fluid preview-edf">
                </div>
                <div class="col-lg-6 p-2">
                    <img src="./assets/images/preview/topoatras.jpeg" alt="frente" class="img-fluid preview-edf">
                </div>
                <div class="col-lg-6 p-2">
                    <img src="./assets/images/preview/in1.jpeg" alt="frente" class="img-fluid preview-edf">
                </div>
                <div class="col-lg-6 p-2">
                    <img src="./assets/images/preview/in2.jpeg" alt="frente" class="img-fluid preview-edf">
                </div>
                <div class="col-lg-6 p-2">
                    <img src="./assets/images/preview/in3.jpeg" alt="frente" class="img-fluid preview-edf">
                </div>
            </div>
        </div>
<div class="modal fade" id="modalPreview">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="carouselPreview" class="carousel slide">
                    <div class="carousel-indicators">
                        <button data-bs-target="#carouselPreview" data-bs-slide-to="0" class="active"></button>
                        <button data-bs-target="#carouselPreview" data-bs-slide-to="1"></button>
                        <button data-bs-target="#carouselPreview" data-bs-slide-to="2"></button>
                        <button data-bs-target="#carouselPreview" data-bs-slide-to="3"></button>
                        <button data-bs-target="#carouselPreview" data-bs-slide-to="4"></button>
                        <button data-bs-target="#carouselPreview" data-bs-slide-to="5"></button>
                        <button data-bs-target="#carouselPreview" data-bs-slide-to="6"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="./assets/images/preview/frente.jpeg" alt="frente" class="d-block w-100">
                        </div>
                        <div class="carousel-item">
                            <img src="./assets/images/preview/frenteclean.jpeg" alt="frente" class="d-block w-100">
                        </div>
                        <div class="carousel-item">
                            <img src="./assets/images/preview/topofrente.jpeg" alt="frente" class="d-block w-100">
                        </div>
                        <div class="carousel-item">
                            <img src="./assets/images/preview/topoatras.jpeg" alt="frente" class="d-block w-100">
                        </div>
                        <div class="carousel-item">
                            <img src="./assets/images/preview/in1.jpeg" alt="frente" class="d-block w-100">
                        </div>
                        <div class="carousel-item">
                            <img src="./assets/images/preview/in2.jpeg" alt="frente" class="d-block w-100">
                        </div>
                        <div class="carousel-item">
                            <img src="./assets/images/preview/in3.jpeg" alt="frente" class="d-block w-100">
                        </div>                        
                    </div>
                    <a class="carousel-control-prev" href="#carouselPreview" role="button" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselPreview" role="button" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
        
        <div class="modal fade" id="modalPlanta">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <img src="./" alt="imagem" id="plantaView" class="img-fluid" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</main>
<?php
require '../../views/footer.php';
?>
