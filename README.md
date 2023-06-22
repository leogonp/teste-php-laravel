# Teste AiSolutions
Esse projeto tem como objetivo testar a importação de um arquivo json no storage do laravel para um bando de dados Mysql via fila utilizando o redis.

## Estrutura do projeto
Essa é uma aplicação Laravel 10 e PHP 8.1.

## Como instalar?

Crie um arquivo `.env` a partir do `.env.example`.

Execute o seguinte commando:
- make docker-install

Para rodar as migrations e seeders, execute o seguinte comando (note que ele apagará todos os dados já presentes no banco):
- make docker-migrate

Caso seja necessário, dê as permissões necessárias à pasta `.docker-volumes`.

Acesse a url: `http://localhost:8080/documents` para visualizar a lista de documentos.

O botão `Importar Documentos` irá iniciar o processo de importação para a base.

