<div class="modal fade" id="_{{$catigory->catigory_id}}" tabindex="-1" aria-labelledby="editTaskModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="editTaskModalLabel">Edit Catigory</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{route('catigory.update',$catigory)}}" style="text-align: left">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="catigory_name" class="form-label">Catigory Name</label>
                    <input type="catigory_name" name="catigory_name" value="{{$catigory->catigory_name}}" class="form-control" id="catigory_name" aria-describedby="catigory_nameHelp">
                    @error('catigory_name')
                        <em style="color:red;">{{$message}}</em>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="color" class="form-label">Color Picker</label>
                    <input type="color" rows="5" name="color" value="{{$catigory->color}}" class="" id="color">
                    @error('color')
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