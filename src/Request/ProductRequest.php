<?php

namespace Request;

use Model\Product;

class ProductRequest extends Request
{

    public function getProductId(): ?int
    {
        return $this->data['product_id'] ?? '';
    }



}