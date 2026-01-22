<?php 

    class ArticleManager extends Manager {

        // Méthode pour gérer les articles
        public function createArticle($title, $content, $destination, $author_id, $image_url = null){

            //Connexion à la BDD
            $db = $this->dbConnect();

            //Requête préparée
            $requete = $db->prepare('INSERT INTO articles (title, content, destination, author_id, image_url) VALUES (:title, :content, :destination, :author_id, :image_url)');

            // Execute la requête
            $requete->execute([
                ':title'       => $title,
                ':content'     => $content,
                ':destination' => $destination,
                ':author_id'   => $author_id,
                ':image_url'   => $image_url
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
            $requete = $db->prepare('SELECT * FROM articles WHERE id = :id');
            $requete->execute([':id' => $id]);

            //Récupère l'article
            $article = $requete->fetch(PDO::FETCH_ASSOC);

            return $article;
        }

        public function updateArticle($id, $title, $content, $destination, $image_url = null){

            // Connexion à la BDD
            $db = $this->dbConnect();

            // Si une nouvelle image est fournie, on la met à jour
            if ($image_url !== null) {
                $requete = $db->prepare('UPDATE articles SET title = :title, content = :content, destination = :destination, image_url = :image_url WHERE id = :id');
                $requete->execute([
                    ':title' => $title,
                    ':content' => $content,
                    ':destination' => $destination,
                    ':image_url' => $image_url,
                    ':id' => $id
                ]);
            } else {
                // Sinon on garde l'image existante
                $requete = $db->prepare('UPDATE articles SET title = :title, content = :content, destination = :destination WHERE id = :id');
                $requete->execute([
                    ':title' => $title,
                    ':content' => $content,
                    ':destination' => $destination,
                    ':id' => $id
                ]);
            }

            return true;
        }

        public function deleteArticle($id){

            // Connexion à la BDD
            $db = $this->dbConnect();

            // Requête pour DELETE
            $requete = $db->prepare('DELETE FROM articles WHERE id = :id');

            // Exécution
            $requete->execute([':id' => $id]);

            return true;
        }
    }