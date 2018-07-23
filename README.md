Property Resolver
=================

Example
-------

```php
class Person
{
    public $firstName;
    public $lastName;
}

$resolver = new PropertyResolver;
$result = $resolver->resolve($person, 'firstName');

```


