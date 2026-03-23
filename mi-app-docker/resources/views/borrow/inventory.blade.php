<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inventario | Sistema Alexxblaro</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=JetBrains+Mono:wght@400;700&display=swap');
        body { font-family: 'Inter', sans-serif; background-color: #09090b; color: #e4e4e7; }
        .font-mono { font-family: 'JetBrains Mono', monospace; }
        .bg-grid { background-size: 30px 30px; background-image: linear-gradient(to right, rgba(255, 255, 255, 0.03) 1px, transparent 1px), linear-gradient(to bottom, rgba(255, 255, 255, 0.03) 1px, transparent 1px); mask-image: linear-gradient(to bottom, transparent, black 10%, black 90%, transparent); }
    </style>
</head>
<body class="min-h-screen relative selection:bg-blue-500/30 py-12">
    <div class="fixed inset-0 z-[-1] bg-grid"></div>
    <div class="container mx-auto px-6 max-w-4xl relative z-10">
        
        <div class="mb-8 flex justify-between items-center">
            <a href="{{ route('books.index') }}" class="text-xs font-mono text-zinc-500 hover:text-white transition-colors">
                < RETORNO_AL_CATALOGO
            </a>
            <span class="text-[10px] font-mono text-blue-500 animate-pulse">CONEXIÓN_ESTABLE :: SESIÓN_ACTIVA</span>
        </div>

        <div class="bg-zinc-950/80 backdrop-blur-xl border border-white/10 rounded-xl p-8 shadow-2xl">
            <header class="border-b border-white/10 pb-6 mb-8">
                <h1 class="text-3xl font-semibold text-white tracking-tight">Mi Inventario</h1>
                <p class="font-mono text-[10px] text-zinc-500 uppercase tracking-widest mt-2">
                    ID_USUARIO: <span class="text-zinc-300">{{ $user->id }}</span> // REGISTROS_VINCULADOS: <span class="text-zinc-300">{{ $user->books->count() }}</span>
                </p>
            </header>

            <div class="grid gap-4">
                @forelse($user->books as $book)
                    <div class="group relative flex items-center justify-between p-4 bg-white/[0.02] border border-white/5 rounded-lg hover:bg-white/[0.04] hover:border-blue-500/30 transition-all">
                        <div class="flex items-center gap-6">
                            <div class="h-16 w-12 rounded border border-white/10 bg-zinc-900 overflow-hidden shrink-0">
                                <img src="" data-title="{{ $book->titulo }}" class="inventory-cover h-full w-full object-cover opacity-0 transition-opacity duration-500">
                            </div>
                            
                            <div>
                                <h3 class="text-white font-medium text-sm">{{ $book->titulo }}</h3>
                                <p class="text-xs text-zinc-500 mt-1 font-mono">
                                    STATUS: <span class="text-blue-400 uppercase">{{ $book->pivot->status }}</span> 
                                    <span class="mx-2 text-zinc-800">|</span> 
                                    FECHA: {{ $book->pivot->created_at->format('d.m.Y') }}
                                </p>
                            </div>
                        </div>
                        
                        <div class="opacity-0 group-hover:opacity-100 transition-opacity">
                            <span class="text-[10px] font-mono text-zinc-500">REF_{{ $book->id }}</span>
                        </div>
                    </div>
                @empty
                    <div class="py-20 text-center border-2 border-dashed border-white/5 rounded-xl">
                        <p class="text-zinc-600 font-mono text-sm uppercase tracking-widest">No hay datos de reserva encriptados</p>
                        <a href="{{ route('books.index') }}" class="mt-4 inline-block text-xs text-blue-500 hover:text-white transition-colors underline decoration-blue-500/30">Explorar Catálogo</a>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <script>
        // Script rápido para cargar portadas en el inventario
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.inventory-cover').forEach(async img => {
                const titulo = img.getAttribute('data-title');
                try {
                    const res = await fetch(`https://openlibrary.org/search.json?title=${encodeURIComponent(titulo)}&limit=1`);
                    const data = await res.json();
                    if (data.docs && data.docs[0].cover_i) {
                        img.src = `https://covers.openlibrary.org/b/id/${data.docs[0].cover_i}-M.jpg`;
                        img.onload = () => img.classList.remove('opacity-0');
                    }
                } catch (e) {}
            });
        });
    </script>
</body>
</html>