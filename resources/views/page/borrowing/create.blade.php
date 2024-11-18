@extends('layouts.blank')

@section('title', 'Borrowing Create')

@section('content')
<div class="min-h-screen py-6 flex flex-col justify-center sm:py-12">
    <div class="relative py-3 sm:max-w-xl md:max-w-4xl mx-auto">
        <div class="relative px-4 py-10 bg-white mx-8 md:mx-0 shadow rounded-3xl sm:p-10">
            <div class="max-w-md mx-auto">
                <div class="divide-y divide-gray-200">
                    <div class="py-8 text-base leading-6 space-y-4 text-gray-700 sm:text-lg sm:leading-7">
                        <h2 class="text-2xl font-bold mb-6">Create New Borrowing</h2>
                        
                        @if ($errors->any())
                        <div class="bg-red-50 p-4 rounded-md mb-4">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-red-800">There were errors with your submission</h3>
                                    <div class="mt-2 text-sm text-red-700">
                                        <ul class="list-disc pl-5 space-y-1">
                                            @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif

                        <form action="{{ route('borrowings.store') }}" method="POST" class="space-y-6" id="borrowingForm">
                            @csrf
                            
                            {{-- Basic Information --}}
                            <div class="space-y-4">
                                {{-- Asset Field --}}
                                <div>
                                    <label for="asset_search" class="text-sm font-medium text-gray-700">
                                        Asset <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <input type="text" 
                                            id="asset_search" 
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('asset_id') border-red-500 @enderror"
                                            placeholder="Search asset..."
                                            value="{{ old('asset_search')}}">
                                        <input type="hidden" 
                                            name="asset_id" 
                                            id="asset_id"
                                            value="{{ old('asset_id') }}"
                                            required>
                                        <div id="asset_suggestions" 
                                            class="absolute z-10 w-full bg-white shadow-lg rounded-md hidden max-h-60 overflow-y-auto">
                                        </div>
                                        @error('asset_id')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Employee Field --}}
                                <div>
                                    <label for="employee_search" class="text-sm font-medium text-gray-700">
                                        Employee <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <input type="text" 
                                            id="employee_search" 
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('employee_id') border-red-500 @enderror"
                                            placeholder="Search employee..."
                                            value="{{ old('employee_search') }}">
                                        <input type="hidden" 
                                            name="employee_id" 
                                            id="employee_id"
                                            value="{{ old('employee_id') }}"
                                            required>
                                        <div id="employee_suggestions" 
                                            class="absolute z-10 w-full bg-white shadow-lg rounded-md hidden max-h-60 overflow-y-auto">
                                        </div>
                                        @error('employee_id')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Date Fields --}}
                                <div>
                                    <label for="date_of_receipt" class="text-sm font-medium text-gray-700">
                                        Date of Receipt <span class="text-red-500">*</span>
                                    </label>
                                    <input type="date" 
                                        name="date_of_receipt" 
                                        id="date_of_receipt" 
                                        required
                                        value="{{ old('date_of_receipt', date('Y-m-d')) }}"
                                        min="{{ date('Y-m-d') }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('date_of_receipt') border-red-500 @enderror">
                                    @error('date_of_receipt')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="date_of_return" class="text-sm font-medium text-gray-700">
                                        Date of Return <span class="text-red-500">*</span>
                                    </label>
                                    <input type="date" 
                                        name="date_of_return" 
                                        id="date_of_return" 
                                        required
                                        value="{{ old('date_of_return') }}"
                                        min="{{ date('Y-m-d') }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('date_of_return') border-red-500 @enderror">
                                    @error('date_of_return')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <input type="text" id="status" name="status" class="hidden" value="borrowed">
                            <div class="pt-5">
                                <div class="flex justify-end">
                                    <button type="button" 
                                        onclick="history.back()"
                                        class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        Cancel
                                    </button>
                                    <button type="submit"
                                        id="submitBtn"
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
    const assets = @json($assets);          
    const employees = @json($employees);    
    
    // Setup date constraints
    const dateOfReceipt = document.getElementById('date_of_receipt');
    const dateOfReturn = document.getElementById('date_of_return');
    
    dateOfReceipt.addEventListener('change', function() {
        dateOfReturn.min = this.value;
        if (dateOfReturn.value && dateOfReturn.value < this.value) {
            dateOfReturn.value = this.value;
        }
    });
    
    // Setup asset autocomplete
    setupAutocomplete('asset', assets, 'asset_id');
    
    // Setup employee autocomplete
    setupAutocomplete('employee', employees, 'name');
    
    function setupAutocomplete(fieldName, data, displayField) {
        const searchInput = document.getElementById(`${fieldName}_search`);
        const hiddenInput = document.getElementById(`${fieldName}_id`);
        const suggestionBox = document.getElementById(`${fieldName}_suggestions`);
        
        // Restore old values if they exist
        if (hiddenInput.value) {
            const selectedItem = data.find(item => item.id == hiddenInput.value);
            if (selectedItem) {
                searchInput.value = selectedItem[displayField];
            }
        }
        
        searchInput.addEventListener('input', debounce(function() {
            const searchTerm = this.value.toLowerCase();
            
            if (searchTerm.length < 1) {
                suggestionBox.classList.add('hidden');
                hiddenInput.value = '';
                return;
            }
            
            const filteredData = data.filter(item => 
                item[displayField].toString().toLowerCase().includes(searchTerm)
            );
            
            if (filteredData.length > 0) {
                suggestionBox.innerHTML = filteredData.map(item => `
                    <div class="p-2 hover:bg-gray-100 cursor-pointer" 
                        data-id="${item.id}" 
                        data-display="${item[displayField]}">
                        <div class="font-medium">${item[displayField]}</div>
                        ${item.name && item.name !== item[displayField] ? 
                            `<div class="text-sm text-gray-500">${item.name}</div>` : ''}
                    </div>
                `).join('');
                
                suggestionBox.classList.remove('hidden');
                
                suggestionBox.querySelectorAll('div[data-id]').forEach(div => {
                    div.addEventListener('click', function() {
                        searchInput.value = this.dataset.display;
                        hiddenInput.value = this.dataset.id;
                        suggestionBox.classList.add('hidden');
                        validateForm();
                    });
                });
            } else {
                suggestionBox.innerHTML = `
                    <div class="p-2 text-gray-500">No results found</div>
                `;
                suggestionBox.classList.remove('hidden');
                hiddenInput.value = '';
            }
        }, 300));
    }
    

    
    // Hide suggestions when clicking outside
    document.addEventListener('click', function(e) {
        ['asset', 'employee'].forEach(fieldName => {
            const searchInput = document.getElementById(`${fieldName}_search`);
            const suggestionBox = document.getElementById(`${fieldName}_suggestions`);
            
            if (!searchInput.contains(e.target) && !suggestionBox.contains(e.target)) {
                suggestionBox.classList.add('hidden');
            }
        });
    });
    
    function debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func.apply(this, args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }
    
});
</script>

@endsection