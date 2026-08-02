<?php

namespace App\Console\Commands;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
class CreateAdmin extends Command {
 protected $signature='admin:create {--name=} {--email=} {--password=}'; protected $description='Cria ou atualiza um administrador';
 public function handle():int{$name=$this->option('name')?:$this->ask('Nome','Administrador Casale');$email=$this->option('email')?:$this->ask('E-mail');$password=$this->option('password')?:$this->secret('Senha (mínimo 8 caracteres)');if(!filter_var($email,FILTER_VALIDATE_EMAIL)||strlen((string)$password)<8){$this->error('Informe e-mail válido e senha com pelo menos 8 caracteres.');return self::FAILURE;}User::updateOrCreate(['email'=>$email],['name'=>$name,'password'=>Hash::make($password)]);$this->info('Administrador pronto para acessar /admin.');return self::SUCCESS;}
}
