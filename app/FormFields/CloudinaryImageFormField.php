<?php

namespace App\FormFields;

use TCG\Voyager\FormFields\AbstractHandler;

class CloudinaryImageFormField extends AbstractHandler
{
    protected $codename = 'cloudinary_image';

    public function createContent($row, $dataType, $dataTypeContent, $options)
    {
        return view('vendor.voyager.formfields.cloudinary_image', [
            'row' => $row,
            'dataType' => $dataType,
            'dataTypeContent' => $dataTypeContent,
            'options' => $options,
        ]);
    }
}
