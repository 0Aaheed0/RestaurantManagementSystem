<x-app-layout>
    <div class="max-w-4xl mx-auto px-6 py-12">
        <div class="bg-white p-8 rounded-3xl shadow-lg border border-slate-200">
            <h1 class="text-4xl font-black text-slate-800 mb-6 pb-4 border-b border-slate-200">Staff Application</h1>
            <form action="/apply-staff" method="POST" class="space-y-6">
                @csrf

                <div>
                    <label for="full_name" class="text-lg font-bold text-slate-700">Full Name</label>
                    <input id="full_name" type="text" name="full_name" placeholder="Enter your full name" required 
                           class="w-full mt-2 px-5 py-4 text-lg text-slate-700 bg-slate-50 rounded-2xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all">
                </div>

                <div>
                    <label for="email" class="text-lg font-bold text-slate-700">Email Address</label>
                    <input id="email" type="email" name="email" placeholder="you@example.com" required
                           class="w-full mt-2 px-5 py-4 text-lg text-slate-700 bg-slate-50 rounded-2xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all">
                </div>

                <div>
                    <label for="phone" class="text-lg font-bold text-slate-700">Phone Number</label>
                    <input id="phone" type="text" name="phone" placeholder="Your contact number"
                           class="w-full mt-2 px-5 py-4 text-lg text-slate-700 bg-slate-50 rounded-2xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all">
                </div>

                <div>
                    <label for="position" class="text-lg font-bold text-slate-700">Position Applied For</label>
                    <input id="position" type="text" name="position" placeholder="e.g., Chef, Waiter, Manager" required
                           class="w-full mt-2 px-5 py-4 text-lg text-slate-700 bg-slate-50 rounded-2xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all">
                </div>

                <div>
                    <label for="experience" class="text-lg font-bold text-slate-700">Relevant Experience</label>
                    <textarea id="experience" name="experience" placeholder="Briefly describe your past work experience" rows="5"
                              class="w-full mt-2 px-5 py-4 text-lg text-slate-700 bg-slate-50 rounded-2xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all"></textarea>
                </div>

                <div class="pt-4">
                    <button type="submit" 
                            class="w-full bg-purple-600 hover:bg-purple-700 text-white font-black text-lg uppercase py-5 rounded-2xl shadow-lg hover:shadow-xl transition-all active:scale-95">
                        Submit Application
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>