# Case Técnico Feegow

## Requisitos para instalação / execução

* Docker
* Git
* NPM

## Passo a passo para executar a aplicação

1. Clonar este repositório git e entrar na pasta do projeto
    * ``git clone https://github.com/viniptds/feegow-challenge-covid.git && cd feegow-challenge-covid``
2. Instalar as dependências do PHP
    * ``docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php82-composer:latest \
    composer install --ignore-platform-reqs``
3. Copie o arquivo .env.example para .env e ajuste conforme necessário (banco de dados e senhas)
    * ``cp .env.example .env``
4. Crie uma chave para a aplicação
    * ``./vendor/bin/sail artisan key:generate``
5. Executar o docker-compose e aguardar a instalação das dependências
    * ``./vendor/bin/sail up -d``
6. Execute as migrations do banco de dados
    * ``./vendor/bin/sail artisan migrate``
7. Instalar as dependências do Node
    * ``npm install``
8. Inicie o frontend Vite
    * ``npm run dev``

A partir de agora você deverá conseguir acessar a aplicação através do endereço http://localhost

Para qualquer dúvida, entrar em contato via email: [vini.vptds@gmail.com](vini.vptds@gmail.com)