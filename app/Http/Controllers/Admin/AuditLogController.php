<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AuditLogController extends Controller
{
    /**
     * Display audit logs.
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', AuditLog::class);

        $logs = AuditLog::query()
            ->with('user')
            ->when($request->filled('q'), function ($query) use ($request) {
                $search = $request->string('q')->toString();

                $query->where(function ($q) use ($search) {
                    $q->where('action', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%")
                        ->orWhere('ip_address', 'like', "%{$search}%");
                });
            })
            ->when($request->filled('action'), function ($query) use ($request) {
                $query->where(
                    'action',
                    $request->string('action')->toString()
                );
            })
            ->when($request->filled('user_id'), function ($query) use ($request) {
                $query->where(
                    'user_id',
                    $request->integer('user_id')
                );
            })
            ->when($request->filled('date_from'), function ($query) use ($request) {
                $query->whereDate(
                    'created_at',
                    '>=',
                    $request->date_from
                );
            })
            ->when($request->filled('date_to'), function ($query) use ($request) {
                $query->whereDate(
                    'created_at',
                    '<=',
                    $request->date_to
                );
            })
            ->latest()
            ->paginate(25)
            ->withQueryString();

        $users = \App\Models\User::query()
            ->orderBy('name')
            ->get(['id', 'name']);

        $actions = AuditLog::query()
            ->whereNotNull('action')
            ->distinct()
            ->orderBy('action')
            ->pluck('action');

        return view('admin.audit-logs.index', compact(
            'logs',
            'users',
            'actions'
        ));
    }

    /**
     * Display a specific audit log.
     */
    public function show(AuditLog $auditLog)
    {
        $this->authorize('view', $auditLog);

        $auditLog->load('user', 'auditable');

        return view('admin.audit-logs.show', compact('auditLog'));
    }

    /**
     * Export audit logs as CSV.
     */
    public function export(Request $request): StreamedResponse
    {
        $this->authorize('export', AuditLog::class);

        $logs = AuditLog::query()
            ->with('user')
            ->latest()
            ->get();

        $filename = 'audit-logs-' . now()->format('Y-m-d-H-i-s') . '.csv';

        return response()->streamDownload(function () use ($logs) {
            $handle = fopen('php://output', 'w');

            fputcsv($handle, [
                'ID',
                'User',
                'Action',
                'Description',
                'IP Address',
                'Date',
            ]);

            foreach ($logs as $log) {
                fputcsv($handle, [
                    $log->id,
                    $log->user?->name ?? 'System',
                    $log->action,
                    $log->description,
                    $log->ip_address,
                    optional($log->created_at)->format('Y-m-d H:i:s'),
                ]);
            }

            fclose($handle);
        }, $filename, [
            'Content-Type' => 'text/csv; charset=UTF-8',
        ]);
    }
}
