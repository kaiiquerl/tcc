<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TI Inventario</title>
    <link rel="stylesheet" href="style.css">
    <link href="headers.css" rel="stylesheet">
    <link href="heroes.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">
    <link href="sidebars.css" rel="stylesheet">
    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body class="bg-light <?php echo $isAdmin ? 'admin-page' : 'user-page'; ?>">
    <header class="bg-primary text-white py-3 <?php echo $isAdmin ? 'admin-header' : ''; ?>">
        <div class="container d-flex justify-content-between align-items-center">
            <img src="img/logo.svg" class="logoM" alt="logop">
            <h1 class="h3">School Stock</h1>
            <nav>
                <ul class="nav">
                    <li class="nav-item"><a href="login.php" class="nav-link text-white">Log Out</a></li>
                    <li class="nav-item"><a href="login.php" class="nav-link text-white">Sobre</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main class="container my-5">
        <div class="row">
            <aside class="col-md-3">
                <div class="list-group">
                    <a href="#" class="list-group-item list-group-item-action active">Bloco A</a>
                    <div class="list-group">
                        <a href="exibir_admin.php?bloco=A&lab=LAB 1" class="list-group-item list-group-item-action">Lab 1</a>
                        <a href="exibir_admin.php?bloco=A&lab=LAB 2" class="list-group-item list-group-item-action">Lab 2</a>
                        <a href="exibir_admin.php?bloco=A&lab=LAB 3" class="list-group-item list-group-item-action">Lab 3</a>
                    </div><br>
                    <a href="#" class="list-group-item list-group-item-action">Bloco B</a>
                    <div class="list-group">
                        <a href="exibir_admin.php?bloco=B&lab=LAB 1" class="list-group-item list-group-item-action">Lab 1</a>
                        <a href="exibir_admin.php?bloco=B&lab=LAB 2" class="list-group-item list-group-item-action">Lab 2</a>
                        <a href="exibir_admin.php?bloco=B&lab=LAB 3" class="list-group-item list-group-item-action">Lab 3</a>
                    </div><br>
                    <a href="#" class="list-group-item list-group-item-action">Bloco C</a>
                    <div class="list-group">
                        <a href="exibir_admin.php?bloco=C&lab=LAB 1" class="list-group-item list-group-item-action">Lab 1</a>
                        <a href="exibir_admin.php?bloco=C&lab=LAB 2" class="list-group-item list-group-item-action">Lab 2</a>
                        <a href="exibir_admin.php?bloco=C&lab=LAB 3" class="list-group-item list-group-item-action">Lab 3</a>
                    </div>
                </div>
            </aside>
            <section class="col-md-9">
                <div class="p-5 bg-white rounded shadow-sm">
                    <h2>Bem-vindos ao School Stock!</h2>
                    <p>Aqui, você pode registrar e gerenciar todos os patrimônios da sua escola de forma simples e eficiente. Estamos prontos para ajudar sua instituição a manter um inventário organizado. Explore nossa plataforma e simplifique sua gestão patrimonial conosco!</p>
                    <img src="img/sejabemvindo.svg" alt="Bem-vindo" class="img-fluid mt-3">
                </div>
            </section>
        </div>
    </main>

    <footer class="bg-dark text-white py-4 mt-5 <?php echo $isAdmin ? 'admin-footer' : ''; ?>">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <img src="img/logo_footer.svg" class="logof" alt="img footer">
                </div>
                <div class="col-md-4">
                    <h5>Contact</h5>
                    <p><img src="img/email.svg" class="logos" alt="img email"> Diretoria: e047dir@cps.sp.gov.br<br>Diretoria Administrativa: e047adm@cps.sp.gov.br<br>Diretoria Acadêmica: e047acad@cps.sp.gov.br</p>
                    <p><img src="img/telefone.svg" class="logos" alt="img telefone"> Tel.: (19) 3651-1229</p>
                </div>
                <div class="col-md-4">
                    <h5>Localização</h5>
                    <p><img src="img/gps.svg" class="logos" alt="img gps"> Rodovia SP, 346 - km 204 - Morro Azul - CEP: 13990-000 - Espirito Santo do Pinhal/SP</p>
                </div>
            </div>
            <?php if ($isAdmin): ?>
                <div class="text-center mt-3">
                    <p>Você está logado como administrador.</p>
                </div>
            <?php endif; ?>
            <div class="text-center mt-3">
                <p>&copy; Todos os Direitos Reservados...</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
