@extends('front.layout.app')
@section('title', 'Learning - Obito BuildWithAngga')
@section('content')

<div class="flex h-screen">
    <aside class="flex flex-col border border-obito-grey bg-white">
        <div class="w-[260px] pb-[20px] h-[280px] px-5 pt-5 flex flex-col gap-5">
            <ul>
                <li>
                    <a href="{{ route('dashboard') }}">
                        <div class="flex items-center gap-2 py-[10px] px-[14px] rounded-full border border-obito-grey bg-white hover:border-obito-green transition-all duration-300">
                            <img src="{{ asset('assets/images/icons/home-trend-up.svg') }}" alt="icon" class="size-[20px] shrink-0" />
                            <p>Back to Dashboard</p>
                        </div>
                    </a>
                </li>
            </ul>
            <header class="flex flex-col gap-[12px]">
                <div class="flex justify-center items-center overflow-hidden w-full h-[100px] rounded-[14px]">
                    <img src="{{ Storage::url($course->thumbnail) }}" alt="image" class="w-full h-full object-cover" />
                </div>
                <h1 class="font-bold">{{ $course->name }}</h1>
            </header>
            <hr class="border-obito-grey" />
        </div>
        <div id="lessons-container" class="h-full overflow-y-auto [&::-webkit-scrollbar]:hidden w-[260px]">
            <nav class="px-5 pb-[33px] flex flex-col gap-5">

                @foreach ($course->courseSections as $section )
                    <div class="lesson accordion flex flex-col gap-4">
                        <button type="button" data-expand="warming-up" class="flex items-center justify-between">
                            <h2 class="font-semibold">{{ $section->name }}</h2>
                            <img src="{{ asset('assets/images/icons/arrow-circle-down.svg') }}" alt="icon" class="size-6 shrink-0 transition-all duration-300" />
                        </button>
                        <div id="warming-up" class="hidden">
                            <ul class="flex flex-col gap-4">
                               @foreach ($section->sectionContents as $content )
                                <li class="group {{ $currentSection && $section->id == $currentSection->id && $currentContent->id == $content->id ? 'active' : ''  }}">
                                    <a href="">
                                        <div class="px-4 group-[&.active]:bg-obito-black group-[&.active]:border-transparent group-[&.active]:text-white py-[10px] rounded-full border border-obito-grey group-hover:bg-obito-black transition-all duration-300">
                                            <h3 class="font-semibold text-sm leading-[21px] group-hover:text-white transition-all duration-300">{{ $content->name }}</h3>
                                        </div>
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <hr class="border-obito-grey" />
                @endforeach
                </nav>
        </div>
    </aside>
    <div class="flex-grow overflow-y-auto">
        <main class="pt-[30px] pb-[118px] pl-[50px]">
            <article>
                <h1>Membangun Website Cepat dan Mudah dengan Laravel</h1>
                <p>Performance atau kecepatan website adalah salah satu elemen penting dalam website development. Website yang lambat dapat membuat pengunjung frustrasi, bahkan bisa saja meninggalkan halaman sebelum mereka benar-benar menjelajahinya..</p>
                <img src="{{ asset('assets/images/thumbnails/course-learning-1.png') }}" alt="image" />
                <p>Penjelasan:</p>
                <ul>
                    <li>
                        Dengan membuat service provider custom, Anda bisa menambahkan layanan spesifik untuk aplikasi Anda.
                    </li>
                    <li>
                        Lifecycle memastikan service ini hanya di-load saat dibutuhkan.
                    </li>
                </ul>
                <h4>Memahami Cara Response Dibentuk</h4>
                <ol>
                    <li>
                        Penggunaan Bebas untuk Proyek Komersial Laravel dapat digunakan untuk membangun proyek berbayar, termasuk yang Anda kerjakan sebagai freelancer.
                    </li>
                    <li>
                        Hak Modifikasi Anda diperbolehkan memodifikasi framework Laravel sesuai kebutuhan proyek Anda. Ini sangat berguna jika Anda ingin menyesuaikan
                    </li>
                </ol>
                <p>Performance atau kecepatan website adalah salah satu elemen penting dalam web development. Website yang lambat dapat membuat pengunjung frustrasi, bahkan meninggalkan halaman sebelum mereka benar-benar menjelajahinya. Sebaliknya, website dengan loading cepat menciptakan pengalaman pengguna yang positif.</p>
                <img src="{{ asset('assets/images/thumbnails/course-learning-2.png') }}" alt="image">
                <p>Kecepatan website memengaruhi user experience secara langsung. Ketika pengunjung dapat dengan cepat mengakses informasi yang mereka butuhkan, mereka lebih cenderung untuk tetap berada di website Anda lebih lama. Hal ini tidak hanya meningkatkan tingkat kepuasan, tetapi juga dapat berkontribusi pada meningkatnya conversion rate</p>
            </article>
        </main>
        <nav class="fixed bottom-0 left-auto right-0 z-30 mx-auto w-[calc(100%-260px)] pt-5 pb-[30px] bg-[#F8FAF9]">
            <div class="px-[30px]">
                <div class="content border border-obito-grey rounded-[20px] bg-white p-[12px] flex items-center justify-between">
                    <p class="text-obito-text-secondary">Pelajari materi dengan baik, jika bingung maka tanya mentor kelas</p>
                    <div class="buttons flex items-center gap-[12px]">
                        <a href="#" class="rounded-full border border-obito-grey px-5 py-[10px] hover:border-obito-green transition-all duration-300">
                            <span class="font-semibold">Ask Mentor</span>
                        </a>
                        <a href="learning-finished.html" class="rounded-full border bg-obito-green text-white px-5 py-[10px] hover:drop-shadow-effect transition-all duration-300">
                            <span class="font-semibold">Next Lesson</span>
                        </a>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</div>
@endsection

@push('after-scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="{{ asset('js/accordion.js') }}"></script>
@endpush
