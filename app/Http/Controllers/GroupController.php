<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groups = Group::with('children')->whereNull('parent_id')->get();

      return view('groups.index')->with([
        'groups'  => $groups
      ]);
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
        $request->validate([
            'name' => 'required|min:3|max:255|string',
            'parent_id' => 'sometimes|nullable|numeric',
        ]);
        Group::create($request->all());
        return redirect()->route('group.index')->withSuccess('You have successfully created a group!');
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
    public function update(Request $request, Group $group)
{
        $validatedData = $this->validate($request, [
            'name'  => 'required|min:3|max:255|string'
        ]);

        $group->update($validatedData);

        return redirect()->route('group.index')->withSuccess('You have successfully updated a Group!');
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Group $group)
{
        if ($group->children) {
            foreach ($group->children()->with('contacts')->get() as $child) {
                foreach ($child->contacts as $contact) {
                    $contact->update(['group_id' => NULL]);
                }
            }
            
            $group->children()->delete();
        }

        foreach ($group->contacts as $contact) {
            $contact->update(['group_id' => NULL]);
        }

        $group->delete();

        return redirect()->route('group.index')->withSuccess('You have successfully deleted a group!');
}
}
