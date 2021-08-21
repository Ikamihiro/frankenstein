# Frankenstein Miniframework

### Requisitos
* **PHP 7.4+**
* **MySQL 8.0.26**
* **Composer 2.0.8**

### Preparando o ambiente

#### 1. **Clone o projeto**
```
git clone https://github.com/Ikamihiro/csc-one
```

#### 2. **Instale as dependências**
Navegue pelo terminal até a pasta do projeto e execute os comandos abaixos:
```
composer install && composer dumpautoload
```

#### 3. **Crie um banco de dados**
Crie um banco de dados com o **charset UTF-8** no MySQL com o nome de sua preferência.
Copie o arquivo ```.env.example``` com o nome ```.env``` e preencha as variáveis de ambiente conforme abaixo:
```
BASE_URL=http://127.0.0.1:3456

DB_TYPE=mysql
DB_HOST=127.0.0.1
DB_NAME=<nome-do-seu-novo-banco-de-dados>
DB_CHARSET=utf8
DB_COLLECTION=utf8_unicode_ci
DB_USER=<usuario-do-seu-banco>
DB_PASS=<senha-do-seu-usuario>
```

#### 4. **Criando as tabelas**
Após o passo anterior, crie as tabelas necessárias com os códigos SQL dentro da pasta ```sql/```. **Respeite a ordem dos códigos**.

### Executando o projeto
Navegue pelo terminal até a pasta ```public/``` e execute o comando abaixo:
```
php -S localhost:3456
```