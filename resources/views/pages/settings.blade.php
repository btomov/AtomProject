@include('partials.head')
@include('layouts.navigation');
<x-guest-layout>
  <x-auth-card>
      <x-slot name="logo">
          <a href="/">
              <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
          </a>
      </x-slot>

      <!-- Validation Errors -->
      <x-auth-validation-errors class="mb-4" :errors="$errors" />

      <form method="POST" action="{{ route('editUser') }}">
          @csrf

          <!-- First Name -->
          <div>
              <x-label for="firstName" :value="__('First name')" />
            <input id="firstName" class="block mt-1 w-full" type="text" name="firstName" value={{Auth::user()->firstName}} required autofocus/>
          </div>
          <!-- Last Name -->
          <div>
              <x-label for="lastName" :value="__('Last Name')" />
              <input id="lastName" class="block mt-1 w-full" type="text" name="lastName" value={{Auth::user()->lastName}} required autofocus/>
          </div>
          <!-- Username -->
          <div>
              <x-label for="username" :value="__('Username')" />
              <input id="username" class="block mt-1 w-full" type="text" name="username" value={{Auth::user()->username}} required autofocus/>
          </div>

          <!-- Email Address -->
          <div class="mt-4">
              <x-label for="email" :value="__('Email')" />
              <input id="email" class="block mt-1 w-full" type="email" name="email" value={{Auth::user()->email}} required autofocus/>
          </div>

          <!-- Password -->
          <div class="mt-4">
              <x-label for="password" :value="__('Current Password')" />
              <input id="password" class="block mt-1 w-full" type="password" name="current_password" value='' />
          </div>

          <!-- New Password -->
          <div class="mt-4">
            <x-label for="new_password" :value="__('New Password')" />
            <input id="new_password" class="block mt-1 w-full" type="password" name="new_password" value='' />
        </div>
            <!-- Repeat New Password -->

        <div class="mt-4">
            <x-label for="new_confirm_password" :value="__('Confirm New Password')" />
            <input id="new_confirm_password" class="block mt-1 w-full" type="password" name="new_confirm_password" value='' />
        </div>

        <div class="flex items-center justify-end mt-4">
              <x-button class="ml-4">
                  {{ __('Save Changes') }}
              </x-button>
          </div>
      </form>
  </x-auth-card>
</x-guest-layout>

@include('partials.edit_book_modal')
@include('partials.footer')
