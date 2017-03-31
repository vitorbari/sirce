<table class="table table-bordered table-striped">
    <thead>
    <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Component</th>
        <th>Created At</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    @foreach($references as $reference)
        <tr>
            <td>
                <a href="{{ route('sketches.show', $reference->id) }}">
                    #{{ $reference->id }}
                </a>
            </td>
            <td>
                <a href="{{ route('sketches.show', $reference->id) }}">
                    {{ $reference->title }}
                </a>

                @if(!$reference->published_at)
                    <br>
                    <span class="label label-warning">Draft (not published)</span>
                @endif
            </td>
            <td>
                <a href="{{ route('components.show', $reference->component_id) }}">
                    {{ $reference->component->component }}
                </a>
            </td>
            <td>
                {{ $reference->created_at->diffForHumans() }}
            </td>
            <td>
                @if(!empty($my_profile))
                    <a href="{{ route('sketches.edit', $reference->id) }}" class="btn btn-sm btn-primary">Edit</a>
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>