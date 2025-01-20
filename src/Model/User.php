<?php
namespace Model;

class User extends Model
{
    private int $id;
    private string $name;
    private string $email;
    private string $password;

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public static function hydrate(array $data): self
    {
        $user = new self();
        $user->id = $data['id'];
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = $data['password'];
        return $user;
    }

    public static function create(string $name, string $email,string $password): void
    {
        $stmt = Model::connectToDatabase()->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");
        $stmt->execute(['name' => $name, 'email' => $email, 'password' => $password]);

    }

    public static function getById(int $id): self|null
    {
        $stmt = self::connectToDatabase()->prepare('SELECT * FROM users WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $data = $stmt->fetch();

        if($data === false){
            return null;
        }
        return self::hydrate($data);

    }

    public static function getByEmail(string $login): self|null
    {
        $stmt = self::connectToDatabase()->prepare('SELECT * FROM users WHERE email = :login');
        $stmt->execute(['login' => $login]);
        $data = $stmt->fetch();

        if($data === false){
            return null;
        }
        return self::hydrate($data);

    }

}