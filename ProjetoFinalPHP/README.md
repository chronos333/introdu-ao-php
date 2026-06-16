# 🎮 GameIntel

**Documentação de Especificação de Requisitos de Software (SRS)**
Documento baseado na **ISO/IEC/IEEE 29148:2018**

**Projeto:** GameIntel
**Versão:** 1.0.0
**Data:** 2026-06-16

---

# 1. Introdução

## 1.1 Propósito

Este documento descreve o sistema **GameIntel**, uma plataforma de comércio eletrônico para venda de jogos digitais inspirada em marketplaces como Steam.

Objetivos:

* Definir os requisitos do sistema
* Padronizar o entendimento entre desenvolvedores e usuários
* Servir como base para implementação, manutenção e testes

---

## 1.2 Escopo

O sistema permite:

* Cadastro de usuários
* Autenticação de usuários
* Visualização de catálogo de jogos
* Consulta de detalhes dos jogos
* Adição de produtos ao carrinho
* Finalização de compras
* Histórico de pedidos
* Administração de usuários
* Administração de jogos

Tecnologias utilizadas:

* PHP 8+
* PostgreSQL
* HTML5
* CSS3
* JavaScript
* LocalStorage

---

## 1.3 Definições

| Termo         | Definição                              |
| ------------- | -------------------------------------- |
| Usuário       | Cliente cadastrado na plataforma       |
| Administrador | Usuário com permissões avançadas       |
| Jogo          | Produto comercializado no sistema      |
| Pedido        | Registro de compra efetuada            |
| Carrinho      | Lista temporária de jogos selecionados |

### Acrônimos

* RF — Requisito Funcional
* RNF — Requisito Não Funcional
* RN — Regra de Negócio

---

# 2. Descrição Geral

## 2.1 Perspectiva do Sistema

O GameIntel funciona como uma loja virtual de jogos digitais, permitindo gerenciamento completo do catálogo, usuários e compras.

---

## 2.2 Funções do Sistema

O sistema deve:

* Cadastrar usuários
* Autenticar usuários
* Exibir catálogo de jogos
* Exibir detalhes dos jogos
* Permitir compras
* Registrar pedidos
* Gerenciar usuários
* Gerenciar jogos

---

## 2.3 Classes de Usuários

| Perfil        | Descrição                 |
| ------------- | ------------------------- |
| Usuário       | Compra e visualiza jogos  |
| Administrador | Gerencia jogos e usuários |

---

## 2.4 Ambiente Operacional

* Navegador Web moderno
* PHP 8+
* PostgreSQL 13+
* Apache ou Servidor PHP embutido

---

## 2.5 Restrições

* Sem integração com gateways de pagamento
* Sem envio de e-mails
* Sem aplicativo mobile
* Sem upload de arquivos

---

# 3. Requisitos Funcionais

## RF-001 — Cadastro de Usuário

Descrição: Permitir cadastro de novos usuários.

Critérios:

* Nome obrigatório
* Senha obrigatória
* Nome único

---

## RF-002 — Login

Descrição: Permitir autenticação.

Critérios:

* Validar credenciais
* Criar sessão
* Redirecionar usuário autenticado

---

## RF-003 — Logout

Descrição: Encerrar sessão do usuário.

---

## RF-004 — Catálogo de Jogos

Descrição: Exibir jogos disponíveis.

Critérios:

* Mostrar imagem
* Mostrar preço
* Mostrar gênero
* Mostrar avaliação

---

## RF-005 — Detalhes do Jogo

Descrição: Exibir informações completas do jogo.

Critérios:

* Descrição
* Requisitos do sistema
* Avaliação
* Preço

---

## RF-006 — Carrinho de Compras

Descrição: Permitir gerenciamento do carrinho.

Critérios:

* Adicionar item
* Remover item
* Alterar quantidade
* Calcular total

---

## RF-007 — Finalização de Compra

Descrição: Registrar pedidos.

Critérios:

