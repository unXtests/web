@extends('layouts.app')

@section('content')
  <div class="well bg-white shadow natural-language-container">

    <div class="text-center section clearfix">
      <div class="col-sm-4 hidden-xs text">Estudio</div>
      <div class="col-sm-8 col-xs-12">
        <div class="row">
          <select id="career-select" class="selectpicker" data-live-search="true">
            <option></option>
            @foreach($careers as $career)
              <option value="{{$career->slug}}">{{ $career->name }}</option>
            @endforeach
          </select>
        </div>
      </div>
    </div>

    <div class="text-center section clearfix">
      <div class="col-sm-4 hidden-xs text">Materia</div>
      <div class="col-sm-8 col-xs-12">
        <div class="row">
          <select id="course-select" class="selectpicker" data-live-search="true" disabled>
            <option></option>
          </select>
        </div>
      </div>
    </div>

    <div class="text-center section clearfix">
      <div class="col-sm-4 hidden-xs text">y quiero</div>
      <div class="col-sm-8 col-xs-12">
        <div class="row">
          <select id="type-select" class="selectpicker" data-live-search="true" disabled>
            <option></option>
          </select>
        </div>
      </div>
    </div>

    <div class="text-center section clearfix">
      <button id="search" type="button" class="btn btn-block btn-default disabled">Search Resources</button>
    </div>
  </div>
@endsection
