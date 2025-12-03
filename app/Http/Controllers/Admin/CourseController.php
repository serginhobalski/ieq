<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class CourseController extends Controller
{
    // Listar Cursos
    public function index()
    {
        $courses = Course::withCount('lessons')->orderBy('created_at', 'desc')->get();
        return view('admin.courses.index', compact('courses'));
    }

    // Formulário de Criação
    public function create()
    {
        return view('admin.courses.create');
    }

    // Salvar Curso
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|in:ebd,trilho',
            'description' => 'nullable|string',
            'cover' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('cover')) {
            $data['cover_path'] = $request->file('cover')->store('courses', 'public');
        }

        $data['is_published'] = $request->has('is_published'); // Checkbox

        $course = Course::create($data);

        // Redireciona direto para a tela de adicionar aulas
        return redirect()->route('admin.courses.show', $course)
                         ->with('success', 'Curso criado! Agora adicione as aulas.');
    }

    // Tela de Gerenciamento do Curso (Onde adicionamos aulas)
    public function show(Course $course)
    {
        $course->load('lessons');
        return view('admin.courses.show', compact('course'));
    }

    // Editar Curso
    public function edit(Course $course)
    {
        return view('admin.courses.edit', compact('course'));
    }

    // Atualizar Curso
    public function update(Request $request, Course $course)
    {
        // 1. Validação
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required',
            'description' => 'nullable|string',
            'cover' => 'nullable|image|max:2048' // O nome do input no HTML é 'cover'
        ]);

        // 2. Prepara os dados para atualização
        $updateData = [
            'title' => $data['title'],
            'category' => $data['category'],
            'description' => $data['description'] ?? null, // Corrige erro de digitação
            'is_published' => $request->has('is_published'),
        ];

        // 3. Lógica da Imagem
        if ($request->hasFile('cover')) {
            // Apaga a antiga se existir
            if ($course->cover_image) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($course->cover_image);
            }

            // Salva a nova e adiciona ao array de atualização
            // Atenção: O store retorna o caminho (string), que vai para o banco
            $updateData['cover_image'] = $request->file('cover')->store('courses', 'public');
        }

        // 4. Efetiva a atualização
        // O Laravel vai pegar o array $updateData e jogar no banco.
        // Se 'cover_image' estiver no $fillable, vai funcionar.
        $course->update($updateData);

        return redirect()->route('admin.courses.index')->with('success', 'Curso atualizado!');
    }

    // Excluir Curso
    public function destroy(Course $course)
    {
        if($course->cover_path) Storage::disk('public')->delete($course->cover_path);
        $course->delete();
        return redirect()->route('admin.courses.index')->with('success', 'Curso removido.');
    }

    // --- Métodos para LIÇÕES (Aulas) ---

    public function storeLesson(Request $request, Course $course)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'video_url' => 'nullable|url',
            'content' => 'nullable|string',
        ]);

        // Define a ordem automaticamente (último + 1)
        $data['order'] = $course->lessons()->max('order') + 1;
        
        $course->lessons()->create($data);

        return back()->with('success', 'Aula adicionada com sucesso!');
    }

    public function destroyLesson(Lesson $lesson)
    {
        $lesson->delete();
        return back()->with('success', 'Aula removida.');
    }
}