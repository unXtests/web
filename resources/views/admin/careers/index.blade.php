@extends('admin.template')

@section('main')
  <table class="table table-striped table-bordered table-condensed">
    <thead>
      <th>{{ trans('texts.name') }}</th>
      <th></th>
    </thead>
    <tbody>
      @foreach ($careers as $career)
        <tr>
          <td>{{ $career->name }}</td>
          <td>
            <div class="pull-left">
              <a role="button" class="btn btn-sm btn-primary" href="{{ route('admin.careers.edit', [$career->id])}}">
                <i class="glyphicon glyphicon-pencil"></i>
              </a>
            </div>
            <div class="pull-left">
              <form class="form-inline" action="{{ route('admin.careers.destroy', [$career->id]) }}" method="POST">
                {!! csrf_field() !!}
                <input type="hidden" name="_method" value="DELETE">
                <button type="submit" class="btn btn-sm btn-danger delete">
                  <i class="glyphicon glyphicon-trash"></i>
                </button>
              </form>
            </div>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
@endsection
