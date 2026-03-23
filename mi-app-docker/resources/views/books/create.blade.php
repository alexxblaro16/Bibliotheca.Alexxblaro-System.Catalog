<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nuevo Registro</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=JetBrains+Mono:wght@400;700&display=swap');
        body { font-family: 'Inter', sans-serif; background-color: #09090b; color: #e4e4e7; }
        .bg-grid { background-size: 30px 30px; background-image: linear-gradient(to right, rgba(255, 255, 255, 0.03) 1px, transparent 1px), linear-gradient(to bottom, rgba(255, 255, 255, 0.03) 1px, transparent 1px); mask-image: linear-gradient(to bottom, transparent, black 10%, black 90%, transparent); }
        .input-dark { width: 100%; background-color: #09090b; border: 1px solid rgba(255, 255, 255, 0.1); color: #f4f4f5; padding: 0.75rem; border-radius: 0.375rem; font-size: 0.875rem; }
        .label-dark { font-family: 'JetBrains Mono', monospace; font-size: 0.7rem; color: #a1a1aa; text-transform: uppercase; margin-bottom: 0.5rem; display: block; }
    </style>
</head>
<body class="min-h-screen relative py-12 flex items-center justify-center">
    <div class="fixed inset-0 z-[-1] bg-grid"></div>
    <div class="w-full max-w-xl px-6 relative z-10">
        <div class="mb-8"><a href="{{ route('books.index') }}" class="text-sm text-zinc-500 hover:text-white">&larr; Volver</a></div>
        <div class="bg-zinc-950/80 backdrop-blur-xl border border-white/10 rounded-xl p-8 md:p-10">
            <h2 class="text-2xl font-semibold text-white mb-6">Añadir Ejemplar</h2>
            <form action="{{ route('books.store') }}" method="POST" class="space-y-5">
                @csrf
                <div><label class="label-dark">Título</label><input type="text" name="titulo" class="input-dark" required></div>
                
                <div class="grid grid-cols-2 gap-5">
                    <div><label class="label-dark">Autor (ID)</label><input type="number" name="author_id" class="input-dark" required></div>
                    <div><label class="label-dark">Categoría (ID)</label><input type="number" name="category_id" class="input-dark" required></div>
                </div>

                <div class="grid grid-cols-2 gap-5">
                    <div><label class="label-dark">Año</label><input type="number" name="anio_publicacion" class="input-dark" required></div>
                    <div><label class="label-dark">Stock Inicial</label><input type="number" name="stock" value="5" class="input-dark" required></div>
                </div>

                <button type="submit" class="w-full mt-6 px-4 py-3 bg-white text-black font-medium text-sm rounded hover:bg-zinc-200 transition-colors">
                    Guardar Registro
                </button>
            </form>
        </div>
    </div>
</body>
</html>