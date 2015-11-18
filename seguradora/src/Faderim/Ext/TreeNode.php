<?php

namespace Faderim\Ext;

/**
 * Description of TreeNode
 *
 * @author Ricardo
 */
class TreeNode implements \Faderim\Json\JsonSerializable
{

    private $title;
    private $name;
    private $children = Array();
    private $checked = null;
    private $value = null;
    private $expanded = false;
    private $parent;

    public function __construct($name, $title)
    {
        $this->value = $name;
        $this->title = $title;
        $this->setName($name);
    }

    public function addNode(TreeNode $oNode)
    {
        $this->children[] = $oNode;
        $oNode->setParent($this);
    }

    /**
     *
     * @param type $sTitle
     * @return TreeNode
     */
    public function newNode($sId, $sTitle)
    {
        $oChild = new TreeNode($sId, $sTitle);
        $this->addNode($oChild);
        return $oChild;
    }

    public function getArrayFormat()
    {
        $result = array();
        $result['name'] = $this->getName();
        $result['value'] = $this->getValue();
        $result['expanded'] = $this->getExpanded();
        $result['text'] = $this->title;
        if ($this->getChecked() !== null) {
            $result['checked'] = $this->getChecked();
        }
        $result['leaf'] = (count($this->children) == 0);
        $result['children'] = $this->children;
        return $result;
    }

    public function getJsonFormat()
    {
        return \Faderim\Json\Json::encode($this->getArrayFormat());
    }

    public function getChecked()
    {
        return $this->checked;
    }

    public function setChecked($checked)
    {
        $this->checked = $checked;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function setValue($value)
    {
        $this->value = $value;
    }

    public function getChildren()
    {
        return $this->children;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function find($name)
    {
        $node = null;
        if ($this->getName() == $name) {
            $node = $this;
        } else if (count($this->children) > 0) {
            foreach ($this->getChildren() as $nodeChild) {
                $node = $nodeChild->find($name);
                if ($node !== null) {
                    break;
                }
            }
        }
        return $node;
    }

    public function getExpanded()
    {
        return $this->expanded;
    }

    public function setExpanded($expanded)
    {
        $this->expanded = $expanded;
    }

    public function getParent()
    {
        return $this->parent;
    }

    public function setParent($parent)
    {
        $this->parent = $parent;
    }

}
