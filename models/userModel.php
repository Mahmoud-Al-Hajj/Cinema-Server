<?php
require ('../connection/db.php');
class UserModel {
private $mysqli;
private int $id;
private string $name;
private string $email;
private string $phone;
private string $password;
private string $favorite_genres;

public function __construct(mysqli $mysqli) {
    $this->mysqli = $mysqli;

}





public function fetchFromDatabase($mysqli, $id) {
        $query = $mysqli->prepare("SELECT * FROM users WHERE id = ?");
        $query->bind_param("i", $id);
        $query->execute();
        $result = $query->get_result();

        if ($row = $result->fetch_assoc()) {

            $this->id = $row['id'];
            $this->name = $row['name'];
            $this->email = $row['email'];
            $this->phone = $row['phone'];
            $this->password = $row['password'];
            $this->favorite_genres = $row['favorite_genres'];
                }
    }


public function getId(): int {
    return $this->id;
}
public function getName(): string {
    return $this->name;
}
public function getEmail(): string {
    return $this->email;
}
public function getPhone(): string {
    return $this->phone;
}
public function getPassword(): string {
    return $this->password;
}
public function getFavoriteGenres(): string {
    return $this->favorite_genres;
}

public function setName(string $name): void {
    $this->name = $name;
}
public function setEmail(string $email): void {
    $this->email = $email;
}
public function setPhone(string $phone): void {
    $this->phone = $phone;
}
public function setPassword(string $password): void {
    $this->password = $password;
}
public function setFavoriteGenres(string $favorite_genres): void {
    $this->favorite_genres = $favorite_genres;
}
public function showUser($id) {
    $query = $this->mysqli->prepare("SELECT * FROM users WHERE id = ?");
    $query->bind_param("i", $id);
    $query->execute();
    $result = $query->get_result();
    return $result->fetch_assoc();
}

  public function createUser($name, $email, $phone, $password, $genres) {
        $sql = "INSERT INTO users (name, email, phone, password, favorite_genres) VALUES (?, ?, ?, ?, ?)";
        $query = $this->mysqli->prepare($sql);
    $hashed = password_hash($_POST['password'], PASSWORD_DEFAULT);
        return $query->execute([$name, $email, $phone, $hashed, $genres]);
    }

public function findByEmail($mysqli, $email) {
    $query = $mysqli->prepare("SELECT * FROM users WHERE email = ?");
    $query->bind_param("s", $email);
    $query->execute();
    $result = $query->get_result();
    return $result->fetch_assoc();
}

public function updateUser($id, $name, $email, $phone, $favorite_genres) {

     $query = $this->mysqli->prepare("SELECT * FROM users WHERE id = ?");
    $query->bind_param("i", $id);
    $query->execute();
    $result = $query->get_result();
    $user = $result->fetch_assoc();
    if (!$user) {
        return false;
    }
    $name = !empty($name) ? $name : $user["name"];
    $email = !empty($email) ? $email : $user["email"];
    $phone = !empty($phone) ? $phone : $user["phone"];
    $favorite_genres = !empty($favorite_genres) ? $favorite_genres : $user["favorite_genres"];
    $password = $user["password"];

    $query = $this->mysqli->prepare("UPDATE users SET name = ?, email = ?, phone = ?, password = ?, favorite_genres = ? WHERE id = ?");
    $query->bind_param("sssssi", $name, $email, $phone, $password, $favorite_genres, $id);



    return $query->execute();
}


}
