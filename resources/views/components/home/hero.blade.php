<section class="pt-10">
    <div class="container flex h-full items-stretch justify-center pt-20 gap-x-7">
        <div class="w-20 flex justify-center items-start">
            <div class="relative h-96  bg-slate-400/20 rounded-xl w-1 overflow-hidden">
                <span
                    style="height:{{ 1/count($steps) * 100 }}%"
                    class="absolute top-0 w-1 bg-rose-500 rounded-xl"
                ></span>
            </div>
        </div>

        <div class="flex-1 flex flex-col justify-between items-start gap-y-40">
            <div class="max-w-2xl space-y-7">
                <h1 class="text-7xl dark:text-white">{{ __('pages/home.hero.headline')  }}</h1>
                <p class="text-xl">{{ __('pages/home.hero.subheadline')  }}</p>
                <x-common.get-started text="{{ __('pages/home.hero.cta') }}"/>
            </div>

            <div class="w-full dark:bg-slate-400/20 bg-indigo-800/20 flex items-stretch gap-1">
                @foreach($steps as $step)
                    <div class="flex-1 py-5">
                        <div class="relative flex items-stretch justify-start flex-col gap-y-7">
                            @if($loop->first)
                                <span class="absolute left-0 w-1 h-6 bg-rose-400 rounded-r-2xl"></span>
                            @endif
                            <p
                                class="px-4 text-lg font-bold
                                    @if($loop->first) dark:text-white @endif text-opacity-70
                                    "
                            >
                                {{ $loop->index + 1  }}
                            </p>

                            <div class="px-4">
                                <p class="text-lg dark:text-slate-200 font-bold">{{ $step['title'] }}</p>
                                <p class="text-md">{{ $step['description'] }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="w-80 h-full flex-center">
                    <div class="w-full border-l h-20 flex items-center justify-around border-slate-400">
                        <a href="#" class="hover:text-indigo-800">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="w-8 h-8 hover:text-indigo-800"
                                viewBox="0 0 512 512"
                            >
                                <path fill="currentColor"
                                      d="M504 256C504 119 393 8 256 8S8 119 8 256c0 123.78 90.69 226.38 209.25 245V327.69h-63V256h63v-54.64c0-62.15 37-96.48 93.67-96.48c27.14 0 55.52 4.84 55.52 4.84v61h-31.28c-30.8 0-40.41 19.12-40.41 38.73V256h68.78l-11 71.69h-57.78V501C413.31 482.38 504 379.78 504 256z"/>
                            </svg>
                        </a>
                        <a href="#" class="hover:text-indigo-800">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="w-8 h-8 hover:text-indigo-800"
                                viewBox="0 0 24 24"
                            >
                                <path fill="currentColor"
                                      d="M22.46 6c-.77.35-1.6.58-2.46.69c.88-.53 1.56-1.37 1.88-2.38c-.83.5-1.75.85-2.72 1.05C18.37 4.5 17.26 4 16 4c-2.35 0-4.27 1.92-4.27 4.29c0 .34.04.67.11.98C8.28 9.09 5.11 7.38 3 4.79c-.37.63-.58 1.37-.58 2.15c0 1.49.75 2.81 1.91 3.56c-.71 0-1.37-.2-1.95-.5v.03c0 2.08 1.48 3.82 3.44 4.21a4.22 4.22 0 0 1-1.93.07a4.28 4.28 0 0 0 4 2.98a8.521 8.521 0 0 1-5.33 1.84c-.34 0-.68-.02-1.02-.06C3.44 20.29 5.7 21 8.12 21C16 21 20.33 14.46 20.33 8.79c0-.19 0-.37-.01-.56c.84-.6 1.56-1.36 2.14-2.23Z"/>
                            </svg>
                        </a>
                        <a href="#" class="hover:text-indigo-800">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="w-8 h-8 hover:text-indigo-800"
                                viewBox="0 0 24 24"
                            >
                                <path fill="currentColor"
                                      d="M7.8 2h8.4C19.4 2 22 4.6 22 7.8v8.4a5.8 5.8 0 0 1-5.8 5.8H7.8C4.6 22 2 19.4 2 16.2V7.8A5.8 5.8 0 0 1 7.8 2m-.2 2A3.6 3.6 0 0 0 4 7.6v8.8C4 18.39 5.61 20 7.6 20h8.8a3.6 3.6 0 0 0 3.6-3.6V7.6C20 5.61 18.39 4 16.4 4H7.6m9.65 1.5a1.25 1.25 0 0 1 1.25 1.25A1.25 1.25 0 0 1 17.25 8A1.25 1.25 0 0 1 16 6.75a1.25 1.25 0 0 1 1.25-1.25M12 7a5 5 0 0 1 5 5a5 5 0 0 1-5 5a5 5 0 0 1-5-5a5 5 0 0 1 5-5m0 2a3 3 0 0 0-3 3a3 3 0 0 0 3 3a3 3 0 0 0 3-3a3 3 0 0 0-3-3Z"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
