<?php

namespace Faderim\Framework\View\Template;

use Faderim\Core\AbstractTemplateView;
use Faderim\Framework\View\Form\IndexForm;

/**
 * Description of IndexTemplate
 *
 * @author Ricardo Schroeder
 */
class IndexTemplate extends AbstractTemplateView
{

    /**
     *
     * @var IndexForm
     */
    private $indexForm;

    protected function createChilds()
    {
        $this->indexForm = new IndexForm();
        $this->setParameter('viewport', $this->indexForm);
    }

    public function setSystems(Array $systems)
    {
        $this->indexForm->setSystems($systems);
    }

    protected function getTemplateName()
    {
        return 'Faderim::Framework::index';
    }

}
