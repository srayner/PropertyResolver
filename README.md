Property Resolver
=================

A helper class to resolve if a property path exists and if so get it's value.

e.g. parent.addressHistory[4].town;

Example
-------

```php
class Person
{
    public $firstName;
    public $lastName;
    public $items = [];
}

class Item
{
    public $name;
    public $value;

    public function __construct($name, $value)
    {
        $this->name = $name;
        $this->value = $value;
    }
}

$person = new Person;
$person->firstName = 'Fred';
$person->lastName = 'Bloggs';
$person->items[] = new Item('Hat', 5);
$person->items[] = new Item('Coat', 7);

$item
$resolver = new PropertyResolver;
$result = $resolver->resolve($person, 'firstName');
$result = $resolver->resolve($person, 'items[0]');
$result = $resolver->resolve($person, 'items[2]');

```


