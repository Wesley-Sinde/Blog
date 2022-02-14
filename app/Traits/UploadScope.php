<?php
namespace App\Traits;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

trait UploadScope{

    protected function uploadImages(Request $request, $image_name)
    {
        $image = $request->file($image_name);
        $image_name = rand(4585, 9857).'.'.$image->getClientOriginalExtension();

        $image->move($this->folder_path, $image_name);

       /* if (config('custom.image_dimensions.'.$this->folder_name.'.main_image'))
            foreach (config('custom.image_dimensions.'.$this->folder_name.'.main_image') as $dimension) {

                // open and resize an image file
                $img = Image::make($this->folder_path.$image_name)->resize($dimension['width'], $dimension['height']);

                // save the same file as jpeg with default quality
                $img->save($this->folder_path.$dimension['width'].'_'.$dimension['height'].'_'.$image_name);
            }*/

        return $image_name;
    }

    protected function uploadFile(Request $request, $reg_no, $name , $file)
    {

        $file = $request->file($file);
        $file_name = rand(4585, 9857).'_'.$name.'.'.$file->getClientOriginalExtension();

        $file->move($this->folder_path.$reg_no, $file_name);

        return $file_name;
    }

    public function loadImage($image_name, $folder, $dimension = false, $options = [])
    {
        if ($image_name) {

            if (file_exists(public_path().DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.$folder.DIRECTORY_SEPARATOR.$image_name)) {

                if ($dimension) {
                    $image_name = $dimension.$image_name;
                }

                $img_html =  '<img src="'.asset('images/'.$folder.'/'.$image_name).'" ';

                if (!empty($options)) {
                    foreach ($options as $key => $option) {
                        $img_html .= $key.'="'.$option.'" ';
                    }
                }

                $img_html .= ' />';

                return $img_html;


            } else
                return '<p>No Image in folder.</p>';


        } else
            return '<p>No Image</p>';
    }
}