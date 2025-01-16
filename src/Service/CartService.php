<?php

namespace Service;

use Model\UserProduct;
use DTO\CartDTO;

class CartService
{
    private UserProduct $userProduct;

    public function __construct()
    {
        $this->userProduct = new UserProduct();
//        $this->cartDTO = new CartDTO();
    }
    public function addProduct(CartDTO $cartDTO): void
    {
        $dataUserProducts = $this->userProduct->getAmountByUserIdAndProductId($cartDTO->getUserId(), $cartDTO->getProductId());
        //print_r($dataUserProducts); die;

        if (!$dataUserProducts) {
            $this->userProduct->addProductInUserProducts($cartDTO->getUserId(), $cartDTO->getProductId(), $cartDTO->getAmount());
        } else {
            $sumAmount = $dataUserProducts->getAmount() + $cartDTO->getAmount();

            $this->userProduct->updateAmountInUserProducts($cartDTO->getUserId(), $cartDTO->getProductId(), $sumAmount);

        }
    }
}