@foreach ($authors as $author)
    <tr>
        <td class="text-primary"><strong>{{ $author->username }}</strong></td>
        <td>{{ $author->total_count }}</td>
        <td>{{ $author->created_at }}</td>
        <td>{{ $author->title }}</td>
    </tr>
@endforeach
