<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuestionRequest;
use App\Repositories\QuestionRepository;
use Illuminate\Http\Request;
use Auth;

class QuestionController extends Controller
{
    protected $questionRepository;

    public function __construct(QuestionRepository $questionRepository)
    {
        $this->middleware('auth')->except(['index','show']);
        $this->questionRepository = $questionRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return 'index';
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('questions.make');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreQuestionRequest $request)
    {
//        StoreQuestionRequest instead
//        $rules = [
//            'title' => 'required|min:6|max:196',
//            'body' => 'required|min:26',
//        ];
//        $message = [
//            'title.required' => '标题不能为空',
//            'title.min' => '标题不能少于6个字符',
//        ];
//        $this->validate($request,$rules,$message);
        $topics = $this->questionRepository->normalizeTopic($request->get('topics'));
        $data = [
            'title' => $request->get('title'),
            'body' => $request->get('body'),
            'user_id' => Auth::id(),
        ];
        $question = $this->questionRepository->create($data);

        $question->topics()->attach($topics);
        return redirect()->route('question.show',[$question->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $question = $this->questionRepository->byIdWithTopics($id);

        return view('questions.show',compact('question'));;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $question = $this->questionRepository->byId($id);
        if (Auth::user()->owns($question)){
            return view('questions.edit',compact('question'));
        }

        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreQuestionRequest $request, $id)
    {
        $question = $this->questionRepository->byId($id);
        $topics = $this->questionRepository->normalizeTopic($request->get('topics'));

        $question->update([
            'title' => $request->get('title'),
            'body' => $request->get('body'),
        ]);

        $question->topics()->sync($topics);

        return redirect()->route('question.show',[$question->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
