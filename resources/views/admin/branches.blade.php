<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Branch Management | Admin Panel</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <style>
        body {
            background: linear-gradient(135deg, #2d004d, #5f0f9c, #9d4edd) !important;
            background-attachment: fixed !important;
            min-height: 100vh;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 2rem;
        }

        .table-header {
            background: rgba(255, 255, 255, 0.1);
        }

        input, select, textarea {
            background: rgba(255, 255, 255, 0.05) !important;
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
            color: white !important;
            font-size: 0.85rem !important;
        }

        input:focus, select:focus, textarea:focus {
            border-color: #9d4edd !important;
            outline: none !important;
            box-shadow: 0 0 0 4px rgba(157, 78, 221, 0.2) !important;
        }

        .modal-bg {
            background: rgba(0, 0, 0, 0.8);
            backdrop-filter: blur(10px);
        }

        .facility-pill {
            @apply flex items-center gap-2 px-3 py-2 rounded-xl border transition-all cursor-pointer select-none;
        }

        .pill-active {
            @apply bg-purple-500/20 border-purple-500/50 text-white shadow-[0_0_15px_rgba(168,85,247,0.2)];
        }

        .pill-inactive {
            @apply bg-white/5 border-white/10 text-white/40;
        }

        /* Custom Scrollbar for Modal */
        .modal-content-scroll::-webkit-scrollbar { width: 4px; }
        .modal-content-scroll::-webkit-scrollbar-track { background: transparent; }
        .modal-content-scroll::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.1); border-radius: 10px; }
    </style>
