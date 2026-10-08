<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Position;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PositionController extends Controller
{
    use AuthorizesRequests;

    public function index(Request $request)
    {
        $this->authorize('viewAny', Position::class);

        $positions = Position::withCount('users')
            ->when($request->filled('q'), function ($query) use ($request) {
                $search = $request->string('q')->toString();

                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('code', 'like', "%{$search}%");
                });
            })
            ->orderBy('name')
            ->paginate(15)
            ->withQueryString();

        return view('admin.positions.index', compact('positions'));
    }

    public function create()
    {
        $this->authorize('create', Position::class);

        return view('admin.positions.create');
    }

    public function store(Request $request)
    {
        $this->authorize('create', Position::class);

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                'unique:positions,name',
            ],

            'code' => [
                'required',
                'string',
                'max:50',
                'unique:positions,code',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'status' => [
                'required',
                Rule::in(['active', 'inactive']),
            ],
        ]);

        Position::create($validated);

        return redirect()
            ->route('admin.positions.index')
            ->with('success', 'Position created successfully.');
    }

    public function show(Position $position)
    {
        $this->authorize('view', $position);

        $position->load('users');

        return view('admin.positions.show', compact('position'));
    }

    public function edit(Position $position)
    {
        $this->authorize('update', $position);

        return view('admin.positions.edit', compact('position'));
    }

    public function update(Request $request, Position $position)
    {
        $this->authorize('update', $position);

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('positions', 'name')->ignore($position->id),
            ],

            'code' => [
                'required',
                'string',
                'max:50',
                Rule::unique('positions', 'code')->ignore($position->id),
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'status' => [
                'required',
                Rule::in(['active', 'inactive']),
            ],
        ]);

        $position->update($validated);

        return redirect()
            ->route('admin.positions.index')
            ->with('success', 'Position updated successfully.');
    }

    public function activate(Position $position)
    {
        $this->authorize('update', $position);

        $position->update([
            'status' => 'active',
        ]);

        return back()->with(
            'success',
            'Position activated successfully.'
        );
    }

    public function deactivate(Position $position)
    {
        $this->authorize('update', $position);

        if ($position->users()->exists()) {
            return back()->withErrors([
                'position' => 'This position has users assigned to it and cannot be deactivated.',
            ]);
        }

        $position->update([
            'status' => 'inactive',
        ]);

        return back()->with(
            'success',
            'Position deactivated successfully.'
        );
    }
}
