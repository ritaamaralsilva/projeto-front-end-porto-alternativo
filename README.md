# Porto Alternativo 

**Porto Alternativo** é uma plataforma de agenda digital dedicada à divulgação de eventos musicais de nicho - cultura underground e experimental da cidade do Porto. O projeto funciona como um guia interativo onde os utilizadores podem explorar locais de culto, consultar a agenda de eventos e submeter novas propostas culturais.

---

## Funcionalidades Principais

*   **Destaques Dinâmicos**: Página inicial com carrossel de eventos de destaques semanais utilizando componentes do Bootstrap.
*   **Guia de Locais**: Listagem dinâmica de salas de concertos, clubes e associações através de um ficheiro `locais.json`.
*   **Filtros para categorias e estilos musicais**: Sistema de filtragem por categorias que suporta espaços híbridos (ex: locais que são simultaneamente Clubbing e Sala de Concertos).
*   **Agenda Cultural**: Visualização de eventos musicais com ordenação e detalhes extraídos de `eventos.json`.
*   **Submissão de Eventos**: Formulário com validação em tempo real, bloqueio de datas retroativas e carregamento dinâmico de locais via API interna.
*   **Interface Responsiva**: Design adaptado para dispositivos móveis, garantindo acessibilidade em qualquer ecrã.

---

## Tecnologias 

*   **HTML5 & CSS3**: Estrutura e estilização personalizada com uma estética *dark mode*.
*   **Bootstrap 5**: Framework utilizado para o sistema de grelha (Grid), componentes (Cards, Modais, Navbar) e utilitários de validação.
*   **JavaScript**: Manipulação do DOM, gestão de eventos, consumo de dados JSON e lógica de validação de formulários.
*   **JSON**: Utilizado como base de dados para armazenamento de informações sobre locais e eventos.

---

## Autoras
*   **Rita Silva**
*   **Sofia Brito**


## Estrutura do Projeto
```text
Porto-Alternativo/
├── assets/
│   ├── style/           # Estilos personalizados (style.css)
│   ├── base-dados/          # Ficheiros JSON (locais.json, eventos.json)
│   ├── js/            # Lógica (main.js, locais.js, eventos.js, submeter-evento.js)
│   └── images/        # Banco de imagens de locais e eventos
├── pages/
│   ├── index.html     # Página inicial
│   ├── locais.html    # Listagem e filtros de locais
│   ├── eventos.html   # Agenda de concertos
│   └── submeter-evento.html  # Formulário de submissão de evento
│   ├── sobre.html     # Sobre nós (Porto Alternativo)
│   └── contacto.html  # Formulário de contacto
└── README.md          # Documentação do projeto

PRO MOV 2026 - Software Developer
Projeto desenvolvido para a UC Web Front End

