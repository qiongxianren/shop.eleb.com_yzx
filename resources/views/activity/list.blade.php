@extends('layout.default')

@section('contents')
    @include('layout._notice')
    <table class="table table-bordered table-striped">
        <tr>
            <th>ID</th>
            <th>活动名称</th>
            <th>开始时间</th>
            <th>结束时间</th>
            <th>操作</th>
        </tr>
        @foreach ($rows as $row)
            <tr>
                <td>{{ $row->id }}</td>
                <td>{{ $row->title }}</td>
                <td>{{ $row->start_time }}</td>
                <td>{{ $row->end_time }}</td>
                <td>
                    <a href="{{ route('activity.show',['row'=>$row]) }}" class="btn btn-primary btn-xs">详情</a>
                </td>
            </tr>
        @endforeach
    </table>
@endsection