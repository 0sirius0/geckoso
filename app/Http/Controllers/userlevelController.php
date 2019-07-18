<?php

namespace App\Http\Controllers;

use App\UserLevel;
use Illuminate\Http\Request;
use PHPUnit\Framework\MockObject\Stub\Exception;
use Illuminate\Support\Facades\Auth;

class userlevelController extends Controller
{
    //
    function getLevelById(Request $request){
        $level = User::find($request)->first();
        return view('levellist')->with(compact('level'));
    }

    function getAllLevel(){
        if (Auth::user()->level->priority == 1){
            $level = UserLevel::where('priority', '>', 1)
                    ->orderBy('priority')->get();

            return view('levellist')->with(compact('level'));
        }else{
            return view('home');
        }
    }

    function addLevel(Request $request){
        $level              = new UserLevel();
        $level->name        = $request->input('name_add');
        $levelcount         = UserLevel::count();
        $level->priority    = $levelcount+1;
        $level->save();
        $message = $level->name.' Add new level success !!!! ';

        return redirect('/level/list')->with(compact('message'));
    }

    function updateLevel(Request $request){
        $level          = UserLevel::find($request);
        $level->name    = $request->input('name_update');

        $level->save();
        $message        = 'Update success !!!';
        return redirect('/level/view?level_id='.$request)->with(compact('message'));
    }

    function movelevelup(Request $request){
        if (Auth::user()->level->priority == 1){
            $id             = (int)$request->input('id');
            $priority       = UserLevel::find($id)->priority;

            if ($priority > 2){
                try{
                    $curlevel           = UserLevel::where('priority', $priority)->first();
                    $prelevel           = UserLevel::where('priority', $priority-1)->first();
                    
                    $tmp                = $prelevel->priority;
                    $prelevel->priority = $curlevel->priority;
                    $prelevel->save();

                    $curlevel->priority = $tmp;
                    $curlevel->save();

                    $message            = 'Update success !!!';
                }catch(Exception $e){
                    $message            = $e;
                }
            }
            else{
                $message = 'This level is the TOP';
            }
        }else{
            $message = 'You can not change level with this permission';
        }
        

        return redirect('/level/list')->with(compact('message'));
    }

    function moveleveldown(Request $request){
        if (Auth::user()->level->priority == 1){
            $id             = (int)$request->input('id');
            $priority       = UserLevel::find($id)->priority;
            $len            = count(UserLevel::all());
            
            if ($priority > 1 && $priority < $len){
                try{
                    $curlevel           = UserLevel::where('priority', $priority)->first();
                    $nxtlevel           = UserLevel::where('priority', $priority+1)->first();
                    
                    $tmp                = $nxtlevel->priority;
                    $nxtlevel->priority = $curlevel->priority;
                    $nxtlevel->save();

                    $curlevel->priority = $tmp;
                    $curlevel->save();

                    $message            = 'Update success !!!';
                }catch(Exception $e){
                    $message            = $e;
                }
            }else{
                $message = 'This level is the LAST';
            }
        }else{
            $message = 'You can not change level with this permission';
        }
        return redirect('/level/list')->with(compact('message'));
    }
}
