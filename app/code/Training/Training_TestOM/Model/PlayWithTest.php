<?php
/**
 * Created by PhpStorm.
 * User: pavelmelnichuk
 * Date: 5/6/19
 * Time: 8:37 PM
 */

namespace Training\Training_TestOM\Model;


class PlayWithTest
{
    private $testObject;
    private $testObjectFactory;
    private $manager;
    public function __construct(
        \Training\Training_TestOM\Model\Test $testObject,
        \Training\Training_TestOM\Model\TestFactory $testObjectFactory,
        \Training\Training_TestOM\Model\ManagerCustomImplementation $manager
    ) {
        $this->testObject = $testObject;
        $this->testObjectFactory = $testObjectFactory;
        $this->manager = $manager;
    }
    public function run()
    {
        // test object with constructor arguments managed by di.xml
        $this->testObject->log();
        // test object with custom constructor arguments
        // some arguments are defined here, others - from di.xml
        $customArrayList = ['item1' => 'aaaaa', 'item2' => 'bbbbb'];
        $newTestObject = $this->testObjectFactory->create([
            'arrayList' => $customArrayList,
            'manager' => $this->manager
        ]);
        $newTestObject->log();
    }

}