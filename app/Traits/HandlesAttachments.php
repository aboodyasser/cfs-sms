<?php

namespace App\Traits;

use App\Models\Attachment;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

trait HandlesAttachments
{
    /**
     * Upload and attach files to a given model.
     * 
     * @param Request $request
     * @param Model $model
     * @param string $inputName The name of the file input in the request
     */
    public function handleAttachments(Request $request, Model $model, string $inputName = 'documents')
    {
        if ($request->hasFile($inputName)) {
            $files = $request->file($inputName);
            $descriptions = $request->input('file_descriptions', []);

            // If it's a single file, wrap it in an array
            if (!is_array($files)) {
                $files = [$files];
            }

            foreach ($files as $index => $file) {
                if ($file && $file->isValid()) {
                    $originalName = $file->getClientOriginalName();
                    $fileSize = $file->getSize();
                    $fileType = $file->getClientMimeType();

                    // Store the file in secure_attachments
                    $filePath = $file->store('secure_attachments', 'public');
                    
                    // Title from descriptions if available, else original name
                    $title = $descriptions[$index] ?? pathinfo($originalName, PATHINFO_FILENAME);

                    // Create the attachment record
                    Attachment::create([
                        'attachable_type' => get_class($model),
                        'attachable_id' => $model->id,
                        'title' => $title,
                        'file_name' => $originalName,
                        'file_path' => $filePath,
                        'file_type' => $fileType,
                        'file_size' => $fileSize,
                        'uploaded_by' => auth()->id(),
                    ]);
                }
            }
        }
    }
}
