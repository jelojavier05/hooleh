<?php

namespace App\Http\Controllers\api\v1;

use Illuminate\Http\Request;
use App\Models\Enforcer;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Facades\JWTAuth;
use DB;
use Hash;
use App\User;

class EnforcerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = JWTAuth::parseToken()->toUser();
        if ($user['original']['tinyintIdentifier'] == 1){
            $enforcer = new Enforcer;
            try {
                DB::beginTransaction();

                $user = new User;
                $user->username = $request->username;
                $user->password = $request->password;
                $user->tinyintIdentifier = 1;
                $user->save();

                $enforcer->strEnforcerIdNumber = $request->strEnforcerIdNumber;
                $enforcer->strEnforcerFirstname = $request->strEnforcerFirstname;
                $enforcer->strEnforcerMiddlename = $request->strEnforcerMiddlename;
                $enforcer->strEnforcerLastname = $request->strEnforcerLastname;
                $enforcer->strEnforcerPicture = $request->strEnforcerPicture;
                $enforcer->strEnforcerPosition = $request->strEnforcerPosition;
                $enforcer->intUserID = $user->id;;
                $enforcer->save();
                DB::commit();
                return response()->json([
                        'message' => 'Enforcer Created.',
                        'status code' => 201, 
                        'data' => $enforcer
                    ]
                );
            } catch (\Illuminate\Database\QueryException $e) {
                DB::rollback();
                return response()->json([
                        'message' => $e->getMessage(),
                        'status code' => 400,
                        'data' => $enforcer
                    ]
                );
            }
        } else{
            return response()->json([
                'message' => 'Unauthorized.',
                'status Code' => 401
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
