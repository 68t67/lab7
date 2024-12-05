<?php
class Animal {
    public $name;
    
    public function __construct($name) {
        $this->name = $name;
    }

    public function makeSound() {
        return "Some sound";
    }
}

class Dog extends Animal {
    public function makeSound() {
        return "Bark!";
    }
}

class Cat extends Animal {
    public function makeSound() {
        return "Meow!";
    }
}

$dog = new Dog("Buddy");

$cat = new Cat("Whiskers");

echo "Класс объекта \$dog: " . get_class($dog) . "<br>"; // Ожидается: Dog
echo "Класс объекта \$cat: " . get_class($cat) . "<br>"; // Ожидается: Cat

echo $dog->name . " издает звук: " . $dog->makeSound() . "<br>"; // Ожидается: "Buddy издает звук: Bark!"
echo $cat->name . " издает звук: " . $cat->makeSound() . "<br>"; // Ожидается: "Whiskers издает звук: Meow!"
?>
