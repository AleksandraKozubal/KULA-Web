<?php

declare(strict_types=1);

namespace App\Observers;

use App\Actions\RemoveSauceFromKebabAction;
use App\Models\Sauce;

class SauceObserver
{
    public function __construct(
        protected RemoveSauceFromKebabAction $removeSauceFromKebabAction,
    )
    {
    }

    public function deleted(Sauce $sauce): void
    {
        $this->removeSauceFromKebabAction->execute($sauce->id);
    }
}