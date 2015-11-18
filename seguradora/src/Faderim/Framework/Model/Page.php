<?php

namespace Faderim\Framework\Model;

/**
 * Description of Page
 *
 * @author Ricardo Schroeder
 * @Entity(repositoryClass="Faderim\Framework\Repository\PageRepository")
 * @Table(name="faderim_page")
 */
class Page
{

    /**
     * @Id
     * @Column(type="string",name="page_name",length=50)
     */
    protected $name;

    /**
     * @Column(type="string",name="page_title",length=255)
     */
    protected $title;

    /**
     * @ManyToOne(targetEntity="System", inversedBy="pages")
     * @JoinColumn(name="system_id", referencedColumnName="system_id",nullable=false)
     */
    protected $system;

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getSystem()
    {
        return $this->system;
    }

    public function setSystem($system)
    {
        $this->system = $system;
    }

}