</head>
<body class="font-sans antialiased text-white" x-data="{ 
    editModal: false, 
    editData: {},
    addForm: {
        has_wifi: true,
        has_ac: true,
        has_parking: true,
        is_open: true
    },
    openEdit(branch) {
        this.editData = JSON.parse(JSON.stringify(branch));
        this.editData.has_wifi = !!this.editData.has_wifi;
        this.editData.has_ac = !!this.editData.has_ac;
        this.editData.has_parking = !!this.editData.has_parking;
        this.editData.is_open = !!this.editData.is_open;
        this.editModal = true;
    }
}">
    <!-- Header -->
    <header class="bg-white/5 border-b border-white/10 sticky top-0 z-50 backdrop-blur-xl">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <div class="flex items-center gap-4">
                    <a href="{{ route('admin.dashboard') }}" class="h-10 w-10 bg-white/10 hover:bg-white/20 flex items-center justify-center rounded-xl transition-all">
                        <i class="fas fa-chevron-left text-xs text-white"></i>
                    </a>
                    <span class="font-black tracking-widest uppercase text-lg">Branch Management</span>
                </div>
                
                <div class="flex items-center gap-4">
                    <span class="text-[10px] font-black uppercase tracking-widest opacity-60">Admin Access</span>
                    <div class="h-10 w-10 rounded-xl bg-gradient-to-tr from-purple-500 to-pink-500 p-[2px]">
                        <div class="h-full w-full bg-[#2d004d] rounded-[10px] flex items-center justify-center font-black text-xs">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Status Messages -->
        @if(session('success'))
            <div class="mb-8 bg-green-500/20 border border-green-500/50 text-green-200 px-6 py-4 rounded-2xl flex items-center gap-4">
                <i class="fas fa-check-circle"></i>
                <span class="font-bold text-sm">{{ session('success') }}</span>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Add New Branch Form -->
            <div class="lg:col-span-1">
                <div class="glass-card p-6 sticky top-28">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="h-10 w-10 bg-purple-500/20 rounded-xl flex items-center justify-center text-purple-300">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <h2 class="text-xl font-black">Add Branch</h2>
                    </div>

                    <form action="{{ route('admin.branches.add') }}" method="POST" class="space-y-3">
                        @csrf
                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-widest text-purple-200 mb-1">Branch Name</label>
                            <input type="text" name="name" placeholder="e.g. Dhaka Main" required class="w-full px-4 py-2.5 rounded-xl">
                        </div>

                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="block text-[10px] font-black uppercase tracking-widest text-purple-200 mb-1">City</label>
                                <input type="text" name="city" placeholder="e.g. Dhaka" required class="w-full px-4 py-2.5 rounded-xl">
                            </div>
                            <div>
                                <label class="block text-[10px] font-black uppercase tracking-widest text-purple-200 mb-1">Area</label>
                                <input type="text" name="area" placeholder="e.g. Banani" required class="w-full px-4 py-2.5 rounded-xl">
                            </div>
                        </div>

                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-widest text-purple-200 mb-1">Email Address</label>
                            <input type="email" name="email" placeholder="branch@rms.com" required class="w-full px-4 py-2.5 rounded-xl">
                        </div>

                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-widest text-purple-200 mb-1">Phone Number</label>
                            <input type="text" name="phone" placeholder="e.g. 017123..." required class="w-full px-4 py-2.5 rounded-xl">
                        </div>

                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-widest text-purple-200 mb-1">Full Address</label>
                            <input type="text" name="address" placeholder="e.g. House 1, Road 2..." required class="w-full px-4 py-2.5 rounded-xl">
                        </div>

                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="block text-[10px] font-black uppercase tracking-widest text-purple-200 mb-1">Opens At</label>
                                <input type="time" name="opening_time" required class="w-full px-4 py-2.5 rounded-xl">
                            </div>
                            <div>
                                <label class="block text-[10px] font-black uppercase tracking-widest text-purple-200 mb-1">Closes At</label>
                                <input type="time" name="closing_time" required class="w-full px-4 py-2.5 rounded-xl">
                            </div>
                        </div>

                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-widest text-purple-200 mb-1">Map Link (Optional)</label>
                            <input type="url" name="map_link" placeholder="https://..." class="w-full px-4 py-2.5 rounded-xl">
                        </div>

                        <div class="grid grid-cols-2 gap-2 pt-2">
                            <!-- Facility Pills -->
                            <label :class="addForm.has_wifi ? 'pill-active' : 'pill-inactive'" class="facility-pill">
                                <input type="checkbox" name="has_wifi" value="1" x-model="addForm.has_wifi" class="hidden">
                                <i class="fas" :class="addForm.has_wifi ? 'fa-check-circle' : 'fa-circle opacity-20'"></i>
                                <span class="text-[9px] font-black uppercase tracking-widest">WiFi</span>
                            </label>
                            <label :class="addForm.has_ac ? 'pill-active' : 'pill-inactive'" class="facility-pill">
                                <input type="checkbox" name="has_ac" value="1" x-model="addForm.has_ac" class="hidden">
                                <i class="fas" :class="addForm.has_ac ? 'fa-check-circle' : 'fa-circle opacity-20'"></i>
                                <span class="text-[9px] font-black uppercase tracking-widest">AC</span>
                            </label>
                            <label :class="addForm.has_parking ? 'pill-active' : 'pill-inactive'" class="facility-pill">
                                <input type="checkbox" name="has_parking" value="1" x-model="addForm.has_parking" class="hidden">
                                <i class="fas" :class="addForm.has_parking ? 'fa-check-circle' : 'fa-circle opacity-20'"></i>
                                <span class="text-[9px] font-black uppercase tracking-widest">Parking</span>
                            </label>
                            <label :class="addForm.is_open ? 'pill-active' : 'pill-inactive'" class="facility-pill">
                                <input type="checkbox" name="is_open" value="1" x-model="addForm.is_open" class="hidden">
                                <i class="fas" :class="addForm.is_open ? 'fa-check-circle' : 'fa-circle opacity-20'"></i>
                                <span class="text-[9px] font-black uppercase tracking-widest">Open</span>
                            </label>
                        </div>

                        <button type="submit" class="w-full bg-white text-purple-700 font-black uppercase tracking-widest py-3.5 rounded-xl shadow-xl hover:bg-purple-50 transition-all active:scale-95 mt-2">
                            Create Branch
                        </button>
                    </form>
                </div>
            </div>

            <!-- Branches List -->
            <div class="lg:col-span-2">
                <div class="glass-card overflow-hidden">
                    <div class="p-8 border-b border-white/10 flex justify-between items-center">
                        <div>
                            <h2 class="text-2xl font-black">Current Locations</h2>
                            <p class="text-purple-200 text-xs font-bold uppercase tracking-widest mt-1 opacity-70">Manage your restaurant branches</p>
                        </div>
                        <i class="fas fa-store text-4xl opacity-20"></i>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="table-header text-[10px] font-black uppercase tracking-[0.2em] text-purple-200">
                                    <th class="px-8 py-5">Branch</th>
                                    <th class="px-8 py-5">Facilities</th>
                                    <th class="px-8 py-5 text-center">Status</th>
                                    <th class="px-8 py-5 text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-white/5">
                                @forelse($branches as $branch)
                                <tr class="hover:bg-white/5 transition-colors group">
                                    <td class="px-8 py-6">
                                        <div class="font-black text-lg tracking-wider text-purple-200">{{ $branch->name }}</div>
                                        <div class="text-[9px] text-white/40 uppercase tracking-tighter">{{ $branch->email }}</div>
                                        <div class="text-[9px] text-white/40 uppercase tracking-tighter">Phone: {{ $branch->phone }}</div>
                                    </td>
                                    <td class="px-8 py-6">
                                        <div class="flex gap-2">
                                            <i class="fas fa-wifi text-xs {{ $branch->has_wifi ? 'text-green-400' : 'text-white/20' }}" title="WiFi"></i>
                                            <i class="fas fa-snowflake text-xs {{ $branch->has_ac ? 'text-blue-400' : 'text-white/20' }}" title="AC"></i>
                                            <i class="fas fa-car text-xs {{ $branch->has_parking ? 'text-orange-400' : 'text-white/20' }}" title="Parking"></i>
                                        </div>
                                        <div class="text-[10px] text-white/50 mt-1 font-bold">{{ $branch->area }}, {{ $branch->city }}</div>
                                    </td>
                                    <td class="px-8 py-6 text-center">
                                        @if($branch->is_open)
                                            <span class="px-3 py-1 bg-green-500/20 text-green-300 text-[9px] font-black uppercase tracking-widest rounded-full border border-green-500/30">Open</span>
                                        @else
                                            <span class="px-3 py-1 bg-red-500/20 text-red-300 text-[9px] font-black uppercase tracking-widest rounded-full border border-red-500/30">Closed</span>
                                        @endif
                                    </td>
                                    <td class="px-8 py-6 text-right">
                                        <div class="flex justify-end gap-2">
                                            <button @click="openEdit({{ json_encode($branch) }})" class="h-10 w-10 rounded-xl bg-white/5 hover:bg-purple-500/20 text-white transition-all flex items-center justify-center border border-white/10">
                                                <i class="fas fa-edit text-xs"></i>
                                            </button>
                                            <form action="{{ route('admin.branches.delete', $branch->id) }}" method="POST" onsubmit="return confirm('Delete this branch?')">
                                                @csrf
                                                <button type="submit" class="h-10 w-10 rounded-xl bg-white/5 hover:bg-red-500/20 hover:text-red-400 border border-white/10 transition-all flex items-center justify-center">
                                                    <i class="fas fa-trash-alt text-xs"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="px-8 py-20 text-center">
                                        <div class="text-4xl mb-4 opacity-20">📍</div>
                                        <p class="text-purple-200/50 font-bold uppercase tracking-widest text-xs">No branches found</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Edit Modal -->
    <div x-show="editModal" class="fixed inset-0 z-[100] flex items-center justify-center p-4 modal-bg" x-cloak x-transition>
        <div class="glass-card w-full max-w-lg overflow-hidden shadow-2xl border-white/20 flex flex-col max-h-[90vh]" @click.away="editModal = false">
            <div class="p-6 border-b border-white/10 flex justify-between items-center bg-white/5">
                <h2 class="text-xl font-black">Edit Branch</h2>
                <button @click="editModal = false" class="text-white/50 hover:text-white transition-colors">
                    <i class="fas fa-times text-lg"></i>
                </button>
            </div>
            
            <form :action="'{{ url('/admin/branches/update') }}/' + editData.id" method="POST" class="overflow-y-auto modal-content-scroll">
                @csrf
                <div class="p-6 space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-widest text-purple-200 mb-1">Branch Name</label>
                            <input type="text" name="name" x-model="editData.name" required class="w-full px-4 py-2 rounded-xl">
                        </div>
                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-widest text-purple-200 mb-1">Email</label>
                            <input type="email" name="email" x-model="editData.email" required class="w-full px-4 py-2 rounded-xl">
                        </div>
                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-widest text-purple-200 mb-1">City</label>
                            <input type="text" name="city" x-model="editData.city" required class="w-full px-4 py-2 rounded-xl">
                        </div>
                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-widest text-purple-200 mb-1">Area</label>
                            <input type="text" name="area" x-model="editData.area" required class="w-full px-4 py-2 rounded-xl">
                        </div>
                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-widest text-purple-200 mb-1">Phone</label>
                            <input type="text" name="phone" x-model="editData.phone" required class="w-full px-4 py-2 rounded-xl">
                        </div>
                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-widest text-purple-200 mb-1">Map Link</label>
                            <input type="url" name="map_link" x-model="editData.map_link" class="w-full px-4 py-2 rounded-xl">
                        </div>
                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-widest text-purple-200 mb-1">Opens At</label>
                            <input type="time" name="opening_time" x-model="editData.opening_time" required class="w-full px-4 py-2 rounded-xl">
                        </div>
                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-widest text-purple-200 mb-1">Closes At</label>
                            <input type="time" name="closing_time" x-model="editData.closing_time" required class="w-full px-4 py-2 rounded-xl">
                        </div>
                    </div>

                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-widest text-purple-200 mb-1">Address</label>
                        <textarea name="address" x-model="editData.address" rows="2" required class="w-full px-4 py-2 rounded-xl resize-none"></textarea>
                    </div>

                    <div class="grid grid-cols-2 gap-3 bg-white/5 p-4 rounded-xl border border-white/10">
                        <!-- Facility Pills for Modal -->
                        <label :class="editData.has_wifi ? 'pill-active' : 'pill-inactive'" class="facility-pill">
                            <input type="checkbox" name="has_wifi" value="1" x-model="editData.has_wifi" class="hidden">
                            <i class="fas" :class="editData.has_wifi ? 'fa-check-circle' : 'fa-circle opacity-20'"></i>
                            <span class="text-[9px] font-black uppercase tracking-widest">WiFi</span>
                        </label>
                        <label :class="editData.has_ac ? 'pill-active' : 'pill-inactive'" class="facility-pill">
                            <input type="checkbox" name="has_ac" value="1" x-model="editData.has_ac" class="hidden">
                            <i class="fas" :class="editData.has_ac ? 'fa-check-circle' : 'fa-circle opacity-20'"></i>
                            <span class="text-[9px] font-black uppercase tracking-widest">AC</span>
                        </label>
                        <label :class="editData.has_parking ? 'pill-active' : 'pill-inactive'" class="facility-pill">
                            <input type="checkbox" name="has_parking" value="1" x-model="editData.has_parking" class="hidden">
                            <i class="fas" :class="editData.has_parking ? 'fa-check-circle' : 'fa-circle opacity-20'"></i>
                            <span class="text-[9px] font-black uppercase tracking-widest">Parking</span>
                        </label>
                        <label :class="editData.is_open ? 'pill-active' : 'pill-inactive'" class="facility-pill">
                            <input type="checkbox" name="is_open" value="1" x-model="editData.is_open" class="hidden">
                            <i class="fas" :class="editData.is_open ? 'fa-check-circle' : 'fa-circle opacity-20'"></i>
                            <span class="text-[9px] font-black uppercase tracking-widest">Open</span>
                        </label>
                    </div>
                </div>

                <div class="p-6 pt-2 flex justify-end gap-3 border-t border-white/10">
                    <button type="button" @click="editModal = false" class="px-6 py-2.5 rounded-xl font-black text-[10px] uppercase tracking-widest transition-all bg-white/10 text-white border border-white/10 hover:bg-white/20">
                        Cancel
                    </button>
                    <button type="submit" class="px-6 py-2.5 rounded-xl font-black text-[10px] uppercase tracking-widest transition-all bg-white text-purple-700 shadow-xl hover:bg-purple-50">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
