<?php

namespace Faderim\Core;

/**
 * Description of GridJsonResponse
 *
 * @author Ricardo Schroeder
 */
class GridJsonResponse
{

    private $start;
    private $limit;

    /**
     *
     * @var ContainerFiltroGrid
     */
    private $filters;
    private $orders;
    private $fields = Array();
    private $Query;

    public function setParameterFromRequest(\Faderim\Core\HttpRequest $request)
    {
        $this->setStart($request->getParameter('start'));
        $this->setLimit($request->getParameter('limit'));
        $this->setOrders($request->getJsonParameter('sort', Array()));
    }

    public function setFilters($filter)
    {
        $this->filters = $filter;
    }

    public function getFilters()
    {
        if (!isset($this->filters)) {
            $this->filters = new ContainerFiltroGrid();
        }
        return $this->filters;
    }

    public function setOrders(Array $orders)
    {
        $this->orders = $orders;
    }

    public function getQuery()
    {
        return $this->Query;
    }

    public function setQuery(\Doctrine\ORM\QueryBuilder $Query)
    {
        $this->Query = $Query;
        $this->createFilters();
        $this->createOrders();
    }

    protected function createFilters()
    {
        $alias = $this->Query->getRootAlias();
        foreach ($this->filters->getFiltros() as $filter) {
            $field = $filter->getNome();
            $operator = $filter->getOperador();
            $val = $filter->getValor();
            $bindName = str_replace('/', '', $field);
            /* @var $fieldObject \Faderim\Ext\Field\GridField */
            $fieldObject = $this->getFieldByName($field);
            if (strpos($field, '/') !== false) {
                $colName = str_replace('/', '.', $field);
            } else {
                $colName = $alias . '.' . $field;
            }
            //condição like para quando for um campo texto
            if ($fieldObject->getType() == \Faderim\Ext\Field\TypeField::TYPE_TEXT) {
                $operator = 'LIKE';
            }
            if ($operator == 'LIKE') {
                $val = strtolower('%' . str_replace(' ', '%%', $val) . '%');
                $colName = 'lower(' . $colName . ')';
            }
            $this->Query->andWhere($colName . ' ' . $operator . ' :' . $bindName);
            $this->Query->setParameter($bindName, $val);
        }
    }

    protected function getFieldByName($name)
    {
        foreach ($this->getFields() as $oField) {
            if ($oField->getName() == $name) {
                return $oField;
            }
        }
        return false;
    }

    protected function createOrders()
    {
        $alias = $this->Query->getRootAlias();
        foreach ($this->orders as $filter) {
            $colName = $filter['property'];
            $direction = $filter['direction'];
            //trata nome da coluna para quando a origem da informação é de um JOIN
            if (strpos($colName, '/') !== false) {
                $colName = str_replace('/', '.', $colName);
            } else {
                $colName = $alias . '.' . $colName;
            }
            $this->Query->addOrderBy($colName, $direction);
        }
    }

    public function getStart()
    {
        return $this->start;
    }

    public function setStart($start)
    {
        $this->start = $start;
    }

    public function getLimit()
    {
        return $this->limit;
    }

    public function setLimit($limit)
    {
        $this->limit = $limit;
    }

    public function getLimitedQuery()
    {
        $query = $this->getQuery();
        $query->setFirstResult($this->start);
        if ($this->limit > 0) {
            $query->setMaxResults($this->limit);
        }
        if ($query instanceof \Doctrine\ORM\QueryBuilder) {
            return $query->getQuery();
        }
        return $query;
    }

    private function getPaginator()
    {
        $query = $this->getLimitedQuery();
        $paginator = new \Doctrine\ORM\Tools\Pagination\Paginator($query, false);
        return $paginator;
    }

    private function addFieldInRow(Array &$row, Array $fields, $currentModel)
    {
        foreach ($fields as $oField) {
            if ($oField instanceof \Faderim\Ext\Field\GroupField) {
                $this->addFieldInRow($row, $oField->getChilds(), $currentModel);
            } else {
                $sProp = $oField->getName();
                if (is_array($currentModel)) {
                    if (isset($currentModel[$sProp])) {
                        $value = $currentModel[$sProp];
                    } else {
                        $value = \Faderim\Bean\ModelBean::getModelProperty($currentModel[0], $sProp);
                    }
                } else {
                    $value = \Faderim\Bean\ModelBean::getModelProperty($currentModel, $sProp);
                }
                $value = $oField->getTypeField()->parseSetModelValue($value);
                $row[$sProp] = $value;
            }
        }
    }

    public function getResponse()
    {
        $data = Array();
        $paginator = $this->getPaginator();
        $result = $paginator->getQuery()->getResult();
        foreach ($result as $currentModel) {
            $currentData = Array();
            $this->addFieldInRow($currentData, $this->getFields(), $currentModel);
            $data[] = $currentData;
        }
        $total = count($paginator);
        return new \Faderim\Core\JsonResponse(Array('rows' => $data, 'total' => $total));
    }

    public function getFields()
    {
        return $this->fields;
    }

    public function setFields($fields)
    {
        $this->fields = $fields;
    }

}
