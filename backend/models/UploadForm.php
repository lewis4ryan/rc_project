<?php
namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

class UploadForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $imageFile;
    public $url;
    public $renamed;

    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, gif', 'maxSize'=>1024 * 1024 * 5],
        ];
    }

    public function randomFileName($fileUpload){
        if (!empty($fileUpload)) {
            $rnd = rand(0,9999).date('ymdhis');
            $filename = "{$rnd}-{$fileUpload}";
            return $filename;
        }
        else{
            return '';
        }
    }

    public function upload()
    {
        if ($this->validate()) {
            $name = preg_replace("/[^a-zA-Z0-9]/", "", $this->imageFile->baseName).'.'.$this->imageFile->extension;
            //$name = $this->imageFile->baseName.'.'.$this->imageFile->extension;
            while (file_exists($this->url.'/'.$name)){
                $name=$this->randomFileName($name);
            }
            $this->imageFile->saveAs($this->url.'/'.$name);
            $this->renamed=$name;
            return true;
        } else {
            return false;
        }
    }
}