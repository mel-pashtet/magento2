<?php
/**
 * Created by PhpStorm.
 * User: pavelmelnichuk
 * Date: 5/6/19
 * Time: 7:14 PM
 */

namespace Training\Training_TestOM\Model;


class Test
{
    private $manager;
    private $arrayList;
    private $name;
    private $number;
    public function __construct(
        \Training\Training_TestOM\Model\ManagerInterface $manager,
        $name,
        int $number,
        array $arrayList
    ) {
        $this->manager = $manager;
        $this->name = $name;
        $this->number = $number;
        $this->arrayList = $arrayList;
    }

    public function log()
    {
        print_r(get_class($this->manager));
        echo '<br>';
        print_r($this->name);
        echo '<br>';
        print_r($this->number);
        echo '<br>';
        print_r($this->arrayList);
    }

}