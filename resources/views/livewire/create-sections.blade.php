<div>
    <div class="card mt-3">
        <div class="card-header">
            <h4>Sections</h4>
        </div>
        <div class="card-body">
            <form wire:submit.prevent="createSection">
                <div class="form-row">
                    <div class="col-sm-3 my-1">
                    <input type="text"class="form-control" wire:model.defer="section_name" id="section-name" placeholder="Section Name" required>
                    </div>
                    <div class="col-sm-2 my-1">
                        <button type="submit" class=" btn btn-primary btn-block">Add Section</button>
                    </div>
                </div>
            </form>
            <nav>
            <div class="nav nav-fill nav-tabs mt-3" id="nav-tab" role="tablist">
                @foreach ($template->sections as $section)
                    <a class="nav-item nav-link  {{ $loop->index == 0 ? "active" : ""}}" id="nav-{{$section->id}}-tab" data-toggle="tab"
                        href="#nav-{{$section->id}}" role="tab" aria-controls="nav-home" aria-selected="true">{{$section->name}}</a>
                @endforeach
            </div>
            </nav>
            <div class="tab-content border-left border-right border-bottom border-black p-3" id="nav-tabContent">
                @foreach ($template->sections as $section)
                    <div class="tab-pane fade {{ $loop->index == 0 ? "show active" : ""}}" id="nav-{{$section->id}}" role="tabpanel" aria-labelledby="home-tab">
                        <livewire:create-categories :section="$section" key="section.{{ $section->id }}"/>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
