<?php

namespace Ihsan\UsernameGenerator\Generator;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
class IslamicUsernameGenerator extends AbstractGenerator
{
    private $reservedNames = array(
        'MUHAMMAD' => 'MUH',
        'MUHAMAD' => 'MUH',
        'MOHAMMAD' => 'MOH',
        'MOHAMAD' => 'MOH',
        'MUCHAMMAD' => 'MUC',
        'MUCHAMAD' => 'MUC',
        'MOCHAMMAD' => 'MOC',
        'MOCHAMAD' => 'MOC',
        'MUHAMMAT' => 'MUH',
        'MUHAMAT' => 'MUH',
        'MOHAMMAT' => 'MOH',
        'MOHAMAT' => 'MOH',
        'MUCHAMMAT' => 'MUC',
        'MUCHAMAT' => 'MUC',
        'MOCHAMMAT' => 'MOC',
        'MOCHAMAT' => 'MOC',
        'MOH' => 'MOH',
        'MOCH' => 'MOC',
        'AHMAD' => 'AHM',
        'ACHMAD' => 'ACH',
        'AHMAT' => 'AHM',
        'ACHMAT' => 'ACH',
        'SITI' => 'SIT',
        'NUR' => 'NUR',
        'ABDUL' => 'ABD',
    );

    /**
     * @param string $fullName
     * @param int    $limit
     *
     * @return array
     */
    public function genarate($fullName, $limit = 8)
    {
        $original = str_replace(' ', '', $fullName);
        if ($limit > strlen($original)) {
            return array();
        }

        if (-1 === $index = $this->isReservedName($fullName)) {
            return array();
        }

        $temp = explode(' ', strtoupper($fullName));
        if (2 > count($temp)) {
            return array();
        }

        $temp[$index] = $this->reservedNames[$temp[$index]];
        $fullName = implode('', $temp);
        if ($limit > strlen($fullName)) {
            $fullName = $original;
        } else {
            $original = $temp[$index];
        }

        return $this->shift($fullName, $original);
    }

    /**
     * @param string $fullName
     *
     * @return int
     */
    public function isReservedName($fullName)
    {
        $temp = explode(' ', strtoupper($fullName));
        if (in_array($temp[0], array_keys($this->reservedNames))) {
            return 0;
        }

        return -1;
    }
}
