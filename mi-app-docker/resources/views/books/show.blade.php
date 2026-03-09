<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalles | {{ $book->titulo }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=JetBrains+Mono:wght@400;700&display=swap');
        body { font-family: 'Inter', sans-serif; background-color: #09090b; color: #e4e4e7; }
        .font-mono { font-family: 'JetBrains Mono', monospace; }
        .bg-grid { background-size: 30px 30px; background-image: linear-gradient(to right, rgba(255, 255, 255, 0.03) 1px, transparent 1px), linear-gradient(to bottom, rgba(255, 255, 255, 0.03) 1px, transparent 1px); mask-image: linear-gradient(to bottom, transparent, black 10%, black 90%, transparent); }
        
        /* Efecto de carga pulsante para el hueco de la imagen */
        @keyframes pulse-dark {
            0%, 100% { background-color: rgba(39, 39, 42, 0.3); }
            50% { background-color: rgba(39, 39, 42, 0.6); }
        }
        .skeleton-loader { animation: pulse-dark 2s cubic-bezier(0.4, 0, 0.6, 1) infinite; }
    </style>
</head>
<body class="min-h-screen flex flex-col items-center justify-center py-12 relative selection:bg-blue-500/30">

    <div class="fixed inset-0 z-[-1] bg-grid"></div>

    <div class="w-full max-w-4xl px-6 relative z-10">
        
        <div class="flex justify-between items-center mb-8">
            <a href="{{ route('books.index') }}" class="text-sm text-zinc-500 hover:text-white transition-colors">
                &larr; Volver
            </a>
            <a href="{{ route('books.edit', $book) }}" class="text-sm px-4 py-2 border border-white/10 rounded-md hover:bg-white/5 transition-colors">
                Editar
            </a>
        </div>

        <div class="bg-zinc-950/80 backdrop-blur-xl border border-white/10 rounded-xl p-8 md:p-12">
            
            <div class="flex flex-col md:flex-row gap-10">
                
                <div class="w-full md:w-1/3 flex-shrink-0 flex flex-col items-center">
                    <div class="w-full aspect-[2/3] rounded-lg border border-white/10 overflow-hidden relative skeleton-loader flex items-center justify-center group shadow-2xl">
                        
                        <img id="book-cover" src="" alt="Portada de {{ $book->titulo }}" class="w-full h-full object-cover opacity-0 transition-opacity duration-700 z-10">
                        
                        <div id="cover-fallback" class="absolute inset-0 flex flex-col items-center justify-center text-zinc-600 p-4 text-center z-0">
                            <svg class="animate-spin h-6 w-6 text-zinc-500 mb-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            <span class="text-xs font-mono">Buscando portada en red...</span>
                        </div>
                    </div>
                </div>

                <div class="w-full md:w-2/3 flex flex-col justify-center">
                    
                    <div class="mb-8 pb-8 border-b border-white/10">
                        <p class="font-mono text-xs text-zinc-500 tracking-wider uppercase mb-3">Ficha de metadatos</p>
                        <h1 class="text-3xl md:text-5xl font-semibold tracking-tight text-white mb-3">
                            {{ $book->titulo }}
                        </h1>
                        <p class="text-lg text-zinc-400">
                            Escrito por <span class="text-zinc-200">{{ $book->autor }}</span>
                        </p>
                    </div>

                    <div class="grid grid-cols-2 gap-8 mb-8">
                        <div>
                            <p class="font-mono text-[10px] text-zinc-500 uppercase tracking-widest mb-1">Año de Publicación</p>
                            <p class="text-xl font-medium text-zinc-200">{{ $book->anio_publicacion }}</p>
                        </div>
                        <div>
                            <p class="font-mono text-[10px] text-zinc-500 uppercase tracking-widest mb-1">Categoría</p>
                            <p class="text-xl font-medium text-zinc-200">{{ $book->categoria }}</p>
                        </div>
                    </div>

                    <div class="pt-6 bg-zinc-900/50 p-6 rounded-lg border border-white/5 mt-auto">
                        <p class="font-mono text-[10px] text-zinc-500 uppercase tracking-widest mb-3">Disponibilidad en Biblioteca</p>
                        
                        @if($book->disponible)
                            <div class="flex items-center gap-3">
                                <div class="w-3 h-3 rounded-full bg-emerald-500 shadow-[0_0_10px_rgba(16,185,129,0.5)]"></div>
                                <span class="text-emerald-400 font-medium text-sm">Disponible para préstamo inmediato</span>
                            </div>
                        @else
                            <div class="flex items-center gap-3">
                                <div class="w-3 h-3 rounded-full bg-red-500 shadow-[0_0_10px_rgba(239,68,68,0.5)]"></div>
                                <span class="text-red-400 font-medium text-sm">Ejemplar actualmente prestado</span>
                            </div>
                        @endif
                    </div>

                </div>
            </div>

        </div>
    </div>

<script>
        document.addEventListener('DOMContentLoaded', function() {
            // 1. Recogemos el título desde Laravel y lo "limpiamos"
            const tituloRaw = "{{ $book->titulo }}";
            // Quitamos caracteres extraños que puedan romper la búsqueda en la API
            const titulo = tituloRaw.replace(/[^\w\s\u00C0-\u017F]/gi, '').trim();
            
            // Elementos del DOM
            const coverImg = document.getElementById('book-cover');
            const fallback = document.getElementById('cover-fallback');

            // 2. PLAN A: Buscar en Open Library (Es mucho más fiable para portadas)
            const urlOpenLibrary = `https://openlibrary.org/search.json?title=${encodeURIComponent(titulo)}&limit=5`;

            fetch(urlOpenLibrary)
                .then(response => response.json())
                .then(data => {
                    // Buscamos entre los primeros resultados alguno que SÍ tenga ID de portada (cover_i)
                    const libroConPortada = data.docs ? data.docs.find(doc => doc.cover_i) : null;

                    if (libroConPortada) {
                        // Construimos la URL de la imagen en alta calidad (-L de Large)
                        const imageUrl = `https://covers.openlibrary.org/b/id/${libroConPortada.cover_i}-L.jpg`;
                        mostrarImagen(imageUrl);
                    } else {
                        // Si no lo encuentra, pasamos al Plan B
                        intentarGoogleBooks(titulo);
                    }
                })
                .catch(error => {
                    // Si falla la conexión a OpenLibrary, pasamos al Plan B
                    intentarGoogleBooks(titulo);
                });

            // 3. PLAN B: Buscar en Google Books (Solo por título para que no sea tan estricto)
            function intentarGoogleBooks(tituloLimpio) {
                const urlGoogle = `https://www.googleapis.com/books/v1/volumes?q=intitle:${encodeURIComponent(tituloLimpio)}&maxResults=1`;
                
                fetch(urlGoogle)
                    .then(res => res.json())
                    .then(data => {
                        if (data.items && data.items.length > 0 && data.items[0].volumeInfo && data.items[0].volumeInfo.imageLinks) {
                            let imageUrl = data.items[0].volumeInfo.imageLinks.thumbnail;
                            // Forzamos HTTPS
                            imageUrl = imageUrl.replace('http:', 'https:');
                            mostrarImagen(imageUrl);
                        } else {
                            mostrarFallo();
                        }
                    })
                    .catch(() => mostrarFallo());
            }

            // Función para pintar la imagen suavemente cuando se encuentra
            function mostrarImagen(url) {
                coverImg.src = url;
                coverImg.onload = () => {
                    coverImg.classList.remove('opacity-0');
                    fallback.style.opacity = '0';
                    setTimeout(() => fallback.style.display = 'none', 500);
                };
            }

            // Función final si el libro definitivamente no existe en internet (ej: los inventados por Factory)
            function mostrarFallo() {
                fallback.innerHTML = `
                    <span class="text-zinc-600 mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 22h20"/><path d="M16 2v20"/><path d="M8 2v20"/><path d="M4 6h16"/><path d="M4 10h16"/><path d="M4 14h16"/><path d="M4 18h16"/></svg>
                    </span>
                    <span class="text-xs font-mono text-zinc-500">Sin portada oficial</span>
                `;
            }
        });
    </script>

</body>
</html>