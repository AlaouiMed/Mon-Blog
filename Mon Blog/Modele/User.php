<?php

class User extends Modele
{
    public function register($email, $username, $password)
    {
        $sql = 'insert into T_AUTEUR(AUT_EMAIL,AUT_NDU,AUT_MDP)'
            . ' values(?, ?, ?)';
        $this->executerRequete($sql, array($email,$username, $password));
    }

    public function login($email, $password)
    {
        $sql = 'select AUT_MDP AS password, AUT_NDU AS username FROM T_AUTEUR WHERE AUT_EMAIL = ?';
        $loginUtilisateur = $this->executerRequete($sql, array($email));
        return $loginUtilisateur->fetch();
    }

}
