<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VisitorController extends Controller
{
    public function index()
    {
       //query from table visitor using model visitor
       $visitors = \App\Models\Visitor::all();

       //return to views
       return view('visitors.index', compact('visitors'));
    }

    public function create()
    {
        // return to views - resources/views/visitors/create.blade.php  
        return view('visitors.create');
    }
    public function store(Request $request)
    {
        // store data to table 'visitor' using model Visitor Method POPULATE
      $visitor = new \App\Models\Visitor();
      $visitor->name = $request->name;
      $visitor->phone = $request->phone;
      $visitor->email = $request->email;
      $visitor->save();

      // redirect to visitors.index
      auth()->user()->notify(new \App\Notifications\VisitorCreatedNotification());
      return redirect()->route('visitors.index');
    }

    public function show(\App\Models\Visitor $visitor)
    {
        //return to views - resources/views/visitors/show.blade.php
        return view('visitors.show', compact('visitor'));
    }

    public function edit(\App\Models\Visitor $visitor)
    {
        //return to views - resources/views/visitors/edit.blade.php
        return view('visitors.edit', compact('visitor'));
    }

    public function update(\App\Models\Visitor $visitor, Request $request)
    {
        //update data to table visitors using model visitor
        $visitor->name = $request->name;
        $visitor->phone = $request->phone;
        $visitor->email = $request->email;
        $visitor->save();

        return redirect()->route('visitors.index');
    }

    public function delete(\App\Models\Visitor $visitor)
    {
        $visitor->delete();
        //return to views - resources/views/visitors/edit.blade.php
        return redirect()->route('visitors.index');
    }
}