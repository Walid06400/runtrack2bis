<?php

class User {
    private $id;
    public $login;
    public $email;
    public $firstname;
    public $lastname;
    private $password;
    protected $database;
    protected $isConnected = false;

    public function __construct() {
        try {
            $this->database = new PDO("mysql:host=localhost;dbname=classes", "root", "");
            $this->database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $error) {
            echo "Connection error: " . $error->getMessage();
            exit();
        }
    }

    public function register($login, $password, $email, $firstname, $lastname) {
        try {
            $passwordHash = password_hash($password, PASSWORD_BCRYPT);

            $query = $this->database->prepare("INSERT INTO utilisateurs (login, password, email, firstname, lastname) VALUES (:login, :password, :email, :firstname, :lastname)");
            $query->bindValue(":login", $login, PDO::PARAM_STR);
            $query->bindValue(":password", $passwordHash, PDO::PARAM_STR);
            $query->bindValue(":email", $email, PDO::PARAM_STR);
            $query->bindValue(":firstname", $firstname, PDO::PARAM_STR);
            $query->bindValue(":lastname", $lastname, PDO::PARAM_STR);

            return $query->execute();
        } catch (PDOException $e) {
            echo "Erreur d'enregistrement : " . $e->getMessage();
            return false;
        }
    }

    public function getAllUsers() {
        try {
            $query = $this->database->query("SELECT * FROM utilisateurs");
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erreur lors de la récupération des utilisateurs : " . $e->getMessage();
            return [];
        }
    }

    public function getUserById($id) {
        try {
            $query = $this->database->prepare("SELECT * FROM utilisateurs WHERE id = :id");
            $query->bindValue(":id", $id, PDO::PARAM_INT);
            $query->execute();
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erreur lors de la récupération de l'utilisateur : " . $e->getMessage();
            return null;
        }
    }

    public function update($id, $login, $email, $firstname, $lastname) {
        try {
            $query = $this->database->prepare("UPDATE utilisateurs SET login = :login, email = :email, firstname = :firstname, lastname = :lastname WHERE id = :id");
            $query->bindValue(":id", $id, PDO::PARAM_INT);
            $query->bindValue(":login", $login, PDO::PARAM_STR);
            $query->bindValue(":email", $email, PDO::PARAM_STR);
            $query->bindValue(":firstname", $firstname, PDO::PARAM_STR);
            $query->bindValue(":lastname", $lastname, PDO::PARAM_STR);

            return $query->execute();
        } catch (PDOException $e) {
            echo "Erreur de mise à jour : " . $e->getMessage();
            return false;
        }
    }

    public function delete($id) {
        try {
            $query = $this->database->prepare("DELETE FROM utilisateurs WHERE id = :id");
            $query->bindValue(":id", $id, PDO::PARAM_INT);
            return $query->execute();
        } catch (PDOException $e) {
            echo "Erreur de suppression : " . $e->getMessage();
            return false;
        }
    }
}
?>
