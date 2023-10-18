<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class TaskList extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'title', 'status'];

    public function index(){
        return auth()
        ->user()
        ->TaskList
        ->sortBy('status');
    }

    public function create($fields) {
        return auth()
        ->user()
        ->TaskList
        ->create($fields);
    }

    public function show($id) {
        $show = auth()
        ->user()
        ->TaskList()
        ->find($id);

        if (!show) {
            throw new \Exception('Nada encontrado', -404);
        }
        return $show;
    }

    public function updateList($fields, $id){
        $tasklist = $this->show($id);

        $tasklist = $this->update($fields);

        return $tasklist;
    }

    public function destroyList($id) {
        $tasklist = $this->show($id);
        $tasklist->delete();
        return $tasklist;
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function tasks(){
    return $this->hasMany('App\Models\Tasks', 'user_id', 'user_id',
    'list_id', 'id');
    }
}
