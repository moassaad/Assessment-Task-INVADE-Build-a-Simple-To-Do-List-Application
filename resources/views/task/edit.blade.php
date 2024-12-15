<div class="modal fade" id="_{{$task->task_id}}" tabindex="-1" aria-labelledby="editTaskModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="editTaskModalLabel">Edit Task</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{route('task.update', $task)}}">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="title" name="title" value="{{ $task->title }}" class="form-control" id="title" aria-describedby="titleHelp">
                    @error('title')
                        <em style="color:red;">{{$message}}</em>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea type="description" rows="5" name="description" class="form-control" id="description">{{ $task->description }}</textarea>
                    @error('description')
                        <em style="color:red;">{{$message}}</em>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="due_date" class="form-label">Due Date</label>
                    <input type="date" name="due_date" value="{{ $task->due_date }}" class="form-control" id="due_date" aria-describedby="due_dateHelp">
                    @error('due_date')
                        <em style="color:red;">{{$message}}</em>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="completion" class="form-label">Completion</label>
                    <input type="checkbox" name="completion" value="completion" id="completion" @checked($task->status)>
                    @error('completion')
                        <em style="color:red;">{{$message}}</em>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="catigory" class="form-label">Catigory</label>
                    <select name="catigory" class="form-control" id="catigory" aria-describedby="catigoryHelp">
                        <option selected disabled hidden>choose item</option>
                        @forelse ($catigories as $catigory)
                            <option value="{{$catigory->catigory_id}}"
                                @if ($task->catigory_id === $catigory->catigory_id)
                                    selected
                                @endif
                                >{{$catigory->catigory_name}}</option>
                        @empty
                            <option disabled>not found data</option>
                        @endforelse
                    </select>
                    @error('catigory')
                        <em style="color:red;">{{$message}}</em>
                    @enderror
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">cancel</button>
                    <button type="submit" class="btn btn-primary" id="saveTaskBtn">save</button>
                </div>
            </form>
        </div>
    </div>
    </div>
</div>