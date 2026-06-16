# 🎮 GameIntel - Documentação Completa

GameIntel é uma loja virtual de jogos inspirada em plataformas como a Steam, desenvolvida em PHP com banco de dados PostgreSQL. O projeto oferece uma experiência completa de e-commerce com autenticação de usuários, sistema de carrinho de compras, gerenciamento de jogos e painel administrativo.

---

## 🚀 Funcionalidades

### Autenticação e Usuários
* ✅ Sistema de login seguro com sessions
* ✅ Cadastro de novos usuários com hash de senha (password_hash)
* ✅ Autenticação de acesso com verificação de permissões
* ✅ Sistema de logout
* ✅ Painel administrativo com controle de permissões

### Catálogo de Jogos
* ✅ Página inicial com listagem de jogos
* ✅ Exibição de jogos em cards com imagem, nome, gênero e preço
* ✅ Página individual de cada jogo com descrição e requisitos do sistema
* ✅ Sistema de avaliação com estrelas (0-5)
* ✅ Filtros por gênero (Ação, Esporte, Exploração, FPS, LEGO, Roguelike, RPG, Simulator, Terror)
* ✅ Múltiplas categorias de jogos

### Carrinho de Compras
* ✅ Carrinho persistente usando localStorage
* ✅ Adicionar e remover itens do carrinho
* ✅ Cálculo automático de total
* ✅ Sistema de checkout com registro de pedidos no banco de dados
* ✅ Visualização de histórico de compras

### Painel Administrativo
* ✅ Dashboard com estatísticas (total de usuários, admins e jogos)
* ✅ Gerenciamento de usuários (promover/rebaixar admin, excluir usuário)
* ✅ Adicionar novos jogos ao catálogo
* ✅ Editar informações de jogos (nome, preço, gênero, descrição, requisitos)
* ✅ Excluir jogos do catálogo
* ✅ Listagem completa de usuários e jogos

### Interface
* ✅ Design responsivo e moderno
* ✅ Navbar com logo, carrinho e informações do usuário
* ✅ Interface amigável com feedback visual (mensagens de sucesso/erro)
* ✅ CSS moderno com efeitos visuais

---

## 🛠️ Tecnologias Utilizadas

* **Backend**: PHP 8.5.6
* **Banco de Dados**: PostgreSQL
* **Frontend**: HTML5, CSS3, JavaScript (localStorage)
* **Segurança**: password_hash, prepared statements (pg_query_params)
* **Sessions**: PHP Sessions para autenticação

---

## 📂 Estrutura do Projeto

```
ProjetoFinalPHP/
├── index.php                     # Redirecionador para public/index.php
├── .gitignore                    # Arquivos a ignorar no Git
├── README.md                     # Documentação completa (este arquivo)
│
├── admin/
│   └── admin.php                 # Painel administrativo
├── database/
│   └── backup.sql               # Backup do banco de dados
├── includes/
│   ├── auth_check.php           # Verificação de autenticação
│   └── conexao.php              # Configuração de conexão com BD
├── pages/
│   ├── home.php                 # Página principal (loja)
│   ├── carrinho.php             # Carrinho de compras
│   ├── logout.php               # Logout
│   └── jogo/
│       ├── jogo.php             # Página de detalhes do jogo
│       ├── adicionar_jogo.php   # Adicionar novo jogo (admin)
│       └── excluir_jogos.php    # Excluir jogo (admin)
└── public/
    ├── index.php                # Página de login (entrada)
    ├── cadastro.php             # Página de cadastro
    ├── .htaccess                # Configurações de segurança
    ├── css/
    │   └── style.css            # Estilos globais
    └── img/
        └── logo.png             # Logo da aplicação
```

---

## 🏁 Como Usar

### 1️⃣ Iniciar o Servidor

```bash
php -S localhost:8000
```

### 2️⃣ Acessar a Aplicação

Abra no navegador:
```
http://localhost:8000/
```

O redirecionador automático leva você para:
```
http://localhost:8000/public/index.php
```

### 3️⃣ Primeiro Acesso

- **Login**: Use credenciais existentes no banco (ou crie uma conta)
- **Cadastro**: Clique em "Cadastre-se aqui" para novo usuário
- **Admin**: Usuários admin têm acesso a "Painel Admin"

---

## 🗄️ Banco de Dados

### Estrutura PostgreSQL

O projeto utiliza as seguintes tabelas:

**`usuarios`** - Dados de usuários
- `id` (serial, PK)
- `nome` (varchar, UNIQUE)
- `senha` (varchar - hash)
- `is_admin` (boolean)

