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
        @keyframes pulse-dark { 0%, 100% { background-color: rgba(39, 39, 42, 0.3); } 50% { background-color: rgba(39, 39, 42, 0.6); } }
        .skeleton-loader { animation: pulse-dark 2s infinite; }
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
                        <img id="book-cover" src="" alt="Portada" class="w-full h-full object-cover opacity-0 transition-opacity duration-700 z-10">
                        <div id="cover-fallback" class="absolute inset-0 flex flex-col items-center justify-center text-zinc-600 p-4 text-center z-0">
                            <span class="text-xs font-mono">Buscando portada...</span>
                        </div>
                    </div>
                </div>

                <div class="w-full md:w-2/3 flex flex-col justify-center">
                    <div class="mb-8 pb-8 border-b border-white/10">
                        <p class="font-mono text-xs text-zinc-500 tracking-wider uppercase mb-3">Ficha de metadatos</p>
                        <h1 class="text-3xl md:text-5xl font-semibold tracking-tight text-white mb-3">{{ $book->titulo }}</h1>
                        <p class="text-lg text-zinc-400">
                            Escrito por <span class="text-zinc-200">{{ $book->author->name }}</span>
                        </p>
                    </div>

                    <div class="grid grid-cols-2 gap-8 mb-8">
                        <div>
                            <p class="font-mono text-[10px] text-zinc-500 uppercase tracking-widest mb-1">Año de Publicación</p>
                            <p class="text-xl font-medium text-zinc-200">{{ $book->anio_publicacion }}</p>
                        </div>
                        <div>
                            <p class="font-mono text-[10px] text-zinc-500 uppercase tracking-widest mb-1">Categoría</p>
                            <p class="text-xl font-medium text-zinc-200">{{ $book->category->name }}</p>
                        </div>
                    </div>

                    <div class="pt-6 bg-zinc-900/50 p-6 rounded-lg border border-white/5 mt-auto flex justify-between items-center">
                        <div>
                            <p class="font-mono text-[10px] text-zinc-500 uppercase tracking-widest mb-3">Disponibilidad (Stock: {{ $book->stock }})</p>
                            @if($book->stock > 0)
                                <div class="flex items-center gap-3">
                                    <div class="w-3 h-3 rounded-full bg-emerald-500 shadow-[0_0_10px_rgba(16,185,129,0.5)]"></div>
                                    <span class="text-emerald-400 font-medium text-sm">Disponible</span>
                                </div>
                            @else
                                <div class="flex items-center gap-3">
                                    <div class="w-3 h-3 rounded-full bg-red-500 shadow-[0_0_10px_rgba(239,68,68,0.5)]"></div>
                                    <span class="text-red-400 font-medium text-sm">Ejemplares agotados</span>
                                </div>
                            @endif
                        </div>

                        @if($book->stock > 0)
                            <form action="{{ route('borrow.store', ['user_id' => 1, 'book_id' => $book->id]) }}" method="POST">
                                @csrf
                                <button type="submit" class="px-6 py-2 bg-white text-black text-xs font-mono rounded hover:bg-zinc-200 transition-all uppercase">
                                    Reservar
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const titulo = "{{ $book->titulo }}".replace(/[^\w\s]/gi, '').trim();
        const coverImg = document.getElementById('book-cover');
        const fallback = document.getElementById('cover-fallback');

        fetch(`https://openlibrary.org/search.json?title=${encodeURIComponent(titulo)}&limit=1`)
            .then(res => res.json())
            .then(data => {
                if (data.docs && data.docs[0].cover_i) {
                    const url = `https://covers.openlibrary.org/b/id/${data.docs[0].cover_i}-L.jpg`;
                    coverImg.src = url;
                    coverImg.onload = () => {
                        coverImg.classList.remove('opacity-0');
                        fallback.style.display = 'none';
                    };
                }
            });
    });
</script>
</body>
</html>