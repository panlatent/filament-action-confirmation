<?php

namespace Panlatent\Filament\ActionConfirmation\Tables\Actions;

use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Hash;
use Panlatent\Filament\ActionConfirmation\Actions\Concerns\Confirmation;

class DeleteAction extends \Filament\Tables\Actions\DeleteAction
{
    use Confirmation;

    protected function setUp(): void
    {
        parent::setUp();

        $this->confirmFailureNotificationTitle(__('Validate Failed'));

        $this->confirmFailureNotification(fn (Notification $notification): Notification => $notification);

        $fn = $this->getActionFunction();

        $this->action(function ($record, array $data) use ($fn): void {
            if ($this->confirmPassword) {
                if (! Hash::check($data['password'], auth()->user()->password)) {
                    $this->confirmFailure();
                }
            }

            $this->evaluate($fn);
        });
    }
}
