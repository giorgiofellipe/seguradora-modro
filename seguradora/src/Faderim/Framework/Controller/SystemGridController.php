<?php
namespace Faderim\Framework\Controller;

/**
 * Description of SystemGridController
 *
 * @author Ricardo Schroeder
 */
class SystemGridController extends BaseGridController
{

    public function createGridAction()
    {
        $oView = new \Faderim\Framework\View\Grid\SystemGrid();
        return $oView;
    }

    protected function getRepositoryName()
    {
        return 'Faderim\Framework\Model\System';
    }
}