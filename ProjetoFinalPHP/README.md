🎮 GameIntel
Plataforma web de jogos para PC feita em PHP com banco de dados PostgreSQL. Permite cadastro e login de usuários, listagem de jogos em destaque e um painel administrativo completo.

📋 Requisitos
PHP 8.0 ou superior (com extensão pgsql ativa)
PostgreSQL 13 ou superior
Servidor web (Apache ou Nginx) — ou php -S para desenvolvimento
🗄️ Configuração do Banco de Dados
1. Crie o banco e as tabelas:

sql
CREATE DATABASE gameintel;

CREATE TABLE usuarios (
    id       SERIAL PRIMARY KEY,
    nome     VARCHAR(100) UNIQUE NOT NULL,
    senha    TEXT NOT NULL,
    is_admin BOOLEAN DEFAULT FALSE
);

CREATE TABLE jogos (
    id      SERIAL PRIMARY KEY,
    nome    VARCHAR(150) NOT NULL,
    preco   NUMERIC(10,2) NOT NULL,
    genero  VARCHAR(80),
    imagem  TEXT
);
2. Se o banco já existia (antes do sistema admin), rode apenas:

sql
ALTER TABLE usuarios ADD COLUMN IF NOT EXISTS is_admin BOOLEAN DEFAULT FALSE;
3. Defina o seu primeiro administrador:

sql
UPDATE usuarios SET is_admin = TRUE WHERE nome = 'seu_usuario';
⚙️ Configuração da Conexão
Edite o arquivo conexao.php com as credenciais do seu banco:

php
$conn = pg_connect("
    host=localhost
    port=5432
    dbname=gameintel
    user=postgres
    password=postgres
");
🚀 Como Rodar
Clone ou extraia os arquivos na pasta do seu servidor (ex: htdocs, www ou public_html) e acesse via navegador:

http://localhost/gameintel/
Para rodar com o servidor embutido do PHP:

bash
php -S localhost:8000
📁 Estrutura de Arquivos
gameintel/
├── index.php           # Tela de login
├── cadastro.php        # Cadastro de novos usuários
├── home.php            # Loja — listagem de jogos
├── adicionar_jogo.php  # Formulário para adicionar jogo (admin)
├── excluir_jogos.php   # Rota para excluir jogo (admin)
├── admin.php           # Painel administrativo
├── auth_check.php      # Helper de sessão e proteção de rotas
├── logout.php          # Encerra a sessão
├── conexao.php         # Conexão com o PostgreSQL
├── setup_admin.sql     # Script SQL de configuração
├── css/
│   └── style.css       # Estilos globais
└── img/
    └── logo.png        # Logo da plataforma
🔐 Sistema de Autenticação
Senhas armazenadas com password_hash() (bcrypt)
Sessões PHP controlam o estado do login
Qualquer página protegida redireciona para index.php se não houver sessão ativa
Rotas exclusivas de admin redirecionam para home.php se o usuário não tiver permissão
👑 Painel Administrativo (admin.php)
Acessível apenas para usuários com is_admin = TRUE. Funcionalidades:

Resumo com total de usuários, admins e jogos cadastrados
Promover usuário comum a administrador
Rebaixar administrador (não é possível rebaixar a si mesmo)
Excluir usuários (não é possível excluir a própria conta)
Excluir jogos diretamente pela tabela
🌐 Páginas
Rota	Acesso	Descrição
index.php	Público	Login
cadastro.php	Público	Criar conta
home.php	Logado	Loja de jogos
adicionar_jogo.php	Admin	Cadastrar novo jogo
excluir_jogos.php	Admin	Excluir jogo (via GET)
admin.php	Admin	Painel de administração
logout.php	Logado	Encerrar sessão
🛠️ Tecnologias
PHP — back-end e renderização server-side
PostgreSQL — banco de dados relacional
HTML5 / CSS3 — interface responsiva com tema escuro
Vanilla JS — confirmações de exclusão via confirm()
📌 Observações
O campo Imagem nos jogos aceita qualquer URL pública. Se deixado em branco, exibe um placeholder automático.
Não é possível ter zero administradores: o sistema impede que um admin remova a si mesmo.
Para ambientes de produção, recomenda-se mover as credenciais do banco para variáveis de ambiente ou um arquivo .env fora da raiz pública.
