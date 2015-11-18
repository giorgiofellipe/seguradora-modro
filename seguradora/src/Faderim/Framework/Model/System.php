<?php

namespace Faderim\Framework\Model;

/**
 * Description of System
 *
 * @author Ricardo Schroeder
 * @Entity(repositoryClass="Faderim\Framework\Repository\SystemRepository")
 * @Table(name="faderim_system")
 */
class System
{

    /**
     * @Id
     * @Column(type="string",length=25,name="system_id")
     * @var String
     */
    protected $id;

    /**
     * @Column(type="string",length=255,name="system_name")
     * @var String
     */
    protected $name;

    /**

     * @Column(type="text",name="system_description")
     * @var String
     */
    protected $description;

    /**
     * @Column(type="string",length=255,name="system_package")
     * @var String
     */
    protected $package;

    /**
     * @Column(type="boolean", nullable=true, name="system_enable")
     * @var type
     */
    protected $enable;

    /**
     * @OneToMany(targetEntity="Page", mappedBy="system")
     * @var Page[]
     */
    protected $pages;

    /**
     * @OneToMany(targetEntity="Menu", mappedBy="system")
     * @var Menu[]
     */
    protected $menus;

    public function __construct()
    {
        $this->pages = new \Doctrine\Common\Collections\ArrayCollection();
        $this->menus = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getPackage()
    {
        return $this->package;
    }

    public function setPackage($package)
    {
        $this->package = $package;
    }

    public function getEnable()
    {
        return $this->enable;
    }

    public function setEnable($enable)
    {
        $this->enable = $enable;
    }

    /**
     *
     * @return Page[]
     */
    public function getPages()
    {
        return $this->pages;
    }

    public function setPages(\Doctrine\Common\Collections\ArrayCollection $pages)
    {
        $this->pages = $pages;
    }

    /**
     *
     * @return Menu[]
     */
    public function getMenus()
    {
        return $this->menus;
    }

    public function setMenus(Array $menus)
    {
        $this->menus = $menus;
    }

}
