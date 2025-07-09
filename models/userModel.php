<?php
require ('../connection/db.php');
require (__DIR__ . '/BaseModel.php');

class UserModel extends Model {
    protected static string $table = 'users';
    protected static string $primary_key = 'id';

    public int $id;
    public string $name;
    public string $email;
    public string $phone;
    public string $password;
    public string $favorite_genres;
    public string $role;

    public function __construct(array $data) {
        $this->id = $data['id'] ?? null;
        $this->name = $data['name'] ?? '';
        $this->email = $data['email'] ?? '';
        $this->phone = $data['phone'] ?? '';
        $this->password = $data['password'] ?? '';
        $this->favorite_genres = $data['favorite_genres'] ?? '';
        $this->role = $data['role'] ?? 'user';
    }

    public static function findByEmail($mysqli, $email) {
        $query = $mysqli->prepare("SELECT * FROM users WHERE email = ?");
        $query->bind_param("s", $email);
        $query->execute();
        $result = $query->get_result();
        $row = $result->fetch_assoc();
        return $row;
    }

    public static function createUser($mysqli, $name, $email, $phone, $password, $genres, $role = 'user') {
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (name, email, phone, password, favorite_genres,role ) VALUES (?, ?, ?, ?, ?, ?)";
        $query = $mysqli->prepare($sql);
        $query->bind_param("ssssss", $name, $email, $phone, $hashed, $genres,$role);
        return $query->execute();
    }

    public static function updateUser($mysqli, $id, $name, $email, $phone, $favorite_genres) {
        $query = $mysqli->prepare("SELECT * FROM users WHERE id = ?");
        $query->bind_param("i", $id);
        $query->execute();
        $result = $query->get_result();
        $user = $result->fetch_assoc();
        if (!$user) {
            return false;
        }
        $name = $name ?? $user['name'];
        $email = $email ?? $user['email'];
        $phone = $phone ?? $user['phone'];
        $favorite_genres = $favorite_genres ?? $user['favorite_genres'];
        $password = $user["password"];
        //keep pass

        $query = $mysqli->prepare("UPDATE users SET name = ?, email = ?, phone = ?, password = ?, favorite_genres = ? WHERE id = ?");
        $query->bind_param("sssssi", $name, $email, $phone, $password, $favorite_genres, $id);
        return $query->execute();
    }
}
