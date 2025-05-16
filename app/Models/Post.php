<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    //
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'user_id',
    ];

    public function user()//user_idالاسم كثير مهم لانه ببحث على ايليمنت بتاءا عليه يعني بده 
    {
        return $this->belongsTo(User::class);
    }

    public function postCreator(){
        //return $this->belongsTo(User::class);//وما بلاقيهاpost_creator_id في هاي الحالة ما برجع اشي لانه ببحث عن 
        return $this->belongsTo(User::class, foreignKey: 'user_id' );
    }
}
