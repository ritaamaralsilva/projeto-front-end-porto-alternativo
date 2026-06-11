# Porto Alternativo

**Porto Alternativo** é uma plataforma de agenda digital dedicada à divulgação de eventos musicais de nicho — cultura underground e experimental da cidade do Porto. Funciona como um guia interativo onde os utilizadores podem explorar locais de culto, consultar a agenda de eventos e gerir conteúdos através de um painel autenticado.

---

## Tema Escolhido

Plataforma de gestão de eventos culturais e locais alternativos da cidade do Porto, com foco em música experimental, clubbing e cultura underground.

---

## Tecnologias Utilizadas

- **HTML5 & CSS3** — Estrutura semântica e estilização personalizada com estética dark mode
- **Bootstrap 5** — Grid, Cards, Modais, Navbar, Carrossel e utilitários de responsividade
- **JavaScript** — Manipulação do DOM, filtros dinâmicos e interação com modais
- **PHP** — Lógica de back-end, autenticação, sessões e processamento de formulários
- **MySQL** — Base de dados relacional com PDO
- **XAMPP** — Ambiente de desenvolvimento local (Apache + MySQL)

---

## Funcionalidades Principais

- **Autenticação** — Registo, login e logout com gestão de sessões (`$_SESSION`) e proteção de páginas privadas
- **CRUD de Locais** — Criar, listar, editar e eliminar locais com categoria, morada, imagem, coordenadas Google Maps e website
- **CRUD de Eventos** — Criar, listar, editar e eliminar eventos com data, hora, bilheteira, local associado e categorias (relação N:N)
- **Carrossel Dinâmico** — Página inicial com eventos futuros ordenados por data; em fallback mostra os mais recentes passados
- **Modais de Detalhe** — Visualização de informação completa de locais e eventos com mapa embed e link de bilheteira
- **Filtros de Categoria** — Filtragem de locais por categoria
- **Formulário de Contacto** — Formulário com validação e envio por email via PHP
- **Interface Responsiva** — Design adaptado para mobile e desktop

---

## Base de Dados

Mínimo de 5 tabelas relacionadas:

| Tabela             | Descrição                                             |
| ------------------ | ----------------------------------------------------- |
| `users`            | Utilizadores registados                               |
| `locais`           | Locais culturais (salas, clubes, associações)         |
| `eventos`          | Eventos da agenda cultural                            |
| `categorias`       | Categorias partilhadas por locais e eventos           |
| `evento_categoria` | Tabela pivot (relação N:N entre eventos e categorias) |

Utilização de `SELECT`, `INSERT`, `UPDATE`, `DELETE`, `JOIN`, chaves primárias e estrangeiras com `ON DELETE CASCADE`.

---

## Segurança

- Prepared statements com PDO em todas as queries
- Sanitização de outputs com `htmlspecialchars()`
- Proteção de páginas privadas com `requireLogin()`
- Gestão de sessões com `$_SESSION`
- Proteção contra SQL Injection e acessos indevidos

---

## Estrutura do Projeto

```text
projeto-front-end-porto-alternativo/
├── assets/
│   ├── style/              # Estilos personalizados (style.css)
│   ├── js/                 # Lógica JS (main.js, locais.js, eventos.js)
│   └── images/             # Imagens de locais e eventos
├── db/
│   └── Database.php        # Ligação PDO à base de dados
├── includes/
│   ├── auth.php            # Funções de autenticação
│   ├── config.php          # Configurações globais (BASE_URL, sessão)
│   ├── header.php          # Cabeçalho HTML
│   ├── nav.php             # Navegação
│   └── footer.php          # Rodapé e scripts
├── pages/
│   ├── locais.php          # Listagem de locais
│   ├── eventos.php         # Agenda de eventos
│   ├── contacto.php        # Formulário de contacto
│   ├── login.php           # Login
│   ├── registo.php         # Registo
│   ├── locais-crud/        # CRUD de locais (criar, editar, eliminar)
│   └── eventos-crud/       # CRUD de eventos (criar, editar, store, eliminar)
├── index.php               # Página inicial com carrossel dinâmico
└── README.md
```

---

## Limitações e Ideias Futuras

- Upload de imagens diretamente pelo formulário (atualmente por URL)
- Sistema de permissões por role (admin vs utilizador)
- Pesquisa full-text de eventos e locais
- Página pública de perfil de utilizador
- Notificações de eventos por email

---

## Autoras

- **Rita Silva** (frontend e backend)
- **Sofia Brito** (frontend)

---

*PRO MOV 2026 — Software Developer*  
*Projeto desenvolvido para a UC Desenvolvimento Web (Front-End e Back-End)*

