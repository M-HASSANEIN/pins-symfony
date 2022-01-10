<?php

namespace App\EventListener;

use Vich\UploaderBundle\Event\Event;
use Vich\UploaderBundle\Handler\UploadHandler;

class RemoveFile
{

    private $uploadHandler;
    public function __construct(UploadHandler $uploadHandler)
    {
        $this->uploadHandler = $uploadHandler;
    }

    public function onVichUploaderPreUpload(Event $event)
    {
        $object = $event->getObject();
       
        $mapping = $event->getMapping();

        $this->uploadHandler->remove($object, 'imageFile');
    }
}