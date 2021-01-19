<?php

require('Connection.php');

class User {

    const ALG = 'SHA256';
    private $conn;

    private function validateRole($role) {
        return $role === '1' || $role === '2';
    }

    public function __construct() {
        $this->conn = (new Connection())->getConn();

        if(!$this->conn->query("SELECT 1 FROM users LIMIT 1")) {
            $query = $this->conn->query("CREATE TABLE users (
                id INTEGER AUTO_INCREMENT PRIMARY KEY,
                login VARCHAR(100) NOT NULL,
                password VARCHAR(100) NOT NULL,
                role INTEGER,
                created_at DATETIME NOT NULL,
                UNIQUE (login)
            )");
            if(!$query) {
                echo '<br>ERROR, CANNOT CREATE DATABASE</br>';
                exit(0);
            }
        }
    }

    public function authenticate() {
        if(!isset($_SESSION['id']) || !isset($_SESSION['login'])) {
            header("Location: /login.php");
            exit(0);
        }
    }

    public function login($login, $password) {
        $sql = $this->conn->prepare('SELECT id, login, created_at FROM users WHERE login = ? and password = ?');
        $sql->execute([
            $login,
            hash(self::ALG, $password)
        ]);
        $user = $sql->fetch();

        if(!empty($user)) {
            $_SESSION['id'] = $user['id'];
            $_SESSION['login'] = $user['login'];
            
            header("Location: /");
            exit(0);
        }

        return false;
    }

    public function logout() {
        session_destroy();
        header("Location: /login.php");
        exit(0);
    }

    public function register($login, $password, $role) {

        if(!$this->validateRole($role)) {
            return false;
        }

        $sql = $this->conn->prepare('INSERT INTO users VALUES (NULL, ?, ?, ?, now())');
        $registered = $sql->execute([
            $login,
            hash(self::ALG, $password),
            $role
        ]);

        if($registered) {            
            header("Location: /login.php");
            exit(0);
        }

        return false;
    }

    public function getUser() {
        $this->authenticate();

        $sql = $this->conn->prepare('SELECT login, role, created_at FROM users WHERE id = ?');
        if($sql->execute([$_SESSION['id']])) {
            return $sql->fetch();
        }

        header("Location: /login.php");
        exit(0);
    }
}