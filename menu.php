<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit();
}
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TI Inventario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body class="bg-light">

<header class="header">
        <div class="headerimg">
            <img src="img/logo.svg" class="logoM" alt="logop">
        </div>
        <a class="welcome-text d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
            <h1 class="txtlogo">School Stock</h1>
        </a>
        <div class="d-flex align-items-center">
            <p class="me-3 mb-0" style="color: white">Bem-vindo, <?php echo $_SESSION['usuario']; ?>!</p>
            <ul class="nav nav-pills">
                <li class="nav-item"><a href="login.php" class="nav-link active" aria-current="page" id="meuBotao">Log Out</a></li>&nbsp;
            </ul>
        </div>
    </header>


    <main class="container my-5">
        <div class="row g-5" style="width: 100rem;">            
                <aside class="col-md-3 p-4">
                    <div class="list-group mb-3">
                        <a class="list-group-item list-group-item-action active">Bloco A</a>
                        <a href="exibir.php?bloco=A&lab=LAB 1" class="list-group-item list-group-item-action">Lab 1</a>
                        <a href="exibir.php?bloco=A&lab=LAB 2" class="list-group-item list-group-item-action">Lab 2</a>
                        <a href="exibir.php?bloco=A&lab=LAB 3" class="list-group-item list-group-item-action">Lab 3</a>
                    </div>
                    <div class="list-group mb-3">
                        <a class="list-group-item list-group-item-action active">Bloco B</a>
                        <a href="exibir.php?bloco=B&lab=LAB 1" class="list-group-item list-group-item-action">Lab 1</a>
                        <a href="exibir.php?bloco=B&lab=LAB 2" class="list-group-item list-group-item-action">Lab 2</a>
                        <a href="exibir.php?bloco=B&lab=LAB 3" class="list-group-item list-group-item-action">Lab 3</a>
                    </div>
                    <div class="list-group">
                        <a class="list-group-item list-group-item-action active">Bloco C</a>
                        <a href="exibir.php?bloco=C&lab=LAB 1" class="list-group-item list-group-item-action">Lab 1</a>
                        <a href="exibir.php?bloco=C&lab=LAB 2" class="list-group-item list-group-item-action">Lab 2</a>
                        <a href="exibir.php?bloco=C&lab=LAB 3" class="list-group-item list-group-item-action">Lab 3</a>
                    </div>
                </aside>
            
            <section class="col-md-9">
                <div class="container my-5">
                    <div id="fundocor" class="row p-4 pb-0 pe-lg-0 pt-lg-5 align-items-center rounded-3 border shadow-lg" style="margin-left: -0px;">
                        <div class="fundocor" style="display: flex;">
                            <div style="width: 80%;">
                                <h1 class="display-4 fw-bold lh-1 text-body-emphasis">
                                    <h1 class="cortxt">SCHOOL STOCK</h1>
                                </h1>
                                <p class="cortxt">Bem-vindos ao School Stock! Aqui, você pode registrar e gerenciar todos os patrimônios da sua escola de forma simples e eficiente. Estamos prontos para ajudar sua instituição a manter um inventário organizado. Explore nossa plataforma e simplifique sua gestão patrimonial conosco!</p>
                            </div>
                            <img class="" src="img/sejabemvindo.svg" alt="gif" width="40%">
                        </div>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-start mb-4 mb-lg-3">
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
    <footer class="bg-dark text-white py-4 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-3 mb-md-0">
                    <img src="img/logo_footer.svg" class="logof" alt="img footer">
                </div>
                <div class="col-md-4 mb-3 mb-md-0">
                    <h5>Contact</h5>
                    <p><img src="img/email.svg" class="logos" alt="img email"> Diretoria: e047dir@cps.sp.gov.br<br>Diretoria Administrativa: e047adm@cps.sp.gov.br<br>Diretoria Acadêmica: e047acad@cps.sp.gov.br</p>
                    <p><img src="img/telefone.svg" class="logos" alt="img telefone"> Tel.: (19) 3651-1229</p>
                </div>
                <div class="col-md-4">
                    <h5>Localização</h5>
                    <p><img src="img/gps.svg" class="logos" alt="img gps"> Rodovia SP, 346 - km 204 - Morro Azul - CEP: 13990-000 - Espirito Santo do Pinhal/SP</p>
                </div>
            </div>
            <div class="text-center mt-3">
                <p>&copy; Todos os Direitos Reservados...</p>
            </div>
        </div>
    </footer>
</body>

</html>