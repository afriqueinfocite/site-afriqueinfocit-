<?php

namespace AdminBundle\FileUploader;
/**
 * Description of FileUploader
 *
 * @author kramo
 */
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileUploader
{
    private $targetDir;

    public function __construct($targetDir)
    {
        $this->targetDir = $targetDir;
    }

    public function upload(UploadedFile $file)
    {
        $fileName =$file->getClientOriginalName();

        $file->move($this->targetDir, $fileName);

        return $fileName;
    }
}