@extends('layouts.app')

@section('title')
    Bíblia Sagrada -ARC
@endsection

@section('content')
    <div class="container-fluid h-100 mt-4">
        <div class="row h-100">

            <!-- COLUNA DE NAVEGAÇÃO (Livros e Capítulos) -->
            <div class="col-md-3 col-lg-2 border-end bg-white" style="height: calc(100vh - 100px); overflow-y: auto;">
                <div class="p-3">
                    <h5 class="fw-bold text-primary mb-3">Livros</h5>
                    <select id="bookSelect" class="form-select mb-3 shadow-sm">
                        <option selected disabled>Escolha um livro...</option>
                        <!-- Preenchido via JS -->
                    </select>

                    <h6 class="fw-bold text-secondary mb-2">Capítulo</h6>
                    <div id="chapterGrid" class="d-flex flex-wrap gap-2">
                        <small class="text-muted">Selecione um livro primeiro.</small>
                    </div>
                </div>
            </div>

            <!-- COLUNA DE LEITURA -->
            <div class="col-md-9 col-lg-10 bg-light" style="height: calc(100vh - 100px); overflow-y: auto;">
                <div class="container py-5">
                    <div class="card shadow-sm border-0">
                        <div class="card-body p-5">

                            <!-- Cabeçalho do Capítulo -->
                            <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
                                <h2 id="readingTitle" class="fw-bold mb-0">Bíblia Sagrada</h2>
                                <span class="badge bg-primary">Almeida</span>
                            </div>

                            <!-- Área de Loading -->
                            <div id="loadingSpinner" class="text-center py-5 d-none">
                                <div class="spinner-border text-primary" role="status">
                                    <span class="visually-hidden">Carregando...</span>
                                </div>
                                <p class="mt-2 text-muted">Buscando as escrituras...</p>
                            </div>

                            <!-- Texto Bíblico -->
                            <div id="bibleText" class="bible-text fs-5" style="line-height: 1.8; text-align: justify;">
                                <div class="text-center text-muted py-5">
                                    <i class="bi bi-book display-1 text-secondary opacity-25"></i>
                                    <p class="mt-3">Selecione um livro e capítulo no menu ao lado para começar a leitura.
                                    </p>
                                </div>
                            </div>

                            <!-- Navegação de Rodapé -->
                            <div id="footerNav" class="d-flex justify-content-between mt-5 d-none">
                                <button class="btn btn-outline-secondary" onclick="prevChapter()">
                                    <i class="bi bi-arrow-left"></i> Anterior
                                </button>
                                <button class="btn btn-outline-primary" onclick="nextChapter()">
                                    Próximo <i class="bi bi-arrow-right"></i>
                                </button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Lista OTIMIZADA para a versão Almeida
        // A chave 'query' é o nome exato que a API espera em português (sem acentos)
        const bibleData = [
            // VELHO TESTAMENTO
            {
                pt: "Gênesis",
                query: "Genesis",
                ch: 50
            },
            {
                pt: "Êxodo",
                query: "Exodo",
                ch: 40
            },
            {
                pt: "Levítico",
                query: "Levitico",
                ch: 27
            },
            {
                pt: "Números",
                query: "Numeros",
                ch: 36
            },
            {
                pt: "Deuteronômio",
                query: "Deuteronomio",
                ch: 34
            },
            {
                pt: "Josué",
                query: "Josue",
                ch: 24
            },
            {
                pt: "Juízes",
                query: "Juizes",
                ch: 21
            },
            {
                pt: "Rute",
                query: "Rute",
                ch: 4
            },
            {
                pt: "1 Samuel",
                query: "1 Samuel",
                ch: 31
            },
            {
                pt: "2 Samuel",
                query: "2 Samuel",
                ch: 24
            },
            {
                pt: "1 Reis",
                query: "1 Reis",
                ch: 22
            },
            {
                pt: "2 Reis",
                query: "2 Reis",
                ch: 25
            },
            {
                pt: "1 Crônicas",
                query: "1 Cronicas",
                ch: 29
            },
            {
                pt: "2 Crônicas",
                query: "2 Cronicas",
                ch: 36
            },
            {
                pt: "Esdras",
                query: "Esdras",
                ch: 10
            },
            {
                pt: "Neemias",
                query: "Neemias",
                ch: 13
            },
            {
                pt: "Ester",
                query: "Ester",
                ch: 10
            },
            {
                pt: "Jó",
                query: "Jo",
                ch: 42
            },
            {
                pt: "Salmos",
                query: "Salmos",
                ch: 150
            },
            {
                pt: "Provérbios",
                query: "Proverbios",
                ch: 31
            },
            {
                pt: "Eclesiastes",
                query: "Eclesiastes",
                ch: 12
            },
            {
                pt: "Cânticos",
                query: "Cantares",
                ch: 8
            }, // Almeida usa 'Cantares'
            {
                pt: "Isaías",
                query: "Isaias",
                ch: 66
            },
            {
                pt: "Jeremias",
                query: "Jeremias",
                ch: 52
            },
            {
                pt: "Lamentações",
                query: "Lamentacoes",
                ch: 5
            },
            {
                pt: "Ezequiel",
                query: "Ezequiel",
                ch: 48
            },
            {
                pt: "Daniel",
                query: "Daniel",
                ch: 12
            },
            {
                pt: "Oseias",
                query: "Oseias",
                ch: 14
            },
            {
                pt: "Joel",
                query: "Joel",
                ch: 3
            },
            {
                pt: "Amós",
                query: "Amos",
                ch: 9
            },
            {
                pt: "Obadias",
                query: "Obadias",
                ch: 1
            },
            {
                pt: "Jonas",
                query: "Jonas",
                ch: 4
            },
            {
                pt: "Miqueias",
                query: "Miqueias",
                ch: 7
            },
            {
                pt: "Naum",
                query: "Naum",
                ch: 3
            },
            {
                pt: "Habacuque",
                query: "Habacuque",
                ch: 3
            },
            {
                pt: "Sofonias",
                query: "Sofonias",
                ch: 3
            },
            {
                pt: "Ageu",
                query: "Ageu",
                ch: 2
            },
            {
                pt: "Zacarias",
                query: "Zacarias",
                ch: 14
            },
            {
                pt: "Malaquias",
                query: "Malaquias",
                ch: 4
            },

            // NOVO TESTAMENTO
            {
                pt: "Mateus",
                query: "Mateus",
                ch: 28
            },
            {
                pt: "Marcos",
                query: "Marcos",
                ch: 16
            },
            {
                pt: "Lucas",
                query: "Lucas",
                ch: 24
            },
            {
                pt: "João",
                query: "Joao",
                ch: 21
            },
            {
                pt: "Atos",
                query: "Atos",
                ch: 28
            },
            {
                pt: "Romanos",
                query: "Romanos",
                ch: 16
            },
            {
                pt: "1 Coríntios",
                query: "1 Corintios",
                ch: 16
            },
            {
                pt: "2 Coríntios",
                query: "2 Corintios",
                ch: 13
            },
            {
                pt: "Gálatas",
                query: "Galatas",
                ch: 6
            },
            {
                pt: "Efésios",
                query: "Efesios",
                ch: 6
            },
            {
                pt: "Filipenses",
                query: "Filipenses",
                ch: 4
            },
            {
                pt: "Colossenses",
                query: "Colossenses",
                ch: 4
            },
            {
                pt: "1 Tessalonicenses",
                query: "1 Tessalonicenses",
                ch: 5
            },
            {
                pt: "2 Tessalonicenses",
                query: "2 Tessalonicenses",
                ch: 3
            },
            {
                pt: "1 Timóteo",
                query: "1 Timoteo",
                ch: 6
            },
            {
                pt: "2 Timóteo",
                query: "2 Timoteo",
                ch: 4
            },
            {
                pt: "Tito",
                query: "Tito",
                ch: 3
            },
            {
                pt: "Filemom",
                query: "Filemom",
                ch: 1
            },
            {
                pt: "Hebreus",
                query: "Hebreus",
                ch: 13
            },
            {
                pt: "Tiago",
                query: "Tiago",
                ch: 5
            },
            {
                pt: "1 Pedro",
                query: "1 Pedro",
                ch: 5
            },
            {
                pt: "2 Pedro",
                query: "2 Pedro",
                ch: 3
            },
            {
                pt: "1 João",
                query: "1 Joao",
                ch: 5
            },
            {
                pt: "2 João",
                query: "2 Joao",
                ch: 1
            },
            {
                pt: "3 João",
                query: "3 Joao",
                ch: 1
            },
            {
                pt: "Judas",
                query: "Judas",
                ch: 1
            },
            {
                pt: "Apocalipse",
                query: "Apocalipse",
                ch: 22
            }
        ];

        let currentBookIndex = -1;
        let currentChapter = 1;

        document.addEventListener('DOMContentLoaded', () => {
            const bookSelect = document.getElementById('bookSelect');
            const chapterGrid = document.getElementById('chapterGrid');

            // Popular Select de Livros
            bibleData.forEach((book, index) => {
                let option = document.createElement('option');
                option.value = index;
                option.textContent = book.pt;
                bookSelect.appendChild(option);
            });

            // Evento ao trocar livro
            bookSelect.addEventListener('change', (e) => {
                currentBookIndex = parseInt(e.target.value);
                const book = bibleData[currentBookIndex];

                // Gerar botões de capítulos
                chapterGrid.innerHTML = '';
                for (let i = 1; i <= book.ch; i++) {
                    let btn = document.createElement('button');
                    btn.className = `btn btn-sm btn-outline-secondary chapter-btn`;
                    btn.style.width = '40px';
                    btn.innerText = i;
                    btn.onclick = () => loadChapter(i);
                    chapterGrid.appendChild(btn);
                }
            });
        });

        async function loadChapter(chapter) {
            if (currentBookIndex === -1) return;

            currentChapter = chapter;
            const book = bibleData[currentBookIndex];

            // UI Updates
            document.getElementById('loadingSpinner').classList.remove('d-none');
            document.getElementById('bibleText').classList.add('d-none');
            document.getElementById('footerNav').classList.add('d-none');
            document.getElementById('readingTitle').innerText = `${book.pt} ${chapter}`;

            // Atualizar botões ativos
            document.querySelectorAll('.chapter-btn').forEach(btn => {
                btn.classList.remove('active', 'btn-primary');
                btn.classList.add('btn-outline-secondary');
                if (parseInt(btn.innerText) === chapter) {
                    btn.classList.add('active', 'btn-primary');
                    btn.classList.remove('btn-outline-secondary');
                }
            });

            try {
                // MUDANÇA: Usamos book.query (nome em PT sem acento)
                // EncodeURIComponent garante que espaços virem %20 corretamente
                const bookName = encodeURIComponent(book.query);
                const url = `https://bible-api.com/${bookName}+${chapter}?translation=almeida`;

                console.log("URL Gerada:", url);

                const response = await fetch(url);

                if (!response.ok) {
                    throw new Error(`Erro API: ${response.status}`);
                }

                const data = await response.json();

                let htmlContent = '';
                if (data.verses && data.verses.length > 0) {
                    data.verses.forEach(verse => {
                        htmlContent += `
                        <p class="mb-2">
                            <sup class="text-primary fw-bold me-1">${verse.verse}</sup>
                            ${verse.text}
                        </p>`;
                    });
                } else {
                    htmlContent = '<p class="text-muted text-center py-5">Texto não encontrado.</p>';
                }

                document.getElementById('bibleText').innerHTML = htmlContent;

                // Show UI
                document.getElementById('loadingSpinner').classList.add('d-none');
                document.getElementById('bibleText').classList.remove('d-none');
                document.getElementById('footerNav').classList.remove('d-none');

            } catch (error) {
                console.error(error);
                document.getElementById('loadingSpinner').classList.add('d-none');

                document.getElementById('bibleText').innerHTML = `
                <div class="alert alert-warning text-center mt-5">
                    <i class="bi bi-exclamation-triangle display-4"></i><br><br>
                    <strong>Não foi possível carregar ${book.pt}.</strong><br>
                    <small>Tente selecionar outro capítulo ou verifique sua internet.</small>
                    <br><small class="text-muted">Erro técnico: ${error.message}</small>
                </div>
            `;
                document.getElementById('bibleText').classList.remove('d-none');
            }
        }

        function nextChapter() {
            if (currentBookIndex === -1) return;
            const book = bibleData[currentBookIndex];
            if (currentChapter < book.ch) {
                loadChapter(currentChapter + 1);
            } else {
                alert('Fim do livro. Selecione o próximo livro no menu.');
            }
        }

        function prevChapter() {
            if (currentChapter > 1) {
                loadChapter(currentChapter - 1);
            }
        }
    </script>

    <style>
        /* CSS HARDCODED PARA GARANTIR VISIBILIDADE */
        .card-chat {
            height: calc(100vh - 120px) !important;
            min-height: 500px;
            display: flex;
            flex-direction: column;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            background: white;
        }

        .card-body {
            flex: 1;
            overflow: hidden;
            /* Impede scroll duplo */
        }

        /* Sidebar */
        .chat-sidebar {
            width: 280px;
            display: flex;
            flex-direction: column;
            border-right: 1px solid #eee;
            background: #fff;
        }

        /* Área Principal */
        .chat-main {
            display: flex;
            flex-direction: column;
            flex: 1;
            /* Ocupa o resto da largura */
            min-width: 0;
            /* Corrige bug flexbox */
            background: #f5f7fa;
        }

        .chat-body {
            flex: 1;
            /* Ocupa altura disponível */
            overflow-y: auto;
            /* Scroll apenas aqui */
            padding: 1rem;
        }

        .chat-footer {
            flex-shrink: 0;
            /* Não encolhe */
            background: white;
            padding: 1rem;
            border-top: 1px solid #eee;
        }

        /* Utilitários */
        .hover-bg-light:hover {
            background-color: #f8f9fa;
            cursor: pointer;
        }

        .active {
            background-color: #eef2f7 !important;
            border-left: 3px solid #0d6efd;
        }

        /* Mobile */
        @media (max-width: 768px) {
            .chat-sidebar {
                width: 70px;
            }

            .flex-1,
            .chat-sidebar-header {
                display: none !important;
            }

            .avatar {
                margin: 0 auto;
            }
        }
    </style>
@endsection
