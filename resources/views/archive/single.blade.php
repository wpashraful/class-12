<x-guest-layout>

    <div class="bg-gray mt-1 py-6">
        <div class="container">
            <h1 class="text-center font-bold text-2xl mv-6 mb-2">{{$title}}</h1>
            <div class="max-w-7xl w-full inline-flex single-feature gap-10 flex-wrap mx-auto">
                @foreach($courses as $course)
                    @include('components.course-box', [
                        'courset' => $course
                    ])
                @endforeach
            </div>
                <div class="mt-5">{{$courses->links()}}</div>
        </div>
    </div>

</x-guest-layout>
