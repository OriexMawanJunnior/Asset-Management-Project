@extends('layouts.blank')

@section('title', 'Asset Create')

@section('content')
<div class="min-h-screen py-6 flex flex-col justify-center sm:py-12">
    <div class="relative py-3 sm:max-w-xl md:max-w-4xl mx-auto">
        <div class="relative px-4 py-10 bg-white mx-8 md:mx-0 shadow rounded-3xl sm:p-10">
            <div class="max-w-md mx-auto">
                <div class="divide-y divide-gray-200">
                    <div class="py-8 text-base leading-6 space-y-4 text-gray-700 sm:text-lg sm:leading-7">
                        <h2 class="text-2xl font-bold mb-6">Create New Asset</h2>
                        <form action="{{route('assets.store')}}" method="POST" class="space-y-6">
                            @csrf
                            
                            {{-- Basic Information --}}
                            <div class="space-y-4">
                                <div>
                                    <label for="name" class="text-sm font-medium text-gray-700">Name *</label>
                                    <input type="text" name="name" id="name" required
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                </div>

                                {{-- Reusable Autocomplete Component --}}
                                @php
                                $fields = [
                                    [
                                        'id' => 'category',
                                        'label' => 'Category',
                                        'placeholder' => 'Search category...'
                                    ],
                                    [
                                        'id' => 'subcategory',
                                        'label' => 'Subcategory',
                                        'placeholder' => 'Search subcategory...'
                                    ]
                                ];
                                @endphp

                                @foreach($fields as $field)
                                <div>
                                <label for="{{ $field['id'] }}" class="text-sm font-medium text-gray-700">{{ $field['label'] }} *</label>
                                    <div class="relative">
                                        <input type="text" 
                                            id="{{ $field['id'] }}_search" 
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                            placeholder="{{ $field['placeholder'] }}">
                                        <input type="hidden" 
                                            name="{{ $field['id'] }}_id" 
                                            id="{{ $field['id'] }}_id" 
                                            required>
                                        <div id="{{ $field['id'] }}_suggestions" 
                                            class="absolute z-10 w-full bg-white shadow-lg rounded-md hidden">
                                        </div>
                                    </div>
                                </div>
                                @endforeach

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label for="merk" class="text-sm font-medium text-gray-700">Merk</label>
                                        <input type="text" name="merk" id="merk"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    </div>

                                    <div>
                                        <label for="color" class="text-sm font-medium text-gray-700">Color</label>
                                        <input type="text" name="color" id="color"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label for="serial_number" class="text-sm font-medium text-gray-700">Serial Number</label>
                                        <input type="text" name="serial_number" id="serial_number"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    </div>

                                    <div>
                                        <label for="purchase_order_number" class="text-sm font-medium text-gray-700">PO Number</label>
                                        <input type="text" name="purchase_order_number" id="purchase_order_number"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label for="purchase_price" class="text-sm font-medium text-gray-700">Purchase Price</label>
                                        <input type="number" name="purchase_price" id="purchase_price" step="0.01"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    </div>

                                    <div>
                                        <label for="quantity" class="text-sm font-medium text-gray-700">Quantity *</label>
                                        <input type="number" name="quantity" id="quantity" required
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label for="condition" class="text-sm font-medium text-gray-700">Condition *</label>
                                        <select name="condition" id="condition" required
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                            <option value="">Select Condition</option>
                                            <option value="new">New</option>
                                            <option value="used">Used</option>
                                            <option value="damaged">Damaged</option>
                                        </select>
                                    </div>

                                    <div>
                                        <label for="status" class="text-sm font-medium text-gray-700">Status *</label>
                                        <select name="status" id="status" required
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                            <option value="">Select Status</option>
                                            <option value="available">Available</option>
                                            <option value="in_use">In Use</option>
                                            <option value="maintenance">Maintenance</option>
                                            <option value="disposed">Disposed</option>
                                        </select>
                                    </div>
                                </div>

                                <div>
                                    <label for="location" class="text-sm font-medium text-gray-700">Location</label>
                                    <input type="text" name="location" id="location"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                </div>

                                <div>
                                    <label for="remaks" class="text-sm font-medium text-gray-700">Remarks</label>
                                    <textarea name="remaks" id="remaks" rows="3"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                                </div>

                                <div>
                                    <label for="asset_detail_url" class="text-sm font-medium text-gray-700">Asset Detail URL</label>
                                    <input type="url" name="asset_detail_url" id="asset_detail_url"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                </div>

                                <div>
                                    <label for="date_of_receipt" class="text-sm font-medium text-gray-700">Date of Receipt *</label>
                                    <input type="date" name="date_of_receipt" id="date_of_receipt" required
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                </div>
                            </div>

                            <div class="pt-5">
                                <div class="flex justify-end">
                                    <button type="button" onclick="history.back()"
                                        class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        Cancel
                                    </button>
                                    <button type="submit"
                                        class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        Save
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Data dari controller
    const categories = @json($categories);
    const subcategories = @json($subcategories);

    // Konfigurasi untuk tiap field
    const fieldsConfig = {
        category: {
            data: categories,
            dependentField: 'subcategory'
        },
        subcategory: {
            data: subcategories,
            parentField: 'category',
            filterBy: 'category_id'
        }
    };

    // Setup autocomplete untuk setiap field
    Object.keys(fieldsConfig).forEach(fieldName => {
        setupAutocomplete(fieldName, fieldsConfig[fieldName]);
    });

    function setupAutocomplete(fieldName, config) {
        const searchInput = document.getElementById(`${fieldName}_search`);
        const hiddenInput = document.getElementById(`${fieldName}_id`);
        const suggestionBox = document.getElementById(`${fieldName}_suggestions`);
        
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            
            if (searchTerm.length < 1) {
                suggestionBox.classList.add('hidden');
                return;
            }
            
            let filteredData = config.data;
            
            // Jika ini adalah subcategory, filter berdasarkan category yang dipilih
            if (config.parentField) {
                const parentId = document.getElementById(`${config.parentField}_id`).value;
                filteredData = filteredData.filter(item => 
                    item[config.filterBy].toString() === parentId
                );
            }
            
            // Filter berdasarkan search term
            filteredData = filteredData.filter(item =>
                item.name.toLowerCase().includes(searchTerm)
            );
            
            if (filteredData.length > 0) {
                suggestionBox.innerHTML = filteredData.map(item => `
                    <div class="p-2 hover:bg-gray-100 cursor-pointer" 
                        data-id="${item.id}" 
                        data-name="${item.name}">
                        ${item.name}
                    </div>
                `).join('');
                
                suggestionBox.classList.remove('hidden');
                
                // Event click untuk setiap saran
                suggestionBox.querySelectorAll('div').forEach(div => {
                    div.addEventListener('click', function() {
                        searchInput.value = this.dataset.name;
                        hiddenInput.value = this.dataset.id;
                        suggestionBox.classList.add('hidden');
                        
                        // Reset dependent field jika ada
                        if (config.dependentField) {
                            const dependentSearch = document.getElementById(`${config.dependentField}_search`);
                            const dependentId = document.getElementById(`${config.dependentField}_id`);
                            if (dependentSearch && dependentId) {
                                dependentSearch.value = '';
                                dependentId.value = '';
                            }
                        }
                    });
                });
            } else {
                suggestionBox.classList.add('hidden');
            }
        });
    }

    // Hide suggestions when clicking outside
    document.addEventListener('click', function(e) {
        Object.keys(fieldsConfig).forEach(fieldName => {
            const searchInput = document.getElementById(`${fieldName}_search`);
            const suggestionBox = document.getElementById(`${fieldName}_suggestions`);
            
            if (!searchInput.contains(e.target) && !suggestionBox.contains(e.target)) {
                suggestionBox.classList.add('hidden');
            }
        });
    });
});
</script>
@endsection