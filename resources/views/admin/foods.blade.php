<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Management | Admin Panel</title>
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

        .status-pill {
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
        is_available: true
    },
    openEdit(food) {
        this.editData = JSON.parse(JSON.stringify(food));
        this.editData.is_available = !!this.editData.is_available;
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
                    <span class="font-black tracking-widest uppercase text-lg">Food Management</span>
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

        @if($errors->any())
            <div class="mb-8 bg-red-500/20 border border-red-500/50 text-red-200 px-6 py-4 rounded-2xl">
                <ul class="list-disc list-inside font-bold text-sm">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Add New Food Form -->
            <div class="lg:col-span-1">
                <div class="glass-card p-6 sticky top-28">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="h-10 w-10 bg-purple-500/20 rounded-xl flex items-center justify-center text-purple-300">
                            <i class="fas fa-hamburger"></i>
                        </div>
                        <h2 class="text-xl font-black">Add New Food</h2>
                    </div>

                    <form action="{{ route('admin.foods.add') }}" method="POST" enctype="multipart/form-data" class="space-y-3">
                        @csrf
                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-widest text-purple-200 mb-1">Food Name</label>
                            <input type="text" name="name" placeholder="e.g. Double Beef Burger" required class="w-full px-4 py-2.5 rounded-xl">
                        </div>

                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-widest text-purple-200 mb-1">Category</label>
                            <input type="text" name="category" placeholder="e.g. Burger, Pizza, Drinks" required class="w-full px-4 py-2.5 rounded-xl">
                        </div>

                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-widest text-purple-200 mb-1">Price ($)</label>
                            <input type="number" step="0.01" name="price" placeholder="0.00" required class="w-full px-4 py-2.5 rounded-xl">
                        </div>

                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-widest text-purple-200 mb-1">Description</label>
                            <textarea name="description" rows="2" placeholder="Brief description..." class="w-full px-4 py-2.5 rounded-xl resize-none"></textarea>
                        </div>

                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-widest text-purple-200 mb-1">Image URL (Optional)</label>
                            <input type="text" name="image" placeholder="https://..." class="w-full px-4 py-2.5 rounded-xl">
                        </div>

                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-widest text-purple-200 mb-1">Or Upload Image</label>
                            <input type="file" name="image_file" class="w-full px-4 py-2 rounded-xl text-[10px] file:mr-4 file:py-1 file:px-4 file:rounded-full file:border-0 file:text-[10px] file:font-black file:bg-purple-500/20 file:text-purple-300 hover:file:bg-purple-500/30">
                        </div>

                        <div class="pt-2">
                            <label :class="addForm.is_available ? 'pill-active' : 'pill-inactive'" class="status-pill w-full justify-center">
                                <input type="checkbox" name="is_available" value="1" x-model="addForm.is_available" class="hidden">
                                <i class="fas" :class="addForm.is_available ? 'fa-check-circle' : 'fa-circle opacity-20'"></i>
                                <span class="text-[9px] font-black uppercase tracking-widest">Available for Order</span>
                            </label>
                        </div>

                        <button type="submit" class="w-full bg-white text-purple-700 font-black uppercase tracking-widest py-3.5 rounded-xl shadow-xl hover:bg-purple-50 transition-all active:scale-95 mt-2">
                            Add to Menu
                        </button>
                    </form>
                </div>
            </div>

            <!-- Foods List -->
            <div class="lg:col-span-2">
                <div class="glass-card overflow-hidden">
                    <div class="p-8 border-b border-white/10 flex justify-between items-center">
                        <div>
                            <h2 class="text-2xl font-black">Menu Items</h2>
                            <p class="text-purple-200 text-xs font-bold uppercase tracking-widest mt-1 opacity-70">Manage your restaurant's food menu</p>
                        </div>
                        <i class="fas fa-utensils text-4xl opacity-20"></i>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="table-header text-[10px] font-black uppercase tracking-[0.2em] text-purple-200">
                                    <th class="px-8 py-5">Item</th>
                                    <th class="px-8 py-5">Category</th>
                                    <th class="px-8 py-5">Price</th>
                                    <th class="px-8 py-5 text-center">Status</th>
                                    <th class="px-8 py-5 text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-white/5">
                                @forelse($foods as $food)
                                <tr class="hover:bg-white/5 transition-colors group">
                                    <td class="px-8 py-6">
                                        <div class="flex items-center gap-4">
                                            <div class="h-12 w-12 rounded-xl bg-white/10 overflow-hidden border border-white/10">
                                                @if($food->image)
                                                    <img src="{{ asset($food->image) }}" alt="{{ $food->name }}" class="h-full w-full object-cover">
                                                @else
                                                    <div class="h-full w-full flex items-center justify-center text-xs font-black opacity-20">NA</div>
                                                @endif
                                            </div>
                                            <div>
                                                <div class="font-black text-white tracking-wide">{{ $food->name }}</div>
                                                <div class="text-[9px] text-white/40 uppercase tracking-tighter truncate max-w-[150px]">{{ $food->description ?? 'No description' }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-8 py-6">
                                        <span class="bg-blue-500/20 text-blue-300 text-[10px] font-black px-3 py-1 rounded-full uppercase tracking-widest border border-blue-500/30">
                                            {{ $food->category }}
                                        </span>
                                    </td>
                                    <td class="px-8 py-6">
                                        <div class="text-sm font-black text-purple-300">${{ number_format($food->price, 2) }}</div>
                                    </td>
                                    <td class="px-8 py-6 text-center">
                                        @if($food->is_available)
                                            <span class="px-3 py-1 bg-green-500/20 text-green-300 text-[9px] font-black uppercase tracking-widest rounded-full border border-green-500/30">Available</span>
                                        @else
                                            <span class="px-3 py-1 bg-red-500/20 text-red-300 text-[9px] font-black uppercase tracking-widest rounded-full border border-red-500/30">Out of Stock</span>
                                        @endif
                                    </td>
                                    <td class="px-8 py-6 text-right">
                                        <div class="flex justify-end gap-2">
                                            <button @click="openEdit({{ json_encode($food) }})" class="h-10 w-10 rounded-xl bg-white/5 hover:bg-purple-500/20 text-white transition-all flex items-center justify-center border border-white/10">
                                                <i class="fas fa-edit text-xs"></i>
                                            </button>
                                            <form action="{{ route('admin.foods.delete', $food->id) }}" method="POST" onsubmit="return confirm('Delete this food item?')">
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
                                    <td colspan="5" class="px-8 py-20 text-center">
                                        <div class="text-4xl mb-4 opacity-20">🍔</div>
                                        <p class="text-purple-200/50 font-bold uppercase tracking-widest text-xs">No food items found in menu</p>
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
                <h2 class="text-xl font-black">Edit Menu Item</h2>
                <button @click="editModal = false" class="text-white/50 hover:text-white transition-colors">
                    <i class="fas fa-times text-lg"></i>
                </button>
            </div>
            
            <form :action="'{{ url('/admin/foods/update') }}/' + editData.id" method="POST" enctype="multipart/form-data" class="overflow-y-auto modal-content-scroll">
                @csrf
                <div class="p-6 space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-widest text-purple-200 mb-1">Food Name</label>
                            <input type="text" name="name" x-model="editData.name" required class="w-full px-4 py-2 rounded-xl">
                        </div>
                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-widest text-purple-200 mb-1">Category</label>
                            <input type="text" name="category" x-model="editData.category" required class="w-full px-4 py-2 rounded-xl">
                        </div>
                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-widest text-purple-200 mb-1">Price ($)</label>
                            <input type="number" step="0.01" name="price" x-model="editData.price" required class="w-full px-4 py-2 rounded-xl">
                        </div>
                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-widest text-purple-200 mb-1">Image URL</label>
                            <input type="text" name="image" x-model="editData.image" class="w-full px-4 py-2 rounded-xl">
                        </div>
                    </div>

                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-widest text-purple-200 mb-1">Description</label>
                        <textarea name="description" x-model="editData.description" rows="3" class="w-full px-4 py-2 rounded-xl resize-none"></textarea>
                    </div>

                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-widest text-purple-200 mb-1">Change Image File</label>
                        <input type="file" name="image_file" class="w-full px-4 py-2 rounded-xl text-[10px] file:mr-4 file:py-1 file:px-4 file:rounded-full file:border-0 file:text-[10px] file:font-black file:bg-purple-500/20 file:text-purple-300">
                    </div>

                    <div class="pt-2">
                        <label :class="editData.is_available ? 'pill-active' : 'pill-inactive'" class="status-pill w-full justify-center">
                            <input type="checkbox" name="is_available" value="1" x-model="editData.is_available" class="hidden">
                            <i class="fas" :class="editData.is_available ? 'fa-check-circle' : 'fa-circle opacity-20'"></i>
                            <span class="text-[9px] font-black uppercase tracking-widest">Available for Order</span>
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
