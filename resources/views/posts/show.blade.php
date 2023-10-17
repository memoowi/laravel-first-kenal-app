@extends('app')

@section('title')
    Detail - Article
@endsection

@section('content')

<div class="max-w-4xl mx-auto bg-white p-6 rounded-md shadow-md">
        <div class="flex justify-between items-center px-1 py-4">
            <a href="{{route('posts.index')}}" class="text-gray-500">
                <i class="fa fa-arrow-left fa-lg"></i>
            </a>
            <h2 class="text-xl font-bold mb-4">Article Detail</h2>
            <h2 class="text-xl font-bold mb-4 text-gray-500">
                <i class="fa fa-info-circle"></i>
            </h2>

        </div>
        <p class="text-center mt-[-20px] text-gray-500 font-semibold">ID : {{$post->id}}</p>
        @if ($post->image)
            <img src="{{asset('storage/'.$post->image)}}" alt="image" class="w-[50%] object-cover mx-auto">
        @elseif ($post->image == null)
            <img src="{{asset('img/default.png')}}" alt="image" class="w-[50%] object-cover mx-auto">
        @endif
        <div class="mb-4">
                <label for="title" class="block text-gray-700 text-lg font-semibold">Title:</label>
                <input type="text" id="title" name="title" value="{{$post->title}}" class="w-full px-4 py-2 @error('title')   border-red-500 @enderror border-2 rounded-md focus:outline-none focus:ring focus:ring-indigo-200" placeholder="Masukkan judul disini" readonly>
                @error('title')    
                <span class="text-red-500 font-semibold">{{$message}}</span>
                @enderror
        </div>
        <div class="mb-4">
                <label for="content" class="block text-gray-700 text-lg font-semibold">Content:</label>
                <textarea id="content" name="content" rows="4" class="w-full px-4 py-2 border-2 @error('content')  border-red-500 @enderror rounded-md focus:outline-none focus:ring focus:ring-indigo-200" placeholder="Masukkan konten disini" readonly>{{$post->content}}</textarea>
                @error('content')                    
                <span class="text-red-500 font-semibold">{{$message}}</span>
                @enderror
        </div>
        {{-- COMMENT --}}
        <div class="w-full mx-auto bg-white p-6 rounded-md m-5 shadow-md">
            <h1 class="text-lg font-semibold text-gray-700">Comments</h1>
        @forelse ( $post->comments as $comment )
            <div class="mb-4 flex flex-row items-center mt-3">
                <img class="comment-img rounded-full w-11 h-11" src="https://ui-avatars.com/api/?name={{$comment->comment}}" alt="User Image">
                <div class="ml-3">
                    <p>{{$comment->comment}}</p>
                </div>
                <div class="ml-auto">
                    <p>
                        {{-- {{$comment->created_at->diffForHumans()}} --}}
                        {{date('D, d M Y', strtotime($comment->created_at))}}
                    </p>
                </div>
            </div>
        @empty    
        <h1 class="text-md font-semibold text-gray-700 text-center">Jadi pertama berkomentar</h1>
        @endforelse
        </div>
        {{-- END of COMMENT --}}
        <form 
        action="{{route('comments.store', $post->id)}}" 
        method="POST">
            @csrf
            <div class="flex flex-row items-center gap-4">
                <input id="input" name="comment" type="text" class="w-full px-4 py-3 rounded-lg border-2 border-gray-300 focus:border-indigo-500 focus:ring focus:outline-none focus:ring-indigo-200" placeholder="Write a comment...">
                <button disabled id="submitButton" type="submit" class="flex items-center justify-center px-4 py-3 bg-indigo-500 text-white rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring focus:ring-indigo-200 cursor-pointer disabled:bg-gray-300 disabled:cursor-not-allowed">
                    <i class="fas fa-paper-plane px-2 py-[6px]"></i>
                </button>
            </div>
        </form>
    </div>  

@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // FUNCTION dri Kak Febry
    // const input = document.getElementById('input');
    // const submitButton = document.getElementById('submitButton');

    // input.addEventListener('input', function() {
    // if (input.value === '') {
    //     submitButton.disabled = true;
    // } else {
    //     submitButton.disabled = false;
    // }
    // });

    let input = document.querySelector("#input");
    let inputButton = document.querySelector("#submitButton");

    inputButton.disabled = true;
    input.addEventListener("input", success);

    function success() {
    if (input.value.length > 0 ) {
        inputButton.disabled = false;
    }
    else {
        inputButton.disabled = true;
    }
    }
</script>
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
</script>
@endsection