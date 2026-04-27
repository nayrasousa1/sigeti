<?php

global $user;
require __DIR__ . '/vendor/autoload.php';

use App\Core\Email;
use App\Core\Session;
use App\Models\Category;
use App\Models\School;

new Session();

require __DIR__ . '/routes/web.php';

$template = file_get_contents(__DIR__ . "/app/Views/Email/forgot-password.php");

$messageHtml = str_replace([
    '{{NOME_USUARIO}}',
    '{{LINK_RESET}}',
    '{{EXPIRACAO_HORAS}}',
    '{{ANO}}',
], [
    "Pedro Leandro",
    url('/redefinir-senha/' . 1),
    '2',
    date('Y'),
], $template);

//try {
//
//    $email = new Email();
//
//    $email->bootstrap(
//        "Redefinição de Senha",
//        $messageHtml,
//        "elciof739@gmail.com",
//        "elcio"
//    );
//
//    $email->send();
//
//    echo "E-mail enviado com sucesso!";
//
//}catch (\InvalidArgumentException $exception){
//    var_dump($exception->getMessage());
//}