<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ProjectController extends Controller
{
    use ValidatesRequests;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $params = $this->validate($request, [
                'name' => 'required|string',
                'thumbnail' => 'required|string'
            ]);
            $request->user()->projects()->create($params);

            return response()->json([
                'success' => true,
                'message' => '创建成功！',
            ]);

        } catch (ValidationException $exception) {
            return response()->json([
                'error' => true,
                'message' => $exception->validator->getMessageBag()->getMessages(),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Project $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        try {

            $params = $this->validate($request, [
                'name' => 'required|string',
                'thumbnail' => 'required|string'
            ]);

            $project->update($params);

            return response()->json([
                'success' => true,
                'message' => '更新成功！',
            ]);

        } catch (ValidationException $exception) {
            return response()->json([
                'error' => true,
                'message' => $exception->validator->getMessageBag()->getMessages(),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        //
    }
}
