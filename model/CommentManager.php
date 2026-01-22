<?php 

    class CommentManager extends Manager {

        // Ajout d'un commentaire
        public function createContent($content, $article_id, $author_id){

            // Connexion à la BDD
            $db = $this->dbConnect();

            // Création de la reqûete
            $requete = $db->prepare('INSERT INTO comments (content, article_id, author_id, created_at) VALUES(:content, :article_id, :author_id, NOW())');
        
            // Exécute la requête
            $requete ->execute([
                ':content' => $content,
                ':article_id' => $article_id,
                ':author_id' => $author_id
            ]);

            return true;
        }

        // Récupérer tout les commentaires d'un article
        public function getCommentsByArticle($article_id){

            // Connexion à la BDD
            $db = $this->dbConnect();

            // Création de la reqûete
            $requete = $db->prepare('SELECT comments.*, users.pseudo FROM comments JOIN users ON comments.author_id = users.id WHERE comments.article_id = :article_id ORDER BY comments.created_at DESC');

            // Exécute la requête
            $requete->execute([':article_id' => $article_id]);

            // Retourner tous les commentaires
            return $requete->fetchAll();

        }

        // Supprimer un commentaire (admin et author only)
        public function deleteComment($id, $user_id){

            // Connexion à la BDD
            $db = $this->dbConnect();

            // VÉRIFIER : admin OU l'auteur du commentaire ?
            if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == 1) {

                // Cas 1 : Admin (user_id = 1) peut tout supprimer
                $requete = $db->prepare('DELETE FROM comments WHERE id = :id');
                $requete->execute([':id' => $id]);

            } else {

                // Cas 2 : User normal peut supprimer UNIQUEMENT son commentaire
                $requete = $db->prepare('DELETE FROM comments WHERE id = :id AND author_id = :author_id');
                $requete->execute([
                    ':id' => $id,
                    ':author_id' => $user_id
                ]);
            }

            return true;
        }
    }