<?php
use Illuminate\Support\Facades\Storage;

if (!function_exists('sortVal')) {
    function sortVal()
    {
        return 'Sort Val Function';
    }
}

/**
 * 初始化檔案名稱
 *
 * @return string 檔案路徑
 * */
if (!function_exists('generateFileName')) {
    function saveFile($file, $callable = null, $path = '', $local = 'media')
    {

        $prefixPath = Storage::disk('media')->getAdapter()->getPathPrefix();
        $fileType = preg_split('/\//', $file->getClientMimeType())[1];
        $fileName = sprintf('%s-%d.%s', Str::random(10), $file->getSize(), $fileType);
        $filePath = sprintf('%s%s', $prefixPath, $path);
        $file->move($filePath, $fileName);
        $fullPath = sprintf('%s/%s', $filePath, $fileName);
        if (is_callable($callable)) {
            $callable($fullPath);
        }

        return $fullPath;
    }
}
