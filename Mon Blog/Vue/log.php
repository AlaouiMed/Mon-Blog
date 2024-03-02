<?php
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === TRUE) {
    echo "Bonjour, " . $_SESSION['username'] . "Bienvenue sur ce blog.";
    echo ' Souhaites-tu <a href="index.php?action=logout">Se déconnecter?</a>';
} else {
    echo 'Bienvenue sur ce blog. Souhaites-tu<a href="login.php">
            <button class="login-btn">Se connecter</button>
        </a>?';
}
