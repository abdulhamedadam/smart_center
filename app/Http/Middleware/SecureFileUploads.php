<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Symfony\Component\HttpFoundation\Response;

class SecureFileUploads
{
    private const DEFAULT_MAX_KB = 204800;
    private const DEFAULT_MAX_FILES = 20;

    private const BLOCKED_EXTENSIONS = [
        'php',
        'php3',
        'php4',
        'php5',
        'php7',
        'php8',
        'phtml',
        'phar',
        'pht',
        'cgi',
        'pl',
        'py',
        'rb',
        'sh',
        'bash',
        'bat',
        'cmd',
        'com',
        'exe',
        'dll',
        'msi',
        'jar',
        'jsp',
        'asp',
        'aspx',
        'htaccess',
        'ini',
        'env',
        'js',
        'mjs',
        'cjs',
        'svg',
        'xml',
        'xhtml',
    ];

    private const ALLOWED_MIME_BY_EXTENSION = [
        'jpg' => ['image/jpeg'],
        'jpeg' => ['image/jpeg'],
        'png' => ['image/png'],
        'gif' => ['image/gif'],
        'webp' => ['image/webp'],
        'pdf' => ['application/pdf', 'application/x-pdf'],
        'doc' => ['application/msword'],
        'docx' => ['application/vnd.openxmlformats-officedocument.wordprocessingml.document'],
        'xls' => ['application/vnd.ms-excel'],
        'xlsx' => ['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'],
        'ppt' => ['application/vnd.ms-powerpoint'],
        'pptx' => ['application/vnd.openxmlformats-officedocument.presentationml.presentation'],
        'csv' => ['text/csv', 'text/plain', 'application/csv', 'application/vnd.ms-excel'],
        'txt' => ['text/plain'],
        'zip' => ['application/zip', 'application/x-zip-compressed'],
        'rar' => ['application/vnd.rar', 'application/x-rar-compressed'],
        'mp4' => ['video/mp4'],
        'mov' => ['video/quicktime'],
    ];

    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->files->count()) {
            return $next($request);
        }

        $maxKb = (int) env('UPLOAD_MAX_KB', self::DEFAULT_MAX_KB);
        $maxFiles = (int) env('UPLOAD_MAX_FILES', self::DEFAULT_MAX_FILES);

        $files = $this->flattenFiles($request->allFiles());

        if (count($files) > $maxFiles) {
            return $this->reject($request, __('Too many files uploaded.'));
        }

        foreach ($files as $file) {
            if (! $file instanceof UploadedFile) {
                continue;
            }

            if (! $file->isValid()) {
                return $this->reject($request, __('Invalid file upload.'));
            }

            $size = $file->getSize();
            if (! is_int($size) || $size <= 0) {
                return $this->reject($request, __('Invalid file upload.'));
            }

            if ($size > ($maxKb * 1024)) {
                return $this->reject($request, __('File is too large.'));
            }

            $originalName = (string) $file->getClientOriginalName();
            if (! $this->isSafeOriginalName($originalName)) {
                return $this->reject($request, __('Invalid file name.'));
            }

            $extension = strtolower((string) $file->getClientOriginalExtension());
            if ($extension === '' || in_array($extension, self::BLOCKED_EXTENSIONS, true)) {
                return $this->reject($request, __('This file type is not allowed.'));
            }

            if (! array_key_exists($extension, self::ALLOWED_MIME_BY_EXTENSION)) {
                return $this->reject($request, __('This file type is not allowed.'));
            }

            $serverMime = strtolower((string) ($file->getMimeType() ?? ''));
            $clientMime = strtolower((string) ($file->getClientMimeType() ?? ''));

            if (! $this->matchesAllowedMime($extension, $serverMime, $clientMime)) {
                return $this->reject($request, __('This file type is not allowed.'));
            }

            if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'webp'], true)) {
                $imageInfo = @getimagesize($file->getRealPath());
                if ($imageInfo === false) {
                    return $this->reject($request, __('Invalid image file.'));
                }
            }
        }

        return $next($request);
    }

    private function matchesAllowedMime(string $extension, string $serverMime, string $clientMime): bool
    {
        $allowed = self::ALLOWED_MIME_BY_EXTENSION[$extension] ?? [];

        $serverOk = $serverMime !== '' && in_array($serverMime, $allowed, true);
        $clientOk = $clientMime !== '' && in_array($clientMime, $allowed, true);

        return $serverOk || $clientOk;
    }

    private function isSafeOriginalName(string $originalName): bool
    {
        if ($originalName === '' || strlen($originalName) > 180) {
            return false;
        }

        if (str_contains($originalName, "\0")) {
            return false;
        }

        if (str_contains($originalName, '/') || str_contains($originalName, '\\')) {
            return false;
        }

        if (str_contains($originalName, '..')) {
            return false;
        }

        $lower = strtolower($originalName);

        if (preg_match('/\.(php\d?|phtml|phar|pht|cgi|pl|py|rb|sh|bash|bat|cmd|com|exe|dll|msi|jar|jsp|asp|aspx)(\.|$)/', $lower)) {
            return false;
        }

        $parts = array_values(array_filter(explode('.', $lower), static fn ($p) => $p !== ''));
        if (count($parts) < 2) {
            return false;
        }

        foreach ($parts as $part) {
            if (in_array($part, self::BLOCKED_EXTENSIONS, true)) {
                return false;
            }
        }

        return (bool) preg_match('/^[A-Za-z0-9][A-Za-z0-9 _.\-()]{0,179}$/', $originalName);
    }

    private function flattenFiles(array $files): array
    {
        $flat = [];

        foreach ($files as $value) {
            if ($value instanceof UploadedFile) {
                $flat[] = $value;
                continue;
            }

            if (is_array($value)) {
                $flat = array_merge($flat, $this->flattenFiles($value));
            }
        }

        return $flat;
    }

    private function reject(Request $request, string $message): Response
    {
        if ($request->expectsJson()) {
            return response()->json(['message' => $message], 422);
        }

        return response($message, 422);
    }
}

