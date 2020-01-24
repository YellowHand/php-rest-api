<?php


namespace App\Http\Controllers\API;


use Illuminate\Http\Request;

use App\Http\Controllers\API\APIBaseController as APIBaseController;

use App\Post;

use Validator;


class PostAPIController extends APIBaseController

{

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function index(Request $request)

    {
        $authHeader = $request->header('Authorization');
        error_log($authHeader);
        $decoded = base64_decode(explode(" ", $authHeader)[1]);
        error_log($decoded);
        $email = explode(":", $decoded)[0];
        error_log($email);
        $posts = Post::where('email', '=', $email)->get();

        return $this->sendResponse($posts->toArray(), 'Posts Retrieved successfully');

    }


    /**

     * Store a newly created resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @return \Illuminate\Http\Response

     */

    public function store(Request $request)

    {

        $authHeader = $request->header('Authorization');
        $decoded = base64_decode(explode(" ", $authHeader)[1]);
        $email = explode(":", $decoded)[0];

        $request->request->add(['email' => $email]);
        $input = $request->all();


        $validator = Validator::make($input, [

            'text' => 'required',

        ]);


        if($validator->fails()){

            return $this->sendError('Validation Error.', $validator->errors());       

        }


        $post = Post::create($input);


        return $this->sendResponse($post->toArray(), 'Post created successfully.');

    }


    public function show($id, Request $request)
    {
        $authHeader = $request->header('Authorization');
        $decoded = base64_decode(explode(" ", $authHeader)[1]);
        $email = explode(":", $decoded)[0];

        $post = Post::find($id);

        if (is_null($post) || $post->email != $email) {
            return $this->sendError('Post not found.');
        }

        return $this->sendResponse($post->toArray(), 'Post retrieved successfully.');
    }

    public function update(Request $request, $id)
    {

        $authHeader = $request->header('Authorization');
        $decoded = base64_decode(explode(" ", $authHeader)[1]);
        $email = explode(":", $decoded)[0];

        $input = $request->all();

        $validator = Validator::make($input, [
            'text' => 'required'
        ]);


        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }


        $post = Post::find($id);

        if (is_null($post) || $post->email != $email) {

            return $this->sendError('Post not found.');

        }


        $post->text = $input['text'];

        $post->save();


        return $this->sendResponse($post->toArray(), 'Post updated successfully.');

    }


    /**

     * Remove the specified resource from storage.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function destroy($id, Request $request)

    {

         $authHeader = $request->header('Authorization');
        $decoded = base64_decode(explode(" ", $authHeader)[1]);
        $email = explode(":", $decoded)[0];

        $post = Post::find($id);


        if (is_null($post) || $post->email != $email) {

            return $this->sendError('Post not found.');

        }


        $post->delete();


        return $this->sendResponse($id, 'Tag deleted successfully.');

    }

}