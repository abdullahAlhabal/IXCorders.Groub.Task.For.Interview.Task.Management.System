@props(['value'])

<x-input-label for="birth_date" :value="__('Birth Date')" />

<input type="date" :value="old('birth_date', $user->birth_date)" {{ $attributes->merge(['class' => 'border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm']) }}>
