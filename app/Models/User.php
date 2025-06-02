<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable=['name','email','password','role'];
    public function rentals(){
        return $this->hasMany(Rental::class);
    }
    public function isAdmin(){
        return $this->role==='admin';
    }
    public function isCustomer(){
        return $this->role === 'customer';
    }
}