**`jogos`** - Catálogo de jogos
- `id` (serial, PK)
- `nome` (varchar)
- `preco` (numeric)
- `genero` (varchar)
- `descricao` (text)
- `requisitos` (text)
- `imagem` (varchar)
- `avaliacao` (numeric)

**`pedidos`** - Histórico de compras
- `id` (serial, PK)
- `usuario_id` (int, FK)
- `jogo_id` (int, FK)
- `quantidade` (int)
- `preco_unitario` (numeric)
- `data_pedido` (timestamp)

**Credenciais padrão** (em `backup.sql`):
- Host: `localhost:5432`
- Database: `gameintel`
- User: `postgres`
- Password: `postgres`

⚠️ **IMPORTANTE**: Alterar credenciais em produção!

---

## 🔐 Segurança

### Implementações de Segurança

- **Autenticação**: Sessions PHP com validação em `includes/auth_check.php`
- **Hash de Senhas**: `password_hash()` com algoritmo padrão (PASSWORD_DEFAULT)
- **SQL Injection**: `pg_query_params()` com prepared statements
- **XSS Protection**: `htmlspecialchars()` em todas as saídas
- **Directory Access**: `.htaccess` bloqueia acesso direto a arquivos PHP em `public/`
- **File Permissions**: Arquivos separados por responsabilidade

### Fluxo de Autorização

1. **Login** (`public/index.php`)
   - Valida credenciais
   - Cria sessão com `usuario_id`, `usuario_nome`, `is_admin`

2. **Páginas Protegidas**
   - Incluem `includes/auth_check.php`
   - Redirecionam para login se não autenticado

3. **Painel Admin**
   - Incluem `requireAdmin()` de `auth_check.php`
   - Redirecionam para home se não admin

---

## 🌐 Mapa de Navegação Detalhado

### 🏠 Ponto de Entrada

**`index.php`** (raiz)
- Redireciona para: `public/index.php`

**`public/index.php`** - Login
- Campo: usuário e senha
- Botão: "Entrar" → POST → valida e redireciona para `pages/home.php`
- Link: "Cadastre-se aqui" → `public/cadastro.php`

**`public/cadastro.php`** - Cadastro
- Campos: nome, senha, confirmar senha
- Botão: "Cadastrar" → POST → insere no BD e redireciona para `index.php`
- Link: "Entre aqui" → `index.php`

---

### 🛍️ Páginas Principais

**`pages/home.php`** - Loja de Jogos
- Include: `../includes/auth_check.php`, `../includes/conexao.php`
- Conteúdo:
  - Navbar com:
    - Logo "🎮 GameIntel"
    - 🛒 Carrinho → `carrinho.php`
    - ➕ Adicionar Jogo (admin) → `jogo/adicionar_jogo.php`
    - ⚙️ Painel Admin (admin) → `../admin/admin.php`
    - 👤 Nome do usuário
    - Sair → `logout.php`
  - Banner com mensagem de boas-vindas
  - Filtro por gênero
  - Grid de jogos com:
    - Imagem
    - Nome
    - Gênero
    - Preço
    - Botão "Ver mais" → `jogo/jogo.php?id={id}`
    - Botão "Adicionar ao carrinho" → localStorage
    - (Admin) Botões: Editar, Excluir

**`pages/carrinho.php`** - Carrinho de Compras
- Include: `../includes/auth_check.php`, `../includes/conexao.php`
- Conteúdo:
  - Navbar com:
    - ← Voltar à Loja → `home.php`
    - 👤 Nome do usuário
    - Sair → `logout.php`
  - Lista de itens no carrinho (localStorage):
    - Imagem/Nome do jogo
    - Preço unitário × Quantidade
    - Botões: −, quantidade, +, 🗑 remover
  - Resumo:
    - Total
    - Botão "✅ Finalizar Compra" → POST → insere em pedidos → limpa localStorage
    - Botão "🗑 Limpar Carrinho"

**`pages/logout.php`** - Logout
- Destroi sessão
- Redireciona para: `../public/index.php`

---

### 🎯 Páginas de Jogos (em `pages/jogo/`)

**`pages/jogo/jogo.php`** - Detalhes do Jogo
- URL: `?id={id}`
- Include: `../../includes/auth_check.php`, `../../includes/conexao.php`
- Conteúdo:
  - Navbar:
    - ← Voltar à Loja → `../home.php`
    - ➕ Adicionar Jogo (admin) → `adicionar_jogo.php`
    - ⚙️ Painel Admin (admin) → `../../admin/admin.php`
    - 👤 Nome do usuário
    - Sair → `../logout.php`
  - Hero section:
    - Cover do jogo
    - Gênero
    - Título
    - Avaliação com estrelas
    - Preço
    - Botão "🛒 Comprar Agora" → localStorage
    - (Admin) Botão "🗑 Excluir Jogo" → `excluir_jogos.php?id={id}`
  - Descrição completa
  - Requisitos do sistema

