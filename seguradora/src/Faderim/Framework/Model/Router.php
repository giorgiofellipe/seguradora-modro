<?php

namespace Faderim\Framework\Model;

/**
 * Description of Page
 *
 * @author Ricardo Schroeder
 * @Entity(repositoryClass="Faderim\Framework\Repository\RouterRepository")
 * @Table(name="faderim_router")
 */
class Router
{

    /**
     * @Id
     * @Column(type="string",name="router_name",length=50)
     */
    protected $name;

    /**
     * @Column(type="string",name="router_title",length=255)
     */
    protected $title;

    /**
     * @ManyToOne(targetEntity="Page", inversedBy="routers")
     * @JoinColumn(name="page_name", referencedColumnName="page_name",nullable=false)
     */
    protected $page;

    /**
     * @Column(type="string",name="router_controller",length=255,nullable=true)
     */
    protected $controllerName;

    /**
     * @Column(type="string",name="router_path",length=255,nullable=true)
     */
    protected $path;
    protected $params;

    /**
     *
     * @var \Faderim\Core\FaderimReflectionClass
     */
    protected $instanceController;

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

    /**
     *
     * @return Page
     */
    public function getPage()
    {
        return $this->page;
    }

    public function setPage($page)
    {
        $this->page = $page;
    }

    public function getControllerName()
    {
        return $this->controllerName;
    }

    public function setControllerName($controllerName)
    {
        $this->controllerName = $controllerName;
    }

    /**
     *
     * @return \Faderim\Core\FaderimReflectionClass
     */
    public function getInstanceController()
    {
        if (empty($this->controllerName)) {
            return null;
        }
        if (!isset($this->instanceController)) {
            $this->instanceController = $this->getNewInstanceController();
        }
        return $this->instanceController;
    }

    public function getNewInstanceController()
    {
        return new \Faderim\Core\FaderimReflectionClass($this->controllerName);
    }

    public function getPath()
    {
        return $this->path;
    }

    public function setPath($path)
    {
        $this->path = $path;
    }

    public function match($id)
    {
        $regularExpression = preg_replace('/(\\\{\w+\\\})/', '(\w+)', preg_quote($this->path, '/'));
        if (preg_match('/^' . $regularExpression . '\/?$/', $id, $this->params)) {
            array_shift($this->params);
            return true;
        }
        return false;
    }

    public function getLink($params)
    {
        return preg_replace_callback('/({(\w+)})/', function($match) use ($params) {
            $var = $match[2];
            return (isset($params[$var]) ? $params[$var] : null);
        }, $this->getPath());
    }

    public function getParams()
    {
        return $this->params;
    }

    public static function link($dir)
    {
        return ($_SERVER['SCRIPT_NAME']) . (substr($dir, 0, 1) == '/' ? $dir : '/' . $dir);
    }

}
