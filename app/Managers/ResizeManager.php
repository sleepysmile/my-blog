<?php


namespace App\Managers;


use App\Interfaces\ImageContract;
use App\Traits\InstanceTrait;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Http\UploadedFile;
use Intervention\Image\ImageManager;

class ResizeManager
{
    use InstanceTrait;

    /** @var ImageContract  */
    public ImageContract $model;

    /** @var Filesystem|null  */
    protected ?Filesystem $storage = null;

    /** @var ImageManager  */
    protected ImageManager $imageManager;

    protected string $path;

    /**
     * @param ImageContract $model
     * @return ResizeManager
     */
    public function setModel(ImageContract $model): self
    {
        $this->model = $model;
        return $this;
    }

    /**
     * @param ImageManager $manager
     * @return ResizeManager
     */
    public function setImageManager(ImageManager $manager): self
    {
        $this->imageManager = $manager;
        return $this;
    }

    /**
     * @param Filesystem $storage
     * @return ResizeManager
     */
    public function setStorage(Filesystem $storage): self
    {
        $this->storage = $storage;
        return $this;
    }

    /**
     * @param string $path
     * @return ResizeManager
     */
    public function setPath(string $path): ResizeManager
    {
        $this->path = $path;
        return $this;
    }

    /**
     * @param UploadedFile $file
     * @return string
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function save(UploadedFile $file): string
    {
        $image = $this->imageManager->make($file->get());

        if (!$this->storage->exists($this->path)) {
            $this->storage->makeDirectory($this->path);
        }
        $uniqueName = uniqid();
        $filePath = '';

        foreach ($this->model->sizes() as $name => $size) {

            if ($size['width'] === false && $size['height'] === false) {
                $image->resize($size['width'], $size['height'], function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
            }

            $filePath = $this->path . $this->getSizeName($uniqueName . '.' . $file->getClientOriginalExtension(),  $name);
            $image->save($this->storage->path($filePath), 80);
        }

        return $filePath;
    }

    /**
     * @param string $path
     * @param string $size
     * @return string
     */
    public function getPathBySizeName(string $path, string $size = ''): string
    {
        return $this->getSizeName($path, $size);
    }

    /**
     * @param string $path
     * @param string $size
     * @return string
     */
    public function getPathByStorage(?string $path, string $size = ''): string
    {
        if ($path === null) {
            return '';
        }

        $fileName = $this->path . $this->getPathBySizeName($path, $size);

        if ($this->storage->exists($fileName)) {
            return $this->storage->url($fileName);
        }

        return '';
    }

    /**
     * @param string $fileName
     * @param string $sizeName
     * @return string
     */
    public function getSizeName(string $fileName, string $sizeName): string
    {
        $pathinfo = pathinfo($fileName);

        return $pathinfo['filename'] . $sizeName . '.' . $pathinfo['extension'];
    }

}
