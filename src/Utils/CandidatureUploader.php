<?php

namespace App\Utils;

use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class CandidatureUploader
{

    private $targetDirectory;
    private $targetDirWeb;

    public function __construct($targetDirectory, $targetDirWeb)
    {
        $this->targetDirectory = $targetDirectory;
        $this->targetDirWeb = $targetDirWeb;
    }
    /**
     * @return mixed
     */
    public function getTargetDirectory()
    {
        return $this->targetDirectory;
    }


    /**
     * Generate a random namefile and move in the tartget directory
     *
     * @param UploadedFile $file
     * @return string
     */
    public function uploadFile(UploadedFile $file)
    {
       $filename = md5(uniqid()).".".$file->guessExtension();

       try{
           $file->move($this->getTargetDirectory(), $filename);
       }
       catch (FileException $fileException){
           $fileException->getMessage();
       }
       $filename = $this->targetDirWeb.$filename;

       return $filename;
    }
}