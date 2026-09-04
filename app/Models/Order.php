<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Client;

class Order extends Model
{
    protected $fillable = ['total', 'status', 'client_id'];
    
    public function client(){

    return $this->BelongsTo(Client::class);

    }
}

//App\Models\Order::create(['total'=>56.84, 'status'=>'shipped', 'client_id'=>1]); 
