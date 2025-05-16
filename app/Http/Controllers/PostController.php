<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;

use App\Models\User;

class PostController extends Controller
{
    //

    //ORM : هو التقنية الي بحول من داتا بيس ريكورد لاوبجيكت ومن اوبجيكت لداتا بيس ميثود
    //eloquent is orm design pattern
    public function firstAction()
    {
        $localName = 'ahmad';
        $newBooks = ['PHP', 'Javascript', 'css'];
        return view('test',['name' => $localName, 'books' => $newBooks]);
    }

    public function index()
    {
        $postsFromDB = Post::all();//collection object:  postsFromDB -> idلازم postsFromDB['id'] بقدر اعامله معاملت الاريي يعني ما بزبط اعملphp هون برجع اوبجكت فال 
        // magic methodاما باللرفيل بزبط بسبب ال 
        // $allPosts =[
        //     ['id' => 1, 'title' =>'PHP', 'posted_by' => 'Ahmed', 'created_at' => '2022-10-10'],
        //     ['id' => 2, 'title' =>'HTML', 'posted_by' => 'Ahmed', 'created_at' => '2022-10-10'],
        //     ['id' => 3, 'title' =>'CSS', 'posted_by' => 'Ahmed', 'created_at' => '2022-10-10']
        // ];
        return view('posts.index', ['posts' => $postsFromDB]);
    }

    //public function show(Post $post) //route model binding
    //convention over configuration
    // للفيوpost وبمرر ال 
    public function show($postId)//postId
    {
    
        //select * from posts where id = $postsId;
        //لطريقة الاولى 
        $singlePostFromDB = Post::find($postId);//model object //or use findOrFail : عشان اذا كان ما في ايليمنت بتحقق الشرط
        //الطريقة الثانية
        //$singlePostFromDB = Post::where('id', $postId) -> first();//model object
        //الطريقة الثالثة
        // $singlePostFromDB = Post::where('id', $postId) ->get();//collection object
        //واحد بستخدم فيرست لو بدي ارجع كل الالمنت المتطابقة بستخدم جتelement يعني لو بدي ارجع 
        // dd(
        //     Post::where('title', 'PHP')->first()/*select *from posts where title ='php' limit 1;*/ 
        // );
        if(is_null($singlePostFromDB)){
            return to_route('posts.index');
        }
       return view('posts.show', ['post' => $singlePostFromDB]);
    }

    public function create(){

        $users = User::all();
        return view('posts.create', ['users' => $users]);
    }

    public function store(){ 
        //code to validate the data
        request()->validate([
            'title' => ['required', 'min:3'],
            'description' => ['required', 'min:5'],
            'post_creator' =>['required', 'exists:users,id']
        ]);
        //1-get the user data
        //الطريقة الاولى لنجيب الداتا
        //$data = request();
        //dd($data->all());
        //الثانية
        $title = request()->title;
        $description = request()->description;
        $post_creator = request()->post_creator;
        // dd($title, $description, $post_creator);
        //2-store the user data in database
        //الطريقة الاولى
        //  $post = new Post;
        //  $post->title = $title;
        //  $post->description = $description;
        //  $post->save();//insert into post
         Post::create([
            'title'=> $title,// داخل المودلزfillable لازم تكون قيمته موجودة بال 
            'description'=>$description,//اذا ما كانت موجودة بالفيلبل بيتم تجاهلها كأنها مش معبية
            'user_id'=>$post_creator,
         ]);
        //  $post->post_creator = $post_creator;
        //3-redirection to posts.index
        return to_route('posts.index'); //بعمل اعادة توجيه لصفحة 
    }

    public function edit(Post $post){//type hinting// urlبحط اسم المودل واسم المتغير الي مررته لل 
       
        $users = User::all();

        return view('posts.edit',['users' =>$users, 'post' =>$post]);
    }

    public function update($postId){
        //1-get the user data
        //الثانية
        
        $title = request()->title;
        $description = request()->description;
        $post_creator = request()->post_creator;
        // dd($title, $description, $post_creator);
        //2-update the user data in database
        //select or find the post
        $singlePostFromDB = Post::find($postId);
        //update the post data
        $singlePostFromDB->update([
            'title' =>$title,
            'description' =>$description,
            'user_id' =>$post_creator,
        ]);

        //3-redirection to posts.show
        return to_route('posts.show',$postId); //بعمل اعادة توجيه لصفحة 
    }

    public function destroy($postId){
        //1-delete the post from database
        //find the post
        $post = Post::find($postId);
        //delete the post from database
        $post->delete();
        //Post::where('id', $postId)->delete();//طريقة ثانية
        //2-redirect to posts index
        return to_route('posts.index');
    }
}
