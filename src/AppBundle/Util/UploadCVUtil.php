<?php
namespace AppBundle\Util;

use \Symfony\Component\HttpFoundation\File\File;

class UploadCVUtil
{
    const VALIDATE_EXTENSION = ["PDF", "doc", "docx"];

    const VALIDATE_SIZE = 2097152;

    const TARGET_DIR = "../uploads/";

    public static function checkFileExtension(File $file)
    {
        return in_array($file->guessExtension(), self::VALIDATE_EXTENSION);
    }

    public static function checkFileSize(File $file)
    {
        return $file->getSize() <= self::VALIDATE_SIZE;
    }
}