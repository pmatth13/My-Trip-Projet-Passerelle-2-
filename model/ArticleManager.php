<?php 

    class ArticleManager extends Manager {

        // Méthode pour gérer les articles
        public function createArticle($title, $content, $destination, $author_id){

            //Connexion à la BDD
            $db = $this->dbConnect();

            //Requête préparée
            $requete = $db->prepare('INSERT INTO articles (title, content, destination, author_id) VALUES (:title, :content, :destination, :author_id)');

            // Execute la requête
            $requete->execute([
                ':title'       => $title,
                ':content'     => $content,
                ':destination' => $destination,
                ':author_id'   => $author_id
            ]);

            return true;
        }

        public function getAllArticles(){

            // Connexion à la BDD
            $db = $this->dbConnect();
            
            // Requête pour récupérer tous les articles
            $requete = $db->query('SELECT * FROM articles ORDER BY created_at DESC');
            
            // Récupérer tous les résultats
            $articles = $requete->fetchAll(PDO::FETCH_ASSOC);
            
            return $articles;
        }

        public function getArticleById($id){

            // Connexion à la BBD
            $db = $this->dbConnect();

            //Requête PREPARER pour recupérer UN seul article par son ID
            $requete = $db->prepare('SELECT * FROM articles WHERE id = id');
            $requete->execute([':id' => $id]);

            //Récupère l'article
            $article = $requete->fetch(PDO::FETCH_ASSOC);

            return $article;
        }
    }