<?php

namespace DTO;

class CreateOrderDTO
{
    public function __construct(private int $userId,
                                private string $contactName,
                                private string $address,
                                private int $phone) {

    }

    public function getUserId(): string
    {
        return $this->userId;
    }

    public function getContactName(): string
    {
        return $this->contactName;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }


}