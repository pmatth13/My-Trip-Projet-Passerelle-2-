<?php 

    class UserManager extends Manager {

        public function registerUser($pseudo, $email, $password){

            //Verification de l'existence de l'émail
            if($this->emailExists($email)){
                return false; //Email déja utilisé
            }

            //mdp hashé
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            //Connection BDD
            $db = $this->dbConnect();
            
            // preparation de la requête
            $requete = $db->prepare('INSERT INTO users (pseudo, email, password) VALUES (:pseudo, :email, :password)');

            //Lier les paramètres de la requête
            $requete->execute([
                ':pseudo'   => $pseudo,
                ':email'    => $email,
                ':password' => $hashedPassword
                ]);
            
                return true; // inscription success
        }

        public function emailExists($email){

        //Connexion à la BDD
        $db = $this->dbConnect();

        //Requête pour chercher l'émail
        $requete = $db->prepare('SELECT COUNT(*) FROM users WHERE email = :email');
        $requete->execute([':email' => $email]);

        //Récupére le résultat (0 ou 1)
        $count = $requete->fetchColumn();

        //Retourne true si au moins 1 ligne sinon false = 0
        return $count >0;
        }

        public function loginUser($email, $password){

        //Connexion à la BDD
        $db = $this->dbConnect();

        //Chercher l'utilisateur par email
        $requete = $db->prepare('SELECT * FROM users WHERE email = :email');
        $requete->execute([':email' => $email]);

        //Récupère les données
        $user = $requete->fetch(PDO::FETCH_ASSOC); //1 ligne tableau associatif

        //Verifie si l'user existe & si mdp correspond
        if ($user && password_verify($password, $user['password'])){
            return $user; //Toutes les infos de l'user dans la db sauf le mdp
        }

        return false; // Email ou mdp incorrect
        }
    }