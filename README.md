# Casale Saúde Integrada — Laravel 12

Site institucional e painel administrativo em Laravel 12, Blade, Tailwind CSS e JavaScript puro.

## Requisitos

- PHP 8.2 ou superior com SQLite, Mbstring, OpenSSL, Fileinfo e PDO;
- Composer 2;
- Node.js 20+ e npm.

## Instalação

```bash
composer install
copy .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan storage:link
npm install
npm run build
php artisan serve
```

Crie o primeiro administrador sem deixar senha no código:

```bash
php artisan admin:create
```

O site abre em `/` e o painel em `/admin`. O banco padrão é SQLite. Em produção, configure `APP_URL`, banco, HTTPS e cache, aponte o servidor para a pasta `public` e execute `php artisan optimize`.

## Conteúdo administrável

- tratamentos, benefícios, visibilidade e ordenação;
- profissionais, biografia, especialidades, foto, visibilidade e ordenação;
- redes sociais, URL, visibilidade e ordenação.

Os dados institucionais iniciais ficam em `database/seeders/DatabaseSeeder.php`. Registros profissionais desconhecidos permanecem vazios, sem credenciais inventadas.
