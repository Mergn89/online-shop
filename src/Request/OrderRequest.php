<?php

namespace Request;

use Mergen\Core\Request;

class OrderRequest extends Request
{
    public function getContactName(): ?string
    {
        return $this->data['contact_name'] ?? '';
    }
    public function getAddress(): ?string
    {
        return $this->data['address'] ?? '';
    }
    public function getPhone(): ?string
    {
        return $this->data['phone'] ?? '';
    }
    public function validate(): array
    {
        $data = $this->data;
        $errors = [];

        if (isset($data['contact_name'])) {
            $contactName = ($data['contact_name']);
            if (strlen($contactName) < 3 || strlen($contactName) > 20) {
                $errors['contact_name'] = "Имя должно содержать не меньше 3 символов и не больше 20 символов";
            } elseif (!preg_match("/^[a-zA-Zа-яА-Я]+$/u", $contactName)) {
                $errors['contact_name'] = "Имя может содержать только буквы";
            }
        } else {
            $errors ['contact_name'] = "Поле должно быть заполнено";
        }

        if (isset($data['address'])) {
            $address = ($data['address']);
            if (strlen($address) < 3 || strlen($address) > 100) {
                $errors['address'] = "Адресс должен содержать не меньше 3 символов и не больше 100 символов";
            } elseif (!preg_match("/^[a-zA-Zа-яА-Я0-9 ,.-]+$/u", $address)) {
                $errors['address'] = "Адресс может содержать только буквы и цифры";
            }
        } else {
            $errors ['address'] = "Поле address должно быть заполнено";
        }

        if (isset($data['phone'])) {
            $phone = ($data['phone']);
            if (!preg_match("/^[0-9]+$/u", $phone)) {
                $errors['phone'] = "Номер телефона может содержать только цифры";
            } elseif (strlen($phone) < 3 || strlen($phone) > 15) {
                $errors['phone'] = "Номер телефона должен содержать не меньше 3 символов и не больше 15 символов";
            }
        } else {
            $errors ['phone'] = "Поле phone должно быть заполнено";
        }

        return $errors;
    }



}