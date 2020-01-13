@component('mail::message')
Sr(a) usuário, não se esqueça de confirmar sua presença na reunião de Segunda-Feira! 

Clique no botão para confirmar agora

@component('mail::button', ['url' => $link])
Entrar
@endcomponent

Atenciosamente,  
Equipe CodeWise.
@endcomponent