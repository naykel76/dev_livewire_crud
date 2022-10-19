<div>

    <table>

        <thead>

            <th>Id</th>
            <th>Title</th>
            <th class="tac">Status</th>
            <th class="tac">Sort Order</th>
            <th>Image</th>

        </thead>

        @forelse($projects as $project)

            <tr>
                <td>{{ $project->id }}</td>
                <td>{{ $project->title }}</td>
                <td class="tac">{{ $project->status }}</td>
                <td class="tac">{{ $project->sort_order }}</td>
                <td>{{ $project->image_name }}</td>
            </tr>

        @empty

            <tr>
                <td class="tac pxy" colspan="6">Nothing to display.</td>
            </tr>

        @endforelse

    </table>

    {{ $projects->links('gotime::pagination.default') }}
</div>
