<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Base de Datos | Catálogo Alexxblaro</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=JetBrains+Mono:wght@400;700&display=swap');
        body { font-family: 'Inter', sans-serif; background-color: #09090b; color: #e4e4e7; }
        .font-mono { font-family: 'JetBrains Mono', monospace; }
        .bg-grid {
            background-size: 30px 30px;
            background-image: linear-gradient(to right, rgba(255, 255, 255, 0.03) 1px, transparent 1px), linear-gradient(to bottom, rgba(255, 255, 255, 0.03) 1px, transparent 1px);
            mask-image: linear-gradient(to bottom, transparent, black 10%, black 90%, transparent);
        }
    </style>
</head>
<body class="min-h-screen relative selection:bg-blue-500/30 py-12">

    <div class="fixed inset-0 z-[-1] bg-grid"></div>

    <div class="container mx-auto px-6 max-w-6xl relative z-10">
        
        <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-12 border-b border-white/10 pb-6">
            <div>
                <p class="font-mono text-zinc-500 text-xs tracking-widest uppercase mb-2">System-Alexxblaro.Catalog</p>
                <h1 class="text-3xl md:text-4xl font-semibold tracking-tight text-white">
                    Registros de Biblioteca
                </h1>
            </div>
            <div class="mt-6 md:mt-0">
                <a href="{{ route('books.create') }}" class="inline-block px-5 py-2.5 bg-white text-black font-medium text-sm hover:bg-zinc-200 transition-colors rounded-md">
                    + Nuevo Registro
                </a>
            </div>
        </div>

        <form action="{{ route('books.index') }}" method="GET" class="mb-8 flex flex-col md:flex-row items-end gap-4 bg-zinc-900/50 p-5 border border-white/10 rounded-lg backdrop-blur-sm">
            <div class="w-full md:w-auto flex-grow max-w-sm">
                <label class="font-mono text-xs text-zinc-400 uppercase tracking-wider mb-2 block">Filtrar por Categoría</label>
                <select name="categoria" class="w-full bg-zinc-950 border border-white/10 text-zinc-300 p-2.5 rounded-md focus:outline-none focus:border-blue-500/50 text-sm transition-colors" onchange="this.form.submit()">
                    <option value="">Todas las categorías</option>
                    @foreach($categorias as $cat)
                        <option value="{{ $cat }}" {{ request('categoria') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                    @endforeach
                </select>
            </div>
            @if(request('categoria'))
                <a href="{{ route('books.index') }}" class="font-mono text-xs text-zinc-500 hover:text-white uppercase tracking-wider transition-colors mb-3">
                    Limpiar filtro ✕
                </a>
            @endif
        </form>

        <div class="overflow-x-auto border border-white/10 rounded-lg bg-zinc-950/80 backdrop-blur-md">
            <table class="w-full text-left border-collapse min-w-[800px]">
                <thead>
                    <tr class="font-mono text-xs uppercase tracking-wider text-zinc-500 border-b border-white/10 bg-zinc-900/50">
                        <th class="p-4 font-normal">Título de la obra y Autor</th>
                        <th class="p-4 font-normal">Categoría</th>
                        <th class="p-4 font-normal">Estado</th>
                        <th class="p-4 text-right font-normal">Acciones</th>
                    </tr>
                </thead>
                <tbody class="text-sm">
                    @foreach($books as $book)
                    <tr class="border-b border-white/5 hover:bg-white/[0.02] transition-colors">
                        
                        <td class="p-4 flex items-center gap-4">
                            
                            <div class="relative h-16 w-12 rounded-md border border-white/10 bg-zinc-900/50 overflow-hidden shadow-inner flex items-center justify-center flex-shrink-0">
                                <img data-title="{{ $book->titulo }}" data-author="{{ $book->autor }}" src="" alt="Portada de {{ $book->titulo }}" class="book-cover-list h-full w-full object-cover opacity-0 transition-opacity duration-300 z-10">
                                
                                <span class="cover-fallback-list text-zinc-700 absolute inset-0 flex items-center justify-center p-2 z-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
                                </span>
                            </div>

                            <div>
                                <h3 class="font-medium text-zinc-100">{{ $book->titulo }}</h3>
                                <p class="text-xs text-zinc-500 mt-1">{{ $book->autor }} &bull; {{ $book->anio_publicacion }}</p>
                            </div>
                        </td>
                        <td class="p-4">
                            <span class="px-2.5 py-1 bg-zinc-800 border border-white/10 text-zinc-300 text-xs rounded-md">
                                {{ $book->categoria }}
                            </span>
                        </td>
                        <td class="p-4">
                            @if($book->disponible)
                                <div class="flex items-center gap-2">
                                    <div class="w-2 h-2 rounded-full bg-emerald-500"></div>
                                    <span class="text-xs text-zinc-400">Disponible</span>
                                </div>
                            @else
                                <div class="flex items-center gap-2">
                                    <div class="w-2 h-2 rounded-full bg-red-500"></div>
                                    <span class="text-xs text-zinc-400">Prestado</span>
                                </div>
                            @endif
                        </td>
                        <td class="p-4 text-right">
                            <div class="flex justify-end gap-3 text-xs font-medium">
                                <a href="{{ route('books.show', $book) }}" class="text-blue-400 hover:text-blue-300 transition-colors">Ver</a>
                                <span class="text-zinc-700">|</span>
                                <a href="{{ route('books.edit', $book) }}" class="text-orange-400 hover:text-white transition-colors">Editar</a>
                                <span class="text-zinc-700">|</span>
                                <form action="{{ route('books.destroy', $book) }}" method="POST" class="inline m-0 p-0">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-400 hover:text-red-300 transition-colors bg-transparent border-none cursor-pointer" onclick="return confirm('¿Eliminar este registro?')">
                                        Borrar
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const covers = document.querySelectorAll('.book-cover-list');
        
        // Función con retardo para no saturar las APIs
        covers.forEach((img, index) => {
            setTimeout(() => {
                cargarPortada(img);
            }, index * 150); // Carga una imagen cada 150ms (escalonado)
        });

        function cargarPortada(img) {
            const tituloRaw = img.getAttribute('data-title');
            const autorRaw = img.getAttribute('data-author');
            const titulo = tituloRaw.replace(/[^\w\s\u00C0-\u017F]/gi, '').trim();
            const fallback = img.nextElementSibling;

            const mostrarImagen = (url) => {
                img.src = url;
                img.onload = () => {
                    img.classList.remove('opacity-0');
                    if (fallback) {
                        fallback.style.opacity = '0';
                        setTimeout(() => fallback.style.display = 'none', 300);
                    }
                };
            };

            // Intentar primero Open Library (más rápido para listas)
            fetch(`https://openlibrary.org/search.json?title=${encodeURIComponent(titulo)}&limit=1`)
                .then(res => res.json())
                .then(data => {
                    if (data.docs && data.docs.length > 0 && data.docs[0].cover_i) {
                        mostrarImagen(`https://covers.openlibrary.org/b/id/${data.docs[0].cover_i}-M.jpg`);
                    } else {
                        // Si falla Open Library, saltar a Google Books
                        fetch(`https://www.googleapis.com/books/v1/volumes?q=intitle:${encodeURIComponent(titulo)}+inauthor:${encodeURIComponent(autorRaw)}&maxResults=1`)
                            .then(res => res.json())
                            .then(data => {
                                if (data.items && data.items[0].volumeInfo.imageLinks) {
                                    let url = data.items[0].volumeInfo.imageLinks.thumbnail.replace('http:', 'https:');
                                    mostrarImagen(url);
                                }
                            });
                    }
                })
                .catch(() => {
                    // Si hay error de conexión, intentar Google Books como último recurso
                    console.log("Reintentando con Google Books para: " + titulo);
                });
        }
    });
</script>
</body>
</html>