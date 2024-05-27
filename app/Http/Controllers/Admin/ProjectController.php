<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Type;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Models\Technology;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.projects.index', ['projects' => Project::orderByDesc('id')->paginate(10)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $technologies = Technology::all();
        $types = Type::all();
        return view('admin.projects.create', compact('types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        $valData = $request->validated();
        $slug = Str::slug($request->title, '-');
        $valData['slug'] = $slug;

        if ($request->hasFile('cover_image')) {
            $img_path = Storage::put('uploads', $request->file('cover_image'));
            $valData['cover_image'] = $img_path;
        }

        $project = Project::create($valData);

        if ($request->has('technology_ids')) {
            $project->technologies()->attach($request->input('technology_ids'));
        }

        return to_route('admin.projects.index')->with('message', "Hai creato un nuovo progetto, congratulazioni");
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $technologies = Technology::all();
        $types = Type::all();
        return view('admin.projects.edit', compact('project', 'types', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        // dd($request);
        $valData = $request->validated();
        $slug = Str::slug($request->title, '-');
        $valData['slug'] = $slug;

        if ($request->has('cover_image')) {
            if ($project->cover_image) {
                Storage::delete($project->cover_image);
            }
            $img_path = Storage::put('uploads', $valData['cover_image']);
            $valData['cover_image'] = $img_path;
        }

        if ($request->has('technology_ids')) {
            $project->technologies()->sync($request->input('technology_ids'));
        }

        $project->update($valData);
        return to_route('admin.projects.index')->with('message', "Project $project->title updated, congratulations");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        if ($project->cover_image) {
            Storage::delete($project->cover_image);
        }
        $project->delete();

        return to_route('admin.projects.index');
    }
}