* Salvar pedido no banco
* Registrar data da compra
* Limpar carrinho após compra

---

## RF-008 — Histórico de Compras

Descrição: Exibir pedidos realizados.

---

## RF-009 — Gerenciamento de Jogos

Descrição: Administrador pode:

* Adicionar jogos
* Editar jogos
* Excluir jogos

---

## RF-010 — Gerenciamento de Usuários

Descrição: Administrador pode:

* Listar usuários
* Promover usuários para administrador
* Rebaixar administradores
* Excluir usuários

---

## RF-011 — Dashboard Administrativo

Descrição: Exibir estatísticas do sistema.

Critérios:

* Total de usuários
* Total de administradores
* Total de jogos

---

# 4. Requisitos Não Funcionais

## RNF-001 — Segurança

As senhas devem ser armazenadas utilizando:

```php
password_hash()
```

---

## RNF-002 — Proteção Contra SQL Injection

Utilizar:

```php
pg_query_params()
```

---

## RNF-003 — Responsividade

Interface compatível com desktop, tablet e smartphone.

---

## RNF-004 — Desempenho

Tempo médio de carregamento inferior a 2 segundos em ambiente local.

---

## RNF-005 — Banco de Dados

Persistência realizada em PostgreSQL.

---

# 5. Regras de Negócio

| Código | Regra                                                              |
| ------ | ------------------------------------------------------------------ |
| RN-001 | Apenas usuários autenticados podem acessar a loja                  |
| RN-002 | Apenas administradores acessam o painel administrativo             |
| RN-003 | Usuários não podem alterar privilégios                             |
| RN-004 | Todo pedido deve estar associado a um usuário                      |
| RN-005 | Todo pedido deve estar associado a um jogo                         |
| RN-006 | O carrinho é mantido no navegador via LocalStorage                 |
| RN-007 | Não é permitido excluir a própria conta administrativa pelo painel |

---

# 6. Banco de Dados

## Tabelas

### usuarios

* id
* nome
* senha
* is_admin

### jogos

* id
* nome
* preco
* genero
* descricao
* requisitos
* imagem
* avaliacao

### pedidos

* id
* usuario_id
* jogo_id
* quantidade
* preco_unitario
* data_pedido

---

## Importação

```bash
createdb -U postgres gameintel

psql -U postgres -d gameintel -f database/backup.sql
```

---

# 7. Estrutura do Projeto

```text
ProjetoFinalPHP/
├── admin/
├── database/
├── includes/
├── pages/
├── public/
├── README.md
└── index.php
```

---

# 8. Como Executar

Clone o projeto:

```bash
git clone <repositorio>
```

Acesse a pasta:

```bash
cd ProjetoFinalPHP
```

Inicie o servidor:

```bash
php -S localhost:8000
```

Abra:

```text
http://localhost:8000
```

---

# 9. Análise de Risco

| Risco           | Impacto | Mitigação              |
| --------------- | ------- | ---------------------- |
| Perda de sessão | Alto    | Validação contínua     |
| SQL Injection   | Alto    | Prepared Statements    |
| Acesso indevido | Alto    | Controle de permissões |
| Dados inválidos | Médio   | Validação backend      |

---

# 10. Controle de Versão

| Versão | Data       | Alteração                                |
| ------ | ---------- | ---------------------------------------- |
| 1.0.0  | 2026-06-16 | Versão inicial da documentação GameIntel |

---

# 11. Funcionalidades Implementadas

* Cadastro de usuários
* Login e logout
* Controle de acesso por perfil
* Catálogo de jogos
* Página de detalhes
* Carrinho de compras
* Checkout
* Histórico de pedidos
* Dashboard administrativo
* CRUD de jogos
* Gerenciamento de usuários
* PostgreSQL
* Sessions PHP
* password_hash()
* pg_query_params()
* Proteção contra SQL Injection
* Proteção contra XSS
* Interface responsiva
* Controle de permissões administrativas

---

© 2026 GameIntel
