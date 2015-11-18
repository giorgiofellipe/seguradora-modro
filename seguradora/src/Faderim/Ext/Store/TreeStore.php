<?php

namespace Faderim\Ext\Store;

/**
 * Description of TreeStore
 *
 * @author Maicon Sasse
 */
class TreeStore extends BaseStore
{

    public function getTypeStore()
    {
        return 'Tree';
    }

    /**
     *
     * @return \Faderim\Ext\TreeNode
     */
    public function getRoot()
    {
        if (!$this->getProperty('root')) {
            $this->setRoot(new \Faderim\Ext\TreeNode('root', 'Root'));
        }
        return $this->getProperty('root');
    }

    public function setRoot(\Faderim\Ext\TreeNode $root)
    {
        $this->setProperty('root', $root);
    }

}
