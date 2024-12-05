<?php

declare(strict_types=1);

namespace App\Observers;

use App\Actions\RemoveFillingFromKebabAction;
use App\Models\Filling;

class FillingObserver
{
    public function __construct(
        protected RemoveFillingFromKebabAction $removeFillingFromKebabAction,
    )
    {
    }

    public function deleted(Filling $filling): void
    {
        $this->removeFillingFromKebabAction->execute($filling->id);
    }
}
