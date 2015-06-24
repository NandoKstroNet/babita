# Babita Framework 1

BF1 é um nano framework inspirado no Silex, Slim e Simple MVC Framework (Utiliza alguns componentes dos mesmos). Foi desenvolvido para atender algumas necessidades do SGAMA - Sistema de Gestão Acadêmica do Maranhão. BF1 é pequeno, rápido e lindo. O toolkit possibilita o desenolvimento de projetos flexiveis sem burocracia, você pode coloca-lo em seu projeto e começar a trabalhar imediatamente.

### Exemplos

```PHP
Router::get('/', function() {
  echo 'Bem vindo ao BF1 <3!';
});

Router::run();
```

BF1 também suporta lambda URIs:

```PHP
Router::get('/nome/(:any)', function($nome) {
  echo 'Meu nome é: ' . $nome;
});

Router::run();
```

Você também pode fazer requests de métodos HTTP:

```PHP
Router::get('/', function() {
  echo 'GET <3';
});

Router::post('/', function() {
  echo'POST <3';
});

Router::put('/', function() {
  echo 'PUT <3';
});

Router::delete('/', function() {
  echo'DELETE <3';
});
Router::run();
```

Se não houver uma rota definida para um determinado local, você pode executar um callback personalizado:

```PHP
Router::error(function() {
  echo '404 :: Página não encontrada';
});
```

Se você não especificar um callback de erro, o BF1 executa o controller padrão para este fim.