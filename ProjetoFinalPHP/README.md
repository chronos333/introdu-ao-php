
# 🎮 GameIntel

Plataforma web de jogos para PC feita em PHP com banco de dados PostgreSQL.
Permite cadastro e login de usuários, listagem de jogos em destaque e um painel administrativo completo.

---

# 📋 Requisitos

* PHP 8.0 ou superior (com extensão `pgsql` ativa)
* PostgreSQL 13 ou superior
* Servidor web (Apache, Nginx) ou servidor embutido do PHP

---

# 🗄️ Configuração do Banco de Dados

## 1. Criar banco e tabelas

```sql
CREATE DATABASE gameintel;

CREATE TABLE usuarios (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(100) UNIQUE NOT NULL,
    senha TEXT NOT NULL,
    is_admin BOOLEAN DEFAULT FALSE
);

CREATE TABLE jogos (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(150) NOT NULL,
    preco NUMERIC(10,2) NOT NULL,
    genero VARCHAR(80),
    imagem TEXT
);
```

---

## 2. Caso o banco já exista

```sql
ALTER TABLE usuarios ADD COLUMN IF NOT EXISTS is_admin BOOLEAN DEFAULT FALSE;
```

---

## 3. Definir primeiro administrador

```sql
UPDATE usuarios SET is_admin = TRUE WHERE nome = 'seu_usuario';
```

---

# ⚙️ Configuração da Conexão

Edite o arquivo `conexao.php`:

```php
$conn = pg_connect("
    host=localhost
    port=5432
    dbname=gameintel
    user=postgres
    password=postgres
");
```

---

# 🚀 Como Rodar o Projeto

## Usando servidor local (Apache/XAMPP/WAMP)

Coloque a pasta do projeto em:

```
htdocs / www / public_html
```

Acesse:

```
http://localhost/gameintel/
```

---

## Usando servidor embutido do PHP

```bash
php -S localhost:8000
```

Depois acesse:

```
http://localhost:8000
```

---

# 📁 Estrutura de Arquivos

```
gameintel/
├── index.php              # Login
├── cadastro.php           # Cadastro de usuários
├── home.php               # Loja (listagem de jogos)
├── adicionar_jogo.php     # Adicionar jogo (admin)
├── excluir_jogo.php       # Excluir jogo (admin)
├── admin.php              # Painel administrativo
├── auth_check.php         # Controle de sessão
├── logout.php             # Encerrar sessão
├── conexao.php            # Conexão PostgreSQL
├── setup_admin.sql        # Script inicial
├── css/
│   └── style.css
└── img/
    └── logo.png
```

---

# 🔐 Sistema de Autenticação

* Senhas armazenadas com `password_hash()` (bcrypt)
* Sessões PHP controlam login
* Páginas protegidas redirecionam para login se não autenticado
* Rotas admin bloqueadas para usuários sem permissão

---

# 👑 Painel Administrativo (`admin.php`)

Apenas usuários com `is_admin = TRUE` podem acessar.

## Funcionalidades:

* Visualização de estatísticas (usuários, admins, jogos)
* Promover usuários a admin
* Rebaixar administradores (exceto o próprio usuário)
* Excluir usuários
* Excluir jogos diretamente

---

# 🌐 Rotas do Sistema

| Rota                 | Acesso  | Descrição       |
| -------------------- | ------- | --------------- |
| `index.php`          | Público | Login           |
| `cadastro.php`       | Público | Criar conta     |
| `home.php`           | Logado  | Loja de jogos   |
| `adicionar_jogo.php` | Admin   | Adicionar jogos |
| `excluir_jogo.php`   | Admin   | Excluir jogos   |
| `admin.php`          | Admin   | Painel admin    |
| `logout.php`         | Logado  | Logout          |

---

# 🛠️ Tecnologias Utilizadas

* PHP (Back-end)
* PostgreSQL (Banco de dados)
* HTML5 / CSS3 (Interface)
* JavaScript (Interações simples)
* SQL (Estrutura do banco)

---

# 📌 Observações

* O campo **imagem** aceita URL externa.
* Se vazio, pode ser usado um placeholder automático.
* O sistema impede que um admin remova a própria conta.
* Recomenda-se uso de `.env` em produção para segurança das credenciais.
* Sempre valide permissões antes de executar ações administrativas.

---

# 🚀 Melhorias Futuras (Sugestões)

* Upload de imagem (em vez de URL)
* Carrinho de compras
* Sistema de avaliações
* Busca e filtros de jogos
* API REST para integração
* Dashboard com gráficos

---
