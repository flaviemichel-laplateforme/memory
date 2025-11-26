<?php

namespace App\Models;

use Core\Database;

class User
{
    /**
     * 
     * Crée un nouvel utilisateur en base de données
     */
    public function create($login, $password, $email, $nom, $prenom)
    {
        $pdo = Database::getPdo();

        $sql = "INSERT INTO utilisateurs(login, password, email, nom, prenom, date_creation)
            VALUES (?, ?, ?, ?, ?, NOW())";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([$login, $password, $email, $nom, $prenom]);
        return $stmt;
    }

    /**
     * Cherhe un utilisateur par son login 
     */
    public function findByLogin($login)
    {
        $pdo = Database::getPdo();

        $sql = "SELECT * FROM utilisateurs WHERE login = ?";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([$login]);

        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
    /**
     * Vérifie si un login existe déja 
     */
    public function exists($login)
    {
        $user = $this->findByLogin($login);
        return $user !== false;
    }

    /**
     * Met à jour les informations de l'utilisateur
     */
    public function update($login, $email, $nom, $prenom, $password = null)
    {
        if (!isset($_SESSION['user']['id'])) {
            return false;
        }

        $id = $_SESSION['user']['id'];
        $pdo = Database::getPdo();

        if ($password) {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $sql = "UPDATE utilisateurs
                    SET login = ?, email = ?, nom = ?, prenom = ?, password = ?
                    WHERE id = ?";

            $stmt = $pdo->prepare($sql);
            $stmt->execute([$login, $email, $nom, $prenom, $hashedPassword, $id]);
        } else {

            $sql = "UPDATE utilisateurs
                    SET login = ?, email = ?, nom = ?, prenom = ? 
                    WHERE id = ?";

            $stmt = $pdo->prepare($sql);
            $stmt->execute([$login, $email, $nom, $prenom, $id]);
        }
        return true;
    }

    /**
     * Recupère toutes les infos
     * Utile pour pré-remplir le formulaire
     */
    public function findById($id)
    {
        $pdo = Database::getPdo();
        $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
}
