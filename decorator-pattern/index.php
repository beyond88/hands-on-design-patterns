<?php 
namespace DesignPattern\Decorator\Example;

interface FoodItem
{
    /**
     * Calculate food item cost
     * 
     */
    public function cost();
}

/**
 * Calculate burger price
 * 
 * @package     DesignPattern
 * @subpackage  Decorator
 * @author      Mohiuddin Abdul Kader <muhin.cse.diu@gmail.com>
 */
class Burger implements FoodItem
{

    /**
     * Calculate food item cost
     * 
     * @param none
     * @return int|float
     */
    public function cost()
    {
        return 4;
    }
}

/**
 * Calculate chees price
 * 
 * @package     DesignPattern
 * @subpackage  Decorator
 * @author      Mohiuddin Abdul Kader <muhin.cse.diu@gmail.com>
 */
class Chees implements FoodItem
{
    /**
     * @var $item
     */
    private $item;

    /**
     * Assign parent class object
     * 
     * @param string $item
     * @return void
     */
    public function __construct(FoodItem $item)
    {
        $this->item = $item;
    }

    /**
     * Calculate chees price
     * 
     * @return int|float
     */
    public function cost()
    {
        return $this->item->cost() + 0.25;
    }
}

/**
 * Calculate chees price
 * 
 * @package     DesignPattern
 * @subpackage  Decorator
 * @author      Mohiuddin Abdul Kader <muhin.cse.diu@gmail.com>
 */
class Patty implements FoodItem
{
    /**
     * @var $item
     */
    private $item;

    /**
     * Assign parent class object
     * 
     * @param string $item
     * @return void
     */
    public function __construct(FoodItem $item)
    {
        $this->item = $item;
    }

    /**
     * Calculate patty price
     * 
     * @return int|float
     */
    public function cost()
    {
        return $this->item->cost() + 1;
    }
}

$burger = new Burger();
$chees = new Chees($burger); // passing burger
$patty = new Patty($burger); // passing burger
$patty_chees = new Patty($patty); // passing chees burger

