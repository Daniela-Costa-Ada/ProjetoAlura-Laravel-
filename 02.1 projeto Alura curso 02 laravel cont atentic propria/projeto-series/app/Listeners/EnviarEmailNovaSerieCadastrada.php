<?php
namespace App\Listeners;
use App\Events\NovaSerie;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
class EnviarEmailNovaSerieCadastrada implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    //listeners de envio de email, foi emitido o evento, registrado no provider e ouvido aqui de forma assincrona ShouldQueue
    /**
     * Handle the event.
     *
     * @param  NovaSerie  $event
     * @return void
     */
    public function handle(NovaSerie $event)
    { 
        $nome = $event->nomeSerie;
        $qtdTemporadas = $event->qtdTemporadas;
        $qtdEpisodios = $event->qtdEpisodios;
        $users = User::all();
    //dd($user); verifica o uuarios e algumas informações importantes
    foreach ($users as $indice => $user) {
        $multiplicador = $indice + 1;
        $email = new \App\Mail\NovaSerie($nome,
        $qtdTemporadas,
        $qtdEpisodios
        
    );
        $email->subject = 'Nova Serie Adicionada';  
        $quando = now()->addSecond($multiplicador * 5); 
        Mail::to($user)->later($quando, $email);
        //sleep(2);
    }
    }
}
