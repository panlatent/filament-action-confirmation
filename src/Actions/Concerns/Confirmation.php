<?php

namespace Panlatent\Filament\ActionConfirmation\Actions\Concerns;

use Closure;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;

trait Confirmation
{
    protected bool | string | Closure | null $confirmInput = null;

    protected bool | Closure | null $confirmPassword = null;

    protected Notification | Closure | null $confirmFailureNotification = null;

    protected string | Closure | null $confirmFailureNotificationTitle = null;

    public function confirmInput(string | Closure $confirmInput): static
    {
        $this->confirmInput = $confirmInput;

        $this->form = array_merge($this->form ?? [], [
            TextInput::make(is_string($confirmInput) ? $confirmInput : 'input')
                ->label(fn ($record) => __('filament-action-confirmation::action-confirmation.To confirm, type ":input" in the box below', ['input' => $record->$confirmInput]))
                ->rule(fn ($record) => static function (string $attribute, $value, Closure $fail) use ($record, $confirmInput) {
                    if ($value !== $record->$confirmInput) {
                        $fail(__('filament-action-confirmation::action-confirmation.Input content does not match'));
                    }
                })
                ->required(),
        ]);

        return $this;
    }

    public function confirmPassword(bool | Closure | null $confirmPassword = true): static
    {
        $this->confirmPassword = $confirmPassword;

        $this->form = array_merge($this->form ?? [], [
            TextInput::make('password')
                ->label(__('filament-action-confirmation::action-confirmation.This is a dangerous operation, identity verification is required'))
                ->password()
                ->revealable()
                ->required(),
        ]);

        return $this;
    }

    public function confirmFailureNotificationTitle(string | Closure | null $title): static
    {
        $this->confirmFailureNotificationTitle = $title;

        return $this;
    }

    public function confirmFailureNotification(Notification | Closure | null $notification): static
    {
        $this->confirmFailureNotification = $notification;

        return $this;
    }

    public function confirmFailure(): void
    {
        $this->sendConfirmFailureNotification();
        $this->halt();
    }

    public function getConfirmFailureNotificationTitle(): ?string
    {
        return $this->evaluate($this->confirmFailureNotificationTitle);
    }

    public function sendConfirmFailureNotification(): static
    {
        $notification = $this->evaluate($this->confirmFailureNotification, [
            'notification' => Notification::make()
                ->danger()
                ->title($this->getConfirmFailureNotificationTitle()),
        ]);

        if (filled($notification?->getTitle())) {
            $notification->send();
        }

        return $this;
    }
}
