# Phalsion Search

[![Build Status](https://travis-ci.org/phalsion/search.svg?branch=master)](https://travis-ci.org/phalsion/search)

### Intro
&nbsp;&nbsp;&nbsp;&nbsp;this repo is a sql builder base on phalcon which is a php's framework. 
it is aim to solve too many fields to handle for us.


### Tutorial

#### like
```php
class KeyWordSearch extends Search
{

    public function initialize()
    {
        $this->addColumn('name', new KeyWord());
    }
}

//...

$search = new KeyWordSearch(['name'=>'js']);
list($condition, $bind) = $search->handle();

echo $condition;// 'name like :name:'
var_dump($bind);//['name'=>'%js%']
```   

&nbsp;&nbsp;&nbsp;&nbsp;By default in `like` condition,it is `%searchword%`. Use `like` option can change this behaviour:
```php
class KeyWordSearch extends Search
{

    public function initialize()
    {
        $this->addColumn('left_key_word', new KeyWord([ 'like' => KeyWord::LEFT ]));
        $this->addColumn('right_key_word', new KeyWord([ 'like' => KeyWord::RIGHT ]));
    }
}
$search = new KeyWordSearch(['left_key_word'=>'left','right_key_word'=>'right']);
list($condition, $bind) = $search->handle();

echo $condition;// 'left_key_word like :left_key_word: and right_key_word like :right_key_word:'
var_dump($bind);//['left_key_word'=>'%left','right_key_word'=>'right%']
```

&nbsp;&nbsp;&nbsp;&nbsp;Sometimes,request's field is not sql field,you can set `field` option to set sql field.


```php
class KeyWordSearch extends Search
{

    public function initialize()
    {
        $this->addColumn('key_word', new KeyWord([ 'field' => 'db_key_word' ]));
    }
}
$search = new KeyWordSearch(['key_word'=>'keyword']);
list($condition, $bind) = $search->handle();

echo $condition;// 'db_key_word like :db_key_word:'
var_dump($bind);//['db_key_word'=>'keyword']

```

you also can set an array to specify some field.

```php
class KeyWordSearch extends Search
{

    public function initialize()
    {
        $this->addColumn('multi_filed_keyword', new KeyWord([ 'field' => [ 'db_key_word1', 'db_key_word2' ] ]));
    }
}
$search = new KeyWordSearch(['multi_filed_keyword'=>'keyword']);
list($condition, $bind) = $search->handle();

echo $condition;// 'db_key_word1 like :db_key_word1: or db_key_word2 like :db_key_word2:'
var_dump($bind);//['db_key_word1'=>'keyword','db_key_word2'=>'keyword']
```

#### Radio

```php
class RadioSearch extends Search
{

    public function initialize()
    {
        $this->addColumn('r1', new Radio());
    }
}
$search = new RadioSearch(['r1'=>'keyword']);
list($condition, $bind) = $search->handle();

echo $condition;// 'r1 = :r1:'
var_dump($bind);//['r1'=>'keyword']

```


#### MultiSelect

```php
class MultiSelectSearch extends Search
{

    public function initialize()
    {
        $this->addColumn('m1', new MultiSelect());
    }
}
$search = new MultiSelectSearch(['m1'=>[1,2]]);
list($condition, $bind) = $search->handle();

echo $condition;// 'm1 in ({r1:array})'
var_dump($bind);//['m1'=>[1,2]]

```

#### LessThan
```php
class LessThanSearch extends Search
{

    public function initialize()
    {
        $this->addColumn('l1', new LessThan());
    }
}
$search = new LessThanSearch(['l1'=>1]);
list($condition, $bind) = $search->handle();

echo $condition;// 'l1 < :l1:'
var_dump($bind);//['l1'=>1]
```

#### GreatThan
```php
class GreatThanSearch extends Search
{

    public function initialize()
    {
        $this->addColumn('g1', new GreatThan());
    }
}
$search = new GreatThanSearch(['g1'=>1]);
list($condition, $bind) = $search->handle();

echo $condition;// 'g1 < :g1:'
var_dump($bind);//['g1'=>1]

```


`GreatThan` and `LessThan` can set `equal` option to change `<` or `>` to `<=` or `>=`

```php
class GreatThanSearch extends Search
{

    public function initialize()
    {
        $this->addColumn('g1', new GreatThan(['equal'=>true]));
    }
}
$search = new GreatThanSearch(['g1'=>1]);
list($condition, $bind) = $search->handle();

echo $condition;// 'g1 <= :g1:'
var_dump($bind);//['g1'=>1]

```


full feature example can be found in example dir.





