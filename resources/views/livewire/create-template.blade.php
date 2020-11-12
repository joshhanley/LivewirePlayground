<div>
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-10" >
                    <h3>{{$template->name}}</h3>
                </div>
                <div class="col-2">
                    <a type="button" href="/templates/{{$template->id}}" class=" btn btn-block btn-primary float-right">Preview Template</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form wire:submit.prevent="update">
                <div class="form-row align-items-center" >
                    <div class="col-sm-3 my-1">
                    <input type="text" class="form-control" id="template-name" wire:model.lazy="template.name" placeholder="New Template" required>
                    </div>
                    <div class="col-sm-6 my-1">
                    <input type="text" class="form-control" id="template-description"  wire:model.lazy="template.description"
                    placeholder="Enter your Template description here">
                    </div>
                    <div class="col-sm-1 my-1 text-center">
                        <div class="form-check">
                            <input class="form-check-input"  wire:model="template.is_shareable" type="checkbox" id="template-is_shareable">
                            <label class="form-check-label" for="template-is_shareable">Share</label>
                        </div>
                    </div>
                    <div class="col-2 my-1">
                        <button type="submit" class=" btn btn-primary btn-block">Update</button>
                    </div>
                </div>
            </form>
            <livewire:create-sections :template="$template" :key="time().$template->id"/>
        </div>
    </div>
</div>
