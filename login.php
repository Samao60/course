<!DOCTYPE html>
<html lang="fr">

<head>
<?php include 'connexion.php'; ?>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Login</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Bienvenue !</h1>
                                    </div>
                                    <form class="user" method="post" action="">
                                        <div class="form-group">
                                            <input type="email" name="email" class="form-control form-control-user"
                                                id="email" aria-describedby="emailHelp"
                                                placeholder="Mon adresse mail">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="pass" class="form-control form-control-user"
                                                id="pass" placeholder="Mot de passe">
                                        </div>
                                        <div class="form-group">
                                          
                                        </div>
                                        <input type="submit" name="connexion" value="Connexion" class="btn btn-primary btn-user btn-block">
                                        <hr>
                                        <!-- <a href="index.html" class="btn btn-google btn-user btn-block">
                                            <i class="fab fa-google fa-fw"></i> Connexion via Google
                                        </a> -->
                                        
                                    </form>
                                    <?php 
                                     if(isset($_POST['connexion'])) {
                                        $email = $_POST['email'];
                                        $pass = $_POST['pass'];
                                          //  Récupération de l'utilisateur et de son pass hashé
        $req = $pdo->prepare('SELECT * FROM `user` WHERE email = :email');
        $req->execute(array('email' => $email));
        $resultat = $req->fetch();
        
        // Comparaison du pass envoyé via le formulaire avec la base
        if(password_verify($pass, $resultat['mdp'])) {
            session_start();
             $_SESSION['id'] = $resultat['id'];
             $_SESSION['prenom'] = $resultat['prenom'];
             $_SESSION['nom'] = $resultat['nom'];
             $_SESSION['email'] = $email;
            header("Location: index");
            exit();

        }
        else {
            echo '<div class="card mb-4 py-3 border-left-danger"><div class="card-body">Mauvais identifiant ou mot de passe !</div></div> <br>';
        }
    }

                                     ?>

                                    <!-- <hr> -->
                                    <div class="text-center">
                                        <a class="small" href="forgot-password.html">Mot de passe oublié ?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="register">Je veux créé mon compte !</a>
                                    </div>
                                </div>
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