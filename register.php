<!DOCTYPE html>
<html lang="fr">

<head>
    <?php include 'connexion.php'; ?>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Register</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Création du compte !</h1>
                            </div>
                            <form class="user" action="" method="post">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" name="prenom" class="form-control form-control-user" id="prenom" placeholder="Prénom" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" name="nom" class="form-control form-control-user" id="nom" placeholder="Nom" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control form-control-user" id="email" placeholder="Adresse mail" required>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" name="pass" class="form-control form-control-user" id="motdepasse" placeholder="Mot de passe" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" name="repeatpass" class="form-control form-control-user" id="confirmationmotdepasse" placeholder="Confirmer le mot de passe" required>
                                    </div>
                                </div>
                                <input type="submit" name="incription" value="Créé mon compte" class="btn btn-primary btn-user btn-block">


                                <hr>
                                <!-- <a href="index.html" class="btn btn-google btn-user btn-block">
                                    <i class="fab fa-google fa-fw"></i> Créé mon compte avec Google
                                </a> -->

                            </form>
                            <?php
                            //envoi du formulaire
                            if (isset($_POST['incription'])) {
                                //verification que les mot de passe sont identiques
                                if ($_POST['pass'] === $_POST['repeatpass']) {
                                    $prenom = $_POST['prenom'];
                                    $nom = $_POST['nom'];
                                    $email = $_POST['email'];
                                    $pass_hache = password_hash($_POST['pass'], PASSWORD_DEFAULT);
                                    $req = $pdo->prepare('INSERT INTO `user`(`nom`,`prenom`,`mdp`,`email`) VALUES (:nom, :prenom, :pass, :email)');
                                    $exec = $req->execute(array('nom' => $nom, 'prenom' => $prenom, 'pass' => $pass_hache, 'email' => $email));
                                    if ($exec) {
                                        echo '<div class="card mb-4 py-3 border-left-success"><div class="card-body">Félicitaion votre compte est crée ! Redirection vers la page de connexion dans 5sec</div></div>';
                                        mkdir('upload/profil/'.$nom.'.'.$prenom.'');
                                        header("refresh:5;url=login");
                                    } else {
                                        echo '<div class="card mb-4 py-3 border-left-danger"><div class="card-body">Oups ! Quelque chose c\'est mal passé !</div></div>';
                                    }
                                } else {
                                    echo '<div class="card mb-4 py-3 border-left-danger"><div class="card-body">Attention ! le mot de passe ne correspond pas !</div></div>';
                                }
                            }
                            ?>
                            <!-- <hr> -->
                            <div class="text-center">
                                <a class="small" href="forgot-password.html">Mot de passe oublié ?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="login">J'ai déjà un compte !</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>



</html>