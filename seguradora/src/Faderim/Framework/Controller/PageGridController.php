<?php
namespace Faderim\Framework\Controller;

/**
 * Description of SystemGridController
 *
 * @author Ricardo Schroeder
 */
class PageGridController extends BaseGridController
{

    public function createGridAction()
    {
        $oView = new \Faderim\Framework\View\Grid\PageGrid();
        return $oView;
    }

    protected function getRepositoryName()
    {
        return 'Faderim\Framework\Model\Page';
    }
}