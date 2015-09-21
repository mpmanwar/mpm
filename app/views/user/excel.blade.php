<div class="col-4">
        <h1 style="color:blue">{{ $title or "" }}</h1>
    </div>

<table class="table table-bordered table-hover dataTable" id="example2" aria-describedby="example2_info">
    <thead>
        <tr role="row">
            <th></th>
            <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Name</th>
            <th class="sorting" role="columnheader" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Permissions</th>
            <th class="sorting" role="columnheader" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Status</th>
            <th class="sorting" role="columnheader" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Last Login</th>
            <th class="sorting" role="columnheader" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Login this week </th></tr>
    </thead>
    
    <!--<tfoot>
        <tr><th rowspan="1" colspan="1">Rendering engine</th><th rowspan="1" colspan="1">Browser</th><th rowspan="1" colspan="1">Platform(s)</th><th rowspan="1" colspan="1">Engine version</th><th rowspan="1" colspan="1">CSS grade</th></tr>
    </tfoot>-->
    <tbody role="alert" aria-live="polite" aria-relevant="all">
    @if(!empty($user_lists) && count($user_lists) > 0)
        @foreach($user_lists as $user_row)
            <tr class="odd">
                <td><input type="checkbox" value="{{$user_row->user_id}}" name="user_delete_id[]" id="user_delete_id"></td>
                <td class="sorting_1"><a href="/edit-user/{{$user_row->user_id}}">{{ $user_row->fname or ""}} {{ $user_row->lname or "" }}</a></td>
                <td class=" ">{{ $user_row->permission or "" }}</td>
                <td class=" ">
                    @if($user_row->status == 'I')
                        <a href="#" class="active_t">Inative</a>
                    @else
                        <a href="#" class="active_t">Active</a>
                    @endif
                </td>
                <td class=" ">{{ $user_row->last_login or '' }}<!-- 1 May 2013 9:13 p.m. --></td>
                <td class=" ">{{ $user_row->login_count or '0' }}</td>
            </tr>
        @endforeach
    @endif
           
    </tbody>
</table>
