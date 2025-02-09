<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../public/assets/css/connexion.css">
    <title>Connexion</title>
    <style>
        body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    margin: 0;
    padding: 0;
    height: 100vh;
    background: url('../public/assets/img/connexion.jpg') no-repeat center center fixed;
    background-size: cover;
    display: flex;
    justify-content: center;
    align-items: center;
    color: #fff; /* Text color to ensure visibility */
}

.container {
    background-color: transparent;
    border: 5px solid #fff;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.4);
    width: 100%;
    max-width: 400px;
}

h1 {
    margin-top: 0;
    color: #fff; /* Ensure header text is visible on dark background */
    text-align: center;
    color: black;
}

label {
    display: block;
    margin: 10px 0 5px;
    color: black; /* Ensure label text is visible on dark background */
    font-weight: bold;
}

input[type="email"], input[type="password"] {
    width: 100%;
    padding: 15px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
    font-size: 16px;
    background-color: #fff; /* White background for input fields */
    color: #333; /* Dark text color for readability */
}

button {
    width: 100%;
    padding: 15px;
    background-color: #007bff;
    border: none;
    color: #fff;
    font-size: 18px;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

button:hover {
    background-color: #0056b3;
}

.message {
    margin-bottom: 20px;
    color: #d9534f;
    text-align: center;
}

.footer {
    position: absolute;
    bottom: 20px;
    width: 100%;
    text-align: center;
    color: #fff;
    font-size: 14px;
}
    </style>
    
    
</head>
<body>
    <div class="container">
        <?php if (!isset($_SESSION['id_user']) && !isset($_SESSION['id_superUser'])): ?>
            <?php if (isset($message)) : ?>
                <div class="message"><?php echo $message; ?></div>
            <?php endif; ?>

            <h1>Connexion</h1>
            <form action="../index.php" method="POST">
                <input type="hidden" name="action" value="login">
                <label for="email">Adresse e-mail:</label>
                <input type="email" id="email" name="email" required>

                <label for="password">Mot de passe:</label>
                <input type="password" id="password" name="password" required>

                <button type="submit">Se connecter</button>
            </form>
        <?php endif; ?>
    </div>
    <div class="footer">
        &copy; 2024 Votre Société. Tous droits réservés.
    </div>
</body>
</html>
