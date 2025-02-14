<?php
namespace Controller;
use Mergen\Core\AuthServiceInterface;
use DTO\CreateOrderDTO;
use Request\OrderRequest;
use Service\OrderService;

class OrderController
{
    private OrderService $orderService;
    private AuthServiceInterface $authService;


    public function __construct(OrderService $orderService, AuthServiceInterface $authService)
    {
        $this->orderService = $orderService;
        $this->authService = $authService;
    }


    public function getOrderForm(): void
    {
        if (!$this->authService->check()) {
            header('Location: /login');
        } else {
            require_once "./../View/order.php";
        }
    }

    public function order(OrderRequest $request): void
    {
        $errors = $request->validate();

        if (empty($errors)) {
            $userId = $this->authService->getCurrentUser()->getId();
            $contactName = $request->getContactName();
            $address = $request->getAddress();
            $phone = $request->getPhone();

            $dto = new CreateOrderDTO($userId, $contactName, $address, $phone);
            $this->orderService->create($dto);

            header('Location: /orders');
        }
        require_once "./../View/order.php";
    }

    public function getOrdersForm(): void
    {
        if (!$this->authService->check()) {
            header("location: /login");
        } else {
            $userId = $this->authService->getCurrentUser()->getId();

            $orders = $this->orderService->getOrders($userId);

            require_once "./../View/orders.php";
        }
    }

}