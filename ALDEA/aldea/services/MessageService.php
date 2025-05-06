<?php

require_once __DIR__ . '/../utils/ApiResponse.php';
require_once __DIR__ . '/../services/AttachmentService.php';
require_once __DIR__ . '/../services/MessageRecipientService.php';
require_once __DIR__ . '/../repositories/MessageRepository.php';
require_once __DIR__ . '/../domain/Attachment.php';

class MessageService
{
    private MessageRepository $messageRepository;
    private AttachmentService $attachmentService;
    private MessageRecipientService $recipientService;

    public function __construct(MessageRepository $messageRepository, AttachmentService $attachmentService, MessageRecipientService $recipientService)
    {
        $this->messageRepository = $messageRepository;
        $this->attachmentService = $attachmentService;
        $this->recipientService = $recipientService;
    }

    private function isMultipleMessage(Message $message): bool
    {
        return $message->getSendType() == 2;
    }

    public function save(Message $message, $files, $recipients,  $attachmentsRemove): array
    {
        try {
            if ($this->isMultipleMessage($message)) {
                $message->setRecipientId(null);
            } else {
                $message->setRecipientId(!empty($recipients) ? $recipients[0]->getUserId() : null);
            }

            $savedMessage = $this->messageRepository->save($message);
            $this->recipientService->syncRecipients($savedMessage['id'], $recipients);

            $attachments = Attachment::getAttachments($savedMessage['id'], $files);
            foreach ($attachments as $attachment) {
                $attachment->setMessageId($savedMessage['id']);
                $this->attachmentService->save($attachment);
            }

            if (!empty($attachmentsRemove)) {
                // $this->attachmentService->deleteAttachments($attachmentsRemove , $message->getId());
            }

            return ApiResponse::successResult(1, 'Mensaje guardado correctamente');
        } catch (Exception $e) {
            throw new Exception("Error al guardar el mensaje: " . $e->getMessage());
        }
    }

    public function findById($messageId): array
    {
        try {
            $message = $this->messageRepository->findById($messageId);
            $recipients = $this->recipientService->getRecipientsByMessageId($messageId);
            $attachments = $this->attachmentService->getAttachmentsByMessageId($messageId);
            $message['recipients'] = $recipients;
            $message['attachments'] = $attachments;
            return ApiResponse::successResult(count($message), $message);
        } catch (Exception $e) {
            throw new Exception("Error al obtener el mensaje: " . $e->getMessage());
        }
    }

    public function list(int $page = 1, int $size = 10): array
    {
        try {
            $result = $this->messageRepository->list(Message::class, $page, $size);
            return ApiResponse::successResult(count($result), $result);
        } catch (Exception $e) {
            throw new Exception("Error al listar los mensajes paginados: " . $e->getMessage());
        }
    }

    public function getMessagesWithSenderAndRecipient($messageId): array
    {

        try {
            $message = $this->messageRepository->findByIdAndRemite($messageId);
            $recipients = $this->recipientService->getRecipientsWithFullNames($messageId);
            $attachments = $this->attachmentService->getAttachmentsByMessageId($messageId);
            $message['recipients'] = $recipients;
            $message['attachments'] = $attachments;
            return ApiResponse::successResult(count($message), $message);
        } catch (Exception $e) {
            throw new Exception("Error al listar los mensajes paginados: " . $e->getMessage());
        }
    }

    public function listMessages(int $page = 1, int $size = 10): array
    {
        try {
            $result = $this->messageRepository->paginateWithSender($page, $size);
            return ApiResponse::successResult(count($result['list']), $result);
        } catch (Exception $e) {
            throw new Exception("Error al listar mensajes: " . $e->getMessage());
        }
    }
    public function deleteMessagesByIds(array $ids): array
    {
        try {
            $this->messageRepository->startTransaction();
            $this->messageRepository->deleteMessageRecipientsByMessageIds($ids);
            $this->messageRepository->deleteAttachmentsByMessageIds($ids);
            $result = $this->messageRepository->deleteMessagesByIds($ids);
            $this->messageRepository->commitTransaction();
            return $result;
        } catch (\Exception $e) {
            $this->messageRepository->rollbackTransaction();
            throw new Exception("Error al eliminar mensajes: " . $e->getMessage());
        }
    }
    public function markMessageAsFavorite(int $messageId,int $userId): array
    {
        return $this->messageRepository->markMessageAsFavorite($messageId,$userId);
    }
    public function markAsRead(int $messageId,int $userId): array
    {
        return $this->recipientService->markAsRead($messageId,$userId);
    }

    public function getMessagesForRecipient(int $recipientId): array
    {
        return $this->messageRepository->getMessagesForRecipient($recipientId);
    }

    public function handleMessageApproval(int $messageId, int $is_approved): array
    {
        try {
            return $this->messageRepository->setApprovalStatus($messageId, $is_approved);
        } catch (Exception $e) {
            throw new Exception("Error al aprobar el mensaje: " . $e->getMessage());
        }
    }
    public function getReceivedMessages(int $userId, $userIsAdmin = false,int $page = 1, int $size = 10): array
    {
        try {
            $result = $this->messageRepository->paginateReceivedMessages($userId,$userIsAdmin, $page, $size);
            return ApiResponse::successResult(count($result['list']), $result);
        } catch (Exception $e) {
            throw new Exception("Error al obtener mensajes recibidos paginados: " . $e->getMessage());
        }
    }

    public function getSentMessages(int $userId, int $page = 1, int $size = 10): array
    {
        try {
            $result = $this->messageRepository->paginateSentMessages($userId, $page, $size);
            return ApiResponse::successResult(count($result['list']), $result);
        } catch (Exception $e) {
            throw new Exception("Error al obtener mensajes enviados paginados: " . $e->getMessage());
        }
    }
}
