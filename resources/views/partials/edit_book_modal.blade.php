<!-- This example requires Tailwind CSS v2.0+ -->
<div class="fixed z-10 inset-0 overflow-y-auto modal-bgr" aria-labelledby="modal-title" role="dialog" aria-modal="true" style="display:none;" id="editBookModal">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">

      <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
  
      <!-- This element is to trick the browser into centering the modal contents. -->
      <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

      <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
          <div>
            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
              <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                Edit book
              </h3>
              <form method="POST" action="{{ route('editBook') }}" enctype="multipart/form-data">
                @csrf
                <x-auth-validation-errors class="mb-4" :errors="$errors" />

                <div class="mt-4">    
                    <x-input id="id" type="hidden" name="id" />
                </div>
                <div class="mt-4">
                    <x-label for="name" :value="__('Name')" />
    
                    <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                </div>
                <div class="mt-4">
                    <x-label for="isbn" :value="__('ISBN')" />
    
                    <x-input id="isbn" class="block mt-1 w-full" type="text" name="isbn" :value="old('isbn')" required autofocus />
                </div>
                <div class="mt-4">
                    <x-label for="year" :value="__('Year')" />
    
                    <x-input id="year" class="block mt-1 w-full" type="number" name="year" :value="old('year')" required autofocus />
                </div>
                <div class="mt-4">
                    <x-label for="description" :value="__('Description')" />
    
                    <textarea cols="48" id="description" name="description" class="resize border rounded-md"></textarea>
                </div>
                <div class="mt-4">
                    <x-label for="coverImage" :value="__('Cover Image')" />
    
                    <img src='' id='image-preview-edit' alt="Editable photo">
                    <div class="col-md-6">
                      <input type="file" class='image-uploader-edit' name="image" class="form-control">
                    </div>
                </div>
    
                <div class="px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                  <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                    Update Book
                  </button>
                  <button type="button" class="closeModal mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                    Cancel
                  </button>
                </div>
            </form>
                </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  