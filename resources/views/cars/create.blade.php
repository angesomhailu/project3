<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Add New Car') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('cars.store') }}" enctype="multipart/form-data" class="space-y-6">
                        @csrf

                        <div class="grid grid-cols-1 gap-6 mt-4 md:grid-cols-2">
                            <!-- Make -->
                            <div>
                                <x-input-label for="make" :value="__('Make')" />
                                <x-text-input id="make" class="block w-full mt-1" type="text" name="make" :value="old('make')" required />
                                <x-input-error :messages="$errors->get('make')" class="mt-2" />
                            </div>

                            <!-- Model -->
                            <div>
                                <x-input-label for="model" :value="__('Model')" />
                                <x-text-input id="model" class="block w-full mt-1" type="text" name="model" :value="old('model')" required />
                                <x-input-error :messages="$errors->get('model')" class="mt-2" />
                            </div>

                            <!-- Year -->
                            <div>
                                <x-input-label for="year" :value="__('Year')" />
                                <x-text-input id="year" class="block w-full mt-1" type="number" name="year" :value="old('year')" required />
                                <x-input-error :messages="$errors->get('year')" class="mt-2" />
                            </div>

                            <!-- Color -->
                            <div>
                                <x-input-label for="color" :value="__('Color')" />
                                <x-text-input id="color" class="block w-full mt-1" type="text" name="color" :value="old('color')" required />
                                <x-input-error :messages="$errors->get('color')" class="mt-2" />
                            </div>

                            <!-- License Plate -->
                            <div>
                                <x-input-label for="license_plate" :value="__('License Plate')" />
                                <x-text-input id="license_plate" class="block w-full mt-1" type="text" name="license_plate" :value="old('license_plate')" required />
                                <x-input-error :messages="$errors->get('license_plate')" class="mt-2" />
                            </div>

                            <!-- Daily Rate -->
                            <div>
                                <x-input-label for="daily_rate" :value="__('Daily Rate')" />
                                <x-text-input id="daily_rate" class="block w-full mt-1" type="number" step="0.01" name="daily_rate" :value="old('daily_rate')" required />
                                <x-input-error :messages="$errors->get('daily_rate')" class="mt-2" />
                            </div>

                            <!-- Mileage -->
                            <div>
                                <x-input-label for="mileage" :value="__('Mileage')" />
                                <x-text-input id="mileage" class="block w-full mt-1" type="number" name="mileage" :value="old('mileage')" required />
                                <x-input-error :messages="$errors->get('mileage')" class="mt-2" />
                            </div>

                            <!-- Transmission -->
                            <div>
                                <x-input-label for="transmission" :value="__('Transmission')" />
                                <select id="transmission" name="transmission" class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="automatic">Automatic</option>
                                    <option value="manual">Manual</option>
                                </select>
                                <x-input-error :messages="$errors->get('transmission')" class="mt-2" />
                            </div>

                            <!-- Fuel Type -->
                            <div>
                                <x-input-label for="fuel_type" :value="__('Fuel Type')" />
                                <x-text-input id="fuel_type" class="block w-full mt-1" type="text" name="fuel_type" :value="old('fuel_type')" required />
                                <x-input-error :messages="$errors->get('fuel_type')" class="mt-2" />
                            </div>

                            <!-- Seats -->
                            <div>
                                <x-input-label for="seats" :value="__('Number of Seats')" />
                                <x-text-input id="seats" class="block w-full mt-1" type="number" name="seats" :value="old('seats')" required />
                                <x-input-error :messages="$errors->get('seats')" class="mt-2" />
                            </div>

                            <!-- Status -->
                            <div>
                                <x-input-label for="status" :value="__('Status')" />
                                <select id="status" name="status" class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="available">Available</option>
                                    <option value="maintenance">Maintenance</option>
                                    <option value="rented">Rented</option>
                                </select>
                                <x-input-error :messages="$errors->get('status')" class="mt-2" />
                            </div>
                        </div>

                        <!-- Features -->
                        <div class="mt-4">
                            <x-input-label for="features" :value="__('Features')" />
                            <div class="grid grid-cols-2 gap-4 mt-2 md:grid-cols-4">
                                <label class="flex items-center">
                                    <input type="checkbox" name="features[]" value="air_conditioning" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <span class="ml-2">Air Conditioning</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" name="features[]" value="gps" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <span class="ml-2">GPS</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" name="features[]" value="bluetooth" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <span class="ml-2">Bluetooth</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" name="features[]" value="usb" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <span class="ml-2">USB Port</span>
                                </label>
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="mt-4">
                            <x-input-label for="description" :value="__('Description')" />
                            <textarea id="description" name="description" rows="4" class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>{{ old('description') }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <!-- Images -->
                        <div class="mt-4">
                            <x-input-label for="images" :value="__('Images')" />
                            <input id="images" type="file" name="images[]" multiple class="block w-full mt-1" accept="image/*" required />
                            <x-input-error :messages="$errors->get('images')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ml-4">
                                {{ __('Create Car') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>