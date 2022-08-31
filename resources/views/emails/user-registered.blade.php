<h1>Olá, {{$user->name}}, tudo bem? Espero que sim!</h1>
<h3>Obrigado por sua inscrição</h3>

<p>
    Faça bom proveito e excelentes compras no nosso marketplace!<br>
    Seu endereço eletrónico de cadastro é: <strong>{{$user->email}}</strong><br>
    Sua senha: <strong>Por questões de segurança não enviamos a sua senha!</strong>
</p>
<hr>
Email enviado em {{date('d/m/Y H:i:s')}}
