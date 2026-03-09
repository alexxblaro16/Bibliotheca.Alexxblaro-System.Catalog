<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Registro</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=JetBrains+Mono:wght@400;700&display=swap');
        body { font-family: 'Inter', sans-serif; background-color: #09090b; color: #e4e4e7; }
        .font-mono { font-family: 'JetBrains Mono', monospace; }
        .bg-grid { background-size: 30px 30px; background-image: linear-gradient(to right, rgba(255, 255, 255, 0.03) 1px, transparent 1px), linear-gradient(to bottom, rgba(255, 255, 255, 0.03) 1px, transparent 1px); mask-image: linear-gradient(to bottom, transparent, black 10%, black 90%, transparent); }
        .input-dark { width: 100%; background-color: #09090b; border: 1px solid rgba(255, 255, 255, 0.1); color: #f4f4f5; padding: 0.75rem; border-radius: 0.375rem; font-size: 0.875rem; transition: border-color 0.2s; }
        .input-dark:focus { outline: none; border-color: #3b82f6; }
        .label-dark { font-family: 'JetBrains Mono', monospace; font-size: 0.7rem; color: #a1a1aa; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.5rem; display: block; }
    </style>
</head>
<body class="min-h-screen relative selection:bg-blue-500/30 py-12 flex items-center justify-center">

    <div class="fixed inset-0 z-[-1] bg-grid"></div>
    
    <div class="w-full max-w-xl px-6 relative z-10">
        
        <div class="mb-8">
            <a href="{{ route('books.index') }}" class="text-sm text-zinc-500 hover:text-white transition-colors">
                &larr; Descartar cambios
            </a>
        </div>

        <div class="bg-zinc-950/80 backdrop-blur-xl border border-white/10 rounded-xl p-8 md:p-10">
            <div class="mb-8 border-b border-white/10 pb-6">
                <h2 class="text-2xl font-semibold text-white">Editar Registro</h2>
                <p class="text-sm text-zinc-500 mt-1">ID del documento: <span class="font-mono text-zinc-300">{{ $book->titulo }}</span></p>
            </div>

            <form action="{{ route('books.update', $book) }}" method="POST" class="space-y-5">
                @csrf
                @method('PUT')
                
                <div>
                    <label class="label-dark">Título de la Obra</label>
                    <input type="text" name="titulo" value="{{ $book->titulo }}" class="input-dark" required>
                </div>

                <div>
                    <label class="label-dark">Autor</label>
                    <input type="text" name="autor" value="{{ $book->autor }}" class="input-dark" required>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="label-dark">Año de Publicación</label>
                        <input type="number" name="anio_publicacion" value="{{ $book->anio_publicacion }}" class="input-dark" required>
                    </div>
                    <div>
                        <label class="label-dark">Categoría</label>
                        <input type="text" name="categoria" value="{{ $book->categoria }}" class="input-dark" required>
                    </div>
                </div>

                <div class="pt-4">
                    <label class="flex items-center cursor-pointer">
                        <input type="checkbox" name="disponible" value="1" {{ $book->disponible ? 'checked' : '' }} class="w-4 h-4 rounded border-gray-800 bg-zinc-900 text-blue-500 focus:ring-blue-500/50 focus:ring-offset-0">
                        <span class="ml-3 text-sm text-zinc-300">
                            Marcar como disponible para préstamo
                        </span>
                    </label>
                </div>

                <button type="submit" class="w-full mt-6 px-4 py-3 bg-zinc-800 text-white font-medium text-sm hover:bg-zinc-700 border border-white/10 transition-colors rounded-md">
                    Actualizar Información
                </button>
            </form>
        </div>
    </div>
</body>
</html>