<?php

namespace Faderim\Ext;

/**
 * Description of TabPanel
 *
 * @author Ricardo
 */
class TreePanel extends Panel
{

    /**
     * @var TreeNode
     */
    private $Root;
    private $value;

    protected function setDefaultProperties()
    {
        $this->Root = new TreeNode('root_' . $this->getName(), 'Root');
        $this->setProperty('root', $this->Root);
        $this->setProperty('rootVisible', false);
        $this->setProperty('stateful', true);
        $this->setProperty('stateId', 'state' . $this->getName());
    }

    public function getRoot()
    {
        return $this->Root;
    }

    protected function getExtClassName()
    {
        return 'Faderim.TreeFormPanel';
    }

    public function getValue()
    {
        return $this->value;
    }

    public function setValue($value)
    {
        if (is_string($value)) {
            $value = json_decode($value);
        }
        $this->value = $value;
    }

    public function find($name)
    {
        return $this->getRoot()->find($name);
    }

    public function setSubmitSelection($submit = true)
    {
        $this->setProperty('submitSelection', $submit);
    }

    public function setNodesSelection($nodesName)
    {
        $this->setProperty('itensSelection', $nodesName);
    }

}
