<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage as FacadesStorage;

class ExcluirCapaSerie implements ShouldQueue
{
    /*job que deleta a capa da serie*/
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $serie;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($serie)
    {
       $this->serie = $serie;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $serie = $this->serie;
        if ($serie->capa) {
            FacadesStorage::delete($serie->capa);
        }
    }
}
