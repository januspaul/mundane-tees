<?php
require_once dirname(__DIR__) . '/../config/config.php';

class UserModel
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getAllUsers($perPage, $currentPage)
    {
        $offset = ($currentPage - 1) * $perPage;
        $query = "SELECT * FROM user LIMIT :perPage OFFSET :offset";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':perPage', $perPage, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $users;
    }

    public function deleteUser($userid)
    {
        $query = 'DELETE FROM user WHERE UserID = :userid';
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':userid', $userid);
        $deleteuser = $stmt->execute();
        return $deleteuser;
    }

    public function editUser($userid, $username, $password, $role)
    {
        $hashedpassword = password_hash($password, PASSWORD_DEFAULT);
        $query = 'UPDATE user SET Username = :username, Password = :password, Role = :role WHERE UserID = :userid';
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':userid', $userid);
        $stmt->bindValue(':username', $username);
        $stmt->bindValue(':password', $hashedpassword);
        $stmt->bindValue(':role', $role);
        $edituser = $stmt->execute();
        return $edituser;
    }

    public function addUser($username, $password, $role)
    {
        $hashedpassword = password_hash($password, PASSWORD_DEFAULT);

        // Check if the username already exists
        $query = 'SELECT COUNT(*) FROM user WHERE BINARY Username = :username';
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':username', $username);
        $stmt->execute();
        $count = $stmt->fetchColumn();

        if ($count === 0) {
            // Insert the new user if the username doesn't exist
            $query = 'INSERT INTO user (Username, Password, Role) VALUES (:username, :password, :role)';
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':username', $username);
            $stmt->bindValue(':password', $hashedpassword);
            $stmt->bindValue(':role', $role);
            $stmt->execute();

            return true;
        } else {
            return false;
        }
    }

    public function getUserById($userid)
    {
        $query = 'SELECT * FROM user WHERE UserID = :userid';
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':userid', $userid, PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user;
    }
    public function getUserByUsername($username)
    {
        $query = 'SELECT * FROM user WHERE BINARY Username = :username';
        $stmt = $this->db->prepare($query);
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user;
    }

    public function getTotalUsers()
    {
        $query = "SELECT COUNT(*) as total FROM user";
        $stmt = $this->db->query($query);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }
}
