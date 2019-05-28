<?php
use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;

$capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => 'localhost',
    'database'  => 'database',
    'username'  => 'root',
    'password'  => 'password',
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
]);

// Make this Capsule instance available globally via static methods... (optional)
$capsule->setAsGlobal();

// Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
$capsule->bootEloquent();

// use Illuminate\Database\Capsule\Manager as Capsule;

// Using The Query Builder
$users = Capsule::table('user')->where('id', '=', 1)->get();
var_dump($users); // object(Illuminate\Support\Collection)

// Other core methods may be accessed directly from the Capsule in the same manner as from the DB facade:
$results = Capsule::select('select * from user where id = ?', [1]);
var_dump($results);


// Using The Eloquent ORM
use Illuminate\Database\Eloquent\Model as Eloquent; 

class User extends Eloquent  
{
    protected $table = 'user';
    protected $primaryKey = 'id';
    public $timestamps = false;
}

$userModel = new User();
$count = $userModel::count();
var_dump($count);

$users = $userModel->where('id','=',1)->get();
// var_dump($users); // object(Illuminate\Database\Eloquent\Collection)
foreach($users as $user){
    // var_dump($user); // object(User)
    // var_dump($user->id);
    // var_dump($user->name);
}

// Using The Schema Builder
Capsule::schema()->create('users', function ($table) {
    $table->increments('id');
    $table->string('email')->unique();
    $table->timestamps();
});

// 获取数据表字段名称
$columns = Capsule::schema()->getColumnListing('order_infos');
foreach($columns as $column) {
    echo '$model->'.$column." = \$data['".$column."'];</br>";
}

// 可以在模型查询操作中对查询结果进行排序和分页：
//
//$posts = Post::where('views', '>', 0)->orderBy('id', 'desc')->offset(10)->limit(5)->get();