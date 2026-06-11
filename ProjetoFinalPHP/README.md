# 🎮 GameIntel

GameIntel é uma loja virtual de jogos inspirada em plataformas como a Steam, desenvolvida em PHP com banco de dados PostgreSQL. O projeto oferece uma experiência completa de e-commerce com autenticação de usuários, sistema de carrinho de compras, gerenciamento de jogos e painel administrativo.

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

## 🛠️ Tecnologias Utilizadas

* **Backend**: PHP 8.5.6
* **Banco de Dados**: PostgreSQL
* **Frontend**: HTML5, CSS3, JavaScript (localStorage)
* **Segurança**: password_hash, prepared statements (pg_query_params)
* **Sessions**: PHP Sessions para autenticação

## 📂 Estrutura do Projeto

```text
ProjetoFinalPHP/
│
├── index.php                 # Página de login
├── cadastro.php             # Página de cadastro de usuários
├── home.php                 # Página inicial com catálogo de jogos
├── jogo.php                 # Página de detalhes de um jogo
├── carrinho.php             # Página do carrinho de compras
├── admin.php                # Painel administrativo
├── adicionar_jogo.php       # Formulário para adicionar novo jogo
├── excluir_jogos.php        # Funcionalidade de excluir jogo
├── logout.php               # Funcionalidade de logout
├── auth_check.php           # Verificação de autenticação
├── conexao.php              # Configuração da conexão PostgreSQL
│
├── css/
│   └── style.css            # Estilos da aplicação
│
├── img/                     # Imagens dos jogos e logo
│   └── ...
│
└── README.md               # Este arquivo
```

## 🗄️ Banco de Dados

### Estrutura PostgreSQL

O projeto utiliza as seguintes tabelas:

- **usuarios**: Armazena dados de usuários (id, nome, senha, is_admin)
- **jogos**: Catálogo de jogos (id, nome, preco, genero, descricao, imagem, requisitos)
- **pedidos**: Histórico de compras (id, usuario_id, jogo_id, quantidade, preco_unitario, data_pedido)


## 🔐 Autenticação

- Novo usuário deve se cadastrar através de "Cadastre-se aqui"
- O sistema utiliza `password_hash` para armazenar senhas de forma segura
- Admins podem ser promovidos através do painel administrativo
- Acesso a áreas administrativas é restrito apenas a usuários com permissão

## 🎮 Uso da Aplicação

### Como Usuário Normal
1. Faça cadastro ou login
2. Navegue pelo catálogo de jogos
3. Filtre por gênero se desejar
4. Clique em "Ver mais" para detalhes do jogo
5. Adicione jogos ao carrinho
6. Finalize a compra no carrinho

### Como Administrador
1. Acesse "admin.php" (apenas admins têm acesso)
2. Visualize estatísticas do sistema
3. Gerencie usuários (promover, rebaixar, excluir)
4. Adicione novos jogos
5. Edite informações de jogos existentes
6. Exclua jogos do catálogo

## 📊 Gêneros de Jogos Disponíveis

- Ação
- Esporte
- Exploração
- FPS (First Person Shooter)
- LEGO
- Roguelike
- RPG
- Simulator
- Terror

## 📝 Exemplo de Dados

O catálogo inclui jogos como:
- Red Dead Redemption 2
- The Last of Us
- Hades
- God of War Ragnarök
- Outlast
- LEGO Batman
- UFC 5
- FIFA 26
- E mais...

## 🎯 Objetivo do Projeto

Este projeto foi desenvolvido com fins educacionais para demonstrar e aprimorar conhecimentos em:
- Desenvolvimento web com PHP
- Integração com banco de dados PostgreSQL
- Segurança em aplicações web (autenticação, hash de senhas)
- Arquitetura MVC básica
- Manipulação de formulários
- Sessions e autenticação
- Design responsivo
- JavaScript com localStorage

## 🚀 Futuras Melhorias

* [ ] Sistema de avaliações de usuários
* [ ] Pesquisa avançada de jogos
* [ ] Integração com gateway de pagamento real
* [ ] Biblioteca de jogos do usuário
* [ ] Sistema de wishlist
* [ ] Recomendações personalizadas
* [ ] Upload de imagens via formulário
* [ ] Notificações por email
* [ ] Dashboard com gráficos e relatórios
* [ ] API RESTful para integração externa

## 👨‍💻 Desenvolvimento

Desenvolvido como projeto final para aplicação de conceitos de programação em PHP e desenvolvimento web.

---

© 2026 GameIntel - Todos os direitos reservados.
