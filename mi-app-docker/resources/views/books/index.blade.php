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
            <div class="mt-6 md:mt-0 flex gap-4">
                <a href="{{ route('borrow.inventory', ['user_id' => 1]) }}" class="inline-block px-5 py-2.5 border border-white/10 text-white font-medium text-sm hover:bg-white/5 transition-colors rounded-md font-mono">
                    > Mi_Inventario
                </a>
                <a href="{{ route('books.create') }}" class="inline-block px-5 py-2.5 bg-white text-black font-medium text-sm hover:bg-zinc-200 transition-colors rounded-md">
                    + Nuevo Registro
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="mb-6 p-4 bg-emerald-500/10 border border-emerald-500/20 text-emerald-500 text-sm rounded-md font-mono">
                [OK] {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto border border-white/10 rounded-lg bg-zinc-950/80 backdrop-blur-md">
            <table class="w-full text-left border-collapse min-w-[800px]">
                <thead>
                    <tr class="font-mono text-xs uppercase tracking-wider text-zinc-500 border-b border-white/10 bg-zinc-900/50">
                        <th class="p-4 font-normal">Título de la obra y Autor</th>
                        <th class="p-4 font-normal">Categoría</th>
                        <th class="p-4 font-normal">Estado / Stock</th>
                        <th class="p-4 text-right font-normal">Acciones</th>
                    </tr>
                </thead>
                <tbody class="text-sm">
                    @foreach($books as $book)
                    <tr class="border-b border-white/5 hover:bg-white/[0.02] transition-colors">
                        <td class="p-4 flex items-center gap-4">
                            <div class="relative h-16 w-12 rounded-md border border-white/10 bg-zinc-900/50 overflow-hidden shadow-inner flex items-center justify-center flex-shrink-0">
                                <img data-title="{{ $book->titulo }}" data-author="{{ $book->author->name }}" src="" alt="Portada" class="book-cover-list h-full w-full object-cover opacity-0 transition-opacity duration-300 z-10">
                                <span class="cover-fallback-list text-zinc-700 absolute inset-0 flex items-center justify-center p-2 z-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
                                </span>
                            </div>
                            <div>
                                <h3 class="font-medium text-zinc-100">{{ $book->titulo }}</h3>
                                <p class="text-xs text-zinc-500 mt-1">{{ $book->author->name }} &bull; {{ $book->anio_publicacion }}</p>
                            </div>
                        </td>
                        <td class="p-4">
                            <span class="px-2.5 py-1 bg-zinc-800 border border-white/10 text-zinc-300 text-xs rounded-md">
                                {{ $book->category->name }}
                            </span>
                        </td>
                        <td class="p-4">
                            @if($book->stock > 0)
                                <div class="flex items-center gap-2">
                                    <div class="w-2 h-2 rounded-full bg-emerald-500"></div>
                                    <span class="text-xs text-zinc-400">Disponible ({{ $book->stock }})</span>
                                </div>
                            @else
                                <div class="flex items-center gap-2">
                                    <div class="w-2 h-2 rounded-full bg-red-500"></div>
                                    <span class="text-xs text-zinc-400">Sin stock</span>
                                </div>
                            @endif
                        </td>
                        <td class="p-4 text-right">
                            <div class="flex justify-end gap-3 text-xs font-medium items-center">
                                @if($book->stock > 0)
                                    <form action="{{ route('borrow.store', ['user_id' => 1, 'book_id' => $book->id]) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="text-emerald-500 hover:text-emerald-400 transition-colors uppercase text-[10px] font-mono tracking-tighter">Reservar</button>
                                    </form>
                                    <span class="text-zinc-700">|</span>
                                @endif
                                <a href="{{ route('books.show', $book) }}" class="text-blue-400 hover:text-blue-300 transition-colors">Ver</a>
                                <span class="text-zinc-700">|</span>
                                <a href="{{ route('books.edit', $book) }}" class="text-orange-400 hover:text-white transition-colors">Editar</a>
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
        covers.forEach((img, index) => {
            setTimeout(() => { cargarPortada(img); }, index * 150);
        });

        function cargarPortada(img) {
            const titulo = img.getAttribute('data-title').replace(/[^\w\s]/gi, '').trim();
            const fallback = img.nextElementSibling;

            const mostrarImagen = (url) => {
                img.src = url;
                img.onload = () => {
                    img.classList.remove('opacity-0');
                    if (fallback) { fallback.style.opacity = '0'; setTimeout(() => fallback.style.display = 'none', 300); }
                };
            };

            fetch(`https://openlibrary.org/search.json?title=${encodeURIComponent(titulo)}&limit=1`)
                .then(res => res.json())
                .then(data => {
                    if (data.docs && data.docs.length > 0 && data.docs[0].cover_i) {
                        mostrarImagen(`https://covers.openlibrary.org/b/id/${data.docs[0].cover_i}-M.jpg`);
                    }
                }).catch(() => {});
        }
    });
</script>
</body>
</html>