<?php
require_once __DIR__ . '/../../interfaces/IRecipientStrategy.php';
class RecipientContext {
    private IRecipientStrategy $strategy;

    public function __construct(IRecipientStrategy $strategy) {
        $this->strategy = $strategy;
    }

    public function setStrategy(IRecipientStrategy $strategy): void {
        $this->strategy = $strategy;
    }

    public function getRecipients(): array {
        return $this->strategy->getRecipients();
    }
}