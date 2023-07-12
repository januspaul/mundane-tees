    <?php
    require_once dirname(__DIR__) . '/../config/config.php';

    class TagModel
    {
        private $db;

        public function __construct($db)
        {
            $this->db = $db;
        }

        public function createTag($tagName)
        {
            $query = "INSERT INTO tags (TagName) VALUES (:tagName)";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':tagName', $tagName, PDO::PARAM_STR);
            $stmt->execute();
            return $this->db->lastInsertId();
        }

        public function getTag($tagID)
        {
            $query = "SELECT * FROM tags WHERE TagID = :tagID";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':tagID', $tagID, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function getAllTags()
        {
            $query = "SELECT * FROM tags";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function updateTag($tagID, $tagName)
        {
            $query = "UPDATE tags SET TagName = :tagName WHERE TagID = :tagID";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':tagID', $tagID, PDO::PARAM_INT);
            $stmt->bindValue(':tagName', $tagName, PDO::PARAM_STR);
            return $stmt->execute();
        }

        public function deleteTag($tagID)
        {
            $query = "DELETE FROM tshirttags WHERE TagID = :tagID";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':tagID', $tagID, PDO::PARAM_INT);
            $stmt->execute();

            $query = "DELETE FROM tags WHERE TagID = :tagID";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':tagID', $tagID, PDO::PARAM_INT);
            return $stmt->execute();
        }

        public function searchTag($tagFilter)
        {
            $query = "SELECT * FROM tags WHERE TagName LIKE :tagFilter";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':tagFilter', "%$tagFilter%", PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        
    }
