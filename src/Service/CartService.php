<?php

namespace Service;

use Model\UserProduct;
use DTO\CartDTO;

class CartService
{
    public function addProduct(CartDTO $cartDTO): void
    {
        $dataUserProducts = UserProduct::getAmountByUserIdAndProductId($cartDTO->getUserId(), $cartDTO->getProductId());

        if (!$dataUserProducts) {
            UserProduct::addProductInUserProducts($cartDTO->getUserId(), $cartDTO->getProductId(), $cartDTO->getAmount());
        } else {
            $sumAmount = $dataUserProducts->getAmount() + $cartDTO->getAmount();

            UserProduct::updateAmountInUserProducts($cartDTO->getUserId(), $cartDTO->getProductId(), $sumAmount);
        }
    }
}