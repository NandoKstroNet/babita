<?php
namespace Controllers;

use Core\Controller;

class Welcome extends Controller
{

    public function index()
    {
print <<<EOT
	<!DOCTYPE html>
    <html>
        <head>
            <meta charset="utf-8"/>
            <title>Welcome &rsaquo; Babita Framework 1</title>
        </head>
        <body>
  			<p style="text-align: center;font-size: 2em;background-color: #838383;padding: 20px;color: #fff;border-radius: 10px;">Olá, bem vindo ao Babita Framework :)</p>
        </body>
    </html>
EOT;
        exit;
    }
}