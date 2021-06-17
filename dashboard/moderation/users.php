<?php
session_start();
if ($_SESSION['state'] != "MODERATEUR") {
    header("Location: ../../");
}
?>
<?php
$request2 = "SELECT `nom_boutique`,`user_id`, `id` FROM `boutique_particulier`";
$request4 = "SELECT `nom`, `prenom`, `id` FROM `user` WHERE `droit_id` = 1";
$dbs = mysqli_connect("localhost", "root", "", "boutique");
$query2 = mysqli_query($dbs, $request2);
$result2 = mysqli_fetch_all($query2);
$query4 = mysqli_query($dbs, $request4);
$result4 = mysqli_fetch_all($query4);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Table - BL-DASH</title>
    <link rel="stylesheet" href="assets/style/style.css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css">
</head>

<body id="page-top">
    <div id="wrapper">
        <nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0">
            <div class="container-fluid d-flex flex-column p-0"><a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">
                    <div class="sidebar-brand-icon rotate-n-15"><i class="fas fa-laugh-wink"></i></div>
                    <div class="sidebar-brand-text mx-3"><span>BL-DASH</span></div>
                </a>
                <hr class="sidebar-divider my-0">
                <ul class="navbar-nav text-light" id="accordionSidebar">
                    <li class="nav-item"><a class="nav-link" href="index.php"><i class="fas fa-tachometer-alt"></i><span>Informations Statistiques</span></a></li>
                    <li class="nav-item"><a class="nav-link active" href="users.php"><i class="fas fa-table"></i><span>Gestion des Utilisateurs</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="../../"><i class="fas fa-table"></i><span>Revenir a La Boutique</span></a></li>
                </ul>
                <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button></div>
            </div>
        </nav>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
                    <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle me-3" id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>
                        <ul class="navbar-nav flex-nowrap ms-auto">
                            <li class="nav-item dropdown d-sm-none no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"><i class="fas fa-search"></i></a>
                                <div class="dropdown-menu dropdown-menu-end p-3 animated--grow-in" aria-labelledby="searchDropdown">
                                    <form class="me-auto navbar-search w-100">
                                        <div class="input-group"><input class="bg-light form-control border-0 small" type="text" placeholder="Search for ...">
                                            <div class="input-group-append"><button class="btn btn-primary py-0" type="button"><i class="fas fa-search"></i></button></div>
                                        </div>
                                    </form>
                                </div>
                            </li>
                            <li class="nav-item dropdown no-arrow mx-1">
                                <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"></a>
                                    <div class="dropdown-menu dropdown-menu-end dropdown-list animated--grow-in">
                                        <h6 class="dropdown-header">alerts center</h6><a class="dropdown-item d-flex align-items-center" href="#">
                                            <div class="me-3">
                                                <div class="bg-primary icon-circle"><i class="fas fa-file-alt text-white"></i></div>
                                            </div>
                                            <div><span class="small text-gray-500">December 12, 2019</span>
                                                <p>A new monthly report is ready to download!</p>
                                            </div>
                                        </a><a class="dropdown-item d-flex align-items-center" href="#">
                                            <div class="me-3">
                                                <div class="bg-success icon-circle"><i class="fas fa-donate text-white"></i></div>
                                            </div>
                                            <div><span class="small text-gray-500">December 7, 2019</span>
                                                <p>$290.29 has been deposited into your account!</p>
                                            </div>
                                        </a><a class="dropdown-item d-flex align-items-center" href="#">
                                            <div class="me-3">
                                                <div class="bg-warning icon-circle"><i class="fas fa-exclamation-triangle text-white"></i></div>
                                            </div>
                                            <div><span class="small text-gray-500">December 2, 2019</span>
                                                <p>Spending Alert: We've noticed unusually high spending for your account.</p>
                                            </div>
                                        </a><a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item dropdown no-arrow mx-1">
                                <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"></a>
                                    <div class="dropdown-menu dropdown-menu-end dropdown-list animated--grow-in">
                                        <h6 class="dropdown-header">alerts center</h6><a class="dropdown-item d-flex align-items-center" href="#">
                                            <div class="dropdown-list-image me-3"><img class="rounded-circle" src="assets/img/avatars/avatar4.jpeg">
                                                <div class="bg-success status-indicator"></div>
                                            </div>
                                            <div class="fw-bold">
                                                <div class="text-truncate"><span>Hi there! I am wondering if you can help me with a problem I've been having.</span></div>
                                                <p class="small text-gray-500 mb-0">Emily Fowler - 58m</p>
                                            </div>
                                        </a><a class="dropdown-item d-flex align-items-center" href="#">
                                            <div class="dropdown-list-image me-3"><img class="rounded-circle" src="assets/img/avatars/avatar2.jpeg">
                                                <div class="status-indicator"></div>
                                            </div>
                                            <div class="fw-bold">
                                                <div class="text-truncate"><span>I have the photos that you ordered last month!</span></div>
                                                <p class="small text-gray-500 mb-0">Jae Chun - 1d</p>
                                            </div>
                                        </a><a class="dropdown-item d-flex align-items-center" href="#">
                                            <div class="dropdown-list-image me-3"><img class="rounded-circle" src="assets/img/avatars/avatar3.jpeg">
                                                <div class="bg-warning status-indicator"></div>
                                            </div>
                                            <div class="fw-bold">
                                                <div class="text-truncate"><span>Last month's report looks great, I am very happy with the progress so far, keep up the good work!</span></div>
                                                <p class="small text-gray-500 mb-0">Morgan Alvarez - 2d</p>
                                            </div>
                                        </a><a class="dropdown-item d-flex align-items-center" href="#">
                                            <div class="dropdown-list-image me-3"><img class="rounded-circle" src="assets/img/avatars/avatar5.jpeg">
                                                <div class="bg-success status-indicator"></div>
                                            </div>
                                            <div class="fw-bold">
                                                <div class="text-truncate"><span>Am I a good boy? The reason I ask is because someone told me that people say this to all dogs, even if they aren't good...</span></div>
                                                <p class="small text-gray-500 mb-0">Chicken the Dog · 2w</p>
                                            </div>
                                        </a><a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                                    </div>
                                </div>
                                <div class="shadow dropdown-list dropdown-menu dropdown-menu-end" aria-labelledby="alertsDropdown"></div>
                            </li>
                            <div class="d-none d-sm-block topbar-divider"></div>
                            <li class="nav-item dropdown no-arrow">
                                <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"><span class="d-none d-lg-inline me-2 text-gray-600 small">MODE MODERATEUR</span></a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
                <div class="container-fluid">
                    <h3 class="text-dark mb-4">Gestion des Utilisateurs</h3>
                    <div class="card shadow" style="margin-bottom: 10px;">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 fw-bold">Boutiques Particulier</p>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive table mt-2" id="dataTable-1" role="grid" aria-describedby="dataTable_info">
                                <table class="table my-0" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th>Nom de La Boutique</th>
                                            <th>Nom du Gerant</th>
                                            <th>Actions</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <?php
                                    if ($result2 != NULL) {
                                        foreach ($result2 as $boutique) {
                                            $name = $boutique[0];
                                            $id = $boutique[1];
                                            $bid = $boutique[2];
                                            $requestS2 = "SELECT `nom`, `prenom` FROM `user` WHERE `id` = $id";
                                            $queryS2 = mysqli_query($dbs, $requestS2);
                                            $resultS2 = mysqli_fetch_all($queryS2);
                                            $nom = $resultS2[0][0];
                                            $prenom = $resultS2[0][1];
                                    ?>
                                            <tbody>
                                                <tr>
                                                    <td><?= $name ?></td>
                                                    <td><?= $nom ?> - <?= $prenom ?></td>
                                                    <td>
                                                        <form method="POST" action="boutique-del.php">
                                                            <input style=display:none name=ID id=ID value=<?= $boutique[2] ?>></input>
                                                            <input style=display:none name=TYPE id=TYPE value=PAR></input>
                                                            <input style=display:none name=UID id=UID value=<?= $boutique[1] ?>></input>
                                                            <button type="submit" class="btn btn-primary" style="margin: 0px;margin-left: 0px;margin-top: 5px;margin-bottom: 10px;">Supprimer La Boutique</button>
                                                        </form>
                                                    </td>
                                                    <td>
                                                        <form method="POST" action="articles.php">
                                                            <input style=display:none name=BID id=BID value=<?= $bid ?>></input>
                                                            <input style=display:none name=TYPE id=TYPE value=PAR></input>
                                                            <input style=display:none name=NAME id=NAME value=<?= $name ?>></input>
                                                            <button type="submit" class="btn btn-primary" style="margin: 0px;margin-left: 0px;margin-top: 5px;margin-bottom: 10px;">Voir Les Articles</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            </tbody>
                                    <?php }
                                    } ?>
                                    <tfoot>
                                        <tr></tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card shadow" style="margin-bottom: 10px;">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 fw-bold">Utilisateurs</p>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive table mt-2" id="dataTable-1" role="grid" aria-describedby="dataTable_info">
                                <table class="table my-0" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th>Nom</th>
                                            <th>Prenom</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <?php
                                    if ($result4 != NULL) {
                                        foreach ($result4 as $user) {
                                            $nom = $user[0];
                                            $prenom = $user[1];
                                            $id = $user[2];
                                    ?>
                                            <tbody>
                                                <tr>
                                                    <td><?= $nom ?></td>
                                                    <td><?= $prenom ?></td>
                                                    <td>
                                                    <form method="POST" action="user-mod.php">
                                                            <input style=display:none name=ID id=ID value=<?= $id ?>></input>
                                                            <input style=display:none name=CMD id=CMD value=BAN></input>
                                                            <button type="submit" class="btn btn-primary" style="margin: 0px;margin-left: 0px;margin-top: 5px;margin-bottom: 10px;">Bannir Le Compte</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            </tbody>
                                    <?php }
                                    } ?>
                                    <tfoot>
                                        <tr></tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="bg-white sticky-footer">
                <div class="container my-auto">
                    <div class="text-center my-auto copyright"><span>Copyright © BL-DASH 2021</span></div>
                </div>
            </footer>
        </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
    </div>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/theme.js"></script>
</body>

</html>