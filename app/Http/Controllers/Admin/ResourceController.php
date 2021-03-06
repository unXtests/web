<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;

use App\Http\Requests\StoreResourceRequest;
use App\Http\Requests\UpdateResourceRequest;
use Auth;
use App\Resource;
use App\Course;
use App\Teacher;
use App\Type;

class ResourceController extends AdminController
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    return view('admin.resources.index', [
      'resources' => Resource::published()->get()
    ]);
  }

  /**
  * Display a listing of the resources unpublisheds.
  *
  * @return \Illuminate\Http\Response
  */
  public function unpublisheds()
  {
    return view('admin.resources.index', [
      'resources' => Resource::unpublished()->get()
    ]);
  }

  /**
  * Publishes the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function publish($id)
  {
    $published_by = Auth::user()->id;

    Resource::findOrFail($id)->publish($published_by);

    return redirect()
    ->route('admin.resources.unpublisheds')
    ->with(['success' => 'Published!']);
  }

  /**
  * Unpublishes the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function unpublish($id)
  {
    Resource::findOrFail($id)->unpublish();

    return redirect()
    ->route('admin.resources.index')
    ->with(['success' => 'Unpublished!']);
  }

  /**
  * Show the form for editing the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function edit($id)
  {
    $resource = Resource::findOrFail($id);

    return view('admin.resources.edit', [
      'resource' => $resource,
      'teachers' => Teacher::all(),
      'courses' => Course::all(),
      'types' => Type::all()
    ]);
  }

  /**
  * Update the specified resource in storage.
  *
  * @param  UpdateResourceRequest  $request
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function update(UpdateResourceRequest $request, $id)
  {
    $data = $request->input();

    if ( empty($data['teacher_id']) ) {
      $data['teacher_id'] = null;
    }

    Resource::findOrFail($id)->update($data);

    return redirect()
    ->route('admin.resources.index')
    ->with(['success' => 'Updated!']);
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function destroy($id)
  {
    Resource::destroy($id);

    return redirect()
    ->route('admin.resources.index')
    ->with(['success' => 'Removed!']);
  }
}
