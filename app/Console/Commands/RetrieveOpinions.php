<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Actions\RetrieveOpinionAction;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Console\Command;

class RetrieveOpinions extends Command
{
    protected $signature = "retrieve:kebab-opinions";
    protected $description = "Retrieve opinions for kebab places";

    public function __construct(
        protected RetrieveOpinionAction $action,
    ) {
        parent::__construct();
    }

    /**
     * @throws GuzzleException
     */
    public function handle(): void
    {
        $this->action->execute();
    }
}
