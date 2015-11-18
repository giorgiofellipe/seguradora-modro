<?php

namespace Faderim\Ext\Field;

/**
 *
 * @author Maicon Sasse
 */
class TypeFieldListTree extends TypeField
{

    /**
     * @var \Faderim\Ext\Store\TreeStore
     */
    private $Store = null;

    public function __construct($name)
    {
        parent::__construct($name);
        $this->setSelectChildren(false);
        $this->setCanSelectFolders(true);
    }

    public function getExtType()
    {
        return 'Faderim.form.field.ListTree';
    }

    /**
     * @return \Faderim\Ext\Store\TreeStore
     */
    public function getLocalStore()
    {
        return $this->getTreeStore();
    }

    /**
     * @return \Faderim\Ext\Store\TreeStore
     */
    public function getTreeStore()
    {
        if (null == $this->Store) {
            $this->Store = new \Faderim\Ext\Store\TreeStore();
            $this->setCustomProperty('store', $this->Store);
        }
        return $this->Store;
    }

    public function setSelectChildren($selectChildren)
    {
        $this->setCustomProperty('selectChildren', $selectChildren);
    }

    public function setCanSelectFolders($canSelectFolders)
    {
        $this->setCustomProperty('canSelectFolders', $canSelectFolders);
    }

}
