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
}
