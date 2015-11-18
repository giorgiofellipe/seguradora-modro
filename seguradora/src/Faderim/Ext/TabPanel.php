<?php

namespace Faderim\Ext;

/**
 * Description of TabPanel
 *
 * @author Ricardo
 */
class TabPanel extends Panel
{

    public function __construct($name = null)
    {
        $this->setDeferredRender(false);
        parent::__construct($name);
    }

    /**
     * Quando verdade o conteudo da aba somente será rederizado quando a aba for selecionada
     * @param bool $deferredRender
     */
    public function setDeferredRender($deferredRender = true)
    {
        $this->setProperty('deferredRender', $deferredRender);
    }

    protected function getExtClassName()
    {
        return 'Ext.tab.Panel';
    }

}
