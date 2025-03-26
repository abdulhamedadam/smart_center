<x-filament-panels::page>
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes slideIn {
            from { transform: translateX(-20px); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        @keyframes progressFill {
            from { width: 0%; }
            to { width: 50%; }
        }

        .animate-fade-in {
            animation: fadeIn 0.6s ease-out forwards;
        }

        .animate-slide-in {
            animation: slideIn 0.5s ease-out forwards;
        }

        .animate-pulse {
            animation: pulse 2s infinite;
        }

        .animate-progress {
            animation: progressFill 1.5s ease-out forwards;
            animation-delay: 0.8s;
        }

        .tab-animate {
            position: relative;
            transition: all 0.3s ease;
        }

        .tab-animate:after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 0;
            left: 0;
            background-color: currentColor;
            transition: width 0.3s ease;
        }

        .tab-animate:hover:after {
            width: 100%;
        }

        .active-tab:after {
            width: 100%;
        }

        .stat-card {
            opacity: 0;
            animation: fadeIn 0.5s ease-out forwards;
        }

        .stat-card:nth-child(1) {
            animation-delay: 0.3s;
        }

        .stat-card:nth-child(2) {
            animation-delay: 0.5s;
        }

        .stat-card:nth-child(3) {
            animation-delay: 0.7s;
        }
    </style>
    <div style="width: 100%;padding: 20px" >
        <div class="bg-white rounded-xl shadow-lg mb-8 overflow-hidden animate-fade-in">
            <div style="padding: 20px">
                <div class="flex flex-wrap md:flex-nowrap gap-3">

                    <div class="mr-7 mb-4 relative animate-slide-in" style="opacity: 0; animation-delay: 0.2s;">
                        <div class="relative">
                            <div class="shadow-lg" style="width: 200px; height: 200px; border: 4px solid #e5e7eb;">
                                <img src="{{asset('build/flags/student.png')}}" alt="Profile image" class="w-full h-full object-cover" />
                            </div>
                            <div class="absolute bottom-0 right-0 w-5 h-5 bg-green-500 border-white transform translate-x-1/4"></div>
                        </div>
                    </div>


                    <div class="flex-grow">
                        <!-- Title Section -->
                        <div class="flex justify-between items-start flex-wrap mb-2">
                            <!-- User -->
                            <div class="animate-slide-in " style="opacity: 0; animation-delay: 0.4s;">

                                <div class="flex items-center mb-2">
                                    <a href="#" class="text-gray-900 hover:text-blue-600 text-2xl font-bold mr-1 transition duration-300">Max Smith</a>
                                    <span class="text-blue-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 animate-pulse" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </span>
                                </div>

                                <div class="flex flex-wrap text-sm font-semibold mb-4 gap-3">
                                    <a href="#" class="flex items-center text-gray-500 hover:text-blue-600 mr-5 mb-2 transition duration-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                        Developer
                                    </a>
                                    <a href="#" class="flex items-center text-gray-500 hover:text-blue-600 mr-5 mb-2 transition duration-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        SF, Bay Area
                                    </a>
                                    <a href="#" class="flex items-center text-gray-500 hover:text-blue-600 mb-2 transition duration-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                        max@example.com
                                    </a>
                                </div>
                            </div>

                            <!-- Actions -->
                            <div class="flex my-4 animate-slide-in" style="opacity: 0; animation-delay: 0.6s;">
                                <button class="bg-gray-100 hover:bg-gray-200 text-gray-800 font-semibold py-2 px-4 rounded mr-2 transition duration-300 group">
                                    <span class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 opacity-0 group-hover:opacity-100 transition-opacity duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        Follow
                                    </span>
                                </button>
                                <button class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded mr-3 transition duration-300 transform hover:scale-105">
                                    Hire Me
                                </button>
                                <!-- Menu -->
                                <div class="relative">
                                    <button class="bg-gray-100 hover:bg-gray-200 text-gray-700 p-2 rounded-full transition duration-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Stats -->
                        <div class="flex flex-wrap flex-stack">
                            <!-- Stats Wrapper -->
                            <div class="flex flex-col flex-grow pr-8 ">
                                <div class="flex flex-wrap gap-3">

                                    <div class="stat-card border border-gray-300 border-dashed rounded min-w-[125px] py-3 px-4 mr-6 mb-3 hover:border-blue-300 hover:shadow-md transition duration-300">
                                        <!-- Number -->
                                        <div class="flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
                                            </svg>
                                            <div class="text-2xl font-bold" id="earnings-counter">$0</div>
                                        </div>
                                        <!-- Label -->
                                        <div class="font-semibold text-sm text-gray-500">Earnings</div>
                                    </div>

                                    <!-- Stat 2 -->
                                    <div class="stat-card border border-gray-300 border-dashed rounded min-w-[125px] py-3 px-4 mr-6 mb-3 hover:border-blue-300 hover:shadow-md transition duration-300">
                                        <!-- Number -->
                                        <div class="flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-red-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                                            </svg>
                                            <div class="text-2xl font-bold" id="projects-counter">0</div>
                                        </div>
                                        <!-- Label -->
                                        <div class="font-semibold text-sm text-gray-500">Projects</div>
                                    </div>

                                    <!-- Stat 3 -->
                                    <div class="stat-card border border-gray-300 border-dashed rounded min-w-[125px] py-3 px-4 mr-6 mb-3 hover:border-blue-300 hover:shadow-md transition duration-300">
                                        <!-- Number -->
                                        <div class="flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
                                            </svg>
                                            <div class="text-2xl font-bold" id="success-counter">0</div>
                                        </div>
                                        <!-- Label -->
                                        <div class="font-semibold text-sm text-gray-500">Success Rate</div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- Navigation Tabs -->
                <ul class="flex border-b border-gray-200 mt-6 gap-4">
                    <li class="mr-10 animate-fade-in" style="opacity: 0; animation-delay: 1s;">
                        <a class="tab-animate active-tab inline-block py-4 text-blue-600 font-bold" href="#">Overview</a>
                    </li>
                    <li class="mr-10 animate-fade-in" style="opacity: 0; animation-delay: 1.1s;">
                        <a class="tab-animate inline-block py-4 text-gray-500 hover:text-blue-600 font-bold" href="#">Projects</a>
                    </li>
                    <li class="mr-10 animate-fade-in" style="opacity: 0; animation-delay: 1.2s;">
                        <a class="tab-animate inline-block py-4 text-gray-500 hover:text-blue-600 font-bold" href="#">Campaigns</a>
                    </li>
                    <li class="mr-10 animate-fade-in" style="opacity: 0; animation-delay: 1.3s;">
                        <a class="tab-animate inline-block py-4 text-gray-500 hover:text-blue-600 font-bold" href="#">Documents</a>
                    </li>
                    <li class="mr-10 animate-fade-in" style="opacity: 0; animation-delay: 1.4s;">
                        <a class="tab-animate inline-block py-4 text-gray-500 hover:text-blue-600 font-bold" href="#">Followers</a>
                    </li>
                    <li class="mr-10 animate-fade-in" style="opacity: 0; animation-delay: 1.5s;">
                        <a class="tab-animate inline-block py-4 text-gray-500 hover:text-blue-600 font-bold" href="#">Activity</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</x-filament-panels::page>
<script>
    // Simple counter animation
    function animateCounter(elementId, targetValue, prefix = '') {
        let currentValue = 0;
        const element = document.getElementById(elementId);
        const duration = 1500; // Animation duration in ms
        const steps = 60; // Number of steps
        const stepValue = targetValue / steps;
        const stepTime = duration / steps;

        // Start animation after a delay
        setTimeout(() => {
            const interval = setInterval(() => {
                currentValue += stepValue;
                if (currentValue >= targetValue) {
                    currentValue = targetValue;
                    clearInterval(interval);
                }
                element.textContent = `${prefix}${Math.round(currentValue)}`;
            }, stepTime);
        }, 1000); // 1 second delay before starting
    }

    // Initialize counters
    document.addEventListener('DOMContentLoaded', () => {
        animateCounter('earnings-counter', 4500, '$');
        animateCounter('projects-counter', 80);
        animateCounter('success-counter', 60, '');

        // Add % sign after success counter finishes
        setTimeout(() => {
            const successCounter = document.getElementById('success-counter');
            successCounter.textContent = successCounter.textContent + '%';
        }, 2600);

        // Tab animation
        const tabs = document.querySelectorAll('.tab-animate');
        tabs.forEach(tab => {
            tab.addEventListener('click', (e) => {
                e.preventDefault();

                // Remove active class from all tabs
                tabs.forEach(t => t.classList.remove('active-tab'));

                // Add active class to clicked tab
                tab.classList.add('active-tab');
            });
        });
    });
</script>
