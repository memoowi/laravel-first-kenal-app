@extends('app')

@section('title')
    Home - Article
@endsection

@section('content')

{{-- @if (session('ok'))    
<div class="max-w-5xl bg-green-700 text-white rounded-lg p-6 mx-auto mb-4">
    <i class="fa fa-check"></i>
    <span class="font-semibold">&nbsp;&nbsp;{{ session('ok') }}</span>
</div>
@endif --}}

<div class="max-w-5xl mx-auto bg-white rounded-lg shadow-md">
    <div class="flex justify-between items-center px-6 py-6">
        <h1 class="text-2xl font-bold text-gray-700">Article List</h1>
        <a href="{{route('posts.create')}}">
            <button class="px-4 py-2 bg-teal-600 text-white rounded hover:bg-teal-800 focus:outline-none focus:ring focus:ring-indigo-200">
                Add New
            </button>
        </a>
    </div>
    <table class="min-w-full divide-y divide-gray-200">
        <thead>
            <tr>
                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">id</th>
                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Image</th>
                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">title</th>
                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">content</th>
                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">comment</th>
                <th class="px-6 py-3 bg-gray-50"></th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse ($post as $row)     
            <tr class="hover:bg-gray-100">
                <td class="px-6 py-4 whitespace-no-wrap">{{$row->id}}</td>
                <td class="px-6 py-4 whitespace-no-wrap">
                    {{-- <img src="{{asset('img/default.png'.$row->image)}}" alt="" class="w-20 h-20 object-cover"> --}}
                    @if ($row->image)
                        <img src="{{asset('storage/'.$row->image)}}" alt="" class="w-20 h-20 object-cover">
                    @else
                        <img src="{{asset('img/default.png')}}" alt="" class="w-20 h-20 object-cover">
                    @endif
                </td>
                <td class="px-6 py-4 whitespace-no-wrap">{{$row->title}}</td>
                <td class="px-6 py-4 whitespace-no-wrap">
                    {{-- {{$row->content}} --}}
                    {{ Str::limit($row->content, 50) }}
                </td>
                <td class="px-6 py-4 whitespace-no-wrap">
                    {{$row->comments->count()}}
                    <?php
                    // $postComment = App\Models\Post::find($row->id);
                    // $comments = $postComment->comments->count();
                    // echo $comments;
                    ?>
                </td>
                <td class="px-6 py-4 whitespace-no-wrap">
                    <a href="{{route('posts.show', $row->slug)}}" class="text-white bg-blue-500 hover:bg-blue-700 p-3 rounded">Details</a>
                    <a href="{{route('posts.edit', $row->id)}}" class="text-white bg-green-500 hover:bg-green-700 p-3 rounded">Edit</a>
                    <form action="{{route('posts.destroy', $row->id)}}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-white bg-red-500 hover:bg-red-700 p-3 rounded">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr class="hover:bg-gray-100">
                <td colspan="5" class="px-6 py-4 whitespace-no-wrap text-center">No Data</td>
            </tr>
            @endforelse  
        </tbody>
    </table>
    <div class="px-6 py-4">
        {{ $post->links() }}
    </div>
</div>

@endsection

{{-- Message alert --}}
@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    @if(session('ok'))
    newdata();
    function newdata(){
        Swal.fire({
            title: '{{session('ok')}}',
            icon: 'success',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
        }) 
    }
    @endif

    // delete
    function deleteData(id){
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: 'grey',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-'+id).submit();
                Swal.fire(
                    'Deleted!', 
                    'Your file has been deleted.',
                    'success'
                )
            }
        })
    }
    

</script>

@endsection