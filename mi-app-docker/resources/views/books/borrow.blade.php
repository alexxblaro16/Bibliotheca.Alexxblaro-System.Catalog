<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mi Inventario | Sistema Alexxblaro</title>
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
        <div class="mb-8">
            <a href="{{ route('books.index') }}" class="text-sm text-zinc-500 hover:text-white transition-colors">&larr; Volver al terminal central</a>
        </div>

        <div class="bg-zinc-950/80 backdrop-blur-xl border border-white/10 rounded-xl p-8">
            <h1 class="text-2xl font-semibold text-white mb-2">Libros Reservados</h1>
            <p class="font-mono text-xs text-zinc-500 uppercase tracking-widest mb-8">Usuario_ID: {{ $user->id }} // Registros_Activos: {{ $user->books->count() }}</p>

            <div class="space-y-4">
                @forelse($user->books as $book)
                    <div class="flex items-center justify-between p-4 bg-white/5 border border-white/10 rounded-lg group hover:border-blue-500/50 transition-colors">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-14 bg-zinc-900 rounded border border-white/10 overflow-hidden shrink-0">
                                <img src="https://covers.openlibrary.org/b/id/{{ $book->cover_i ?? '' }}-S.jpg" class="w-full h-full object-cover" onerror="this.src='https://via.placeholder.com/40x60?text=?'">
                            </div>
                            <div>
                                <h3 class="text-white font-medium">{{ $book->titulo }}</h3>
                                <p class="text-xs text-zinc-500">Reservado el: {{ $book->pivot->created_at->format('d/m/Y H:i') }}</p>
                            </div>
                        </div>
                        <span class="text-[10px] font-mono px-2 py-1 bg-blue-500/10 text-blue-400 border border-blue-500/20 rounded">ACTIVO</span>
                    </div>
                @empty
                    <div class="text-center py-12 border-2 border-dashed border-white/5 rounded-xl">
                        <p class="text-zinc-500 font-mono text-sm">No se detectan libros vinculados a esta cuenta.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</body>
</html>