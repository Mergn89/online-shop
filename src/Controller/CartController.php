<?php
namespace Controller;
use Mergen\Core\AuthServiceInterface;
use DTO\CartDTO;
use Model\Product;
use Model\UserProduct;
use Request\AddProductRequest;
use Request\ProductRequest;
use Service\CartService;


class CartController
{

    private CartService $cartService;
    private AuthServiceInterface $authService;

    public function __construct(CartService $cartService, AuthServiceInterface $authService)
    {
        $this->cartService = $cartService;
        $this->authService = $authService;
    }
    public function getCart():void
    {
        if (!$this->authService->check()) {
            header("location: /login");
        } else {

            $userId = $this->authService->getCurrentUser()->getId();

            $allUserProducts = UserProduct::getUserProductsByUserId($userId);
            if(!empty($allUserProducts)) {

                $productIds = [];

                foreach ($allUserProducts as $userProduct) {
                    $productIds[] = $userProduct->getProductId();
                }
                $userProducts = Product::getAllByIds($productIds);

                $total = 0;
                foreach ($allUserProducts as $userProd) {
                    //$products = [];
                    foreach ($userProducts as $product) {
                        if ($userProd->getProductId() === $product->getId()) {
                            $product->setAmount($userProd->getAmount());
                            $allPrice = $userProd->getAmount() * $product->getPrice();
                            $total += $allPrice;
                        }
                    }
                }
            }
        }
        require_once './../View/cart.php';
    }


    public function getAddProductForm():void
    {
        if (!$this->authService->check()) {
            header("location: /login");
        }
        require_once './../View/addProduct.php';
    }

    public function addProduct(AddProductRequest $request):void
    {
        $errors = $request->validate();

        if (empty($errors)) {
            $productId = $request->getProductId();
            $amount = $request->getAmount();

            $userId = $this->authService->getCurrentUser()->getId();

            $dto = new CartDTO($userId, $productId, $amount);
            $this->cartService->addProduct($dto);
            $totalAmount = UserProduct::getAmountByUserId($userId);

            $response = ['success' => true, 'totalAmount' => $totalAmount->getTotalAmount()];
            echo json_encode($response);
            exit;
        }
    }

    public function deleteProduct(ProductRequest $productRequest): void
    {
        $userId = $this->authService->getCurrentUser()->getId();
        $productId = $productRequest->getProductId();
        UserProduct::deleteByUserIdAndProductId($userId, $productId);
        header('Location: /cart');
    }

}