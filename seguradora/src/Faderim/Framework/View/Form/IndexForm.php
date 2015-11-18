<?php

namespace Faderim\Framework\View\Form;

use Faderim\Ext\AbstractViewPort;
use Faderim\Ext\TabPanel;
use Faderim\Ext\TreePanel;

/**
 * Description of IndexForm
 *
 * @author Ricardo Schroeder
 */
class IndexForm extends AbstractViewPort
{

    private $sidePanel;
    private $tabPanel;
    private $teste;

    protected function setDefaultProperties()
    {
        parent::setDefaultProperties();
        $this->setLayout(self::LAYOUT_BORDER);
    }

    protected function createTabPanel()
    {
        $this->tabPanel = new TabPanel('tab_menu');
        $this->tabPanel->setRegion('center');
        $this->tabPanel->setMargins(0, 0, 5);

        //$oTab->addChild($this->teste);
        //$this->tabPanel->addChild(new \Ponto\View\Grid\FeriadoGrid());
        //$this->tabPanel->addChild(new \Ponto\View\Grid\SetorGrid());
        //$this->tabPanel->addChild(new \Ponto\View\Grid\FuncionarioGrid());
        //$oTab->addChild(new \Faderim\Framework\View\Form\SystemForm());
        //$oTab->addChild(new \Faderim\Framework\View\Grid\SystemGrid());
        //$oTab->addChild(new \Faderim\Framework\View\Grid\PageGrid());
        $this->addChild($this->tabPanel);
    }

    private function addChildsMenuTree($menus, \Faderim\Ext\TreeNode $node)
    {
        foreach ($menus as $menu) {
            $id = $menu->getRouter() ? $menu->getRouter()->getName() : $menu->getId();
            $oNode = new \Faderim\Ext\TreeNode($id, $menu->getName());
            $node->addNode($oNode);
            $this->addChildsMenuTree($menu->getChildren(), $oNode);
        }
    }

    /**
     *
     * @param \Faderim\Framework\Model\System[] $systems
     */
    public function setSystems(Array $systems)
    {
        foreach ($systems as $currentSystem) {
            $oTree = new TreePanel($currentSystem->getId());
            $oTree->setTitle($currentSystem->getName());
            $this->addChildsMenuTree($currentSystem->getMenus(), $oTree->getRoot());
            $this->sidePanel->addChild($oTree);
            $oTree->getListener()->onItemClick('clickArvore');
        }
    }

    protected function createMenuPanel()
    {
        $this->sidePanel = new \Faderim\Ext\Panel('lateral');
        $this->sidePanel->setRegion('west');
        $this->sidePanel->setWidth(200);
        $this->sidePanel->setCollapsible(true);
        $this->sidePanel->setSplit(true);
        $this->sidePanel->setMargins(0, 0, 5, 5);
        $this->sidePanel->setTitle('Menu');
        $this->sidePanel->setLayout('accordion');
        //$oTree = new TreePanel('tre');
        //$oTree->setTitle('Teste');
        //$this->sidePanel->addChild($oTree);

        $this->addChild($this->sidePanel);
    }

    protected function createChilds()
    {
        $this->createTabPanel();
        $this->createMenuPanel();
    }

    protected function getViewPortName()
    {
        return 'view_principal';
    }

}
