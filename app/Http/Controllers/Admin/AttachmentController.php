<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class AttachmentController extends Controller
{
    /**
     * حفظ مرفق جديد (يدعم أي نموذج مثل Contract, Payment, إلخ عبر Polymorphic)
     */
    public function store(Request $request)
    {
        // التحقق من صلاحية الرفع
        abort_if(!auth()->user()->can('upload_attachments'), Response::HTTP_FORBIDDEN);

        $request->validate([
            'title' => 'required|string|max:255',
            'file' => 'required|file|mimes:pdf,jpg,jpeg,png,webp,doc,docx|max:10240', // حد أقصى 10 ميجابايت
            'model_type' => 'required|string', // مثال: App\Models\Contract
            'model_id' => 'required|integer',
        ]);

        $file = $request->file('file');
        $originalName = $file->getClientOriginalName();
        $fileSize = $file->getSize();
        $fileType = $file->getClientMimeType();

        // تخزين الملف في مجلد secure_attachments داخل الـ storage/app/public
        $filePath = $file->store('secure_attachments', 'public');

        // إنشاء سجل المرفق في قاعدة البيانات
        Attachment::create([
            'attachable_type' => $request->model_type,
            'attachable_id' => $request->model_id,
            'title' => $request->title,
            'file_name' => $originalName,
            'file_path' => $filePath,
            'file_type' => $fileType,
            'file_size' => $fileSize,
            'uploaded_by' => auth()->id(),
        ]);

        return back()->with('success', __('Attachment uploaded successfully.'));
    }

    /**
     * تحميل أو معاينة المرفق
     */
    public function download(Attachment $attachment)
    {
        abort_if(!auth()->user()->can('view_attachments'), Response::HTTP_FORBIDDEN);

        if (!Storage::disk('public')->exists($attachment->file_path)) {
            return back()->with('error', __('File not found on server.'));
        }

        return Storage::disk('public')->download($attachment->file_path, $attachment->file_name);
    }

    /**
     * حذف المرفق
     */
    public function destroy(Attachment $attachment)
    {
        // فقط من يملك صلاحية الحذف أو الـ Super Admin
        abort_if(!auth()->user()->can('delete_attachments'), Response::HTTP_FORBIDDEN);

        // حذف الملف من التخزين الفعلي
        if (Storage::disk('public')->exists($attachment->file_path)) {
            Storage::disk('public')->delete($attachment->file_path);
        }

        // حذف السجل من قاعدة البيانات
        $attachment->delete();

        return back()->with('success', __('Attachment deleted successfully.'));
    }
}
