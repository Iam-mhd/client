<?php
// Importer les dépendances
require_once '_config/db.php';
require_once 'models/usermodel.php';
require_once 'controllers/usercontroller.php';
require_once 'models/productModel.php';
require_once 'controllers/productController.php';
require_once 'models/categoriModel.php'; // Nouveau
require_once 'controllers/categoriController.php'; // Nouveau

// Démarrer la session
session_start();

// Gestion des connexions
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'login') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Vérification pour les utilisateurs
    $tableUser = "SELECT * FROM users WHERE email = :email AND mot_de_passe = :password";
    $requete = $database->prepare($tableUser);
    $requete->bindParam(':email', $email);
    $requete->bindParam(':password', $password);
    $requete->execute();
    $user = $requete->fetch();

    if ($user) {
        $_SESSION['id_user'] = $user['id_user'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['role'] = 'user'; // Ajouter le rôle de l'utilisateur
        header('Location: views/actionsAdmin/dashbordview.php'); // Redirection vers le tableau de bord admin
        exit;
    } else {
        // Vérification pour les super utilisateurs
        $tableSuperUser = "SELECT * FROM superUser WHERE email = :email AND mot_de_passe = :password";
        $requete = $database->prepare($tableSuperUser);
        $requete->bindParam(':email', $email);
        $requete->bindParam(':password', $password);
        $requete->execute();
        $superUser = $requete->fetch();

        if ($superUser) {
            $_SESSION['id_superUser'] = $superUser['id_superUser'];
            $_SESSION['email'] = $superUser['email'];
            $_SESSION['role'] = 'super_user'; // Ajouter le rôle du super utilisateur
            header('Location: views/actionsSuperAdmin/dashbordview.php'); // Redirection vers le tableau de bord super admin
            exit;
        } else {
            $message = "Adresse e-mail ou mot de passe incorrect.";
        }
    }
}

// Gestion de l'ajout au panier
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add_to_cart') {
    $productId = $_POST['product_id'];

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Ajouter le produit au panier
    if (isset($_SESSION['cart'][$productId])) {
        $_SESSION['cart'][$productId]++;
    } else {
        $_SESSION['cart'][$productId] = 1;
    }

    header('Location: index.php');
    exit;
}
?>
