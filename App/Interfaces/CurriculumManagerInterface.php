<?php

namespace App\Interfaces ;

interface CurriculumManagerInterface
{
    public function modifyCurrriculum($data = []) : array;
    public function addPhoto($photoPath);
    public function modifyPhoto($photoPath);
    public function removePhoto();
    public function downloadCurriculum();
}