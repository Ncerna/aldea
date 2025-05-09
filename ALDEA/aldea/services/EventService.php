<?php

require_once __DIR__ . '/../utils/ApiResponse.php';

require_once __DIR__ . '/../domain/Attachment.php';

class EventService
{
    private EventRepository $eventRepository;
    private EventRecipientService $eventRecipientService;
    private AttachmentService $attachmentService;

    public function __construct(
        EventRepository $eventRepository,
        EventRecipientService $eventRecipientService,
        AttachmentService $attachmentService
    ) {
        $this->eventRepository = $eventRepository;
        $this->eventRecipientService = $eventRecipientService;
        $this->attachmentService = $attachmentService;
    }

    public function listEvents(int $userId,bool $isAdmin, int $page = 1, int $size = 10): array
    {
        try {
            $result = $isAdmin 
            ? $this->eventRepository->listEvents($page, $size) 
            : $this->eventRepository->listEventsByUser($userId, $page, $size);

            return ApiResponse::successResult(count($result), $result);
        } catch (Exception $e) {

            throw new Exception("Error al listar eventos: " . $e->getMessage());
        }
    }
    public function getById(int $eventId): ?array
    {
        try {
            $event = $this->eventRepository->getById($eventId, Event::class);
            $eventArray = $event->toArray();
            if (!$eventArray) {
                return ApiResponse::notFound("Evento no encontrado.");
            }
            $eventArray['recipients'] = $this->eventRecipientService->getRecipientsByEventId($eventId);

            $eventArray['attachments'] = $this->attachmentService->getAttachmentsByEventId($eventId);

            return ApiResponse::successResult(count($eventArray), $eventArray);
        } catch (Exception $e) {

            throw new Exception("Error al listar eventos: " . $e->getMessage());
        }
    }
    public function save(Event $event, $files, $recipients, $existingFiles, $newFilesMeta): array
    {
        try {
            $savedEvent = $this->eventRepository->saveEvent($event);
            if(empty($event->getId())){
                $eventRecipient =   $this->eventRecipientService->createEventRecipient($savedEvent['id']);
                $this->eventRecipientService->save($eventRecipient);
            } 
            if (!empty($existingFiles)) {
                $this->attachmentService->updateExistingAttachments($existingFiles);
            }
            if (!empty($files['attachments'])) {
                $this->attachmentService->saveNewAttachments($savedEvent['id'], $files['attachments'], $newFilesMeta);
            }
            $this->verifyAndAssignFavorite($savedEvent['id'], $existingFiles, $newFilesMeta);

            $this->eventRecipientService->syncRecipients($savedEvent['id'], $recipients, $event->getRecipientType());

            return ApiResponse::successResult(1, 'Evento guardado correctamente');
        } catch (Exception $e) {
            throw new Exception("Error al guardar el evento: " . $e->getMessage());
        }
    }
    public function verifyAndAssignFavorite(int $eventId, array $existingFiles, array $newFilesMeta): void
    {
        $hasFavorite = false;
        foreach ($existingFiles as $file) {
            if (!empty($file['isFavorite']) && $file['isFavorite'] == 1 && (!isset($file['status']) || $file['status'] != 0)) {
                $hasFavorite = true;
                break;
            }
        }

        // Revisar archivos nuevos si no hay favorito en existentes
        if (!$hasFavorite) {
            foreach ($newFilesMeta as $meta) {
                if (!empty($meta['isFavorite']) && $meta['isFavorite'] == 1) {
                    $hasFavorite = true;
                    break;
                }
            }
        }

        // Si no hay favorito marcado, asignar uno por defecto
        if (!$hasFavorite) {
            $this->attachmentService->ensureSingleFavorite($eventId);
        }
    }



    public function deleteEvent(int $eventId): array
    {
        try {
            return $this->eventRepository->deleteEvent($eventId);
        } catch (Exception $e) {
            throw new Exception("Error al eliminar evento: " . $e->getMessage());
        }
    }

    public function approveEvent(int $eventId, int $approverId): array
    {
        try {
            return $this->eventRepository->approveEvent($eventId, $approverId);
        } catch (Exception $e) {
            throw new Exception("Error al aprobar evento: " . $e->getMessage());
        }
    }

    public function disapprove(int $eventId): array
    {
        try {
            return $this->eventRepository->disapprove($eventId);
        } catch (Exception $e) {
            throw new Exception("Error al desaprobar evento: " . $e->getMessage());
        }
    }


    public function toggleFavorite(int $eventId, int $userId): array
    {
        try {
            return $this->eventRepository->toggleFavorite($eventId, $userId);
        } catch (Exception $e) {
            throw new Exception("Error al marcar/desmarcar favorito: " . $e->getMessage());
        }
    } /////////////////////////////////////////
}
