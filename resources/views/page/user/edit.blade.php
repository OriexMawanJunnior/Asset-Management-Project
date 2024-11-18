@extends('layouts.blank')

@section('title', 'Users Edit')

@section('content')
    <div class="min-h-screen py-6 flex flex-col justify-center sm:py-12">
        <div class="relative py-3 sm:max-w-xl md:max-w-4xl mx-auto">
            <div class="relative px-4 py-10 bg-white mx-8 md:mx-0 shadow rounded-3xl sm:p-10">
                <div class="max-w-md mx-auto">
                    <div class="divide-y divide-gray-200">
                        <div class="py-8 text-base leading-6 space-y-4 text-gray-700 sm:text-lg sm:leading-7">
                            <h2 class="text-2xl font-bold mb-6">Edit User</h2>
                            <form action="{{route('users.update', $employee->id)}}" method="POST" class="space-y-6">
                                @csrf
                                @method('PUT')
                                
                                {{-- Basic Information --}}
                                <div class="space-y-4">
                                    <div>
                                        <label for="name" class="text-sm font-medium text-gray-700">Name *</label>
                                        <input type="text" name="name" id="name" required
                                            value="{{ old('name', $employee->name) }}"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    </div>
                                    <div>
                                        <label for="organization" class="text-sm font-medium text-gray-700">Organization *</label>
                                        <input type="text" name="organization" id="organization" required
                                            value="{{ old('organization', $employee->organization) }}"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    </div>
                                    <div>
                                        <label for="job_position" class="text-sm font-medium text-gray-700">Job Position *</label>
                                        <input type="text" name="job_position" id="job_position" required
                                            value="{{ old('job_position', $employee->job_position) }}"
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
                                            Update
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
@endsection