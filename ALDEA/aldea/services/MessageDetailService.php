<?php
require_once __DIR__ . '/../utils/ApiResponse.php';



class MessageDetailService {
    private MessageDetailRepository $repository;

    public function __construct(MessageDetailRepository $repository) {
        $this->repository = $repository;
    }

    public function markAsRead(int $messageId): array {
        return $this->repository->markAsRead($messageId);
    }

    public function markAsDeleted(int $messageId): array {
        return $this->repository->markAsDeleted($messageId);
    }

    public function getByMessageId(int $messageId): array {
        return $this->repository->getByMessageId($messageId);
    }

    public function save(MessageDetail $messageDetail): array {
        return $this->repository->save($messageDetail);
    }
}
