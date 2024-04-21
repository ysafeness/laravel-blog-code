<?php
use Illuminate\Support\Str;
/**
 * 返回可读性更好的文件尺寸
 */
function human_filesize($bytes,$decimals = 2)
{
    $size = ['B', 'KB', 'MB', 'GB', 'TB', 'PB'];
    $factor = floor((strlen($bytes) - 1) / 3);
    return sprintf("%.{$decimals}f",$bytes / pow(1024,$factor)).@$size[$factor];
}
/**
 * 判断文件的MIME类型是否位图片
 */
function is_image($mimeType)
{
    return Str::startsWith($mimeType,'image/');
}
/**
 * return "checked" if true
 */
function checked($value)
{
    return $value?'checked':'';
}
/**
 * return img url for headers
 */
function page_image($value = null)
{
    if(empty($value))
    {
        $value = config('blog.page_image');
    }
    if(! Str::startsWith($value,'http') && $value[0]!=='/')
    {
        $value = config('blog.uploads.webpath') . '/' . $value;
    }
    return $value;
}