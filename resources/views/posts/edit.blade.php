@extends('app')

@section('title')
    Add New - Article
@endsection

@section('content')

<div class="max-w-4xl mx-auto bg-white p-6 rounded-md shadow-md">
        <div class="flex justify-between items-center px-1 py-4">
            <h2 class="text-xl font-semibold mb-4">Add New Article</h2>
            <a href="{{route('posts.index')}}">
                <button class="px-4 py-2 bg-gray-400 text-white rounded hover:bg-gray-600 focus:outline-none focus:ring focus:ring-indigo-200">
                    Back
                </button>
            </a>
        </div>
        <form 
        action="{{ route('posts.update' , $post->id) }}" 
        method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="image" class="block text-gray-700 text-lg font-semibold">Image:</label>
                <input type="file" class="block w-full text-sm text-slate-500 px-4 py-2
                    file:mr-4 file:py-2 file:px-4
                    file:rounded-full file:border-0
                    file:text-sm file:font-semibold
                    file:bg-violet-50 file:text-violet-700
                    hover:file:bg-violet-100"
                    id="image" name="image"/>
            </div>
            <div class="mb-4">
                <label for="title" class="block text-gray-700 text-lg font-semibold">Title:</label>
                <input type="text" id="title" name="title" class="w-full px-4 py-2 @error('title')   border-red-500 @enderror border-2 rounded-md focus:outline-none focus:ring focus:ring-indigo-200" placeholder="Masukkan judul disini" value="{{$post->title}}">
                @error('title')    
                <span class="text-red-500 font-semibold">{{$message}}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label for="content" class="block text-gray-700 text-lg font-semibold">Content:</label>
                <textarea id="content" name="content" rows="4" class="w-full px-4 py-2 border-2 @error('content')  border-red-500 @enderror rounded-md focus:outline-none focus:ring focus:ring-indigo-200" placeholder="Masukkan konten disini" >{{ $post->content }}</textarea>
                @error('content')                    
                <span class="text-red-500 font-semibold">{{$message}}</span>
                @enderror
            </div>
            <div class="text-center">
                <button type="submit" class="px-4 py-2 bg-teal-600 text-white rounded hover:bg-teal-800 focus:outline-none focus:ring focus:ring-indigo-200">Update</button>
            </div>
        </form>
    </div>  

@endsection