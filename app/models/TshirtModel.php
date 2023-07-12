<?php
require_once dirname(__DIR__) . '/../config/config.php';
class TshirtModel
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getAllTshirt()
    {
        $query = "SELECT tshirt.*, GROUP_CONCAT(tags.TagName SEPARATOR ', ') AS TagNames
        FROM tshirt
        LEFT JOIN tshirttags ON tshirt.TshirtID = tshirttags.TshirtID
        LEFT JOIN tags ON tshirttags.TagID = tags.TagID";
        $tshirtlist = $this->db->query($query);
        return $tshirtlist;
    }


    public function deleteTshirt($tshirtid)
    {
        $query = "DELETE FROM tshirt WHERE TshirtID = :tshirtid";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':tshirtid', $tshirtid);
        $deletetshirt = $stmt->execute();
        return $deletetshirt;
    }

    public function addTshirt($size, $sleeve, $style, $neckshape, $sex, $name, $itemcode, $image, $datecreated, $userid)
    {
        $query = 'INSERT INTO tshirt (Size, Sleeve, Style, NeckShape, Sex, Name, ItemCode, Image, Datecreated, UserID) VALUES (:size, :sleeve, :style, :neckshape, :sex, :name, :itemcode, :image, :datecreated, :userid)';
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':size', $size);
        $stmt->bindValue(':sleeve', $sleeve);
        $stmt->bindValue(':style', $style);
        $stmt->bindValue(':neckshape', $neckshape);
        $stmt->bindValue(':sex', $sex);
        $stmt->bindValue(':name', $name);
        $stmt->bindValue(':itemcode', $itemcode);
        $stmt->bindValue(':image', $image);
        $stmt->bindValue(':datecreated', $datecreated);
        $stmt->bindValue(':userid', $userid);
        $addtshirt = $stmt->execute();
        return $addtshirt;
    }

    public function editTshirt($size, $sleeve, $style, $neckshape, $sex, $name, $itemcode, $image, $datecreated, $userid, $tshirtid)
    {
        $query = 'UPDATE tshirt SET Size = :size, Sleeve = :sleeve, Style = :style, NeckShape = :neckshape, Sex = :sex, Name = :name, ItemCode = :itemcode, Image = :image, Datecreated = :datecreated, UserID = :userid WHERE TshirtID = :tshirtid';
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':size', $size);
        $stmt->bindValue(':sleeve', $sleeve);
        $stmt->bindValue(':style', $style);
        $stmt->bindValue(':neckshape', $neckshape);
        $stmt->bindValue(':sex', $sex);
        $stmt->bindValue(':name', $name);
        $stmt->bindValue(':itemcode', $itemcode);
        $stmt->bindValue(':image', $image);
        $stmt->bindValue(':datecreated', $datecreated);
        $stmt->bindValue(':userid', $userid);
        $stmt->bindValue(':tshirtid', $tshirtid);
        $edittshirt = $stmt->execute();
        return $edittshirt;
    }

    public function getTshirtById($tshirtid)
    {
        $query = "SELECT tshirt.*, GROUP_CONCAT(tags.TagName SEPARATOR ', ') AS TagNames
        FROM tshirt
        LEFT JOIN tshirttags ON tshirt.TshirtID = tshirttags.TshirtID
        LEFT JOIN tags ON tshirttags.TagID = tags.TagID
        WHERE tshirt.TshirtID = :tshirtid";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':tshirtid', $tshirtid);
        $stmt->execute();
        $tshirt = $stmt->fetch(PDO::FETCH_ASSOC);
        return $tshirt;
    }

    public function searchTshirts($searchQuery, $page, $perPage, $sizeFilter, $styleFilter, $sleeveFilter, $neckshapeFilter, $sexFilter)
    {
        $offset = ($page - 1) * $perPage;

        $query = "SELECT SQL_CALC_FOUND_ROWS tshirt.*, GROUP_CONCAT(tags.TagName SEPARATOR ', ') AS TagNames
              FROM tshirt
              LEFT JOIN tshirttags ON tshirt.TshirtID = tshirttags.TshirtID
              LEFT JOIN tags ON tshirttags.TagID = tags.TagID
              WHERE 1 = 1";

        $params = [];

        if (!empty($searchQuery)) {
            $query .= " AND (tags.TagName LIKE :searchQuery OR tshirt.Name LIKE :searchQuery)";
            $params[':searchQuery'] = '%' . $searchQuery . '%';
        }

        if (!empty($sizeFilter)) {
            $query .= " AND tshirt.Size = :sizeFilter";
            $params[':sizeFilter'] = $sizeFilter;
        }
        if (!empty($styleFilter)) {
            $query .= " AND tshirt.Style = :styleFilter";
            $params[':styleFilter'] = $styleFilter;
        }
        if (!empty($sleeveFilter)) {
            $query .= " AND tshirt.Sleeve = :sleeveFilter";
            $params[':sleeveFilter'] = $sleeveFilter;
        }
        if (!empty($neckshapeFilter)) {
            $query .= " AND tshirt.NeckShape = :neckshapeFilter";
            $params[':neckshapeFilter'] = $neckshapeFilter;
        }
        if (!empty($sexFilter)) {
            $query .= " AND tshirt.Sex = :sexFilter";
            $params[':sexFilter'] = $sexFilter;
        }

        $query .= " GROUP BY tshirt.TshirtID LIMIT $perPage OFFSET $offset";

        $stmt = $this->db->prepare($query);
        $stmt->execute($params);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $totalQuery = "SELECT FOUND_ROWS() as total";
        $totalStmt = $this->db->query($totalQuery);
        $totalResult = $totalStmt->fetch(PDO::FETCH_ASSOC);
        $total = $totalResult['total'];

        return ['results' => $results, 'total' => $total];
    }


    public function getTotalTshirts()
    {
        $query = "SELECT COUNT(*) as total FROM tshirt";
        $stmt = $this->db->query($query);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }

    public function getTshirtsByPage($perPage, $offset)
    {
        $query = "SELECT tshirt.*, GROUP_CONCAT(tags.TagName SEPARATOR ', ') AS TagNames
              FROM tshirt
              LEFT JOIN tshirttags ON tshirt.TshirtID = tshirttags.TshirtID
              LEFT JOIN tags ON tshirttags.TagID = tags.TagID
              GROUP BY tshirt.TshirtID
              LIMIT $perPage OFFSET $offset";
        $stmt = $this->db->query($query);
        $tshirtList = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $tshirtList;
    }


    public function addTagToShirt($tagID, $tshirtID)
    {
        $query = "SELECT COUNT(*) FROM tshirttags WHERE TshirtID = ? AND TagID = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(1, $tshirtID, PDO::PARAM_INT);
        $stmt->bindParam(2, $tagID, PDO::PARAM_INT);
        $stmt->execute();
        $count = $stmt->fetchColumn();

        if ($count === 0) {
            $query = "INSERT INTO tshirttags (TshirtID, TagID) VALUES (?, ?)";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(1, $tshirtID, PDO::PARAM_INT);
            $stmt->bindParam(2, $tagID, PDO::PARAM_INT);
            return $stmt->execute();
        }

        return false;
    }


    public function deleteTagtoShirt($tshirtID)
    {
        $query = "DELETE FROM tshirttags WHERE tshirtID = $tshirtID";
        $stmt = $this->db->query($query);
        $deletetag = $stmt->fetch(PDO::FETCH_ASSOC);
        return $deletetag;
    }
    public function removeUnselectedTags($tshirtID, $selectedTags)
    {
        $query = "DELETE FROM tshirttags WHERE TshirtID = :tshirtID AND TagID NOT IN (:selectedTags)";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':tshirtID', $tshirtID);
        $stmt->bindValue(':selectedTags', implode(',', $selectedTags));
        $stmt->execute();
    }
    public function getTshirtsByUserAndPage($userID, $perPage, $offset)
    {
        $query = "SELECT tshirt.*, GROUP_CONCAT(tags.TagName SEPARATOR ', ') AS TagNames
                  FROM tshirt
                  LEFT JOIN tshirttags ON tshirt.TshirtID = tshirttags.TshirtID
                  LEFT JOIN tags ON tshirttags.TagID = tags.TagID
                  WHERE tshirt.UserID = :userID
                  GROUP BY tshirt.TshirtID
                  LIMIT $perPage OFFSET $offset";

        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':userID', $userID);
        $stmt->execute();
        $tshirtList = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $tshirtList;
    }
}
