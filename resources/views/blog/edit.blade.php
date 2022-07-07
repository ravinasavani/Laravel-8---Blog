<x-app-layout>
<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Update Blog
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <form name="blog_form" method="POST" action="{{ route('blog.update', ['id' => $editBlog->id]) }}">
                    @method('PUT')
                    {{ csrf_field() }}
                    <div class="col-md-6 bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="mb-4">
                            <label  class="block text-gray-700 text-sm font-bold mb-2">Title:</label>
                            <input type="text" class="form-control"  placeholder="Enter Title" name="title" value="{{ $editBlog->title }}">
                            @if ($errors->has('title'))
                                <span class="text-red-600">{{ $errors->first('title') }}</span>
                            @endif
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Description:</label>
                            <textarea class="form-control"  name="description" placeholder="Enter Description" >{{ $editBlog->description }}</textarea>
                            @if ($errors->has('description'))
                                <span class="text-red-600">{{ $errors->first('description') }}</span>
                            @endif
                        </div>
                        <div class="py-3  sm:flex sm:flex-row-reverse">
                            <button  type="submit" class="btn btn-primary">
                                Edit
                            </button>
                            <a href="{{ route('blog') }}" class="btn btn-secondary ml-2">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>