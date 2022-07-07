<x-app-layout>
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Blog List
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
            <div class="col-12">
                @if(Session::has('message'))
                    {!! Session::get('message') !!}
                @endif
            </div>
            <table class="table-fixed w-full text-md rounded mb-4 table">
                <thead>
                <tr class="border-b">
                    <th class="text-left p-3 px-5">Title</th>
                    <th class="text-left p-3 px-5">Description</th>
                    <th class="text-left p-3 px-5">Actions</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($blogs as $blog)
                    <tr class="border-b hover:bg-orange-100">
                    <td class="p-3 px-5">
                            {{$blog->title}}
                        </td>
                        <td class="p-3 px-5">
                            {{$blog->description}}
                        </td>
                        <td class="p-3 px-5">
                        <a href="{{ route('blog.edit', ['id' => $blog->id]) }}" class="btn btn-success btn-xs">Edit</a>
                        <a href="{{ route('blog.delete',['id'=>$blog->id]) }}" class="btn btn-danger btn-xs">Delete</a>    
                        
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            
        </div>
    </div>
</div>
</x-app-layout>