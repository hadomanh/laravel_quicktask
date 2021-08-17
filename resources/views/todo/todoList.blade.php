<tr>
    <th>#</th>
    <th>Title</th>
    <th>Description</th>
    <th>Created at</th>
    <th>Updated at</th>
    <th>Deadline</th>
    <th>Status</th>
    <th></th>
</tr>

@foreach ($todos as $todo)
    <tr>
        <td>{{ $loop->index + 1 }}</td>
        <td class="titleTodo">{{ $todo->title }}</td>
        <td class="contentTodo">{{ $todo->content }}</td>
        <td>{{ \Carbon\Carbon::parse($todo->created_at)->format('Y-m-d')}}</td>
        <td>{{ \Carbon\Carbon::parse($todo->updated_at)->format('Y-m-d')}}</td>
        <td class="deadlineTodo">{{ \Carbon\Carbon::parse($todo->deadline)->format('Y-m-d')}}</td>
        @switch($todo->status)
            @case(1)
                <td class="statusTodo text-danger">On progress</td>
                @break
            @case(2)
                <td class="statusTodo text-secondary">Done</td>
                @break
            @default
                <td class="statusTodo text-warning">Todo</td>
                @break
                
        @endswitch
        <td>
            <div class="btnGroup btn-group">
                <div class="editBtn btn btn-outline-warning" data-todo-id="{{ $todo->id }}"><i class="bi bi-pencil-square"></i> Edit
                </div>
                <div class="deleteBtn btn btn-outline-danger"><i class="bi bi-archive"></i> Delete</div>
            </div>

            <div style="display: none;" class="deleteConfirmBtnGroup btn-group">
                <div onclick="handleDelete(this)" data-todo-id="{{ $todo->id }}" class="btn btn-outline-danger"><i class="bi bi-archive"></i> Delete permanently
                </div>
                <div class="deleteCancelBtn btn btn-outline-secondary">Cancel</div>
            </div>
        </td>
    </tr>
@endforeach
