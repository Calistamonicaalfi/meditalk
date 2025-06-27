<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Doctor;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::with('doctor')->latest()->get();
        return view('admin.article.index', compact('articles'));
    }

    public function create()
    {
        $dokter = Doctor::all();
        return view('admin.article.create', compact('dokter'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'isi' => 'required',
            'doctor_id' => 'nullable|exists:calista_doctors,id'
        ]);

        Article::create($request->all());
        return redirect()->route('article.index')->with('success', 'Artikel berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $article = Article::findOrFail($id);
        $dokter = Doctor::all();
        return view('admin.article.edit', compact('article', 'dokter'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required',
            'isi' => 'required',
            'doctor_id' => 'nullable|exists:calista_doctors,id'
        ]);

        $article = Article::findOrFail($id);
        $article->update($request->all());
        return redirect()->route('article.index')->with('success', 'Artikel berhasil diupdate.');
    }

    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        $article->delete();
        return redirect()->route('article.index')->with('success', 'Artikel berhasil dihapus.');
    }
}
