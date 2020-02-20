<?php

namespace App\Http\Controllers;

use App;
use App\Constant;
use App\Http\Requests\TodoRequest;
use App\Log;
use App\Todo;
use App\Utils\Api;
use Illuminate\Http\Request;

class TodoController extends Controller
{

	/**
	 * Vérifier qu'un user a bien et bel accès à une tâche
	 */
	public function hasUserAccessTodo($todo_id){

		$todo = $todo = Todo::where([
    			'id' => $todo_id,
    			'user_id'=>auth()->user()->id,
    		])->first();

		if(is_null($todo)){
			return false;
		}else{
			return true;
		}
	}

	/**
	 * Retourne toutes les tâches d'un user
	 */
    public function all(){

    	$user = auth()->user();

    	$todos = Todo::where('user_id',$user->id)->get();

    	$data =[
    		'todos' => $todos,
    	];

    	return Api::respondSuccess($data);
    }

    public function todo_details($id){
    	$todo = Todo::find($id);

    	if(! $this->hasUserAccessTodo($todo->id)){
    		return response()->json(['error' => 'Unauthorized'], 401);
    	}

    	$data =[
    		'todo' => $todo,
    	];

    	return Api::respondSuccess($data);
    }

    /**
     * Marquer un todo comme complet
     * @param [int] $id : id du todo
     * @return
     */
    public function complete_todo($id){
    	$todo = Todo::find($id);

    	if(! $this->hasUserAccessTodo($todo->id)){
    		return response()->json(['error' => 'Unauthorized'], 401);
    	}

        if(json_decode($todo->status)->status != Constant::TODOCOMPLETED){
            $todo->update([
                'status' => json_encode(['status' => Constant::TODOCOMPLETED,'time_action' => time()]),
            ]);

            Api::createLog("The user completed a todo", ['todo_id' => $todo->id]);
        }

        return Api::respondSuccess([], "Todo successfully completed.");

    }

    /**
     * Marquer un todo comme annulé
     * @param [int] $id : id du todo
     * @return
     */
    public function cancel_todo($id){
        $todo = Todo::find($id);

        if(! $this->hasUserAccessTodo($todo->id)){
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        if(json_decode($todo->status)->status != Constant::TODOCANCELED){
            $todo->update([
                'status' => json_encode(['status' => Constant::TODOCANCELED,'time_action' => time()]),
            ]);

            Api::createLog("The user canceled a todo", ['todo_id' => $todo->id]);
        }

        return Api::respondSuccess([], "Todo successfully canceled.");
    }

    /**
     * Créer un todo
     */
    public function new(TodoRequest $request){
        $name = $request->name;
        $description = $request->description;

        $todo = Todo::create([
            'user_id' => auth()->user()->id,
            'name' => $name,
            'description' => $description,
            'status' => json_encode([
                'status' => Constant::TODOINITIATED,
                'time_action' => time()
            ]),
        ]);

        Api::createLog("The user created a todo", ['todo_id' => $todo->id]);

        return Api::respondSuccess([], "Todo successfully created.");
    }
}
