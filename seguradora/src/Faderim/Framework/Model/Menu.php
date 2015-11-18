<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Faderim\Framework\Model;

/**
 * Description of Menu
 * @Entity(repositoryClass="Faderim\Framework\Repository\MenuRepository")
 * @Table(name="faderim_menu")
 * @author Ricardo Schroeder
 */
class Menu
{

    /**
     * @ManyToOne(targetEntity="System",inversedBy="menus")
     * @JoinColumn(name="system_id", referencedColumnName="system_id")
     * @Id
     * @var System
     */
    protected $system;

    /**
     * @Id
     * @Column(type="smallint", name="menu_id")
     * @var int 
     */
    protected $id;

    /**
     * @Column(type="string", length=50, name="menu_name")
     * @var string 
     */
    protected $name;

    /**
     * @ManyToOne(targetEntity="Router")
     * @JoinColumn(name="router_name", referencedColumnName="router_name")
     * @var Router 
     */
    protected $router;

    /**
     * @ManyToOne(targetEntity="Menu", inversedBy="children")
     * @JoinColumns({@JoinColumn(name="system_id", referencedColumnName="system_id"),@JoinColumn(name="parent_id", referencedColumnName="menu_id")})
     * @var Menu
     */
    protected $parent;
    
    /**
     * @OneToMany(targetEntity="Menu", mappedBy="parent")
     * @var Menu[]
     */
    protected $children;
    
    public function getSystem()
    {
        return $this->system;
    }

    public function setSystem(System $system)
    {
        $this->system = $system;
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

    public function getRouter()
    {
        return $this->router;
    }

    public function setRouter(Router $router)
    {
        $this->router = $router;
    }

    public function getParent()
    {
        return $this->parent;
    }

    public function setParent(Menu $parent)
    {
        $this->parent = $parent;
    }

    public function getChildren()
    {
        return $this->children;
    }

    public function setChildren(Array $children)
    {
        $this->children = $children;
    }



}