**`pages/jogo/adicionar_jogo.php`** - Adicionar Jogo (Admin Only)
- Include: `../../includes/auth_check.php`, `requireAdmin()`, `../../includes/conexao.php`
- Formulário POST:
  - Nome do Jogo
  - Preço
  - Gênero
  - Descrição
  - Requisitos
  - Imagem (URL)
  - Botão: "Adicionar Jogo" → insere em BD → redireciona para `../home.php`
  - Link: "← Voltar para a loja" → `../home.php`

**`pages/jogo/excluir_jogos.php`** - Excluir Jogo (Admin Only)
- URL: `?id={id}`
- Include: `../../includes/conexao.php`
- Ação: DELETE jogo onde id = {id}
- Redireciona: `../home.php`

---

### ⚙️ Painel Administrativo

**`admin/admin.php`** - Dashboard Admin
- Include: `../includes/auth_check.php`, `requireAdmin()`, `../includes/conexao.php`
- Navbar:
  - ← Voltar à Loja → `../pages/home.php`
  - ⚙️ Admin: {nome}
  - Sair → `../pages/logout.php`
- Cards de Estatísticas:
  - Total de Usuários
  - Total de Admins
  - Total de Jogos
  - Botão: "➕ Novo Jogo" → `../pages/jogo/adicionar_jogo.php`
- Tabela de Usuários:
  - ID, Nome, Perfil (Admin/Usuário)
  - Ações:
    - Promover → POST `promover`
    - Rebaixar → POST `rebaixar` (não aplica a si mesmo)
    - Excluir → POST `excluir_usuario` com confirmação (não aplica a si mesmo)
- Tabela de Jogos:
  - ID, Nome, Gênero, Preço
  - Ação: Excluir → `../pages/jogo/excluir_jogos.php?id={id}` com confirmação

---

### 🔧 Arquivos de Configuração

**`includes/conexao.php`** - Conexão com Banco
```php
// Conecta ao PostgreSQL
$conn = pg_connect("
    host=localhost
    port=5432
    dbname=gameintel
    user=postgres
    password=postgres
");
```

**`includes/auth_check.php`** - Autenticação
```php
// Valida sessão
if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../public/index.php");
    exit();
}

// Função para validar admin
function requireAdmin() {
    if (empty($_SESSION['is_admin'])) {
        header("Location: ../pages/home.php");
        exit();
    }
}
```

---

## 📋 Resumo de Fluxo

```
1. Usuário acessa http://localhost:8000/
   ↓
2. index.php redireciona para public/index.php
   ↓
3. Login com credenciais
   ↓
4. Cria sessão e redireciona para pages/home.php
   ↓
5. Exibe catálogo de jogos
   ├─ Clica em jogo → pages/jogo/jogo.php
   ├─ Adiciona ao carrinho → localStorage
   ├─ Vai para pages/carrinho.php
   ├─ Finaliza compra → POST → BD (pedidos)
   │
   └─ (Se Admin)
      ├─ Acessa admin/admin.php
      ├─ Gerencia usuários e jogos
      └─ Adiciona novos jogos via pages/jogo/adicionar_jogo.php
```

---

## ✅ Checklist de Verificação

- [x] Todos os includes usam caminhos relativos (`../`)
- [x] Redirecionamentos apontam para URLs corretas
- [x] CSS em `public/css/style.css`
- [x] Imagens em `public/img/`
- [x] Banco de dados em `database/backup.sql`
- [x] Autenticação em `includes/auth_check.php`
- [x] Conexão em `includes/conexao.php`
- [x] Admin protegido com `requireAdmin()`
- [x] Proteção contra SQL injection com `pg_query_params`
- [x] Proteção contra XSS com `htmlspecialchars`

---

## 🎯 Próximas Melhorias (Opcional)

- [ ] Implementar arquivo `.env` para credenciais
- [ ] Adicionar autoloader PSR-4 com Composer
- [ ] Implementar validações mais robustas em formulários
- [ ] Adicionar sistema de notificações por email
- [ ] Implementar paginação em listagens
- [ ] Adicionar sistema de reviews/comentários
- [ ] Implementar filtros de preço e busca
- [ ] Adicionar recuperação de senha

---

## 📞 Suporte

Para dúvidas ou problemas, revise:
1. Credenciais do banco de dados em `includes/conexao.php`
2. Permissões de pasta (public deve ter permissão de escrita)
3. Versão do PHP (recomendado 8.0+)
4. Extensão PostgreSQL habilitada no PHP

---

© 2026 GameIntel - Todos os direitos reservados.