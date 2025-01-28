<?php
namespace Model;
class Product extends Model
{
    private int $id;
    private string $title;
    private string $description;
    private string $price;
    private string $imageLink;
    private ?int $amount = null;

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getPrice(): string
    {
        return $this->price;
    }

    public function getImageLink(): string
    {
        return $this->imageLink;
    }
    public function getAmount(): int
    {
        return $this->amount;

    }
    public function setId(int $id): Product
    {
        $this->id = $id;
        return $this;
    }

    public function setTitle(string $title): Product
    {
        $this->title = $title;
        return $this;
    }

    public function setDescription(string $description): Product
    {
        $this->description = $description;
        return $this;
    }

    public function setPrice(string $price): Product
    {
        $this->price = $price;
        return $this;
    }

    public function setImageLink(string $imageLink): Product
    {
        $this->imageLink = $imageLink;
        return $this;
    }
    public function setAmount(int $amount): Product
    {
        $this->amount = $amount;
        return $this;
    }
public static function hydrate(array $data): self
{
    $products = new self();
    $products->id = $data['id'];
    $products->title = $data['title'];
    $products->description = $data['description'];
    $products->price = $data['price'];
    $products->imageLink = $data['image_link'];
    return $products;

}

    public static function getProducts(): array|null
    {
        $stmt = self::connectToDatabase()->query("SELECT * FROM products");

        $data = $stmt->fetchAll();
        if($data === false){
            return null;
        } else{
            foreach ($data as &$product){
                $product = self::hydrate($product);
            }
        } return $data;
    }

    public static function getOneById(int $productId): self|null
    {
        $stmt = Model::connectToDatabase()->prepare("SELECT * FROM products WHERE id = :id");
        $stmt->execute(['id' => $productId]);
        $data = $stmt->fetch();
        if($data === false) {
            return null;
        }
        return Product::hydrate($data);
    }


    public static function getAllByIds(array $productIds): array|null
    {
        //$productId = implode(',' , $productIds);
        $productId = '?' . str_repeat(', ?', count($productIds)-1); //преобразывает массив  в строку

//        $sql = 'SELECT * FROM test WHERE id in ('.implode(",", $array).')';

        $stmt = self::connectToDatabase()->prepare("SELECT * FROM products WHERE id IN ($productId)");
        $stmt->execute($productIds);
        $data = $stmt->fetchAll();
        if ($data === false) {
            return null;
        }
        foreach ($data as &$product) {
            $product = self::hydrate($product);
        }
        return $data;

    }






}