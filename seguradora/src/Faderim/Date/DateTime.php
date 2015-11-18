<?php

namespace Faderim\Date;

/**
 * Description of DateTime
 *
 * @author Ricardo Schroeder
 */
class DateTime
{

    private $object;

    const FORMAT_DATE = 'd/m/Y';
    const FORMAT_DATE_ISO = 'Y-m-d';
    const FORMAT_DATETIME = 'd/m/Y H:i:s';

    public function __construct($data = null)
    {
        if (!is_null($data)) {
            if ($data instanceof \DateTime) {
                $this->object = $data;
            } else {
                $this->setObjectFromString($data);
            }
        }
    }

    public function setObjectFromString($data)
    {
        $this->object = \DateTime::createFromFormat(self::FORMAT_DATETIME, $data . ' 12:00:00');
    }

    public function setDiaUtil($bConsideraSabado = false, $bConsideraDomingo = false, $bConsideraFeriado = false, $operation = '+')
    {
        $skiped = 0;
        while (!$this->isDiaUtil($bConsideraSabado, $bConsideraDomingo, $bConsideraFeriado)) {
            $this->modifyDay(1, $operation);
            $skiped++;
        }
        return $skiped;
    }

    public function modifyDay($dias, $operation = '+')
    {
        $this->object->modify($operation . $dias . 'day');
    }

    public function isDiaUtil($bConsideraSabado = false, $bConsideraDomingo = false, $bConsideraFeriado = false)
    {
        $dow = $this->format('N');
        if (($dow == 6 and $bConsideraSabado === false) or
                ($dow == 7 and $bConsideraDomingo === false) or
                ($bConsideraFeriado === false and $this->isFeriado())) {
            return false;
        }
        return true;
    }

    public function diferencaDiasUteis(DateTime $data, $bConsideraSabado = false, $bConsideraDomingo = false, $bConsideraFeriado = false)
    {
        $ts = $this->object->getTimestamp();
        $days = 0;
        //enquanto a data atual for menor que a comparada
        while ($data->object > $this->object) {
            //adiciona um dia
            $this->modifyDay(1);
            //caso o novo dia seja um dia
            if ($this->isDiaUtil($bConsideraSabado, $bConsideraDomingo, $bConsideraFeriado)) {
                $days++;
            }
        }
        $this->object->setTimestamp($ts);
        return $days;
    }

    public function addDiaUtil($dias, $bConsideraSabado = false, $bConsideraDomingo = false, $bConsideraFeriado = false)
    {
        $diasCorridos = 0;
        while ($dias > 0) {
            $diasCorridos++;
            $this->modifyDay(1);
            if ($this->isDiaUtil($bConsideraSabado, $bConsideraDomingo, $bConsideraFeriado))
                $dias--;
        }
        return $diasCorridos;
    }

    public function isFeriado()
    {
        return false;
    }

    public function format($formato = self::FORMAT_DATE)
    {
        return $this->object->format($formato);
    }

    public function getObject()
    {
        return $this->object;
    }

    public function setObject(\DateTime $object)
    {
        $this->object = $object;
    }

}
