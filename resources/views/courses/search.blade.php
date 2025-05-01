@extends('front.layout.app')
@section('title', 'My Courses - Obito BuildWithAngga')
@section('content')
    <x-navigation-auth />

    <nav id="bottom-nav" class="flex w-full bg-white border-b border-obito-grey py-[14px]">
        <ul class="flex w-full max-w-[1280px] px-[75px] mx-auto gap-3">
            <li class="group">
                <a href="#" class="flex items-center gap-2 rounded-full border border-obito-grey py-2 px-[14px] hover:border-obito-green bg-white transition-all duration-300 group-[.active]:bg-obito-light-green group-[.active]:border-obito-light-green">
                    <img src="assets/images/icons/home-trend-up.svg" class="flex shrink-0 w-5" alt="icon">
                    <span>Overview</span>
                </a>
            </li>
            <li class="group">
                <a href="catalog-v2.html" class="flex items-center gap-2 rounded-full border border-obito-grey py-2 px-[14px] hover:border-obito-green bg-white transition-all duration-300 group-[.active]:bg-obito-light-green group-[.active]:border-obito-light-green">
                    <img src="assets/images/icons/note-favorite.svg" class="flex shrink-0 w-5" alt="icon">
                    <span>Courses</span>
                </a>
            </li>
            <li class="group">
                <a href="#" class="flex items-center gap-2 rounded-full border border-obito-grey py-2 px-[14px] hover:border-obito-green bg-white transition-all duration-300 group-[.active]:bg-obito-light-green group-[.active]:border-obito-light-green">
                    <img src="assets/images/icons/message-programming.svg" class="flex shrink-0 w-5" alt="icon">
                    <span>Quizzess</span>
                </a>
            </li>
            <li class="group">
                <a href="#" class="flex items-center gap-2 rounded-full border border-obito-grey py-2 px-[14px] hover:border-obito-green bg-white transition-all duration-300 group-[.active]:bg-obito-light-green group-[.active]:border-obito-light-green">
                    <img src="assets/images/icons/cup.svg" class="flex shrink-0 w-5" alt="icon">
                    <span>Certificates</span>
                </a>
            </li>
            <li class="group">
                <a href="#" class="flex items-center gap-2 rounded-full border border-obito-grey py-2 px-[14px] hover:border-obito-green bg-white transition-all duration-300 group-[.active]:bg-obito-light-green group-[.active]:border-obito-light-green">
                    <img src="assets/images/icons/ruler&pen.svg" class="flex shrink-0 w-5" alt="icon">
                    <span>Portfolios</span>
                </a>
            </li>
        </ul>
    </nav>
    <main class="flex flex-col gap-10 pb-10 mt-[50px]">
        <div class="flex flex-col items-center gap-[10px] max-w-[500px] w-full mx-auto">
            <p class="flex items-center gap-[6px] w-fit rounded-full py-2 px-[14px] bg-obito-light-green">
                <img src="assets/images/icons/crown-green.svg" class="flex shrink-0 w-5" alt="icon">
                <span class="font-bold text-sm">GROW CAREER</span>
            </p>
            <h1 class="font-bold text-[28px] leading-[42px] text-center">Explore Our Greatest Courses</h1>
            <form action="search-course.html" class="relative ">
                <label class="group">
                    <input type="text" name="" id="" class="appearance-none outline-none ring-1 ring-obito-grey rounded-full w-[550px] py-[14px] px-5 bg-white font-bold placeholder:font-normal placeholder:text-obito-text-secondary group-focus-within:ring-obito-green transition-all duration-300 pr-[50px]" placeholder="Search course by name">
                    <button type="submit" class="absolute right-0 top-0 h-[52px] w-[52px] flex shrink-0 items-center justify-center">
                        <img src="assets/images/icons/search-normal-green-fill.svg" class="flex shrink-0 w-10 h-10" alt="">
                    </button>
                </label>
            </form>
        </div>
        <section id="result" class="flex flex-col w-full max-w-[1280px] px-[75px] gap-5 mx-auto">
            <h2 class="font-bold text-[22px] leading-[33px]">Search Result: JavaScript</h2>
            <div id="result-list" class="tab-content grid grid-cols-4 gap-5">
                <a href="course-details.html" class="card">
                    <div class="course-card flex flex-col rounded-[20px] border border-obito-grey hover:border-obito-green transition-all duration-300 bg-white overflow-hidden">
                        <div class="thumbnail-container p-[10px]">
                            <div class="relative w-full h-[150px] rounded-[14px] overflow-hidden bg-obito-grey">
                                <img src="assets/images/thumbnails/thumbnail-3.png" class="w-full h-full object-cover" alt="thumbnail">
                                <p class="absolute top-[10px] right-[10px] z-10 w-fit h-fit flex flex-col items-center rounded-[14px] py-[6px] px-[10px] bg-white gap-0.5">
                                    <img src="assets/images/icons/like.svg" class="w-5 h-5" alt="icon">
                                    <span class="font-semibold text-xs">4.8</span>
                                </p>
                            </div>
                        </div>
                        <div class="flex flex-col p-4 pt-0 gap-[13px]">
                            <h3 class="font-bold text-lg line-clamp-2">Cyber Security for Dummies 101</h3>
                            <p class="flex items-center gap-[6px]">
                                <img src="assets/images/icons/crown-green.svg" class="flex shrink-0 w-5" alt="icon">
                                <span class="text-sm text-obito-text-secondary">Programming</span>
                            </p>
                            <p class="flex items-center gap-[6px]">
                                <img src="assets/images/icons/menu-board-green.svg" class="flex shrink-0 w-5" alt="icon">
                                <span class="text-sm text-obito-text-secondary">182 Lessons</span>
                            </p>
                            <p class="flex items-center gap-[6px]">
                                <img src="assets/images/icons/briefcase-green.svg" class="flex shrink-0 w-5" alt="icon">
                                <span class="text-sm text-obito-text-secondary">Ready to Work</span>
                            </p>
                        </div>
                    </div>
                </a>
                <a href="course-details.html" class="card">
                    <div class="course-card flex flex-col rounded-[20px] border border-obito-grey hover:border-obito-green transition-all duration-300 bg-white overflow-hidden">
                        <div class="thumbnail-container p-[10px]">
                            <div class="relative w-full h-[150px] rounded-[14px] overflow-hidden bg-obito-grey">
                                <img src="assets/images/thumbnails/thumbnail-4.png" class="w-full h-full object-cover" alt="thumbnail">
                                <p class="absolute top-[10px] right-[10px] z-10 w-fit h-fit flex flex-col items-center rounded-[14px] py-[6px] px-[10px] bg-white gap-0.5">
                                    <img src="assets/images/icons/like.svg" class="w-5 h-5" alt="icon">
                                    <span class="font-semibold text-xs">4.8</span>
                                </p>
                            </div>
                        </div>
                        <div class="flex flex-col p-4 pt-0 gap-[13px]">
                            <h3 class="font-bold text-lg line-clamp-2">Cyber Security for Dummies 101</h3>
                            <p class="flex items-center gap-[6px]">
                                <img src="assets/images/icons/crown-green.svg" class="flex shrink-0 w-5" alt="icon">
                                <span class="text-sm text-obito-text-secondary">Programming</span>
                            </p>
                            <p class="flex items-center gap-[6px]">
                                <img src="assets/images/icons/menu-board-green.svg" class="flex shrink-0 w-5" alt="icon">
                                <span class="text-sm text-obito-text-secondary">182 Lessons</span>
                            </p>
                            <p class="flex items-center gap-[6px]">
                                <img src="assets/images/icons/briefcase-green.svg" class="flex shrink-0 w-5" alt="icon">
                                <span class="text-sm text-obito-text-secondary">Ready to Work</span>
                            </p>
                        </div>
                    </div>
                </a>
                <a href="course-details.html" class="card">
                    <div class="course-card flex flex-col rounded-[20px] border border-obito-grey hover:border-obito-green transition-all duration-300 bg-white overflow-hidden">
                        <div class="thumbnail-container p-[10px]">
                            <div class="relative w-full h-[150px] rounded-[14px] overflow-hidden bg-obito-grey">
                                <img src="assets/images/thumbnails/thumbnail-5.png" class="w-full h-full object-cover" alt="thumbnail">
                                <p class="absolute top-[10px] right-[10px] z-10 w-fit h-fit flex flex-col items-center rounded-[14px] py-[6px] px-[10px] bg-white gap-0.5">
                                    <img src="assets/images/icons/like.svg" class="w-5 h-5" alt="icon">
                                    <span class="font-semibold text-xs">4.8</span>
                                </p>
                            </div>
                        </div>
                        <div class="flex flex-col p-4 pt-0 gap-[13px]">
                            <h3 class="font-bold text-lg line-clamp-2">Cyber Security for Dummies 101</h3>
                            <p class="flex items-center gap-[6px]">
                                <img src="assets/images/icons/crown-green.svg" class="flex shrink-0 w-5" alt="icon">
                                <span class="text-sm text-obito-text-secondary">Programming</span>
                            </p>
                            <p class="flex items-center gap-[6px]">
                                <img src="assets/images/icons/menu-board-green.svg" class="flex shrink-0 w-5" alt="icon">
                                <span class="text-sm text-obito-text-secondary">182 Lessons</span>
                            </p>
                            <p class="flex items-center gap-[6px]">
                                <img src="assets/images/icons/briefcase-green.svg" class="flex shrink-0 w-5" alt="icon">
                                <span class="text-sm text-obito-text-secondary">Ready to Work</span>
                            </p>
                        </div>
                    </div>
                </a>
                <a href="course-details.html" class="card">
                    <div class="course-card flex flex-col rounded-[20px] border border-obito-grey hover:border-obito-green transition-all duration-300 bg-white overflow-hidden">
                        <div class="thumbnail-container p-[10px]">
                            <div class="relative w-full h-[150px] rounded-[14px] overflow-hidden bg-obito-grey">
                                <img src="assets/images/thumbnails/thumbnail-6.png" class="w-full h-full object-cover" alt="thumbnail">
                                <p class="absolute top-[10px] right-[10px] z-10 w-fit h-fit flex flex-col items-center rounded-[14px] py-[6px] px-[10px] bg-white gap-0.5">
                                    <img src="assets/images/icons/like.svg" class="w-5 h-5" alt="icon">
                                    <span class="font-semibold text-xs">4.8</span>
                                </p>
                            </div>
                        </div>
                        <div class="flex flex-col p-4 pt-0 gap-[13px]">
                            <h3 class="font-bold text-lg line-clamp-2">Cyber Security for Dummies 101</h3>
                            <p class="flex items-center gap-[6px]">
                                <img src="assets/images/icons/crown-green.svg" class="flex shrink-0 w-5" alt="icon">
                                <span class="text-sm text-obito-text-secondary">Programming</span>
                            </p>
                            <p class="flex items-center gap-[6px]">
                                <img src="assets/images/icons/menu-board-green.svg" class="flex shrink-0 w-5" alt="icon">
                                <span class="text-sm text-obito-text-secondary">182 Lessons</span>
                            </p>
                            <p class="flex items-center gap-[6px]">
                                <img src="assets/images/icons/briefcase-green.svg" class="flex shrink-0 w-5" alt="icon">
                                <span class="text-sm text-obito-text-secondary">Ready to Work</span>
                            </p>
                        </div>
                    </div>
                </a>
                <a href="course-details.html" class="card">
                    <div class="course-card flex flex-col rounded-[20px] border border-obito-grey hover:border-obito-green transition-all duration-300 bg-white overflow-hidden">
                        <div class="thumbnail-container p-[10px]">
                            <div class="relative w-full h-[150px] rounded-[14px] overflow-hidden bg-obito-grey">
                                <img src="assets/images/thumbnails/thumbnail-7.png" class="w-full h-full object-cover" alt="thumbnail">
                                <p class="absolute top-[10px] right-[10px] z-10 w-fit h-fit flex flex-col items-center rounded-[14px] py-[6px] px-[10px] bg-white gap-0.5">
                                    <img src="assets/images/icons/like.svg" class="w-5 h-5" alt="icon">
                                    <span class="font-semibold text-xs">4.8</span>
                                </p>
                            </div>
                        </div>
                        <div class="flex flex-col p-4 pt-0 gap-[13px]">
                            <h3 class="font-bold text-lg line-clamp-2">Cyber Security for Dummies 101</h3>
                            <p class="flex items-center gap-[6px]">
                                <img src="assets/images/icons/crown-green.svg" class="flex shrink-0 w-5" alt="icon">
                                <span class="text-sm text-obito-text-secondary">Programming</span>
                            </p>
                            <p class="flex items-center gap-[6px]">
                                <img src="assets/images/icons/menu-board-green.svg" class="flex shrink-0 w-5" alt="icon">
                                <span class="text-sm text-obito-text-secondary">182 Lessons</span>
                            </p>
                            <p class="flex items-center gap-[6px]">
                                <img src="assets/images/icons/briefcase-green.svg" class="flex shrink-0 w-5" alt="icon">
                                <span class="text-sm text-obito-text-secondary">Ready to Work</span>
                            </p>
                        </div>
                    </div>
                </a>
                <a href="course-details.html" class="card">
                    <div class="course-card flex flex-col rounded-[20px] border border-obito-grey hover:border-obito-green transition-all duration-300 bg-white overflow-hidden">
                        <div class="thumbnail-container p-[10px]">
                            <div class="relative w-full h-[150px] rounded-[14px] overflow-hidden bg-obito-grey">
                                <img src="assets/images/thumbnails/thumbnail-8.png" class="w-full h-full object-cover" alt="thumbnail">
                                <p class="absolute top-[10px] right-[10px] z-10 w-fit h-fit flex flex-col items-center rounded-[14px] py-[6px] px-[10px] bg-white gap-0.5">
                                    <img src="assets/images/icons/like.svg" class="w-5 h-5" alt="icon">
                                    <span class="font-semibold text-xs">4.8</span>
                                </p>
                            </div>
                        </div>
                        <div class="flex flex-col p-4 pt-0 gap-[13px]">
                            <h3 class="font-bold text-lg line-clamp-2">Cyber Security for Dummies 101</h3>
                            <p class="flex items-center gap-[6px]">
                                <img src="assets/images/icons/crown-green.svg" class="flex shrink-0 w-5" alt="icon">
                                <span class="text-sm text-obito-text-secondary">Programming</span>
                            </p>
                            <p class="flex items-center gap-[6px]">
                                <img src="assets/images/icons/menu-board-green.svg" class="flex shrink-0 w-5" alt="icon">
                                <span class="text-sm text-obito-text-secondary">182 Lessons</span>
                            </p>
                            <p class="flex items-center gap-[6px]">
                                <img src="assets/images/icons/briefcase-green.svg" class="flex shrink-0 w-5" alt="icon">
                                <span class="text-sm text-obito-text-secondary">Ready to Work</span>
                            </p>
                        </div>
                    </div>
                </a>
                <a href="course-details.html" class="card">
                    <div class="course-card flex flex-col rounded-[20px] border border-obito-grey hover:border-obito-green transition-all duration-300 bg-white overflow-hidden">
                        <div class="thumbnail-container p-[10px]">
                            <div class="relative w-full h-[150px] rounded-[14px] overflow-hidden bg-obito-grey">
                                <img src="assets/images/thumbnails/thumbnail-9.png" class="w-full h-full object-cover" alt="thumbnail">
                                <p class="absolute top-[10px] right-[10px] z-10 w-fit h-fit flex flex-col items-center rounded-[14px] py-[6px] px-[10px] bg-white gap-0.5">
                                    <img src="assets/images/icons/like.svg" class="w-5 h-5" alt="icon">
                                    <span class="font-semibold text-xs">4.8</span>
                                </p>
                            </div>
                        </div>
                        <div class="flex flex-col p-4 pt-0 gap-[13px]">
                            <h3 class="font-bold text-lg line-clamp-2">Cyber Security for Dummies 101</h3>
                            <p class="flex items-center gap-[6px]">
                                <img src="assets/images/icons/crown-green.svg" class="flex shrink-0 w-5" alt="icon">
                                <span class="text-sm text-obito-text-secondary">Programming</span>
                            </p>
                            <p class="flex items-center gap-[6px]">
                                <img src="assets/images/icons/menu-board-green.svg" class="flex shrink-0 w-5" alt="icon">
                                <span class="text-sm text-obito-text-secondary">182 Lessons</span>
                            </p>
                            <p class="flex items-center gap-[6px]">
                                <img src="assets/images/icons/briefcase-green.svg" class="flex shrink-0 w-5" alt="icon">
                                <span class="text-sm text-obito-text-secondary">Ready to Work</span>
                            </p>
                        </div>
                    </div>
                </a>
            </div>
        </section>
    </main>

    @push('after-scripts')
    <script src="{{ asset('js/dropdown-navbar.js') }}"></script>
    @endpush


@endsection
