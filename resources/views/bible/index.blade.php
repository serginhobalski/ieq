@extends('layouts.app')

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
        // Dados dos Livros (Nome PT-BR, Nome API Inglês, Qtd Capítulos)
        const bibleData = [{
                pt: "Gênesis",
                en: "Genesis",
                ch: 50
            },
            {
                pt: "Êxodo",
                en: "Exodus",
                ch: 40
            },
            {
                pt: "Levítico",
                en: "Leviticus",
                ch: 27
            },
            {
                pt: "Números",
                en: "Numbers",
                ch: 36
            },
            {
                pt: "Deuteronômio",
                en: "Deuteronomy",
                ch: 34
            },
            {
                pt: "Josué",
                en: "Joshua",
                ch: 24
            },
            {
                pt: "Juízes",
                en: "Judges",
                ch: 21
            },
            {
                pt: "Rute",
                en: "Ruth",
                ch: 4
            },
            {
                pt: "1 Samuel",
                en: "1 Samuel",
                ch: 31
            },
            {
                pt: "2 Samuel",
                en: "2 Samuel",
                ch: 24
            },
            {
                pt: "1 Reis",
                en: "1 Kings",
                ch: 22
            },
            {
                pt: "2 Reis",
                en: "2 Kings",
                ch: 25
            },
            {
                pt: "1 Crônicas",
                en: "1 Chronicles",
                ch: 29
            },
            {
                pt: "2 Crônicas",
                en: "2 Chronicles",
                ch: 36
            },
            {
                pt: "Esdras",
                en: "Ezra",
                ch: 10
            },
            {
                pt: "Neemias",
                en: "Nehemiah",
                ch: 13
            },
            {
                pt: "Ester",
                en: "Esther",
                ch: 10
            },
            {
                pt: "Jó",
                en: "Job",
                ch: 42
            },
            {
                pt: "Salmos",
                en: "Psalms",
                ch: 150
            },
            {
                pt: "Provérbios",
                en: "Proverbs",
                ch: 31
            },
            {
                pt: "Eclesiastes",
                en: "Ecclesiastes",
                ch: 12
            },
            {
                pt: "Cânticos",
                en: "Song of Solomon",
                ch: 8
            },
            {
                pt: "Isaías",
                en: "Isaiah",
                ch: 66
            },
            {
                pt: "Jeremias",
                en: "Jeremiah",
                ch: 52
            },
            {
                pt: "Lamentações",
                en: "Lamentations",
                ch: 5
            },
            {
                pt: "Ezequiel",
                en: "Ezekiel",
                ch: 48
            },
            {
                pt: "Daniel",
                en: "Daniel",
                ch: 12
            },
            {
                pt: "Oseias",
                en: "Hosea",
                ch: 14
            },
            {
                pt: "Joel",
                en: "Joel",
                ch: 3
            },
            {
                pt: "Amós",
                en: "Amos",
                ch: 9
            },
            {
                pt: "Obadias",
                en: "Obadiah",
                ch: 1
            },
            {
                pt: "Jonas",
                en: "Jonah",
                ch: 4
            },
            {
                pt: "Miqueias",
                en: "Micah",
                ch: 7
            },
            {
                pt: "Naum",
                en: "Nahum",
                ch: 3
            },
            {
                pt: "Habacuque",
                en: "Habakkuk",
                ch: 3
            },
            {
                pt: "Sofonias",
                en: "Zephaniah",
                ch: 3
            },
            {
                pt: "Ageu",
                en: "Haggai",
                ch: 2
            },
            {
                pt: "Zacarias",
                en: "Zechariah",
                ch: 14
            },
            {
                pt: "Malaquias",
                en: "Malachi",
                ch: 4
            },
            // Novo Testamento
            {
                pt: "Mateus",
                en: "Matthew",
                ch: 28
            },
            {
                pt: "Marcos",
                en: "Mark",
                ch: 16
            },
            {
                pt: "Lucas",
                en: "Luke",
                ch: 24
            },
            {
                pt: "João",
                en: "John",
                ch: 21
            },
            {
                pt: "Atos",
                en: "Acts",
                ch: 28
            },
            {
                pt: "Romanos",
                en: "Romans",
                ch: 16
            },
            {
                pt: "1 Coríntios",
                en: "1 Corinthians",
                ch: 16
            },
            {
                pt: "2 Coríntios",
                en: "2 Corinthians",
                ch: 13
            },
            {
                pt: "Gálatas",
                en: "Galatians",
                ch: 6
            },
            {
                pt: "Efésios",
                en: "Ephesians",
                ch: 6
            },
            {
                pt: "Filipenses",
                en: "Philippians",
                ch: 4
            },
            {
                pt: "Colossenses",
                en: "Colossians",
                ch: 4
            },
            {
                pt: "1 Tessalonicenses",
                en: "1 Thessalonians",
                ch: 5
            },
            {
                pt: "2 Tessalonicenses",
                en: "2 Thessalonians",
                ch: 3
            },
            {
                pt: "1 Timóteo",
                en: "1 Timothy",
                ch: 6
            },
            {
                pt: "2 Timóteo",
                en: "2 Timothy",
                ch: 4
            },
            {
                pt: "Tito",
                en: "Titus",
                ch: 3
            },
            {
                pt: "Filemom",
                en: "Philemon",
                ch: 1
            },
            {
                pt: "Hebreus",
                en: "Hebrews",
                ch: 13
            },
            {
                pt: "Tiago",
                en: "James",
                ch: 5
            },
            {
                pt: "1 Pedro",
                en: "1 Peter",
                ch: 5
            },
            {
                pt: "2 Pedro",
                en: "2 Peter",
                ch: 3
            },
            {
                pt: "1 João",
                en: "1 John",
                ch: 5
            },
            {
                pt: "2 João",
                en: "2 John",
                ch: 1
            },
            {
                pt: "3 João",
                en: "3 John",
                ch: 1
            },
            {
                pt: "Judas",
                en: "Jude",
                ch: 1
            },
            {
                pt: "Apocalipse",
                en: "Revelation",
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
                // Chamada API (Usando versão Almeida = 'almeida')
                const response = await fetch(`https://bible-api.com/${book.en}+${chapter}?translation=almeida`);
                const data = await response.json();

                let htmlContent = '';
                data.verses.forEach(verse => {
                    htmlContent += `
                    <p class="mb-2">
                        <sup class="text-primary fw-bold me-1">${verse.verse}</sup>
                        ${verse.text}
                    </p>`;
                });

                document.getElementById('bibleText').innerHTML = htmlContent;

                // Show UI
                document.getElementById('loadingSpinner').classList.add('d-none');
                document.getElementById('bibleText').classList.remove('d-none');
                document.getElementById('footerNav').classList.remove('d-none');

            } catch (error) {
                alert('Erro ao carregar o texto bíblico. Verifique sua conexão.');
            }
        }

        function nextChapter() {
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
        /* Estilo para destacar versículo ao passar o mouse */
        .bible-text p:hover {
            background-color: #f8f9fa;
            border-radius: 5px;
        }
    </style>
@endsection
