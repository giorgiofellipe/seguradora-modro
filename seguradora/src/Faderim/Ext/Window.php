<?php

namespace Faderim\Ext;

class Window extends Panel
{

    public function setModal($modal)
    {
        $this->setProperty('modal', $modal);
    }

    protected function setDefaultProperties()
    {
        parent::setDefaultProperties();
        $this->setAutoShow(true);
        $this->setProperty('autoScroll', true);
    }

    public function setAutoShow($autoshow = TRUE)
    {
        $this->setProperty('autoShow', $autoshow);
    }

    public function setHtml($html)
    {
        $this->setProperty('html', $html);
    }

    protected function getExtClassName()
    {
        return 'Ext.Window';
    }

}

