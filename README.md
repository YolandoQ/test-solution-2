# Sistema de gerenciamento de clientes
## Contexto
Implementar em laravel uma API para integrar um frontend Vue de carrinho de compras.

## Funcionalidades
- Listar produtos, adicionar produtos no carrinho, realizar ordem de compra.

## Tecnologias

- Laravel - Laravel é um framework PHP de aplicações web com sintaxe expressiva e elegante.
- VueJS - A Estrutura JavaScript Progressiva uma estrutura acessível, de alto desempenho e versátil para a construção de interfaces.
- PostgreSQL - Um sistema open-source de gerenciamento de base de dados relacional.
- Docker(Com Apache, Nginx e NodeJS) - O Docker permite que você separe seus aplicativos de sua infraestrutura para que você possa entregar software rapidamente.

## Instalação

##### Requisito obrigátorio
Antes de tudo você precisa ter o docker e o docker-compose e também o git.
Caso não tenha instalado, aqui alguns links de referência:
- Aqui encontra os passos para instalação do Docker => https://docs.docker.com/get-docker/ 
- Aqui encontra os passos para instalação do Docker Compose => https://docs.docker.com/compose/ 
- Aqui encontra os passos para instalação do git => https://git-scm.com/book/en/v2/Getting-Started-Installing-Git

##### Clone o projeto
Com o git instalado e em um diretório da sua escolha, baixe o projeto:

```sh
git clone https://github.com/YolandoQ/test-solution-2.git
```

##### Suba o serviço
###### Primeiro verifique se a pasta "postgres-data" está criada na raiz do projeto, ela vai servir para persistência dos dados do PostgreSQL.

Em seguida, com o Docker-compose instalado, execute esse comando na raiz do projeto:

```sh
docker-compose up -d
```

##### Acesse o container
Com o container rodando, execute esse comando na raiz do projeto:

```sh
docker exec -it laravel bash
```
##### Configure o .env
Se não tiver alterado nada, o .env ja vai estar configurado depois de rodar seguintes comandos:

```sh
cp .env.example .env
```
(Importante verificar no .env se existe essa informação que é necessária para a camada de autenticação => APP_HASH_AUTH="MASTERDAWEB")

```sh
php artisan key:generate
```

##### Instale as dependências
Agora você pode executar:

```sh
composer install
```

##### Dê permissões as pastas necessárias
São elas storage/logs e storage/framework, como estamos num ambiente de testes vamos dar todas as permissões, apenas execute:

```sh
chmod -R 777 storage/logs storage/framework
```

##### Pra finalizar vamos rodar as migrations e a seeder
Caso não tenha alterado credenciais nos arquivo do docker basta rodar os comandos de sempre:

```sh
php artisan migrate
```

```sh
php artisan db:seed --class=ProductsTableSeeder
```

Pronto, agora é só partir pro abraço, acesse o projeto na porta configurada(localhost:9001 se nada tiver sido alterado nos arquivos de configuração do docker).
