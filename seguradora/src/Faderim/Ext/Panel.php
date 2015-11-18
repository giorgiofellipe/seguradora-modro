<?php

namespace Faderim\Ext;

/**
 * Description of TabPanel
 *
 * @author Ricardo
 */
class Panel extends Container
{

    const REGION_CENTER = 'center';
    const REGION_NORTH = 'north';
    const REGION_SOUTH = 'south';

    public function setRegion($region)
    {
        $this->setProperty('region', $region);
    }

    public function setSplit($bSplit)
    {
        $this->setProperty('split', (bool) $bSplit);
    }

    public function setCollapsible($collapse)
    {
        $this->setProperty('collapsible', (bool) $collapse);
    }

    protected function getExtClassName()
    {
        return 'Ext.Panel';
    }

}

